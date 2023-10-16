<?php
session_start();
require_once 'config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';
require_once BASE_PATH . '/lib/Users/Users.php';

$user_instance = new Users();

if ($_SESSION['type'] !== 'super')
    $user_instance->failure('Only a "super admin" account can access the admin listing page', 'Location: index.php');


$edit = false;
if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["edit"]) && $_GET["edit"] == "true" && isset($_GET["id"])) {
    $edit = true;
    $user = $user_instance->getUser($_GET["id"]);
}

if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["del_id"])) {
    $user_instance->deleteUser($_POST["del_id"]);
}

if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["edit"])) {
    if(
        isset($_POST["username"]) &&
        isset($_POST["password"]) &&
        isset($_POST["type"]) &&
        isset($_POST["id"])
    )
        $user_instance->editUser($_POST);
}

if($_SERVER["REQUEST_METHOD"] === "POST" && !isset($_POST["edit"])) {
    if(
        isset($_POST["username"]) &&
        isset($_POST["password"]) &&
        isset($_POST["type"])
    )
        $user_instance->addUser($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">
    <title>Qrcode Generator</title>
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
		                <?php include BASE_PATH . '/forms/form_users.php'; ?>
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
