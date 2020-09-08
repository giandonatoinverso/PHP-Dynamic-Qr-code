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

// Serve POST method, After successful insert, redirect to static_qrcodes.php page.
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    switch($_GET['type']){
        case 'text':         $static_qrcode->textQrcode($_POST['text']);
                                break;
                        
        case 'email':        $static_qrcode->emailQrcode($_POST['email'], $_POST['subject'], $_POST['message']);
                                break; 
                        
        case 'phone':        $static_qrcode->phoneQrcode($_POST['country_code'], $_POST['phone_number']);
                                break;  
                                
        case 'sms':          $static_qrcode->smsQrcode($_POST['country_code'], $_POST['phone_number'],$_POST['message']);
                                break; 
                                
        case 'whatsapp':     $static_qrcode->whatsappQrcode($_POST['country_code'], $_POST['phone_number'],$_POST['message']);
                                break;
                                
        case 'skype':        $static_qrcode->skypeQrcode($_POST['skype_username']);
                                break;
                        
        case 'location':     $static_qrcode->locationQrcode($_POST['latitude'], $_POST['longitude']);
                                break;
                                
        case 'vcard':        $static_qrcode->vcardQrcode($_POST['full_name'], $_POST['nickname'], $_POST['email'], $_POST['website'], $_POST['phone'], $_POST['home_phone'], $_POST['work_phone'], $_POST['company'], $_POST['role'], $_POST['categories'], $_POST['note'], $_POST['photo'], $_POST['address'], $_POST['city'], $_POST['post_code'], $_POST['state']);
                                break;
                                
        case 'event':        $static_qrcode->eventQrcode($_POST['title'], $_POST['start'], $_POST['end'], $_POST['location'], $_POST['description'], $_POST['url']);
                                break;
                                
        case 'bookmark':     $static_qrcode->bookmarkQrcode($_POST['url'], $_POST['title']);
                                break;
                                
        case 'wifi':         $static_qrcode->wifiQrcode($_POST['encryption'], $_POST['ssid'], $_POST['password']);
                                break;
                                
        case 'paypal':       $static_qrcode->paypalQrcode($_POST['payment_type'], $_POST['email'], $_POST['item_name'], $_POST['item_id'], $_POST['amount'], $_POST['currency'], $_POST['shipping'], $_POST['tax_rate']);
                                break;
                                
        case 'bitcoin':      $static_qrcode->bitcoinQrcode($_POST['address'], $_POST['amount'], $_POST['label'], $_POST['message']);
                                  break;
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
    <title>Add static - Qrcode Generator</title>
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
                <h3 class="card-title">Enter the requested data</h3>
            </div>
                <div class="card-body">
                <?php include BASE_PATH.'/forms/add_static_form.php'; ?>
                </div>
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
