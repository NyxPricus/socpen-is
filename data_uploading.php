<?php

session_start();
require_once './config/config.php';
require_once './include/auth_validate.php';

?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Add Notifier</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
  </head>

  <body id="page-top">
	<?php require_once './include/header.php'; ?>
    <div id="content-wrapper">
        <div class="container-fluid">
          <!-- Breadcrumbs-->
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="#">Upload Accomplishment</a>
				</li>
				<li class="breadcrumb-item active">Overview</li>
			</ol>		  
			<div class="card card-register mx-auto mt-5">
			<!--div class="card mb-3"-->
				<div class="card-header">
				  Upload Notifier Accomplishment</div>
					<div class="card-body">
					<?php if (isset($_SESSION["upload_error"])) {?>
						<div class="alert alert-success alert-dismissable">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<?php echo $_SESSION["upload_error"];unset($_SESSION["upload_error"]); ?>
						</div>
					<?php }?>
					<form action="create_accomplishment.php" method="post" enctype="multipart/form-data">
						<input type="file" name="uploadFile" value="" />
						<input type="submit" name="submit" value="Upload" class="btn btn-success"/>
					</form>
				<!--/div-->				
			</div>
				<div class="card-footer small text-muted">*Upload accomplsihment/s, this form only accepts xls and xlsx</div>
			</div>
		</div>
	</div>
	<?php require_once './include/footer.php'; ?>
  </body>

</html>