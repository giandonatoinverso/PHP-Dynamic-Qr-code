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
require_once BASE_PATH . '/includes/auth_validate.php';

// Users class
require_once BASE_PATH . '/lib/Users/Users.php';
$Users = new Users();

// User ID for which we are performing operation
$admin_user_id = htmlspecialchars($_GET['admin_user_id'], ENT_QUOTES, 'UTF-8');
$operation = htmlspecialchars($_GET['operation'], ENT_QUOTES, 'UTF-8');
($operation == 'edit') ? $edit = true : $edit = false;

// Serve POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST')
    $Users->edit();

// Select where clause
$db = getDbInstance();
$db->where('id', $admin_user_id);

$admin_account = $db->getOne("admin_accounts");
?>

<!DOCTYPE html>
<html lang="en">
    <title>Edit admin - Qrcode Generator</title>
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
            <h1 class="m-0 text-dark"><?php echo (!$edit) ? 'Add' : 'Update'; ?> User</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <!-- Flash messages -->
    <?php include BASE_PATH.'/includes/flash_messages.php'; ?>
    <!-- /.Flash messages -->
    
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
    
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Enter the requested data</h3>
                </div>
	            <form class="well form-horizontal" action="" method="post" id="contact_form" enctype="multipart/form-data">
	                <div class="card-body">
		                <?php include BASE_PATH . '/forms/users_form.php'; ?>
		            </div>
	                <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>

        </div><!--/. container-fluid -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

<!-- Footer and scripts -->
<?php include './includes/footer.php'; ?>
</body>
</html>
