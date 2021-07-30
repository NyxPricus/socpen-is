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

    <title>UCT [UNCONDITIONAL CASH TRANSFER]</title>

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

   <?php include("include/header.php")?>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
          </ol>   

          <div class="card mb-3">
            <div class="card-header">
              Upload Notifier Accomplishment</div>
            <div class="card-body">
              	<form method="post" action="import.php" enctype="multipart/form-data">
					<fieldset>
						<div class="form-group">
							<input type="file" name="uploaded[]" multiple/>
						</div> 
						<input class="btn btn-success" type="submit" name="submit_file" value="Submit"/>
					</fieldset> 
				</form>
            </div>
            <div class="card-footer small text-muted">&nbsp;</div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

	<?php include("include/footer.php")?>

  </body>

</html>