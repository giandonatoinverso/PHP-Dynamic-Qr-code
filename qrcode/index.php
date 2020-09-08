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
require_once './config/config.php';
require_once 'includes/auth_validate.php';

//Get DB instance. function is defined in config.php
$db = getDbInstance();

//Get Dynamic qr code rows
$numQrcode_dynamic = $db->getValue ("dynamic_qrcodes", "count(*)");

//Get Static qr code rows
$numQrcode_static = $db->getValue ("static_qrcodes", "count(*)");

$total = $numQrcode_dynamic + $numQrcode_static;

//Get Total scan
$numScan = $db->query("SELECT sum(scan) FROM dynamic_qrcodes");

                                                /* CREATED CHART *///I initialize the variables that will contain the daily values to 0 otherwise in the foreach loop they will be reset every time

//Get the number of DYNAMIC qr code created in 7 days and total scan
$createdQrcode_dynamic = $db->query("select `created_at`, `scan` from dynamic_qrcodes where `created_at` > curdate()-7;");

$dynamic_today = $dynamic_oneday = $dynamic_twoday = $dynamic_threeday = $dynamic_fourday = $dynamic_fiveday = $dynamic_sixday  = 0;
$scan_today = $scan_oneday = $scan_twoday = $scan_threeday = $scan_fourday = $scan_fiveday = $scan_sixday = 0;
foreach ($createdQrcode_dynamic as $row) {
    switch (substr($row['created_at'],0,10)){
        case date("Y-m-d",mktime(0,0,0,date('m'),date('d'),date('Y'))): $dynamic_today++; $scan_today = $scan_today + $row['scan']; break; 
        case date("Y-m-d",mktime(0,0,0,date('m'),date('d')-1,date('Y'))): $dynamic_oneday++; $scan_oneday = $scan_oneday + $row['scan']; break;
        case date("Y-m-d",mktime(0,0,0,date('m'),date('d')-2,date('Y'))): $dynamic_twoday++; $scan_twoday = $scan_twoday + $row['scan']; break;
        case date("Y-m-d",mktime(0,0,0,date('m'),date('d')-3,date('Y'))): $dynamic_threeday++; $scan_threeday = $scan_threeday + $row['scan']; break;
        case date("Y-m-d",mktime(0,0,0,date('m'),date('d')-4,date('Y'))): $dynamic_fourday++; $scan_fourday = $scan_fourday + $row['scan']; break;
        case date("Y-m-d",mktime(0,0,0,date('m'),date('d')-5,date('Y'))): $dynamic_fiveday++; $scan_fiveday = $scan_fiveday + $row['scan']; break;
        case date("Y-m-d",mktime(0,0,0,date('m'),date('d')-6,date('Y'))): $dynamic_sixday++; $scan_sixday = $scan_sixday + $row['scan']; break;
        //I increase the daily variable and update the variable of the number of scans for a given day
    }
}

                                                /* SCAN CHART */
//Get the number of STATIC qr code created in 7 days
$createdQrcode_static = $db->query("select `created_at` from static_qrcodes where `created_at` > curdate()-7;");

