<?php
include 'config/config.php';

if($_SERVER["REQUEST_METHOD"] !== "GET" || !isset($_GET['id']))
    die("Method not allowed. Check id parameter");

$db = getDbInstance();

$db->where("identifier", $_GET['id']);
$qrcode = $db->getOne("dynamic_qrcodes");

$data = array (
    'scan' => $db->inc(1)
);
$db->where("identifier", $_GET['id']);
$db->update ('dynamic_qrcodes', $data);
    
    if($qrcode['state'] == 'enable'){
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Pragma: no-cache");
        echo '<meta http-equiv="refresh" content="0; URL='.$qrcode['link'].'" />';
        echo 'Loading...'; // You can include a custom page to display during the redirect
    }
    else
        echo 'Disabled link';
?>
