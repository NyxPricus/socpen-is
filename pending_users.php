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

    <title>Pending User</title>

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
              <a href="#">Users</a>
            </li>
            <li class="breadcrumb-item active">Pending Users</li>
          </ol>

          <!-- DataTables Example -->
   
   <?php
   if (isset($_SESSION["register_deleted"]))
   {
	   if($_SESSION["register_deleted"]=="Request Deleted Successfully"){?>
   <div class="alert alert-success" role="alert">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<?php echo $_SESSION["register_deleted"];unset($_SESSION["register_deleted"]); ?>
			</div>
   <?php
	   }else
	   {
		  ?>
		  
		  <div class="alert alert-danger" role="alert">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<?php echo $_SESSION["register_deleted"];unset($_SESSION["register_deleted"]); ?>
			</div>
		  
		  <?php
	   }
   ?>
   
   
   

<?php

   }?>


      <div id="content-wrapper">

        <div class="container-fluid">

         

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              List of Pending Notifier Users</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Full Name</th>
                      <th>Email</th>
					  <th>Date of Registration</th>
					  <th>Address</th>
					  <th>Type</th>
					  <th>Action</th>
                 
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Full Name</th>
                      <th>Email</th>
                      <th>Date of Registration</th>
					   <th>Address</th>
					    <th>Type</th>
					  <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
					<?php
						$sql = 'SELECT CONCAT(firstName," ",lastName) as fullname, uEmail, uType, fo3UserId, uDate, address,uType FROM fo3user WHERE uType = 0 or uStatus = 0';
						if($stmt = $mysqli->prepare($sql)){							
							if($stmt->execute()){
								$stmt->bind_result($fullname,$uEmail,$uType, $fo3UserId,$uDate,$address,$type);
								while($stmt->fetch()){
									$_SESSION['fullname']=$fullname;
									echo "<tr>";
									  echo "<td>" . $fullname . "</td>";
									  echo "<td>" . $uEmail . "</td>";
									  echo "<td>" . $uDate . "</td>";
									  echo "<td>" . $address . "</td>";
									  
									  if($type==5)
									  {
									  echo "<td>Notifier</td>";
									  }
									   if($type==1)
									  {
									  echo "<td>Admin</td>";
									  }
									   if($type==2)
									  {
									  echo "<td>Encoder</td>";
									  }
									   if($type==3)
									  {
									  echo "<td>TEV</td>";
									  }
									    if($type==4)
									  {
									  echo "<td>Reviewer</td>";
									  }
									 ?>
									 
									
									 
									 <!-- Split button -->
<script>
function confirmDelete(delUrl,fullname) {
  if (confirm("Are you sure you want to Decline " + fullname + " request?")) {
    document.location = delUrl;
  }
}
function confirmUpdate(delUrl,fullname) {
  if (confirm("Are you sure you want to Accept " + fullname + " request?")) {
    document.location = delUrl;
  }
}
</script>

<td>
<a href="javascript:confirmUpdate('accept_user?request_id=<?php echo $fo3UserId?>','<?PHP echo $fullname?>')"><button class="btn btn-success"><i class="fa fa-check"></i>Accept</button></a>&nbsp; 
<a href="	javascript:confirmDelete('decline_user?uid=<?php echo$fo3UserId?>', '<?PHP echo $fullname?>')"><button class="btn btn-danger"><i class="fa fa-trash"></i> Decline</button></a> </td>
									  
									  <?php
									echo "</tr>";
									
								}
							}
						}
					?>
                  </tbody>
                </table>
				<a href = "add_user"><button type="button" class="btn btn-success"><span class = "fa fa-plus"></span>&nbsp;Add New User</button></a>
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




   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

	<?php include("include/footer.php")?>

  </body>

</html>
