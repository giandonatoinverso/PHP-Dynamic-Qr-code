<?php
require_once 'config/config.php';
require_once BASE_PATH . '/lib/ICS/ICS.php';
require_once BASE_PATH . '/lib/vCard/vCard.php';
require_once BASE_PATH . '/lib/Qrcode/Qrcode.php';

class StaticQrcode {
    private $sData;         // Data for the qr code
    private $sContent;      // Content to be stored in the database
    private Qrcode $qrcode_instance;
    /**
     *
     */
    public function __construct() {
        $this->qrcode_instance = new Qrcode("static");
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
            'id_owner' => 'Owner',
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
            $this->sContent = 'Text: '.$text;
            $this->addQrcode("text");
        }
        else
            $this->requiredFieldsError();
    }
    
    /**
     * create a qr code of type "email"
     * @string email -> required
     * @string subject
     * @string message -> required
     */
    public function emailQrcode($email, $subject, $message)
    {
        if($email != NULL && $message != NULL){
            $this->sData = 'MATMSG:TO:'.$email.';SUB:'.$subject.';BODY:'.$message.';';
            $this->sContent = 'Email: '.$email.'<br>'.'Subject: '.$subject.'<br>'.'Message: '.$message;

            $this->addQrcode("email");
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
            $this->sContent = 'Phone number: '.$country_code.$phone_number;

            $this->addQrcode("phone");
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
            $this->sContent = 'Phone number: '.$country_code.$phone_number.'<br>'.'Message: '.$message;

            $this->addQrcode("sms");
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
            $this->sContent = 'Phone number: '.$country_code.$phone_number.'<br>'.'Message: '.$message;

            $this->addQrcode("whatsapp");
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
            $this->sContent = 'Skype username: '.$skype_username;

            $this->addQrcode("skype");
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
            $this->sContent = 'Latitude: '.$latitude.'<br>'.'Longitude: '.$longitude;

            $this->addQrcode("location");
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
            
                $this->sContent .= 'Full name: '.$fullname.'<br>'.'Nickname: '.$nickname.'<br>'.'Email: '.$email.'<br>'.'Website: '.$website.'</div>';
            
            $this->sContent .= '<div class="col-sm-4">';
            
                $this->sContent .= 'Company: '.$company.'<br>'.'Role: '.$role.'<br>'.'Categories: '.$categories.'<br>'.'Note: '.$note.'</div>';
                
            $this->sContent .= '<div class="col-sm-4">';
            
                $this->sContent .= 'Phone: '.$phone.'<br>'.'Home Phone: '.$home_phone.'<br>'.'Work phone: '.$work_phone.'<br>'.'Address: '.$address.'&nbsp;'.$city.'&nbsp;'.$postcode.'&nbsp;'.$state.'</div>';
            
            $this->sContent .= '</div>';

            $this->addQrcode("vcard");
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
            
                $this->sContent .= 'Title: '.$title.'<br>'.'Start event: '.$start.'<br>'.'End event: '.$end.'<br></div>';
            
            $this->sContent .= '<div class="col-sm-4">';
            
                $this->sContent .= 'Location: '.$location.'<br>'.'Description: '.$description.'<br>'.'URL: '.$url.'</div>';
            
            $this->sContent .= '</div>';

            $this->addQrcode("event");
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
            $this->sContent = 'Title: '.$title.'<br>'.'Url: '.$url;

            $this->addQrcode("bookmark");
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
            $this->sContent = 'Encryption: '.$encryption.'<br>'.'SSID: '.$ssid.'<br>'.'Password: '.$password;

            $this->addQrcode("wifi");
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
            
                $this->sContent .= 'Payment type: '.$payment_type.'<br>'.'Email: '.$email.'<br>'.'Item name: '.$item_name.'<br>'.'Item id: '.$item_id.'</div>';
            
            $this->sContent .= '<div class="col-sm-4">';
            
                $this->sContent .= 'Amount: '.$amount.'<br>'.'Currency: '.$currency.'<br>'.'Shipping: '.$shipping.'<br>'.'Tax rate: '.$tax_rate.'</div>';
                
            $this->sContent .= '</div>';

            $this->addQrcode("paypal");
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
            $this->sContent = 'BTC address: '.$address.'<br>'.'Amount: '.$amount.'<br>';
            $this->sContent .= 'Label: '.$label.'<br>'.'Message: '.$message;
        
            $this->addQrcode("bitcoin");
        }
        else
            $this->requiredFieldsError();
    }

    public function getQrcode($id) {
        return $this->qrcode_instance->getQrcode($id);
    }
    
    /**
     * Add qr code
     * Check out http://goqr.me/api/ for more information
     * We save the file obtained with the chosen name and in the selected folder
     * We save into db the url of qrcode image
     */
    private function addQrcode($type) {
        if($_POST['id_owner'] != "")
            $data_to_db['id_owner'] = $_POST['id_owner'];
        else
            $data_to_db['id_owner'] = NULL;
        $data_to_db['created_at'] = date('Y-m-d H:i:s');
        $data_to_db['created_by'] = $_SESSION['user_id'];
        $data_to_db['filename'] = htmlspecialchars($_POST['filename'], ENT_QUOTES, 'UTF-8');
        $data_to_db['created_at'] = date('Y-m-d H:i:s');
        $data_to_db['type'] = $type;
        $data_to_db['format'] = $_POST['format'];
        $data_to_db['qrcode'] = $data_to_db['filename'].'.'.$data_to_db['format'];
        $data_to_db['content'] = htmlspecialchars($this->sContent, ENT_QUOTES, 'UTF-8');

        if(isset($_POST['level']))
            $input_data["level"] = $_POST['level'];

        if(isset($_POST['size']))
            $input_data["size"] = $_POST['size'];

        $input_data["foreground"] = $_POST['foreground'];
        $input_data["background"] = $_POST['background'];

        $data_to_qrcode = urlencode($this->sData);

        $this->qrcode_instance->addQrcode($input_data, $data_to_db, $data_to_qrcode);
    }
    
    /**
     * Edit qr code
     * 
     */
    public function editQrcode($input_data) {
        if($input_data['id_owner'] != "")
            $data_to_db['id_owner'] = $input_data['id_owner'];
        else
            $data_to_db['id_owner'] = NULL;
        $data_to_db['filename'] = htmlspecialchars($input_data['filename'], ENT_QUOTES, 'UTF-8');
        $data_to_db['created_at'] = date('Y-m-d H:i:s');

        $this->qrcode_instance->editQrcode($input_data, $data_to_db);
    }
    
    /**
     * Delete qr code
     * 
     */
    public function deleteQrcode($id, $async = false) {
        if($_SESSION['type'] === "super") {
            $this->qrcode_instance->deleteQrcode($id, $async);
        } else if ($_SESSION['type'] === "admin") {
            $qrcode = $this->getQrcode($id);

            if(!isset($qrcode["id_owner"]))
                $this->failure("You cannot delete this qrcode");

            require_once BASE_PATH . '/lib/Users/Users.php';
            $users = new Users();
            $user = $users->getUser($_SESSION['user_id']);

            if($user["id"] === $qrcode["id_owner"])
                $this->qrcode_instance->deleteQrcode($id, $async);
            else
                $this->failure("You cannot delete this qrcode because it's of another user");
        }
    }
    
    /**
     * Flash message Failure process
     */
    private function failure($message) {
        $_SESSION['failure'] = $message;
        header('Location: static_qrcodes.php');
    	exit();
    }
    
    /**
     * Flash message Success process
     */
    private function success($message) {
        $_SESSION['success'] = $message;
        header('Location: static_qrcodes.php');
    	exit();
    }
    
    /**
     * Flash message Info process
     */
    private function info($message) {
        $_SESSION['info'] = $message;
        header('Location: static_qrcodes.php');
    	exit();
    }
    
    /**
     * Error message if not filled in all the fields required by the type of the qr code
     */
    private function requiredFieldsError() {
        $this->failure('The qr code cannot be created if you do not fill in all the required fields (*)');
    }

    public function debug($data) {
        echo '<pre>' . var_export($data, true) . '</pre>';
        exit();
    }
}
?>
