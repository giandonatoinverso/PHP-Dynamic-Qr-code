<?php
session_start();
require_once 'config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';

// Users class


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file_name = $_POST['profile_pic'];
    $path = 'upload/images/'.$file_name;
    
    if (file_exists($path)) {
        unlink($path);
        $db = getDbInstance();
        $db->where('id', $_SESSION['user_id']);
        $data_to_db['profile_pic'] = '';
        $stat = $db->update('admin_accounts', $data_to_db);
        $message = 'Fail to remove file';
        $code = 302;
        
        if ($stat) {
            $message = 'File successfully removed';
            $code = 200;
        }
        echo json_encode(['message'=>$message]);
        http_response_code($code);
    }
}
