<?php
/**
* PHP Dynamic Qr code
*
* @author    Giandonato Inverso <info@giandonatoinverso.it>
* @copyright Copyright (c) 2020-2021
* @license   https://opensource.org/licenses/MIT MIT License
* @link      https://github.com/giandonatoinverso/PHP-Dynamic-Qr-code
* @version   1.0
*/

require_once 'config/config.php';


class Dynamic_Qrcode
{

    /**
     *
     */
    public function __construct()
    {
    }

    /**
     *
     */
    public function __destruct()
    {
    }
    
    /**
     * Set friendly columns\' names to order tables\' entries
     * N.B. This function is called to generate the "list all" table
     */
    public function setOrderingValues()
    {
        $ordering = [
            'id' => 'ID',
            'filename' => 'File Name',
            'identifier' => 'Identifier',
            'link' => 'Link',
            'qrcode' => 'Qr Code',
            'created_at' => 'Created at',
            'updated_at' => 'Updated at'
        ];

        return $ordering;
    }
    
    /**
     * This private function is used by both add () and edit () of this class to initially store in the array that will be sent to the database the:
     * filename, created_at, link
     */
    private function collect()
    {
    
    $data_to_db['filename'] = htmlspecialchars($_POST['filename'], ENT_QUOTES, 'UTF-8');
    $data_to_db['created_at'] = date('Y-m-d H:i:s');
    $data_to_db['link'] = htmlspecialchars($_POST['link'], ENT_QUOTES, 'UTF-8');
    
    return $data_to_db;
    }
    
    /**
     * Set option for qr code like:
     * Error Correction Level, size (default = 100), foreground, background
     * return array of values
     */
    private function setOptions()
    {
        $errorCorrectionLevel = 'L';
    if (isset($_POST['level']) && in_array($_POST['level'], array('L','M','Q','H')))
        $errorCorrectionLevel = $_POST['level'];   
      
    $size = 100;
    if (isset($_POST['size']))
        $size = min(max((int)$_POST['size'], 100), 1000);
    
    $foreground = substr($_POST['foreground'], 1);                      // We eliminate the character "#" for the hexadecimal color
    $background = substr($_POST['background'], 1);
    
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
    public function add()
    {
        $data_to_db['created_by'] = $_SESSION['user_id'];
        $data_to_db = $this->collect();
        $data_to_db['format'] = $_POST['format'];
        // for the identifier we create a random alphanumeric string through the function "randomString" in helpers.php > config.php
        $data_to_db['identifier'] = randomString(rand(5,8));
        $data_to_db['qrcode'] = $data_to_db['filename'].'.'.$data_to_db['format'];
        
        $options = $this->setOptions();

        if(!file_exists(DIRECTORY.$data_to_db['filename'].'.'.$data_to_db['format'])){
            $content = file_get_contents('https://api.qrserver.com/v1/create-qr-code/?data='.READ_PATH.$data_to_db['identifier'].'&amp;&size='.$options['size'].'x'.$options['size'].'&ecc='.$options['errorCorrectionLevel'].'&margin=0&color='.$options['foreground'].'&bgcolor='.$options['background'].'&qzone=2'.'&format='.$data_to_db['format']);
            
            $filename = DIRECTORY.$data_to_db['filename'].'.'.$data_to_db['format'];
        
            try{
                file_put_contents($filename, $content);
            }
            catch(Exception $e){
                $this->failure($e->getMessage());
            }
            
            // If you want you can customide qr code with logo
            //$this->addLogo($data_to_db['qrcode'], $options['optionlogo']);
              
            $db = getDbInstance();
            $last_id = $db->insert('dynamic_qrcodes', $data_to_db);
        }
        else
            $this->failure('You cannot create a new qr code with an existing name on the server!');
        
        if ($last_id){
            $this->success('Qr code added successfully!');
        }
        else{
        echo 'Insert failed: ' . $db->getLastError();
        exit();
        }
    }
    
    /**
     * Edit qr code
     * 
     */
    public function edit()
    {
        $db = getDbInstance();
        
        $dynamic_id = htmlspecialchars($_GET['dynamic_id'], ENT_QUOTES, 'UTF-8');           // get dynamic id
        $old_filename = htmlspecialchars($_GET['filename'], ENT_QUOTES, 'UTF-8');           // get filename
        
        $query = $db->query("SELECT format FROM dynamic_qrcodes WHERE id=$dynamic_id");     // get format
        $format = $query[0]['format'];
        
        $data_to_db = $this->collect();
        $data_to_db['state'] = $_POST['state'];                                             // update link state
        $data_to_db['qrcode'] = $data_to_db['filename'].'.'.$format;                        // update qrcode in db

        if(!file_exists(DIRECTORY.$data_to_db['filename'].'.'.$format) || $data_to_db['filename'] == $old_filename){
            $db->where('id', $dynamic_id);
            $stat = $db->update('dynamic_qrcodes', $data_to_db);
            
            try{
                rename(DIRECTORY.$old_filename.'.'.$format, DIRECTORY.$data_to_db['filename'].'.'.$format);
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
        else{
        echo 'Insert failed: ' . $db->getLastError();
        exit();
        }
    }
    
    /**
     * Delete qr code
     * 
     */
    public function cancel($dynamic_id, $filename)
    {
        if($_SESSION['admin_type']!='super')
            $this->failure('You don\'t have permission to perform this action');
        
        $db = getDbInstance();
        
        $query = $db->query("SELECT format FROM dynamic_qrcodes WHERE id=$dynamic_id");     
        $format = $query[0]['format'];
        
        $db->where('id', $dynamic_id);
        $status = $db->delete('dynamic_qrcodes');
        
        try{
            unlink(DIRECTORY.$filename.'.'.$format);
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
    private function addLogo($src, $logo = 'none')
    {
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
    
                                    /* FLASH MESSAGE */
/* 3 functions for 3 types of messages with different styles defined in the flash_message.php file 
Each function takes a string as input and after a redirection it prints the desired message
*/
    
    
    /**
     * Flash message Failure process
     */
    private function failure($message)
    {
        $_SESSION['failure'] = $message;
        // Redirect to the listing page
        header('Location: dynamic_qrcodes.php');
        // Important! Don't execute the rest put the exit/die.
    	exit();
    }
    
    /**
     * Flash message Success process
     */
    private function success($message)
    {
        $_SESSION['success'] = $message;
        // Redirect to the listing page
        header('Location: dynamic_qrcodes.php');
        // Important! Don't execute the rest put the exit/die.
    	exit();
    }
    
    /**
     * Flash message Info process
     */
    private function info($message)
    {
        $_SESSION['info'] = $message;
        // Redirect to the listing page
        header('Location: dynamic_qrcodes.php');
        // Important! Don't execute the rest put the exit/die.
    	exit();
    }
    
}
?>
