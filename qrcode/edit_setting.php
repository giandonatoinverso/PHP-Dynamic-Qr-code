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
require_once BASE_PATH.'/includes/auth_validate.php';
check_super();

// Dynamic qrcode class
require_once BASE_PATH . '/lib/Setting/Setting.php';
$setting = new Setting;

$operation = htmlspecialchars($_GET['operation'], ENT_QUOTES, 'UTF-8');
$edit = ($operation == 'edit');
$db = getDbInstance();

// Handle update request. As the form's action attribute is set to the same script, but 'POST' method,
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $setting->edit();
}

// If edit variable is set, we are performing the update operation.
if ($edit) {
    $dynamic_id = htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');

    $db->where('id', $dynamic_id);
    // Get data to pre-populate the form.
    $setting_data = $db->getOne('social_setting');
}
?>
<!DOCTYPE html>
<html lang="en">
    <title>Edit dynamic - Expression Way</title>
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
            <h1 class="m-0 text-dark">Editar códios QR</h1>
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
                    <h3 class="card-title">Introduce los datos requeridos</h3>
                </div>
                <form class="form" action="" method="post" id="dynamic_form" enctype="multipart/form-data">
                    <div class="card-body">
                        <?php include BASE_PATH.'/forms/setting_form.php'; ?>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div><!--/. container-fluid -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

<!-- Footer and scripts -->
<?php include './includes/footer.php'; ?>

<!-- Page script -->
<script type="text/javascript">

</script>
</body>
</html>
