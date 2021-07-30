
<?php
session_start();
require_once 'config/config.php';
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
	
	<!-- datatables css -->
    <title>UCT - LISTAHANAN</title>
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

  <body id="page-top">

   <?php include("include/header.php")?>

      <div id="content-wrapper">

        <div class="container-fluid">

		
		
		
		
		
		
		
		    
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Unpaid beneficiaries from <?php echo $_GET["province"]?> > <?php echo $_GET["muni"]?> > <?php echo $_GET["brgy"]?></a>
			  <h3><?php echo $_GET["year"]?></h3>
			  
            </li>
          
          </ol>
		 
									
		<div class="card-body">
        <div class="row">
			
					<div class="col-md-12">
						<div class="edit-messages"></div>
						<?php 
						if(isset($_SESSION['province'])){?>
							
<?php
						}
						else
						{
							?>
							<div class='table-responsive'>
        <table id="dtBasicExample" class="table table-striped table-bordered">
							<?php
						}?>						
							<thead>
								<tr>
									
									<th>HHID</th>													
									<th>Full Name</th>
									<th>Address</th>		
									
								</thead>	
										<?php	$sql="SELECT ul.hhid, concat(first_name,' ' , ifnull(middle_name,'') , ' ' ,last_name , ' ', ifnull(ul.ext,'')) as fullname, concat(ul.barangay,', ',ul.city_muni) as address
															from uct_list_110 ul
															inner join listahanan_unpaid lu on ul.hhid = lu.hhid
															where ul.province = '" . $_GET['province'] .
															"' and city_muni = '" . $_GET['muni'] . "' and barangay = '" . $_GET["brgy"] . "'";
												
												if($stmt = $mysqli->prepare($sql)){
													
												
													if($stmt->execute()){
														$stmt->store_result();
														if($stmt->num_rows != 0){                    
														$stmt->bind_result($hhid,$fullname,$address);
															while($stmt->fetch()){
															//$unpaid = getCountUnpaidMuniBrgy($mysqli,$province,$muni,$brgy,$year);
															//$paid = $target - $unpaid;
															//$per = ($paid / $target) * 100;
														?>
														
														
														<tbody>
																<tr>
														<td><?php echo $hhid?></td>
														<td><?php echo $fullname?></td>
														<td><?php echo $address?></td>
														
													
													</tr>
													</tbody>
														
														
														
														<?php		}
															}
														} else{
														echo "Error loading page";
														}
													} else{
														echo "Oops! Something went wrong. Please try again later.";
														$stmt->close(); 
													}	
									
									
									
									
									
									
									
									
									?>
									
							


















									
							
								</tr>
						
						</table>
					</div>
				</div>	
</div>
</div>

		
		
		
		
		
        <!-- /.container-fluid -->
      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->
<script>
$('.counter-count').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: 5000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
</script>
	<?php include("include/footer.php")?>

  </body>

</html>





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
	<?php include("include/footer.php")?>







<script language=JavaScript>
var message="Right click disabled!";
function clickIE4(){
if (event.button==2){
alert(message);
return false;
}
}

function clickNS4(e){
if (document.layers||document.getElementById&&!document.all){
if (e.which==2||e.which==3){
alert(message);
return false;
}
}
}

if (document.layers){
document.captureEvents(Event.MOUSEDOWN);
document.onmousedown=clickNS4;
}
else if (document.all&&!document.getElementById){
document.onmousedown=clickIE4;
}

document.oncontextmenu=new Function("alert(message);return false")


$(document).ready(function () {
$('#dtBasicExample').DataTable();
$('.dataTables_length').addClass('bs-select');
});
</script>