<?php
require_once BASE_PATH . '/config/config.php';



// Get Input data from query string
$order_by	= filter_input(INPUT_GET, 'order_by', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$order_dir	= filter_input(INPUT_GET, 'order_dir', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$search_str	= filter_input(INPUT_GET, 'search_str', FILTER_SANITIZE_FULL_SPECIAL_CHARS);



// If filter types are not selected we show latest added data first
if (!$order_by) {
	$order_by = 'id';
}

if (!$order_dir) {
	$order_dir = 'Desc';
}

// Start building query according to input parameters
// If search string

if ($search_str) {
    foreach ($search_fields as $value) {
        $db->orwhere($value, '%' . $search_str . '%', 'like');
    }
}

// If order direction option selected
if ($order_dir) {
	$db->orderBy($order_by, $order_dir);
}


 ?>
