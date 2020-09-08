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
require_once BASE_PATH . '/lib/ICS/ICS.php';
require_once BASE_PATH . '/lib/vCard/vCard.php';

class Static_Qrcode
{
    private $sData;         // Data for the qr code
    private $sContent;      // Content to be stored in the database

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
     */
    public function setOrderingValues()
    {
        $ordering = [
            'id' => 'ID',
            'filename' => 'File Name',
            'type' => 'Type',
            'content' => 'Content',
            'qrcode' => 'Qr Code',
            'created_at' => 'Created at',
            'updated_at' => 'Updated at'
        ];

        return $ordering;
    }
    
    /**
     * create a qr code of type "text"
     * @string text -> required
     */
    public function textQrcode($text)
    {
        if($text != NULL){
            $this->sData = $text;
            $this->sContent = '<strong>Text:</strong> '.$text;
            $this->add($this->sData, $this->sContent);
        }
        else
            $this->requiredFieldsError();
    }
    
    /**
     * create a qr code of type "emai"
     * @string email -> required
     * @string subject
     * @string message -> required
     */
    public function emailQrcode($email, $subject, $message)
    {
        if($email != NULL && $message != NULL){
            $this->sData = 'MATMSG:TO:'.$email.';SUB:'.$subject.';BODY:'.$message.';';
            $this->sContent = '<strong>Email:</strong> '.$email.'<br>'.'<strong>Subject:</strong> '.$subject.'<br>'.'<strong>Message:</strong> '.$message;
        
            $this->add($this->sData, $this->sContent);
        }
        else
            $this->requiredFieldsError();
    }
    
    /**
     * create a qr code of type "phone"
     * @int country code -> required
     * @string phone number -> required
     */
    public function phoneQrcode($country_code, $phone_number)
    {
        if($phone_number != NULL){
            $this->sData = 'TEL:'.$country_code.$phone_number;  
            $this->sContent = '<strong>Phone number:</strong> '.$country_code.$phone_number;
        
            $this->add($this->sData, $this->sContent);
        }
        else
            $this->requiredFieldsError();
    }
    
    /**
     * create a qr code of type "sms"
     * @int country code -> required
     * @string phone number -> required
     * @string message -> required
     */
    public function smsQrcode($country_code, $phone_number, $message)
    {
        if($phone_number != NULL && $message != NULL){
            $this->sData = 'SMSTO:'.$country_code.$phone_number.':'.$message;  
            $this->sContent = '<strong>Phone number:</strong> '.$country_code.$phone_number.'<br>'.'<strong>Message:</strong> '.$message;
        
            $this->add($this->sData, $this->sContent);
        }
        else
            $this->requiredFieldsError();
    }
    
    /**
     * create a qr code of type "whatsapp"
     * @int country code -> required
     * @string phone number -> required
     * @string message
     */
    public function whatsappQrcode($country_code, $phone_number, $message)
    {
        if($phone_number != NULL){
            $this->sData = 'https://wa.me/'.$country_code.$phone_number.'?text='.$message;  
            $this->sContent = '<strong>Phone number:</strong> '.$country_code.$phone_number.'<br>'.'<strong>Message:</strong> '.$message;
        
            $this->add($this->sData, $this->sContent);
        }
        else
            $this->requiredFieldsError();
    }
    
    /**
     * create a qr code of type "skype"
     * @string skype username -> required
     */
    public function skypeQrcode($skype_username)
    {
        if($skype_username != NULL){
            $this->sData = 'skype:'.$skype_username.'?call';
            $this->sContent = '<strong>Skype username:</strong> '.$skype_username;
        
            $this->add($this->sData, $this->sContent);
        }
        else
            $this->requiredFieldsError();
    }
    
    /**
     * create a qr code of type "location"
     * @int latitude -> required
     * @int longitude -> required
     */
    public function locationQrcode($latitude, $longitude)
    {
        if($latitude != NULL && $longitude != NULL){
            $this->sData = 'GEO:'.$latitude.','.$longitude.';';
            $this->sContent = '<strong>Latitude:</strong> '.$latitude.'<br>'.'<strong>Longitude:</strong> '.$longitude;
        
            $this->add($this->sData, $this->sContent);
        }
        else
            $this->requiredFieldsError();
    }
    
