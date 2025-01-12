<?php
/*
|--------------------------------------------------------------------------
| DOCKER INSTALLATION
|--------------------------------------------------------------------------
 */

if(is_string(Getenv('TYPE')) && Getenv('TYPE') == "docker") {
    define('DATABASE_HOST', Getenv('DATABASE_HOST'));
    define('DATABASE_PORT', filter_var(Getenv('DATABASE_PORT'), FILTER_VALIDATE_INT));
    define('DATABASE_NAME', Getenv('DATABASE_NAME'));
    define('DATABASE_USER', Getenv('DATABASE_USER'));
    define('DATABASE_PASSWORD', Getenv('DATABASE_PASSWORD'));
    define('DATABASE_PREFIX', Getenv('DATABASE_PREFIX'));
    define('DATABASE_CHARSET', Getenv('DATABASE_CHARSET'));
    define('TYPE', Getenv('TYPE'));
    define('BASE_URL', Getenv('BASE_URL'));
    define("QRCODE_GENERATOR", Getenv('QRCODE_GENERATOR'));
} else {
    define('DATABASE_HOST', "localhost");
    define('DATABASE_PORT', "3306");
    define('DATABASE_NAME', "qrcode");
    define('DATABASE_USER', "root");
    define('DATABASE_PASSWORD', "root");
    define('DATABASE_PREFIX', "qr_");
    define('DATABASE_CHARSET', "utf8");
    define("QRCODE_GENERATOR", "external-api.qrserver.com");  // external-api.qrserver.com  => https://api.qrserver.com/v1/create-qr-code/?data=    //  internal-chillerlan.qrcode => https://github.com/chillerlan/php-qrcode
}
/*
|--------------------------------------------------------------------------
| INSTALLATION WITHOUT CONTAINER
|--------------------------------------------------------------------------
 */

?>
