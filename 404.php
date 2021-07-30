<?php
session_start();
require_once './config/config.php';
require_once './include/auth_validate.php';
unset($_SESSION['province']);
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>UCT - LISTAHANAN</title>

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
       
<!-- <a href="https://www.vecteezy.com/free-vector/404">404 Vectors by Vecteezy</a> Free--> 
<img src = "icons/404.jpg" style = "height:800px"><br>
<strong>Click <a href = "index.php" title = "Are you lost baby girl?">here</a> to Go Home</strong>

          <!-- Icon Cards-->
          
          <!-- DataTables Example -->
         
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

	<?php include("include/footer.php")?>

  </body>

</html>
