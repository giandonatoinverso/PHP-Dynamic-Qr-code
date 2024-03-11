<?php
require_once 'config/config.php';

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
            $size = min(max((int)$input_data['size'], 100), 1000);

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

        if(!file_exists(SAVED_QRCODE_DIRECTORY.$data_to_db['filename'].'.'.$data_to_db['format'])){
            $url =
                'https://api.qrserver.com/v1/create-qr-code/?data='.
                $data_to_qrcode.
                '&amp;&size='.$options['size'].'x'.$options['size'].
                '&ecc='.$options['errorCorrectionLevel'].
                '&margin=0&color='.$options['foreground'].
                '&bgcolor='.$options['background'].
                '&qzone=2'.
                '&format='.$data_to_db['format'];

            $content = file_get_contents($url);
            
            $filename = SAVED_QRCODE_DIRECTORY.$data_to_db['filename'].'.'.$data_to_db['format'];
        
            try{
                file_put_contents($filename, $content);
            }
            catch(Exception $e){
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
    public function deleteQrcode($id) {
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
            $this->info('Qr code deleted successfully!');
        else
            $this->failure('Unable to delete qr code');
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
