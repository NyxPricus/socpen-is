<?php
session_start();
require_once 'config/config.php';
require_once 'include/auth_validate.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>2018 Unpaid Tagging</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="css/fontastic.css">
    <!-- Google fonts - Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.secondary.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
	
  </head>
  <body>
    <div class="page">
      <!-- Main Navbar-->
      <?php require_once 'include/nav_header.php';?>

      <div class="page-content d-flex align-items-stretch"> 
        <!-- Side Navbar -->
        <?php require_once 'include/nav_side.php';?>


        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Dashboard</h2>
            </div>
          </header>
		  
		  
		  <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="col-xs-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Upload Accomplishment</strong>
                        </div>
                        <div class="card-body"> <!--card-block-->
                            <!--div class="card mb-3"-->
                            <?php if (isset($_SESSION["upload_error"])) {?>
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $_SESSION["upload_error"];unset($_SESSION["upload_error"]); ?>
                                </div>
                            <?php }?>
                            <?php if (isset($_SESSION["upload_success"])) {?>
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $_SESSION["upload_success"];unset($_SESSION["upload_success"]); ?>
                                </div>
                            <?php }?>
                            <!--h2 >UPLOAD NOTIFIERS ACCOMPLISHMENT</h2-->
                            <form action="file_save.php" method="post" enctype="multipart/form-data">
                                <input type="file" name="uploadFile[]" multiple />
                                <input type="submit" name="submit" value="Upload" class="btn btn-dark"/>
                            </form>
                        </div>
                        <div class="card-footer small text-muted"><i style='color:red'>*This form only accepts xls and xlsx file type*</i></div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
		  
          
          <!-- Page Footer-->
          <?php require_once 'include/footer.php';?>
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="js/charts-home.js"></script>
    <!-- Main File-->
    <script src="js/front.js"></script>
  </body>
</html>
