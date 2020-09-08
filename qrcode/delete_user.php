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

session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';

// Users class
require_once BASE_PATH . '/lib/Users/Users.php';
$Users = new Users();

// Delete a user using user_id
if ($_SERVER['REQUEST_METHOD'] === 'POST')
    $Users->cancel($_POST['del_id']);
