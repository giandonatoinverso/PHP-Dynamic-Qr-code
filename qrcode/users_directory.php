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
$db = getDbInstance();
$select = array('id', 'user_name', 'first_name', 'last_name', 'email', 'profile_pic', 'facebook', 'twitter', 'instagram');

// Search and order
$search_fields = array('first_name', 'last_name', 'email');
require_once BASE_PATH . '/includes/search_order.php';

// Set pagination limit
$db->pageLimit = 15;

// Get current page
$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? 1;

// Get result of the query
$rows = $db->arraybuilder()->paginate('admin_accounts', $page, $select);
$total_pages = $db->totalPages;
?>

<!DOCTYPE html>
<html lang="en">
<title>List admin - Expression Way</title>

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
                            <h1 class="m-0 text-dark">Todos los Usuarios</h1>
                        </div><!-- /.col -->

                        <div class="col-sm-6">
                            
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div><!-- /.content-header -->

            <!-- Flash message-->
            <?php include BASE_PATH . '/includes/flash_messages.php'; ?>
            <!-- /.Flash message-->

            <!-- Filters -->
            <?php $options = $ordering = [
                'first_name' => 'Nombre',
                'last_name' => 'Apellido',
                'email' => 'Email',
            ];

            include BASE_PATH . '/forms/filters.php'; ?>
            <!-- /.Filters -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <!-- Table -->
                    <?php include BASE_PATH . '/forms/users_directory_table.php'; ?>
                    <!-- /.Table -->

                </div><!-- /.container-fluid -->
            </section>
        </div><!-- /.content-wrapper -->

        <!-- Footer and scripts -->
        <?php include './includes/footer.php'; ?>
        <!-- /.Footer and scripts -->
</body>

</html>