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
require_once 'config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = getDbInstance();
    $json = json_decode(file_get_contents('php://input'), true);
    $action = filter_var($json['action'], FILTER_SANITIZE_STRING);
    $params = $json['params'];
    $files = [];
    $type = filter_var($json['type'], FILTER_SANITIZE_STRING);

    if (count($params) == 0) {
        echo json_encode([
            'data' => 'No qrcodes were selected.',
            'status' => 400
        ]);
        exit();
    }

    foreach ($params as $param) {
        $row = $db->where('id', $param);
        $row = $db->getOne("{$type}_qrcodes");
        $files[] = './saved_qrcode/' . $row['qrcode'];
    }

    $zip = new ZipArchive();
    $relative_dir = './saved_qrcode/zip/qrcodes_'. $_SESSION['user_id'] .'.zip';
    unlink($relative_dir);
    $url_path = base_url() . '/saved_qrcode/zip/qrcodes_'. $_SESSION['user_id'] .'.zip';
    $zip->open($relative_dir, ZipArchive::CREATE);

    foreach ($files as $file) {
        $download_file = file_get_contents($file, true);
        $zip->addFromString(basename($file), $download_file);
    }

    $zip->close();
    
    echo json_encode([
        'data' => $url_path,
        'status' => 200
    ]);
    exit();
} else {
    exit('Direct access to this script not allowed.');
}
?>