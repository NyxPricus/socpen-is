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
	
	<!-- datatables css -->

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="bootstrap-select2/dist/css/bootstrap-select.css">


    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

	

<title>EDIT HISTORY</title>

  </head>

  <body id="page-top">

<?php
include("include/header.php");

?>
	
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Beneficiaries</a>
            </li>
            <li class="breadcrumb-item active">View Edit History</li>
          </ol>

          <!-- DataTables Example -->
		   <div class="card mb-3">
            <div class="card-header">
			<b>Beneficiary Data of</b>
			</div>
			  <div class="card-body">
			  		<table class = "table table-stripped" id = "dataTable">
					<thead>
					<tr>
					<td>HHID</td>
					<td>FullName</td>
					<td>Address</td>
					<td>Reason why edited</td>
					<td>Date Edited</td>
					<td>Supporting Document</td>
					</tr>
					</thead>
					<tfoot>
					<tr>
					<td>HHID</td>
					<td>FullName</td>
					<td>Address</td>
					<td>Reason why edited</td>
					<td>Date Edited</td>
					<td>Supporting Document</td>
					</tr>
					</tfoot>
					<tbody>

			

			
			<?php
			if(isset($_GET['full']) OR isset($_POST['historyID']))
							{
							if(isset($_GET['full']))
							{
								$id = $_GET['hhid'];
								$fname = $_GET['full'];
								$type = $_GET['type'];
								echo "<h3>".$fname;
								 $sql="SELECT concat(first_name,' ',middle_name,' ',last_name) as fullname,hhid, concat(purok_sitio,' ',barangay, ' ',city_muni,' ',province) as address,remarks,supporting_document,edited FROM uct_list_edit_history where hhid = ? and type_of_update = ? order by edit_id desc";
				  $stmt = $mysqli->prepare($sql);
				  $stmt->bind_param("ss", $id,$type);
					
				  			 $stmt->execute();
							 $stmt->bind_result($fullname,$hhid,$address,$remarks,$doc,$date);
							 while($stmt->fetch()){
								  
								  echo "<tr>";
								  echo "<td>" . $hhid . "</td>";
								  echo "<td>" . $fullname . "</td>";
								  echo "<td>" . $address . "</td>";
								  echo "<td>" . $remarks . "</td>";
								  echo "<td>" . $date . "</td>";
								  echo "<td><a href = 'uploads/$doc' target = '_blank'>" . $doc . "</td>";
								  echo "</tr>";  
							  }
							}
							else
							{
								$id = $_POST['historyID'];
								$f = $_POST['historyFullName'];
								echo "<h3>".$f;
								 $sql="SELECT concat(first_name,' ',middle_name,' ',last_name) as fullname,hhid, concat(purok_sitio,' ',barangay, ' ',city_muni,' ',province) as address,remarks,supporting_document,edited FROM uct_list_edit_history where id = ? order by edit_id desc";
							  $stmt = $mysqli->prepare($sql);
							  $stmt->bind_param("i", $id);
							  				  
							 $stmt->execute();
							 $stmt->bind_result($fullname,$hhid,$address,$remarks,$doc,$date);
							 while($stmt->fetch()){
								  
								  echo "<tr>";
								  echo "<td>" . $hhid . "</td>";
								  echo "<td>" . $fullname . "</td>";
								  echo "<td>" . $address . "</td>";
								  echo "<td>" . $remarks . "</td>";
								  echo "<td>" . $date . "</td>";
								  echo "<td><a href = 'uploads/$doc' target = '_blank'>" . $doc . "</td>";
								  echo "</tr>";  
							  }
			  
							}
						echo "</h3>";
						//echo $id;
				 

			
							}
    //$province= mysqli_fetch_all($result,MYSQLI_ASSOC);

?>
</tbody>
</table>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!-- /edit modal -->
			<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>	
    <!-- /#wrapper -->
<script src="assets/js/jquery-1.10.2.js"></script>	
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
	<!-- include custom index.js -->
	<script src="custom/js/encoding.js"></script>
	<!-- datatables js -->
	<script src="assests/datatables/datatables.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
<script src="bootstrap-select2/dist/js/bootstrap-select.js"></script>



  </body>
<?php include("include/footer.php");

?>
</html>