    /**
     * create a qr code of type "vcard"
     * 
     */
    public function vcardQrcode($fullname, $nickname, $email, $website, $phone, $home_phone, $work_phone, $company, $role, $categories, $note, $photo, $address, $city, $postcode, $state)
    {
        if($fullname != NULL && $phone != NULL){
            
            $vcard = new vCard;
            $vcard->name($fullname);
            $vcard->nickName($nickname); 
            $vcard->email($email); 
            $vcard->url($website); 
            $vcard->cellPhone($phone); 
            $vcard->homePhone($home_phone); 
            $vcard->workPhone($work_phone); 
            $vcard->organization($company); 
            $vcard->role($role); 
            $vcard->categories($categories); 
            $vcard->note($note); 
            $vcard->photo($photo); 
            $vcard->address($address, $city, $postcode, $state); 
            $vcard->create();
            
            $this->sData = $vcard->get();
            $this->sContent = '<div class="row"><div class="col-sm-4">';
            
                $this->sContent .= '<strong>Full name:</strong> '.$fullname.'<br>'.'<strong>Nickname:</strong> '.$nickname.'<br>'.'<strong>Email:</strong> '.$email.'<br>'.'<strong>Website:</strong> '.$website.'</div>';
            
            $this->sContent .= '<div class="col-sm-4">';
            
                $this->sContent .= '<strong>Company:</strong> '.$company.'<br>'.'<strong>Role:</strong> '.$role.'<br>'.'<strong>Categories:</strong> '.$categories.'<br>'.'<strong>Note:</strong> '.$note.'</div>';
                
            $this->sContent .= '<div class="col-sm-4">';
            
                $this->sContent .= '<strong>Phone:</strong> '.$phone.'<br>'.'<strong>Home Phone:</strong> '.$home_phone.'<br>'.'<strong>Work phone:</strong> '.$work_phone.'<br>'.'<strong>Address:</strong> '.$address.'&nbsp;'.$city.'&nbsp;'.$postcode.'&nbsp;'.$state.'</div>';
            
            $this->sContent .= '</div>';
        
            $this->add($this->sData, $this->sContent);
        }
        else
            $this->requiredFieldsError();
    }
    
    /**
     * create a qr code of type "event"
     * @string description -> required
     * @string start event -> required
     * @string end event -> required
     * @string location
     * @string summary
     * @string url
     */
    public function eventQrcode($title, $start, $end, $location, $description, $url)
    {
        if($description != NULL && $start != NULL && $end != NULL){
            header('Content-Type: text/calendar; charset=utf-8');
            header('Content-Disposition: attachment; filename=invite.ics');
            
            $ics = new ICS(array(
                'location' => $location,
                'description' => $description,
                'dtstart' => $start,
                'dtend' => $end,
                'summary' => $title,
                'url' => $url
            ));
            
            $this->sData = $ics->to_string();
            $this->sContent = '<div class="row"><div class="col-sm-4">';
            
                $this->sContent .= '<strong>Title:</strong> '.$title.'<br>'.'<strong>Start event:</strong> '.$start.'<br>'.'<strong>End event:</strong> '.$end.'<br></div>';
            
            $this->sContent .= '<div class="col-sm-4">';
            
                $this->sContent .= '<strong>Location:</strong> '.$location.'<br>'.'<strong>Description:</strong> '.$description.'<br>'.'<strong>URL:</strong> '.$url.'</div>';
            
            $this->sContent .= '</div>';
        
            $this->add($this->sData, $this->sContent);
        }
        else
            $this->requiredFieldsError();
    }
    
    /**
     * create a qr code of type "bookmark"
     * @string title
     * @string url -> required
     */
    public function bookmarkQrcode($url, $title)
    {
        if($url != NULL){
            $this->sData = 'MEBKM:TITLE:'.$title.';URL:'.$url.';';  
            $this->sContent = '<strong>Title:</strong> '.$title.'<br>'.'<strong>Url:</strong> '.$url;
        
            $this->add($this->sData, $this->sContent);
        }
        else
            $this->requiredFieldsError();
    }
    
    /**
     * create a qr code of type "wifi"
     * @string encryption -> required
     * @string ssid -> required
     * @string password
     */
    public function wifiQrcode($encryption, $ssid, $password)
    {
        if($ssid != NULL){
            $this->sData = 'WIFI:T:'.$encryption.';S:'.$ssid.';P:'.$password.';';  
            $this->sContent = '<strong>Encryption:</strong> '.$encryption.'<br>'.'<strong>SSID:</strong> '.$ssid.'<br>'.'<strong>Password:</strong> '.$password;
        
            $this->add($this->sData, $this->sContent);
        }
        else
            $this->requiredFieldsError();
    }
    
    /**
     * create a qr code of type "paypal"
     * @string payment type -> required
     * @string email -> required
     * @string item_name -> required
     * @int item_id
     * @int amount -> required
     * @string currency -> required
     * @int shipping
     * @int tax_rate
     */
    public function paypalQrcode($payment_type, $email, $item_name, $item_id, $amount, $currency, $shipping, $tax_rate)
    {
        if($email != NULL && $item_name != NULL && $amount != NULL){
            $this->sData = 'https://www.paypal.com/webapps/xorouter?cmd='.$payment_type.'&business='.$email.'&item_name='.$item_name.'&item_number='.$item_id.'&amount='.$amount.'&currency_code='.$currency.'&shipping='.$shipping.'&tax_rate='.$tax_rate;
            
            $this->sContent = '<div class="row"><div class="col-sm-4">';
            
                $this->sContent .= '<strong>Payment type:</strong> '.$payment_type.'<br>'.'<strong>Email:</strong> '.$email.'<br>'.'<strong>Item name:</strong> '.$item_name.'<br>'.'<strong>Item id:</strong> '.$item_id.'</div>';
            
            $this->sContent .= '<div class="col-sm-4">';
            
                $this->sContent .= '<strong>Amount:</strong> '.$amount.'<br>'.'<strong>Currency:</strong> '.$currency.'<br>'.'<strong>Shipping:</strong> '.$shipping.'<br>'.'<strong>Tax rate:</strong> '.$tax_rate.'</div>';
                
            $this->sContent .= '</div>';

            $this->add($this->sData, $this->sContent);
        }
        else
            $this->requiredFieldsError();
    }
    
