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
// require_once BASE_PATH . '/includes/auth_validate.php';

// // Users class
// require_once BASE_PATH . '/lib/Users/Users.php';
// $Users = new Users();

// Get DB instance. i.e instance of MYSQLiDB Library

$user_name = filter_input(INPUT_GET, 'user', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if (!strlen($user_name)) {
    $_SESSION['failure'] = 'User Not Found';
    header('Location:users_directory.php');
}
    $db = getDbInstance();
    $select = array('id', 'user_name','first_name','last_name','email','profile_pic','facebook','twitter','instagram');

    $db->where('user_name', $user_name);
    $profile = $db->objectBuilder()->getOne('admin_accounts');
    if (is_null($profile)) {
        $_SESSION['failure'] = 'User Not Found';
        header('Location:users_directory.php');
    }
    $db->where('created_by', $profile->id);
    $dynamic_qrcodes = $db->objectBuilder()->where('is_default', 0)->orderBy('id', 'desc')->get('dynamic_qrcodes');

    $db->where('created_by', $profile->id);
    $default_qr = $db->objectBuilder()->where('is_default', 1)->orderBy('id', 'desc')->getOne('dynamic_qrcodes');


    $db->where('created_by', $profile->id);
    $static_qrcodes = $db->objectBuilder()->orderBy('id', 'desc')->get('static_qrcodes');

?>

<!DOCTYPE html>
<html lang="en">
<title>List admin - Qrcode Generator</title>

<head>
    <?php include './includes/head.php'; ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include './includes/navbar.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include './includes/sidebar.php'; ?>
        <!-- /.Main Sidebar Container -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">

                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark"></h1>
                        </div><!-- /.col -->

                        <div class="col-sm-6">
                            
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div><!-- /.content-header -->

            <!-- Flash message-->
            <?php include BASE_PATH . '/includes/flash_messages.php'; ?>
            <!-- /.Flash message-->


            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <!-- Table -->
                    <?php include BASE_PATH . '/forms/user_profile_inner.php'; ?>
                    <!-- /.Table -->

                </div><!-- /.container-fluid -->
            </section>
        </div><!-- /.content-wrapper -->

        <!-- Footer and scripts -->
        <?php include './includes/footer.php'; ?>
        <!-- /.Footer and scripts -->
</body>

</html>