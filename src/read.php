<?php
include 'config/config.php';

if ($_SERVER["REQUEST_METHOD"] !== "GET" || !isset($_GET['id'])) {
    die("Method not allowed. Check id parameter");
}

// Validation and sanitization of the input UPDATE to php 8.3
$id = filter_input(INPUT_GET, 'id', FILTER_UNSAFE_RAW);
$id = trim(strip_tags($id));

if (!$id) {
    die("Invalid ID parameter");
}

$db = getDbInstance();

// Using prepared statements to avoid SQL injections
$db->where("identifier", $id);
$qrcode = $db->getOne("dynamic_qrcodes");

if (!$qrcode) {
    die("QR code not found");
}

$data = array(
    'scan' => $db->inc(1)
);

$db->where("identifier", $id);
if (!$db->update('dynamic_qrcodes', $data)) {
    die("Failed to update scan count");
}

if ($qrcode['state'] == 'enable') {
    // Validation and escaping of the URL to avoid XSS attacks
    $link = filter_var($qrcode['link'], FILTER_VALIDATE_URL);
    if ($link) {
        echo '<meta http-equiv="refresh" content="0; URL=' . htmlspecialchars($link, ENT_QUOTES, 'UTF-8') . '" />';
        echo 'Loading...'; // You can include a custom page to display during the redirect
    } else {
        echo 'Invalid URL';
    }
} else {
    echo 'Disabled link';
}
?>
