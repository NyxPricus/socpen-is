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

    <title>List of Notifiers</title>

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
              <a href="#">Notifiers</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
          </ol>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              List of Notifiers
			</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Contact Number</th>
                      <th>Email Address</th>
                      <th>Address</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Name</th>
                      <th>Contact Number</th>
                      <th>Email Address</th>
                      <th>Address</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                        $sql = 'SELECT CONCAT(firstName," ",middleName," ",lastName," ",nameSuffix) as fullname, contactNo, emailAdd, address1 FROM fo3notifier WHERE status = 1';
                        if($stmt = $mysqli->prepare($sql)){							
                            if($stmt->execute()){
                                $stmt->bind_result($fullname,$contactNo,$emailAdd,$address1);
                                while($stmt->fetch()){
                                    echo "<tr>";
                                    echo "<td>" . $fullname . "</td>";
                                    echo "<td>" . $contactNo . "</td>";
                                    echo "<td>" . $emailAdd . "</td>";
                                    echo "<td>" . $address1 . "</td>";
                                    echo "</tr>";
                                }
                            }
                        }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
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
