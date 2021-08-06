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
require_once BASE_PATH . '/lib/Dynamic_Qrcode/Dynamic_Qrcode.php';
$dynamic_qrcode = new Dynamic_Qrcode();
$num_used_for = 1;
$edit = false;
// Serve POST method, After successful insert, redirect to dynamic_qrcodes.php page.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num_used_for = $_POST['num_fields'];
    $dynamic_qrcode->add();
}



?>

<!DOCTYPE html>
<html lang="en">
    <title>Add dynamic - Expression Way</title>
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
            <h1 class="m-0 text-dark">Add qr code</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <!-- Flash message-->
    <?php include BASE_PATH . '/includes/flash_messages.php'; ?>
    <!-- /.Flash message-->
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Introduce los datos requeridos</h3>
            </div>
            <form class="form" action="" method="post" id="dynamic_form" enctype="multipart/form-data">
                <div class="card-body">
                <?php include BASE_PATH.'/forms/add_dynamic_form.php'; ?>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
       </div><!--/. container-fluid -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
<?php include BASE_PATH.'/forms/used_for_template.php'; ?>
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
            link: {
                required: true,
                minlength: 3
            },   
        }
    });
});
</script>
<script>
  $(function () {

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    let i = 1;
    $('#add_more').on('click',function(){
        i++;
        let template_id = $(this).data('template');
        let append_id = $(this).data('append');
        let _template = $("#"+template_id).html();
        $('#'+append_id).append(_template);
        $('#num_fields').val(i);
    });

    $('body').on('click','.remove',function(){
        $(this).closest('.del-row').remove();
   });

  })
</script>
</body>
</html>
