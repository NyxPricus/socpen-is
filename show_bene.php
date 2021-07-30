
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

    <title>UCT - LISTAHANAN | ROSTER DATA</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

<script src="custom/js/jquery-1.11.1.min.js"></script>

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

<style>

/**
 * Profile image component
 */
.profile-header-container{
    margin: left;
    text-align: left;
	float: left;
}




.profile-header-img {
    padding: 54px;
	float: left;
}

.profile-header-img > img.img-circle {
    width: 250px;
    height: 250px;
    border: 5px solid #078f2b;
	float: left;
}

.profile-header {
    margin-top: 43px;
}

/**
 * Ranking component
 */
.rank-label-container {
    margin-top: -19px;
    /* z-index: 1000; */
    text-align: center;
	color:white;
}


hr.new5 {
  border: 5px solid #8dd3f2;
  border-radius: 5px;
}
hr.new4 {
  border: 2px solid white;
  border-radius: 2px;
}



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
<script>
$(document).ready(function(){
	$('#bene_img').click(function(){
  		$('#modal_bene').modal('show')
		  
	});
});











var input = document.getElementById("txt_hhid");
input.addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        document.getElementById("myButt").click();
    }
});
</script>

  </head>

  <body id="page-top">

   <?php include("include/header.php")?>

      <div id="content-wrapper">

        <div class="container-fluid">
   
		
		
		
		
		  <!--  
		<div class="alert alert-info">
		<i>Search result of&nbsp;
		<?php 
		echo $_GET['txthhid'];
		$hhid = trim($_GET['txthhid']);
		$hhidcount=strlen($hhid);
		$year=trim($_GET['txtyear']);
		$_SESSION['taon']=$year;
		if($taon==0)
		{
			echo '<script>alert("lagyan mo ng taon!")</script>';
			//exit;
		}
		?></i>
		</div> -->




<?php 

if($hhidcount <> 8)
{
		$sql="SELECT hh_id from uct_roster where hh_id = ?";
}
else
{
	$sql="SELECT hh_id from uct_roster where right(hh_id,8) = ? limit 1";
}
									




if($stmt = $mysqli->prepare($sql)){
																			
	$stmt->bind_param("s", $param_hhid);
	$param_hhid = $hhid;
		if($stmt->execute()){
			$stmt->store_result();
			if($stmt->num_rows != 0){                    
			$stmt->bind_result($complete_hhid);
			$stmt->fetch();
				//echo $hhid;
				//echo "<br>" . 'kumpleto - '.$complete_hhid;





		
?>		





<?php


	




















$sql="SELECT hh_id from uct_roster where hh_id = ?";
	if($stmt = $mysqli->prepare($sql)){
																			
		$stmt->bind_param("s", $param_hhid);
		$param_hhid = $complete_hhid;
			if($stmt->execute()){
				$stmt->store_result();
				if($stmt->num_rows != 0){   
?>

<fieldset class="scheduler-border">
    <legend class="scheduler-border">TAGGING OF PAID</legend>

        <div style="background-color: #c5eafa; height:350px">


					













							<?php
							
								$sql="SELECT ur.uct_id,ur.first_name1,ur.mid_name1,ur.last_name1,ur.ext_name1,ul.city_muni,ul.province,ul.barangay,ul.purok_sitio,ur.line_number,LEFT(ur.birthday, 10) as dob, sex_id
						from uct_roster ur
						inner join uct_list_110 ul on ul.hhid = ur.hh_id
						where ur.hh_id = ? and ur.rel_hh = '1'";
														
																		if($stmt = $mysqli->prepare($sql)){
																			
																		$stmt->bind_param("s", $param_hhid);
																		$param_hhid = $complete_hhid;
																			if($stmt->execute()){
																				$stmt->store_result();
																				if($stmt->num_rows != 0){                    
																				$stmt->bind_result($uct_id,$first_name,$middle_name,$last_name,$ext,$muni,$province,$barangay,$purok,$line_number,$dob,$sex);
																					while($stmt->fetch()){
																					$taon = date("Y");
																					$year = substr($dob,0,4);
																					//echo $taon;
																					//echo $year;

																					$muni = strtoupper($muni);
																					
																					$age = ($taon - $year);
																					if($sex==1)
																					{
																						$uri = "MALE";
																		
																					}
																					else{
																						$uri = "FEMALE";
																					}
																				?>
						
								  
							

    <div style="display: inline-block;padding:40px;padding-top:20px">

	
	<strong>HOUSEHOLD ID:</strong>&nbsp;<?php echo $uct_id?><br>
	
<H4><strong><?php echo $first_name . " " . $middle_name .  " " . $last_name . " " . $ext?><br></strong></H4>
	<hr class = "new4">
	<H5><strong>	PERSONAL INFORMATION</strong></H5>
	<hr class = "new4">
													
													
													
													<strong>BIRTHDAY:</strong><?php echo $dob?><br>
													<strong>AGE: </strong><?php echo $age?><br>
													<strong>SEX: </strong><?php echo $uri?><br>
													<strong>COMPLETE ADDRESS: </strong><a href="https://www.google.com/maps/place/<?php echo $barangay. " " . str_replace("(CAPITAL)", "" ,$muni) . " " . $province?>" target="_BLANK" title="Click here to view on Map (Up to barangay level only)"><i class="fas fa-map-marker-alt"></i><?php echo $barangay. ", " . $muni . ", " . $province?></a><br>
													
													
													<br><br>
												
												</div>	
												<div style="clear: left;"/>
																	
																		</tr>		
																				<?php		}
																					}else{
																						echo "Not found";
																					}
																				} else{
																				echo "Error loading page";
																				}
																			} else{
																				echo "Oops! Something went wrong. Please try again later.";
																				$stmt->close(); 
																			}
																			
																			
																	?>


								  
						</div>			  
								  













		</fieldset>
			</div>
        </div>

<?php
}
}
}?>



		
		
		
																			
																			
																		
								  
	
								  
								  
							








<?php
																				}else
																				{
																					$_SESSION['register_failure'] = 
																					"No results found or invalid search key";	
																					echo "<script>window.history.back();</script>";
																					exit;
																				}
																			}
																		}
																		?>






		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		

	

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


   

   

    

        $("#paid-modal").submit(function (e) {

   

            $("#myButt").attr("disabled", true);

   

            return true;

    

        });

    

    


</script>