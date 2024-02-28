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
$db->update (DATABASE_PREFIX.'dynamic_qrcodes', $data);
    
    if($qrcode['state'] == 'enable'){
        echo '<meta http-equiv="refresh" content="0; URL='.$qrcode['link'].'" />';
        echo 'Loading...'; // You can include a custom page to display during the redirect
    }
    else
        echo 'Disabled link';
?>
