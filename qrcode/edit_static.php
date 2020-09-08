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

// Dynamic qrcode class
require_once BASE_PATH . '/lib/Static_Qrcode/Static_Qrcode.php';
$static_qrcode = new Static_Qrcode();

$static_id = htmlspecialchars($_GET['static_id'], ENT_QUOTES, 'UTF-8');
$operation = htmlspecialchars($_GET['operation'], ENT_QUOTES, 'UTF-8');
($operation == 'edit') ? $edit = true : $edit = false;
$db = getDbInstance();

// Handle update request. As the form's action attribute is set to the same script, but 'POST' method, 
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    $static_qrcode->edit();

// If edit variable is set, we are performing the update operation.
if ($edit)
{
    $db->where('id', $static_id);
    // Get data to pre-populate the form.
    $static_qrcode = $db->getOne('static_qrcodes');
}
?>
<!DOCTYPE html>
<html lang="en">
    <title>Edit static - Qrcode Generator</title>
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
            <h1 class="m-0 text-dark">Edit Qr codes</h1>
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
                <form class="form" action="" method="post" id="static_form" enctype="multipart/form-data">
                    <div class="card-body">
                        <?php include BASE_PATH.'/forms/edit_static_form.php'; ?>
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

<!-- Page script -->
<script type="text/javascript">
$(document).ready(function(){
   $('#dynamic_form').validate({
       rules: {
            filename: {
                required: true,
            },
        }
    });
});
</script>
</body>
</html>
