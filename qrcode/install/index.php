<?php

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
                    <!--<h1>PHP Dynamic Qr code Generator</h1>-->
                    <img src="assets/img/DynamicQRCode_BlackWhite.png">
                    <!--<p>Welcome to the Installer</p>-->
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">

                    <div class="install-box">


                        <div class="steps">
                            <div class="step-progress">
                                <div class="step-progress-line" data-now-value="28" data-number-of-steps="5" style="width: 28%;"></div>
                            </div>
                            <div class="step active">
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
                            <div class="step">
                                <div class="step-icon"><i class="fa fa-user"></i></div>
                                <p>Finish</p>
                            </div>
                        </div>

                        <div class="step-contents">
                            <div class="tab-1">
                                <h1 class="step-title">System Requirements</h1>
                                <div class="row">
                                    <div class="col-sm-11">
                                        <p>
                                            <span class="req-span"><i class="fa fa-circle"></i>&nbsp;&nbsp;&nbsp;PHP Version:</span>
                                            <?php if (phpversion() >= 5.6): ?>
                                                <strong class="color-success"><?php echo phpversion(); ?></strong>
                                            <?php else: ?>
                                                <strong class="color-danger"><?php echo phpversion(); ?>&nbsp;<small>(Your PHP version must be 5.6 or greater)</small>
                                                </strong>
                                            <?php endif; ?>
                                        </p>
                                        <p>
                                            <span class="req-span"><i class="fa fa-circle"></i>&nbsp;&nbsp;&nbsp;cURL PHP Extension:</span>
                                            <?php if (extension_loaded('curl')): ?>
                                                <strong class="color-success">Enabled</strong>
                                            <?php else: ?>
                                                <strong class="color-danger">Disabled&nbsp;<small>(You should enable "cURL" in your server)</small>
                                                </strong>
                                            <?php endif; ?>
                                        </p>

                                    </div>
                                    <div class="col-sm-1 text-right">
                                        <p>
                                            <?php if (phpversion() >= 5.6): ?>
                                                <i class="fa fa-check color-success"></i>
                                            <?php else: ?>
                                                <i class="fa fa-times color-danger"></i>
                                            <?php endif; ?>
                                        </p>
                                        <p>
                                            <?php if (extension_loaded('curl')): ?>
                                                <i class="fa fa-check color-success"></i>
                                            <?php else: ?>
                                                <i class="fa fa-times color-danger"></i>
                                            <?php endif; ?>
                                        </p>
                                        
                                    </div>
                                </div>

                               <div class="buttons">
                              
                                    <a href="folder-permissions.php" class="btn btn-success btn-custom pull-right">Next</a>
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
