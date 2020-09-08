<?php

if (!file_exists('../config/config.php')) {
        header("Location: index.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP Dynamic Qr code - Installer</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700" rel="stylesheet">
	<!-- Font-awesome CSS -->
	<link href="assets/css/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-12 col-md-offset-2">

            <div class="row">
                <div class="col-sm-12 logo-cnt">
                    <img src="assets/img/DynamicQRCode_BlackWhite.png">
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">

                    <div class="install-box">


                        <div class="steps">
                            <div class="step-progress">
                                <div class="step-progress-line" data-now-value="100" data-number-of-steps="5" style="width: 100%;"></div>
                            </div>
                            <div class="step">
                                <div class="step-icon"><i class="fa fa-code"></i></div>
                                <p>Start</p>
                            </div>
                            <div class="step">
                                <div class="step-icon"><i class="fa fa-folder-open"></i></div>
                                <p>Folder Permissions</p>
                            </div>
                            <div class="step">
                                <div class="step-icon"><i class="fa fa-database"></i></div>
                                <p>Database</p>
                            </div>
                            <div class="step active">
                                <div class="step-icon"><i class="fa fa-user"></i></div>
                                <p>Finish</p>
                            </div>
                        </div>

                        <div class="step-contents">
                            <div class="tab-1">
                                <h1 class="step-title">Finish</h1>
                                <div class="form-group">
												
												<p style="font-size: 18px"><strong>The installation was successful.</strong><br> Keep the documentation handy and log in to the control panel by entering the default credentials:<br><br>

<b>superadmin</b><br>
<b>superadmin</b><br><br>

We recommend that you create a new superadmin user and to delete the default one mentioned above.<br><br>

<b>N.B.</b> Remember to delete the "install" folder otherwise you could accidentally start the installation procedure again, deleting all the saves in the database</p>
											</div>

                               <div class="buttons">
                              
                                    <a href="../login.php" class="btn btn-success btn-custom pull-right">Log in</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>
