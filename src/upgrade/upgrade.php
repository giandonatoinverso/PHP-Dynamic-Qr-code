<?php
require_once ('../config/environment.php');

$conn = new mysqli(DATABASE_HOST,DATABASE_USER,DATABASE_PASSWORD,DATABASE_NAME, DATABASE_PORT);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Upgrading from version 1.0 to a version >= 2.0.<br>";

$sql = "ALTER TABLE " . DATABASE_PREFIX . "admin_accounts" ." RENAME TO " . DATABASE_PREFIX . "users";
if ($conn->query($sql) === TRUE) {
    echo "The admin_accounts table has been renamed to users successfully.<br>";
} else {
    echo "Error renaming table: " . $conn->error . "<br>";
}

$sql = "ALTER TABLE " . DATABASE_PREFIX . "users" . " CHANGE `user_name` `username` VARCHAR(50) NOT NULL";
if ($conn->query($sql) === TRUE) {
    echo "The user_name column has been renamed to username successfully.<br>";
} else {
    echo "Error renaming column: " . $conn->error . "<br>";
}

$sql = "ALTER TABLE " . DATABASE_PREFIX . "users" . " CHANGE `admin_type` `type` VARCHAR(10) NOT NULL";
if ($conn->query($sql) === TRUE) {
    echo "The admin_type column was renamed to type successfully.<br>";
} else {
    echo "Error renaming column: " . $conn->error . "<br>";
}

$sql = "ALTER TABLE " . DATABASE_PREFIX . "dynamic_qrcodes" . " ADD `id_owner` INT(25) NULL DEFAULT NULL AFTER `id`";
if ($conn->query($sql) === TRUE) {
    echo "The id_owner column has been added to dynamic_qrcodes successfully.<br>";
} else {
    echo "Error adding column: " . $conn->error . "<br>";
}

$sql = "ALTER TABLE " . DATABASE_PREFIX . "static_qrcodes" . " ADD `id_owner` INT(25) NULL DEFAULT NULL AFTER `id`";
if ($conn->query($sql) === TRUE) {
    echo "The id_owner column has been added to static_qrcodes successfully.<br>";
} else {
    echo "Error adding column: " . $conn->error . "<br>";
}

$conn->close();
?>
