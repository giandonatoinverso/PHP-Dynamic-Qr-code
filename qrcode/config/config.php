<?php

require_once ('environment.php');

//Note: This file should be included first in every php page.
error_reporting(E_ALL);
ini_set('display_errors', 'On');
define('BASE_PATH', dirname(dirname(__FILE__)));
define('APP_FOLDER', 'simpleadmin');
define('CURRENT_PAGE', basename($_SERVER['REQUEST_URI']));

/* PATH OF SAVED QR CODES */
define('PATH', './saved_qrcode/');                              //You can change the folder where the qr code will be saved
define('DIRECTORY', BASE_PATH.'/saved_qrcode/');

//You can change the page name for the redirect and the search parameter (the default is "id")
define('READ_PATH', $_SERVER['HTTP_HOST'].'/read.php?id=');     

require_once BASE_PATH . '/lib/MysqliDb/MysqliDb.php';
require_once BASE_PATH . '/helpers/helpers.php';


/**
 * Get instance of DB object
 */
function getDbInstance() {
    return new MysqliDb (Array (
        'host' => DATABASE_HOST,
        'username' => DATABASE_USER,
        'password' => DATABASE_PASSWORD,
        'db'=> DATABASE_NAME,
        'port' => DATABASE_PORT,
        'prefix' => DATABASE_PREFIX,
        'charset' => DATABASE_CHARSET));
}
