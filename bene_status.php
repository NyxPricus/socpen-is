
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

    <title>UCT - LISTAHANAN | STATUS</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

<script src="custom/js/jquery-1.11.1.min.js"></script>

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
              <a href="#">Beneficiaries Status as of December 31, 2019</a>
            </li>
          
          </ol>

          <!-- Icon Cards-->
          <style>
		  fieldset.scheduler-border {
    border: 20px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

legend.scheduler-border {
    font-size: 1.2em !important;
    font-weight: bold !important;
    text-align: left !important;
	color: #47bbed !important;
}
legend.scheduler-border {
    width:inherit; /* Or auto */
    padding:0 10px; /* To give a bit of padding on the left and right */
    border-bottom:none;
}
		  </style>

				<div class="container" id="content-wrapper">
					<div class='table-responsive'>
        <table id="dtBasicExample" class="table table-striped table-bordered">
																			
																			<thead>
																			<th>BENEFICIARIES STATUS</th>
																			<th>COUNT</th>
	
																		
																			
																			</thead>	
																			<tbody>



						<?php	$sql="SELECT sd.validation_status_description, count(ul.hhid),sd.validation_status
						FROM uct_list_110 ul 
						INNER JOIN listahanan_statuses ls on ls.hhid = ul.hhid 
						INNER JOIN status_description sd on sd.validation_status = ls.status  
						GROUP BY sd.validation_status_description asc";
												
												if($stmt = $mysqli->prepare($sql)){
													
												
													if($stmt->execute()){
														$stmt->store_result();
														if($stmt->num_rows != 0){                    
														$stmt->bind_result($desc,$count,$status_id);
														$ctr = 0;
															while($stmt->fetch()){
															//$unpaid = getCountUnpaid($mysqli,$province,$year);
															//$paid = $target - $unpaid;
															//$per = ($paid / $target) * 100;
															$ctr += $count;
															
														
															//$per=number_format((float)$per, 2, '.', '');  // Outputs -> 105.00
														?>
														
														
														
																<tr>
														
														<td><a href = "bene_status_breakdown?status_code=<?php echo $status_id;?>"><?php echo $desc?></a></td>
														<td><?php echo $count?></td>
														
													
													
													</tr>
														
														
														
														
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




</tbody>
<tfoot>
																			<th></th>
																			<th><?php echo $ctr;?></th>
	
																		
																			
																			</tfoot>
</table>


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