<?php

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

/*
|--------------------------------------------------------------------------
| DATABASE CONFIGURATION
|--------------------------------------------------------------------------
 */

define('DB_HOST', "%HOSTNAME%");
define('DB_USER', "%USERNAME%");
define('DB_PASSWORD', "%PASSWORD%");
define('DB_NAME', "%DATABASE%");

/**
 * Get instance of DB object
 */
function getDbInstance() {
	return new MysqliDb(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
}
