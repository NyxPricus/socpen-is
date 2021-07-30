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

	

<title>EDITED BENE - CHANGE BASIC INFORMATION</title>

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
            <li class="breadcrumb-item active">Beneficiaries that has Changes in Basic Information</li>
          </ol>

          <!-- DataTables Example -->
		   <div class="card mb-3">
 <div class="card-header">
			<b>Beneficiaries that has Changes in Basic Information</b>
			</div>
			  <div class="card-body">
			  		<table class = "table table-stripped" id = "dataTable">
					<thead>
					<tr>
					<td>HHID</td>
					<td>FullName</td>
					<td>Address</td>
					<td>Times Edited</td>
					
					</tr>
					</thead>
					<tfoot>
					<tr>
					<td>HHID</td>
					<td>FullName</td>
					<td>Address</td>
					<td>Times Edited</td>
					
					</tr>
					</tfoot>
					<tbody>

			<?php
	//	$id = $_POST['historyID'];
		//echo $id;
		$typeofupdate = "Change Basic information";
  $sql="SELECT id,concat(first_name,' ',middle_name,' ',last_name) as fullname,hhid,concat(purok_sitio,' ',barangay, ' ',city_muni,' ',province) as address, count(hhid) as bilang FROM uct_list_edit_history where type_of_update = 'Change Basic information' group by hhid order by edit_id desc";
  $stmt = $mysqli->prepare($sql);
  //$stmt->bind_param("i", $id);
  
  $stmt->execute();
 $stmt->bind_result($id,$fullname,$hhid,$address,$bilang);
 while($stmt->fetch()){
	  
	  echo "<tr>";
	  echo "<td><a href = 'bene_edit_history?id=$id&full=$fullname&hhid=$hhid&type=$typeofupdate'>" . $hhid . "</a></td>";
	  echo "<td>" . $fullname . "</td>";
	  echo "<td>" . $address . "</td>";
	  echo "<td>" . $bilang . "</td>";
	  echo "</tr>";
	  
  }
  
  

  
    //$province= mysqli_fetch_all($result,MYSQLI_ASSOC);

?>
</tbody>
</table>
<form action = "export_basic.php?type=<?php echo $typeofupdate;?>" method = "POST">
 <button type = "submit" id="exportButton" class="btn btn-lg btn-success clearfix"><span class="fa fa-file-excel-o"></span> Export to Excel</button>
 </form>
 
 
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