$static_today = $static_oneday = $static_twoday = $static_threeday = $static_fourday = $static_fiveday = $static_sixday = 0;
foreach ($createdQrcode_static as $row) {
    switch (substr($row['created_at'],0,10)){
        case date("Y-m-d",mktime(0,0,0,date('m'),date('d'),date('Y'))): $static_today++; break;
        case date("Y-m-d",mktime(0,0,0,date('m'),date('d')-1,date('Y'))): $static_oneday++; break;
        case date("Y-m-d",mktime(0,0,0,date('m'),date('d')-2,date('Y'))): $static_twoday++; break;
        case date("Y-m-d",mktime(0,0,0,date('m'),date('d')-3,date('Y'))): $static_threeday++; break;
        case date("Y-m-d",mktime(0,0,0,date('m'),date('d')-4,date('Y'))): $static_fourday++; break;
        case date("Y-m-d",mktime(0,0,0,date('m'),date('d')-5,date('Y'))): $static_fiveday++; break;
        case date("Y-m-d",mktime(0,0,0,date('m'),date('d')-6,date('Y'))): $static_sixday++; break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <title>PHP Qr Code Generator v1.0</title>
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
                                <h1 class="m-0 text-dark">Dashboard</h1>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div><!-- /.content-header -->
                
                <!-- Flash message-->
                <?php include BASE_PATH . '/includes/flash_messages.php'; ?>
                <!-- /.Flash message-->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <!-- Info boxes -->
                            <div class="row">
                                
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box mb-3 bg-warning">
                                        <span class="info-box-icon"><i class="fa fa-qrcode"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Total qr codes</span>
                                            <span class="info-box-number"><?php echo $total; ?></span>
                                        </div><!-- /.info-box-content -->
                                    </div>
                                </div><!-- /.col -->
                                    
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box mb-3 bg-success">
                                        <span class="info-box-icon"><i class="fa fa-qrcode"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Dynamic Qr codes</span>
                                            <span class="info-box-number"><?php echo $numQrcode_dynamic; ?></span>
                                        </div><!-- /.info-box-content -->
                                    </div>
                                </div><!-- /.col -->

                                <!-- fix for small devices only -->
                                <div class="clearfix hidden-md-up"></div>

                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box mb-3 bg-danger">
                                        <span class="info-box-icon"><i class="fa fa-qrcode"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Static QR codes</span>
                                            <span class="info-box-number"><?php echo $numQrcode_static; ?></span>
                                        </div><!-- /.info-box-content -->

                                    </div>
                                </div><!-- /.col -->
                                
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="info-box mb-3 bg-info">
                                        <span class="info-box-icon"><i class="fas fa-chart-line"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Total Scans</span>
                                            <span class="info-box-number"><?php echo $numScan[0]['sum(scan)']; ?></span>
                                        </div><!-- /.info-box-content -->
                                    </div>
                                </div><!-- /.col -->
                            </div><!-- /.row -->

                        <div class="row">
                                
                            <div class="col-md-6">
                                <!-- Created chart -->
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Qr codes created in the last week</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <p class="d-flex flex-column">
                                                <span class="text-bold text-lg"><?php echo $dynamic_today + $dynamic_oneday + $dynamic_twoday + $dynamic_threeday + $dynamic_fourday + $dynamic_fiveday + $dynamic_sixday + $static_today + $static_oneday + $static_twoday + $static_threeday + $static_fourday + $static_fiveday + $static_sixday?></span>
                                                <span>Total qr code created</span>
                                            </p>
                                        </div>

                                        <div class="position-relative mb-4">
                                            <div class="chartjs-size-monitor">
                                                <div class="chartjs-size-monitor-expand">
                                                    <div class=""></div>
                                                </div>
                                                <div class="chartjs-size-monitor-shrink">
                                                    <div class=""></div>
                                                </div>
                                            </div>
                    
                                            <canvas id="created-chart" height="400" width="958" class="chartjs-render-monitor" style="display: block; height: 200px; width: 479px;"></canvas>
                                        </div>

                                        <div class="d-flex flex-row justify-content-end">
                                            <span class="mr-2">
                                                <i class="fas fa-square text-primary"></i> Dynamic
                                            </span>

                                            <span>
                                                <i class="fas fa-square text-gray"></i> Static
                                            </span>
                                        </div>
                                    </div><!-- /.card-body -->
                                </div><!-- /.card -->
                            </div><!-- /.col (LEFT) -->

                            <div class="col-md-6">
                                <section class="connectedSortable">
                                    <div class="card bg-gradient-info">
                                        <div class="card-header border-0">
                                            <h3 class="card-title">
                                                <i class="fas fa-th mr-1"></i>
                                                Scan Graph
                                                </h3>

                                            <div class="card-tools">
                                                <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <div class="card-body">
                                            <canvas class="chart" id="scan-chart" style="min-height: 313px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                        </div>
                                    </div>
                                </section>
                            </div><!-- /.col (RIGHT) -->
                        </div><!-- /.row -->
                        
                    </div><!--/. container-fluid -->
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
        

        <!-- Footer and scripts -->
        <?php include './includes/footer.php'; ?>
        <!-- ChartJS -->
        <script src="plugins/chart.js/Chart.min.js"></script>
        <!-- Created Qr code Chart script -->
        <script>
        $(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode      = 'index'
  var intersect = true

  var $createdChart = $('#created-chart')
  var createdChart  = new Chart($createdChart, {
    data   : {
      labels  : [   
                    '<?php echo date("Y-m-d",mktime(0,0,0,date('m'),date('d')-6,date('Y'))); ?>', 
                    '<?php echo date("Y-m-d",mktime(0,0,0,date('m'),date('d')-5,date('Y'))); ?>', 
                    '<?php echo date("Y-m-d",mktime(0,0,0,date('m'),date('d')-4,date('Y'))); ?>', 
                    '<?php echo date("Y-m-d",mktime(0,0,0,date('m'),date('d')-3,date('Y'))); ?>', 
                    '<?php echo date("Y-m-d",mktime(0,0,0,date('m'),date('d')-2,date('Y'))); ?>', 
                    '<?php echo date("Y-m-d",mktime(0,0,0,date('m'),date('d')-1,date('Y'))); ?>', 
                    '<?php echo date("Y-m-d",mktime(0,0,0,date('m'),date('d'),date('Y'))); ?>'
                ],
      datasets: [{
        type                : 'line',
        data                : [
                                <?php echo $dynamic_sixday ?>, 
                                <?php echo $dynamic_fiveday ?>, 
                                <?php echo $dynamic_fourday ?>,
                                <?php echo $dynamic_threeday ?>,
                                <?php echo $dynamic_twoday ?>,
                                <?php echo $dynamic_oneday ?>,
                                <?php echo $dynamic_today ?>,

                            ],
        backgroundColor     : 'transparent',
        borderColor         : '#007bff',
        pointBorderColor    : '#007bff',
        pointBackgroundColor: '#007bff',
        fill                : false
      },
        {
          type                : 'line',
          data                : [
                                <?php echo $static_sixday ?>, 
                                <?php echo $static_fiveday ?>, 
                                <?php echo $static_fourday ?>,
                                <?php echo $static_threeday ?>,
                                <?php echo $static_twoday ?>,
                                <?php echo $static_oneday ?>,
                                <?php echo $static_today ?>,

                            ],
          backgroundColor     : 'tansparent',
          borderColor         : '#ced4da',
          pointBorderColor    : '#ced4da',
          pointBackgroundColor: '#ced4da',
          fill                : false
        }]
    },
    options: {
      maintainAspectRatio: false,
      tooltips           : {
        mode     : mode,
        intersect: intersect
      },
      hover              : {
        mode     : mode,
        intersect: intersect
      },
      legend             : {
        display: false
      },
      scales             : {
        yAxes: [{
          // display: false,
          gridLines: {
            display      : true,
            lineWidth    : '4px',
            color        : 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks    : $.extend({
            beginAtZero : true,
            suggestedMax: 10
          }, ticksStyle)
        }],
        xAxes: [{
          display  : true,
          gridLines: {
            display: false
          },
          ticks    : ticksStyle
        }]
      }
    }
  })
})
        </script>
        <!-- /.Created Chart script -->
        <!-- Scan Chart -->
        <script>
            /*
 * Author: Abdullah A Almsaeed
 * Date: 4 Jan 2014
 **/

$(function () {

  'use strict'
  /* Chart.js Charts */
  // Sales graph chart
  var salesGraphChartCanvas = $('#scan-chart').get(0).getContext('2d');
  //$('#revenue-chart').get(0).getContext('2d');

  var salesGraphChartData = {
    labels  : [   
                    '<?php echo date("Y-m-d",mktime(0,0,0,date('m'),date('d')-6,date('Y'))); ?>', 
                    '<?php echo date("Y-m-d",mktime(0,0,0,date('m'),date('d')-5,date('Y'))); ?>', 
                    '<?php echo date("Y-m-d",mktime(0,0,0,date('m'),date('d')-4,date('Y'))); ?>', 
                    '<?php echo date("Y-m-d",mktime(0,0,0,date('m'),date('d')-3,date('Y'))); ?>', 
                    '<?php echo date("Y-m-d",mktime(0,0,0,date('m'),date('d')-2,date('Y'))); ?>', 
                    '<?php echo date("Y-m-d",mktime(0,0,0,date('m'),date('d')-1,date('Y'))); ?>', 
                    '<?php echo date("Y-m-d",mktime(0,0,0,date('m'),date('d'),date('Y'))); ?>'
                ],
    datasets: [
      {
        label               : 'Scan',
        fill                : false,
        borderWidth         : 2,
        lineTension         : 0,
        spanGaps : true,
        borderColor         : '#efefef',
        pointRadius         : 3,
        pointHoverRadius    : 7,
        pointColor          : '#efefef',
        pointBackgroundColor: '#efefef',
        data                : [
                                <?php echo $scan_sixday ?>, 
                                <?php echo $scan_fiveday ?>, 
                                <?php echo $scan_fourday ?>,
                                <?php echo $scan_threeday ?>,
                                <?php echo $scan_twoday ?>,
                                <?php echo $scan_oneday ?>,
                                <?php echo $scan_today ?>,

                            ],
      }
    ]
  }

  var salesGraphChartOptions = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: false,
    },
    scales: {
      xAxes: [{
        ticks : {
          fontColor: '#efefef',
        },
        gridLines : {
          display : false,
          color: '#efefef',
          drawBorder: false,
        }
      }],
      yAxes: [{
        ticks : {
          stepSize: 2,
          fontColor: '#efefef',
          suggestedMax: 30,
        },
        gridLines : {
          display : true,
          color: '#efefef',
          drawBorder: false,
        }
      }]
    }
  }

  // This will get the first returned node in the jQuery collection.
  var salesGraphChart = new Chart(salesGraphChartCanvas, { 
      type: 'line', 
      data: salesGraphChartData, 
      options: salesGraphChartOptions
    }
  )

})
        </script>
        <!-- /. Scan Chart -->
        <!-- /.Footer and scripts -->
    </body>
</html>
