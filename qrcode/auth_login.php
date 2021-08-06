<?php
session_start();
require_once 'config/config.php';
$network  = filter_input(INPUT_GET, 'network', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$_SESSION['network'] = $network;
if (strlen($network)) {
    header('Location: social_auth.php');
} else {
    clearSessions();
    header('Location: login.php');
}
