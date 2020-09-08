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
                    <img src="assets/img/DynamicQRCode_BlackWhite.png">
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">

                    <div class="install-box">


                        <div class="steps">
                            <div class="step-progress">
                                <div class="step-progress-line" data-now-value="50" data-number-of-steps="5" style="width: 50%;"></div>
                            </div>
                            <div class="step">
                                <div class="step-icon"><i class="fa fa-code"></i></div>
                                <p>Start</p>
                            </div>
                            <div class="step active">
                                <div class="step-icon"><i class="fa fa-folder-open"></i></div>
                                <p>Folder Permissions</p>
                            </div>
                            <div class="step">
                                <div class="step-icon"><i class="fa fa-database"></i></div>
                                <p>Database</p>
                            </div>
                            <div class="step">
                                <div class="step-icon"><i class="fa fa-user"></i></i></div>
                                <p>Finish</p>
                            </div>
                        </div>

                        <div class="step-contents">
                            <div class="tab-1">
                                <h1 class="step-title">Folder Permissions</h1>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p><i class="fa fa-folder-open"></i> /config</p>
                                        <p><i class="fa fa-folder-open"></i> /saved_qrcode</p>
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <p><?php if (is_writable('../config')) { ?><i class="fa fa-check color-success"></i><?php } else { ?><i class="fa fa-close color-danger"></i><?php } ?></p>
                                        <p><?php if (is_writable('../saved_qrcode')) { ?><i class="fa fa-check color-success"></i><?php } else { ?><i class="fa fa-close color-danger"></i><?php } ?></p>
                                    </div>
                                </div>
                                <div class="buttons">
                                    <a href="index.php" class="btn btn-success btn-custom pull-left">Prev</a>
                                    
                                    <a href="database.php" class="btn btn-success btn-custom pull-right">Next</a>
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
