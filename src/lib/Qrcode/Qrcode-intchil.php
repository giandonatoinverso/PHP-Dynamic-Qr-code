<?php
require_once 'config/config.php';
use chillerlan\QRCode\Common\EccLevel;
use chillerlan\QRCode\Common\Version;
use chillerlan\QRCode\QRCode as QRCodeEx;
use chillerlan\QRCode\QROptions;
use chillerlan\QRCode\Data\QRMatrix;
use chillerlan\QRCode\Output\QRImagick;
use chillerlan\QRCode\Output\QRGdImagePNG;
use chillerlan\QRCode\Output\QRGdImageJPEG;
use chillerlan\QRCode\Output\QREps;
use chillerlan\QRCode\Output\QRMarkupSVG;
use chillerlan\QRCode\Output\QRCodeOutputException;
use chillerlan\QRCode\Output\QROutputInterface;
use chillerlan\Settings\SettingsContainerInterface;

require_once __DIR__.'/../../vendor/autoload.php';

class Qrcode {
    private string $table;
    private string $redirect_url;

    /**
     *
     */
    public function __construct($type) {
        if($type === "static") {
            $this->table = "static_qrcodes";
            $this->redirect_url = "static_qrcodes.php";
        } else if($type === "dynamic") {
            $this->table = "dynamic_qrcodes";
            $this->redirect_url = "dynamic_qrcodes.php";
        } else {
            $this->redirect_url = "index.php";
            $this->failure("Type not allowed");
        }
    }

    /**
     *
     */
    public function __destruct()
    {
    }

    public function getQrcode($id) {
        $db = getDbInstance();

        $db->where('id', $id);
        $result = $db->getOne($this->table);

        if($result !== NULL)
            return $result;
        else
            $this->failure("Qrcode not found");
    }
    
    /**
     * Set option for qr code like:
     * Error Correction Level, size (default = 100), foreground, background
     * return array of values
     */
    private function setOptions($input_data) {
        $errorCorrectionLevel = 'L';

        if (isset($input_data['level']) && in_array($input_data['level'], array('L','M','Q','H')))
            $errorCorrectionLevel = $input_data['level'];
      
        $size = 100;
        if (isset($input_data['size']))
            $size = min(max((int)$input_data['size'], 100), 2000);

        //character # deleted
        $foreground = substr($input_data['foreground'], 1);
        $background = substr($input_data['background'], 1);

        //$logo = $_POST['optionlogo'];
           
        return array(
            "errorCorrectionLevel" => $errorCorrectionLevel,
            "size" => $size,
            "foreground" => $foreground,
            "background" => $background,
            //"optionlogo" => $logo,
        );
    }
    