    /**
     * create a qr code of type "bitcoin"
     * @string address -> required
     * @int amount -> required
     * @string label
     * @string message
     */
    public function bitcoinQrcode($address, $amount, $label, $message)
    {
        if($address != NULL && $amount != NULL){
            $this->sData = 'bitcoin:'.$address.'?amount='.$amount.'&label='.$label.'&message='.$message;
            $this->sContent = '<strong>BTC address:</strong> '.$address.'<br>'.'<strong>Amount:</strong> '.$amount.'<br>';
            $this->sContent .= '<strong>Label:</strong> '.$label.'<br>'.'<strong>Message:</strong> '.$message;
        
            $this->add($this->sData, $this->sContent);
        }
        else
            $this->requiredFieldsError();
    }
    
    /**
    This private function is used by both add () and edit () of this class to initially store in the array that will be sent to the database the:
     * filename, created_at, type of qr code
     * N.B. If the function is called from edit () the "type" field will not be taken as it cannot be modified
     */
    private function collect()
    {
    
        $data_to_db['filename'] = htmlspecialchars($_POST['filename'], ENT_QUOTES, 'UTF-8');
        $data_to_db['created_at'] = date('Y-m-d H:i:s');
        
        if($_GET['type'] != NULL)
            $data_to_db['type'] = htmlspecialchars($_GET['type']);
    
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
    private function add($sData, $sContent)
    {
        $sData = urlencode($sData);
        $data_to_db['created_by'] = $_SESSION['user_id'];
        $data_to_db = $this->collect();
        $data_to_db['format'] = $_POST['format'];
        $data_to_db['qrcode'] = $data_to_db['filename'].'.'.$data_to_db['format'];
        $data_to_db['content'] = $sContent;
        $options = $this->setOptions();

        if(!file_exists(DIRECTORY.$data_to_db['filename'].'.'.$data_to_db['format'])){
            $content = file_get_contents('https://api.qrserver.com/v1/create-qr-code/?data='.$sData.'&amp;&size='.$options['size'].'x'.$options['size'].'&ecc='.$options['errorCorrectionLevel'].'&margin=0&color='.$options['foreground'].'&bgcolor='.$options['background'].'&qzone=2'.'&format='.$data_to_db['format']);
            
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
            $last_id = $db->insert('static_qrcodes', $data_to_db);
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
        
        $static_id = htmlspecialchars($_GET['static_id'], ENT_QUOTES, 'UTF-8');
        $old_filename = htmlspecialchars($_GET['filename'], ENT_QUOTES, 'UTF-8');
        
        $query = $db->query("SELECT format FROM static_qrcodes WHERE id=$static_id");     // get format
        $format = $query[0]['format'];
        
        $data_to_db = $this->collect();
        
        $data_to_db['qrcode'] = $data_to_db['filename'].'.'.$format;                        // update qrcode in db
        
        if(!file_exists(DIRECTORY.$data_to_db['filename'].'.'.$format) || $data_to_db['filename'] == $old_filename){
            $db->where('id', $static_id);
            $stat = $db->update('static_qrcodes', $data_to_db);
            
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
    public function cancel($static_id, $filename)
    {
        if($_SESSION['admin_type']!='super')
            $this->failure('You don\'t have permission to perform this action');
        
        $db = getDbInstance();
        
        $query = $db->query("SELECT format FROM static_qrcodes WHERE id=$static_id");     // get format
        $format = $query[0]['format'];
        
        $db->where('id', $static_id);
        $status = $db->delete('static_qrcodes');
        
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
    
    /**
     * Flash message Failure process
     */
    private function failure($message)
    {
        $_SESSION['failure'] = $message;
        // Redirect to the listing page
        header('Location: static_qrcodes.php');
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
        header('Location: static_qrcodes.php');
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
        header('Location: static_qrcodes.php');
        // Important! Don't execute the rest put the exit/die.
    	exit();
    }
    
    /**
     * Error message if not filled in all the fields required by the type of the qr code
     */
    private function requiredFieldsError()
    {
        $this->failure('The qr code cannot be created if you do not fill in all the required fields (*)');
    }
    
}
?>
