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
require_once BASE_PATH . '/lib/Users/Profile.php';
$profile = new Profile();
$profile_data = $profile->get_user(true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $profile->update();
}
?>

<!DOCTYPE html>
<html lang="en">
<title>Update Mi Perfil - Expression Way</title>

<head>
    <?php include './includes/head.php'; ?>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css' integrity='sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==' crossorigin='anonymous'/>
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
                            <h1 class="m-0 text-dark">Mi Perfil</h1>
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
                            <h3 class="card-title">Edita tu perfilprofile</h3>
                        </div>
                        <form class="well form-horizontal" action="" method="post" id="contact_form" enctype="multipart/form-data">
                            <div class="card-body">
                                <?php include BASE_PATH . '/forms/user_profile_form.php'; ?>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--/. container-fluid -->
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

        <!-- Footer and scripts -->
        <?php include './includes/footer.php'; ?>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js' integrity='sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==' crossorigin='anonymous'></script>
        <!-- Page script -->
        <script>
            $(function () {
                let drEvent = $('.dropify').dropify();
                drEvent.on('dropify.beforeClear', function (event, element) {
                    if (confirm("Do you really want to delete \"" + element.file.name + "\" ?")) {
                        $.post("ajax_remove_img.php", {
                                    profile_pic: element.file.name
                                },
                                function (data, textStatus, jqXHR) {
                                    alert(data.message);
                                }
                            )
                            .fail(function (data,textStatus) {
                                location.reload();
                            });
                    }
                });
            })
        </script>
</body>

</html>