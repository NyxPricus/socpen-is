
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

    <title>UCT - LISTAHANAN</title>

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
              <a href="#">Unpaid beneficiaries from <?php echo $_GET["province"]?> > <?php echo $_GET["muni"]?></a>
			  <h3><?php echo $_GET["year"]?></h3>
			  
            </li>
          
          </ol>
		 
									
		
		
		
		
										<?php	$sql_year="select lu.date_of_payout from listahanan_unpaid lu
															group by lu.date_of_payout";
												
												if($stmt_year = $mysqli->prepare($sql_year)){
													
												
													if($stmt_year->execute()){
														$stmt_year->store_result();
														if($stmt_year->num_rows != 0){                    
														$stmt_year->bind_result($year);
															while($stmt_year->fetch()){
														
														?>
		 

							
													<table class = "table">
													
													<thead>
													<th>Province</th>
													<th>Target</th>
													<th>Paid</th>
													<th>Unpaid</th>
													<th>Percentage</th>
													</thead>	
													<tbody>
							
													

													
													<?php	$sql="SELECT ul.province,city_muni,barangay, count(ul.hhid) as target
															from uct_list_110 ul
															where ul.province = '" . $_GET['province'] .
															"' and city_muni = '" . $_GET['muni'] . "' group by ul.province , ul.city_muni, ul.barangay	";
												
												if($stmt = $mysqli->prepare($sql)){
													
												
													if($stmt->execute()){
														$stmt->store_result();
														if($stmt->num_rows != 0){                    
														$stmt->bind_result($province,$muni,$brgy,$target);
															while($stmt->fetch()){
															$unpaid = getCountUnpaidMuniBrgy($mysqli,$province,$muni,$brgy,$year);
															$paid = $target - $unpaid;
															$per = ($paid / $target) * 100;
															$per=number_format((float)$per, 2, '.', '');  // Outputs -> 105.00
														?>
														
														
														
																<tr>
														
														<td><?php echo $brgy?></td>
														<td><?php echo $target?></td>
														<td><?php echo $paid?></td>
														<td><a href = "unpaid_brgy.php?province=<?php echo $province?>&muni=<?php echo $muni?>&brgy=<?php echo $brgy?>&year=<?php echo $year?>" target ="_BLANK"><?php echo $unpaid?></a></td>
														<td><?php echo $per?>%</td>
													
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
													</table>
													
													
<?php													
															}
														}
													}
												}													
											?>		
						<br>
						
						
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
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

</script>