<?php
/*
|--------------------------------------------------------------------------
| UNIFIED ENVIRONMENT CONFIGURATION
|--------------------------------------------------------------------------
*/

define('DATABASE_HOST', getenv('DATABASE_HOST') ?: 'localhost');
define('DATABASE_PORT', filter_var(getenv('DATABASE_PORT'), FILTER_VALIDATE_INT) ?: 3306);
define('DATABASE_NAME', getenv('DATABASE_NAME') ?: 'qrcode');
define('DATABASE_USER', getenv('DATABASE_USER') ?: 'root');
define('DATABASE_PASSWORD', getenv('DATABASE_PASSWORD') ?: 'root');
define('DATABASE_PREFIX', getenv('DATABASE_PREFIX') !== false ? getenv('DATABASE_PREFIX') : 'qr_');
define('DATABASE_CHARSET', getenv('DATABASE_CHARSET') ?: 'utf8');

define('TYPE', getenv('TYPE') ?: 'local');
define('BASE_URL', getenv('BASE_URL') ?: 'http://localhost');
define('QRCODE_GENERATOR', getenv('QRCODE_GENERATOR') ?: 'external-api.qrserver.com'); // opties: external-api.qrserver.com of internal-chillerlan.qrcode
