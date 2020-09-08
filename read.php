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

include 'qrcode/config/config.php';

//Get DB instance. function is defined in config.php
$db = getDbInstance();
$get_id = htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8'); // I take the id through the GET method

$state = $db->query("SELECT state FROM dynamic_qrcodes WHERE identifier='$get_id'");
$link = $db->query("SELECT link FROM dynamic_qrcodes WHERE identifier='$get_id'");

$update = $db->query("UPDATE dynamic_qrcodes SET scan=scan+1 WHERE identifier='$get_id'");    
    
    if($state[0]['state'] == 'enable'){
        echo '<meta http-equiv="refresh" content="0; URL='.$link[0]['link'].'" />';         // Page refresh with the link obtained
        echo 'Loading...';                                                                  // You can include a custom page to display during the redirect
    }
    else
        echo 'Disabled link';
?>
