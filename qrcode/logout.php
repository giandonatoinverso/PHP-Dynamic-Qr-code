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

require_once './config/config.php';
session_start();
session_destroy();


if(isset($_COOKIE['series_id']) && isset($_COOKIE['remember_token'])){
	clearAuthCookie();
}
header('Location:index.php');
exit;

 ?>
