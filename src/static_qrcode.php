<?php
session_start();
require_once 'config/config.php';
require_once BASE_PATH.'/includes/auth_validate.php';
require_once BASE_PATH . '/lib/StaticQrcode/StaticQrcode.php';

$static_qrcode_instance = new StaticQrcode();

$edit = false;
if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["edit"]) && $_GET["edit"] == "true" && isset($_GET["id"])) {
    $edit = true;
    $static_qrcode = $static_qrcode_instance->getQrcode($_GET["id"]);
}

if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["del_id"])) {
    $static_qrcode_instance->deleteQrcode($_POST["del_id"]);
}

if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["edit"])) {
    if(
        isset($_POST["filename"]) &&
        isset($_POST["id_owner"]) &&
        isset($_POST["id"])
    )
        $static_qrcode_instance->editQrcode($_POST);
}

if($_SERVER["REQUEST_METHOD"] === "POST" && !isset($_POST["edit"])) {
    switch($_GET['type']){
        case 'text':         $static_qrcode_instance->textQrcode($_POST['text']);
            break;

        case 'email':        $static_qrcode_instance->emailQrcode($_POST['email'], $_POST['subject'], $_POST['message']);
            break;

        case 'phone':        $static_qrcode_instance->phoneQrcode($_POST['country_code'], $_POST['phone_number']);
            break;

        case 'sms':          $static_qrcode_instance->smsQrcode($_POST['country_code'], $_POST['phone_number'],$_POST['message']);
            break;

        case 'whatsapp':     $static_qrcode_instance->whatsappQrcode($_POST['country_code'], $_POST['phone_number'],$_POST['message']);
            break;

        case 'skype':        $static_qrcode_instance->skypeQrcode($_POST['skype_username']);
            break;

        case 'location':     $static_qrcode_instance->locationQrcode($_POST['latitude'], $_POST['longitude']);
            break;

        case 'vcard':        $static_qrcode_instance->vcardQrcode($_POST['full_name'], $_POST['nickname'], $_POST['email'], $_POST['website'], $_POST['phone'], $_POST['home_phone'], $_POST['work_phone'], $_POST['company'], $_POST['role'], $_POST['categories'], $_POST['note'], $_POST['photo'], $_POST['address'], $_POST['city'], $_POST['post_code'], $_POST['state']);
            break;

        case 'event':        $static_qrcode_instance->eventQrcode($_POST['title'], $_POST['start'], $_POST['end'], $_POST['location'], $_POST['description'], $_POST['url']);
            break;

        case 'bookmark':     $static_qrcode_instance->bookmarkQrcode($_POST['url'], $_POST['title']);
            break;

        case 'wifi':         $static_qrcode_instance->wifiQrcode($_POST['encryption'], $_POST['ssid'], $_POST['password']);
            break;

        case 'paypal':       $static_qrcode_instance->paypalQrcode($_POST['payment_type'], $_POST['email'], $_POST['item_name'], $_POST['item_id'], $_POST['amount'], $_POST['currency'], $_POST['shipping'], $_POST['tax_rate']);
            break;

        case 'bitcoin':      $static_qrcode_instance->bitcoinQrcode($_POST['address'], $_POST['amount'], $_POST['label'], $_POST['message']);
            break;
    }
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
            <h1 class="m-0 text-dark"><?php echo ($edit) ? "Edit" : "Add"; ?> Qr code</h1>
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
                <?php if($edit) {?>
                    <form class="form" action="" method="post" id="static_form" enctype="multipart/form-data">
                        <div class="card-body">
                            <?php include BASE_PATH . '/forms/form_static_edit.php';?>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                <?php } else { ?>
                    <div class="card-body">
                        <?php include BASE_PATH . '/forms/form_static_add.php'; ?>
                    </div>
                <?php } ?>
            </div>
        </div><!--/. container-fluid -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

<!-- Footer and scripts -->
<?php include './includes/footer.php'; ?>

<!-- Page script -->
<script type="text/javascript">
$(document).ready(function(){
   $('#static_form').validate({
       rules: {
            filename: {
                required: true,
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

            $('#start').daterangepicker({
                timePicker: true,
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 2020,
                maxYear: 2030,
                locale: {
                    format: 'YYYY-MM-DD hh:mm A'
                }
            })

            $('#end').daterangepicker({
                timePicker: true,
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 2020,
                maxYear: 2030,
                locale: {
                    format: 'YYYY-MM-DD hh:mm A'
                }
            })

        })
    </script>
</body>
</html>