    /**
     * Add qr code
     * Check out http://goqr.me/api/ for more information
     * We save the file obtained with the chosen name and in the selected folder
     * We save into db the url of qrcode image
     */
    public function addQrcode($input_data, $data_to_db, $data_to_qrcode) {
        $options = $this->setOptions($input_data);

        $outputInterface = QRGdImagePNG::class;
        $imageFormat = strtolower($data_to_db['format']);
        $fileExt = $imageFormat;
        $forceBlackWhite = false;


         switch ($imageFormat)
         {
             case 'png':
                 $outputInterface = QRGdImagePNG::class;
                 $imageFormat = 'png';
                 break;
             case 'gif':
                 $outputInterface = QRImagick::class;
                 $imageFormat = 'gif';
                 break;
             case 'jpg':
                 $outputInterface = QRImagick::class;
                 $imageFormat = 'jpg';
                 break;
             case 'jpeg':
                 $outputInterface = QRImagick::class;
                 $imageFormat = 'jpeg';
                 break;
             case 'svg':
                 # $outputInterface = QRImagick::class;
                 $outputInterface = QRMarkupSVG::class;
                 $imageFormat = 'svg';
                 break;
             case 'svgbw':
                 $outputInterface = QRMarkupSVG::class;
                 $imageFormat = 'svg';
                 $fileExt = 'svg';
                 $forceBlackWhite = true;
                 $data_to_db['format'] = $fileExt;
                 $data_to_db['qrcode'] = str_replace('.svgbw', '.svg', $data_to_db['qrcode']);
                 break;
             case 'eps':
                 $outputInterface = QREps::class;
                 $imageFormat = 'eps';
                 break;
         }


        if(!file_exists(SAVED_QRCODE_DIRECTORY.$data_to_db['filename'].'.' . $fileExt)){
            $eccLevel = constant(EccLevel::class.'::'.strtoupper($options['errorCorrectionLevel']));

            $qroptions                       = new QROptions;
            $qroptions->outputInterface      = $outputInterface;
            $qroptions->outputBase64         = false;
            $qroptions->eccLevel             = $eccLevel;
            $qroptions->quietzoneSize        = 2;

            $moduleValues = [
                // finder
                QRMatrix::M_FINDER_DARK    => $options['foreground'],
                QRMatrix::M_FINDER_DOT     => $options['foreground'],
                QRMatrix::M_FINDER         => $options['background'],
                // alignment
                QRMatrix::M_ALIGNMENT_DARK => $options['foreground'],
                QRMatrix::M_ALIGNMENT      => $options['background'],
                // timing
                QRMatrix::M_TIMING_DARK    => $options['foreground'],
                QRMatrix::M_TIMING         => $options['background'],
                // format
                QRMatrix::M_FORMAT_DARK    => $options['foreground'],
                QRMatrix::M_FORMAT         => $options['background'],
                // version
                QRMatrix::M_VERSION_DARK   => $options['foreground'],
                QRMatrix::M_VERSION        => $options['background'],
                // data
                QRMatrix::M_DATA_DARK      => $options['foreground'],
                QRMatrix::M_DATA           => $options['background'],
                // darkmodule
                QRMatrix::M_DARKMODULE     => $options['foreground'],
                // separator
                QRMatrix::M_SEPARATOR      => $options['background'],
                // quietzone
                QRMatrix::M_QUIETZONE      => $options['background'],
            ];

            if(in_array($data_to_db['format'], ['png', 'jpg', 'gif'], true))
            {
                $moduleValues = array_map(function($v)
                {
                    if(preg_match('/[a-f\d]{6}/i', $v) === 1)
                    {
                        return array_map('hexdec', str_split($v, 2));
                    }

                    return null;
                }, $moduleValues);

                $qroptions->moduleValues = $moduleValues;
            }
            else
            {
                $moduleValues = array_map(function($v)
                {
                    if(preg_match('/[a-f\d]{6}/i', $v) === 1)
                    {
                        return '#' . $v ;
                    }

                    return null;
                }, $moduleValues);

                $qroptions->moduleValues = $moduleValues;
            }

            if ($outputInterface === QRMarkupSVG::class)
            {
                $qroptions->version              = Version::AUTO;
                // if set to false, the light modules won't be rendered
                $qroptions->drawLightModules     = true;
                $qroptions->svgUseFillAttributes = false;
                // draw the modules as circles isntead of squares
                $qroptions->drawCircularModules  = true;
                $qroptions->circleRadius         = 0.4;
                // connect paths
                $qroptions->connectPaths         = true;
                // keep modules of these types as square
                $qroptions->keepAsSquare = [
                    QRMatrix::M_FINDER_DARK,
                    QRMatrix::M_FINDER_DOT,
                    QRMatrix::M_ALIGNMENT_DARK,
                ];
                
                if($forceBlackWhite)
                {
                    $qroptions->drawLightModules     = false;
                    $qroptions->drawCircularModules  = false;
                    // https://developer.mozilla.org/en-US/docs/Web/SVG/Element/linearGradient
                    $qroptions->svgDefs = '
                        <linearGradient id="rainbow" x1="1" y2="1">
                            <stop stop-color="#' . $options['foreground'] . '" offset="0"/>
                            <stop stop-color="#' . $options['foreground'] . '" offset="1"/>
                        </linearGradient>
                        <style><![CDATA[
                            .dark{fill: url(#rainbow);}
                            .light{fill: #eee;}
                        ]]></style>';
                }
                else
                {
                  // https://developer.mozilla.org/en-US/docs/Web/SVG/Element/linearGradient
                    $qroptions->svgDefs             = '
                        <linearGradient id="rainbow" x1="1" y2="1">
                            <stop stop-color="#e2453c" offset="0"/>
                            <stop stop-color="#e07e39" offset="0.2"/>
                            <stop stop-color="#e5d667" offset="0.4"/>
                            <stop stop-color="#51b95b" offset="0.6"/>
                            <stop stop-color="#1e72b7" offset="0.8"/>
                            <stop stop-color="#6f5ba7" offset="1"/>
                        </linearGradient>
                        <style><![CDATA[
                            .dark{fill: url(#rainbow);}
                            .light{fill: #eee;}
                        ]]></style>';
                }
            }
            else
            {
                $qroptions->version         = Version::AUTO;
                $qroptions->scale           = 20;
                $qroptions->quality         = 83;
            }

            if ($outputInterface === QRImagick::class)
            {
                $qroptions->imagickFormat       = $imageFormat;
                $qroptions->returnResource = true;
                $imagick = (new QRCodeEx($qroptions))->render(urldecode($data_to_qrcode));
                $imagick->scaleImage($options['size'], $options['size'], true);
                $content = $imagick->getImageBlob();
                $imagick->destroy();
            }
            else
            {
                $content = (new QRCodeEx($qroptions))->render(urldecode($data_to_qrcode));
            }

            $filename = SAVED_QRCODE_DIRECTORY.$data_to_db['filename'].'.' . $fileExt;

            try
            {
                file_put_contents($filename, $content);
                if ($outputInterface !== QRImagick::class &&
                    $outputInterface !== QRMarkupSVG::class)
                {
                    $imagick = new \Imagick(realpath($filename));
                    $imagick->resizeImage($options['size'], $options['size'], imagick::FILTER_LANCZOS, 1, false);
                    $imagick->writeImage($filename);
                    $imagick->destroy();
                }
            }
            catch(Exception $e)
            {
                $this->failure($e->getMessage());
            }

            // If you want you can customi<e qr code with logo
            //$this->addLogo($data_to_db['qrcode'], $options['optionlogo']);
              
            $db = getDbInstance();
            $last_id = $db->insert($this->table, $data_to_db);
        }
        else
            $this->failure('You cannot create a new qr code with an existing name on the server!');
        
        if ($last_id){
            $this->success('Qr code added successfully!');
        }
        else {
            $this->failure('Insert failed: ' . $db->getLastError());
        }
    }
    
    /**
     * Edit qr code
     * 
     */
    public function editQrcode($input_data, $data_to_db) {
        $db = getDbInstance();
        $old_qrcode = $this->getQrcode($input_data["id"]);

        $data_to_db['qrcode'] = $data_to_db['filename'].'.'.$old_qrcode["format"];

        if(!file_exists(SAVED_QRCODE_DIRECTORY.$data_to_db['filename'].'.'.$old_qrcode["format"]) || $data_to_db['filename'] == $input_data["old_filename"]){
            $db->where('id', $input_data["id"]);
            $stat = $db->update($this->table, $data_to_db);
            
            try{
                rename(SAVED_QRCODE_DIRECTORY.$old_qrcode["qrcode"], SAVED_QRCODE_DIRECTORY.$data_to_db['filename'].'.'.$old_qrcode["format"]);
            }
            catch(Exception $e){
                $this->failure($e->getMessage());
            }
        }
        else
            $this->failure('You cannot edit a qr code with an existing name on the server!');
        
        if ($stat){
            $this->success('Qr code updated successfully!');
        }
        else {
            $this->failure('Insert failed: ' . $db->getLastError());
        }
    }

    
    /**
     * Delete qr code
     * 
     */
    public function deleteQrcode($id, $async = false) {
        $db = getDbInstance();

        $qrcode = $this->getQrcode($id);

        $db->where('id', $id);
        $status = $db->delete($this->table);
        
        try{
            unlink(SAVED_QRCODE_DIRECTORY.$qrcode["filename"].'.'.$qrcode["format"]);
        }
        catch(Exception $e){
            $this->failure($e->getMessage());
        }

        if ($status)
            if (!$async) {
                $this->info('Qr code deleted successfully!');
            }
        else
            if (!$async) {
                $this->failure('Unable to delete qr code');
            }
    }
    
    /**
     * Add logo
     * IMPORTANT: I do not recommend to use this option because there may be problems with the scanning of the qr code as some readers may not recognize the code
     */
    private function addLogo($src, $logo = 'none') {
        try
        {
            if($logo != 'none')
            {
                $logo = imagecreatefrompng($_SERVER['HTTP_HOST'].'/admin'.$logo);
                $QR = imagecreatefrompng(BASE_PATH.$src);
            
	            $QR_width = imagesx($QR);
	            $QR_height = imagesy($QR);
	
	            $logo_width = imagesx($logo);
	            $logo_height = imagesy($logo);
	
	            // Scale logo to fit in the QR Code
	            $logo_qr_width = $QR_width/3;
	            $scale = $logo_width/$logo_qr_width;
	            $logo_qr_height = $logo_height/$scale;
	            
	            // You can try also with imagecopymerge() with same arguments
	            imagecopyresampled($QR, $logo, $QR_width/3, $QR_height/3, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
	    
	            //$output = Set directory for saving image;
	            header('Content-Type: image/png'); 
	            imagepng($QR /*, $output*/); 
                imagedestroy($QR);
            }
        }
        catch(Exception $e)
        {
            $this->failure($e->getMessage());
        }
    }

    /**
     * Flash message Failure process
     */
    private function failure($message) {
        $_SESSION['failure'] = $message;
        header('Location: ' . $this->redirect_url);
    	exit();
    }
    
    /**
     * Flash message Success process
     */
    private function success($message) {
        $_SESSION['success'] = $message;
        header('Location: ' . $this->redirect_url);
    	exit();
    }
    
    /**
     * Flash message Info process
     */
    private function info($message) {
        $_SESSION['info'] = $message;
        header('Location: ' . $this->redirect_url);
    	exit();
    }

    public function debug($data) {
        echo '<pre>' . var_export($data, true) . '</pre>';
        exit();
    }
}
?>
