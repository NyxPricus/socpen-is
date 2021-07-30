
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



.help {cursor: help;}

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
</style>
<script>
$(document).ready(function(){
	$('#bene_img').click(function(){
  		$('#modal_bene').modal('show')
	});
});
</script>

  </head>

  <body id="page-top" style="background-color:#aef5c0">

   <?php include("include/header.php")?>

      <div id="content-wrapper">

        <div class="container-fluid">

		
		
		
		
		
		
		
	
		<?php 
		//echo $_GET['txthhid'];
		$hhid = trim($_GET['txthhid']);
		$hhidcount=strlen($hhid);

		?>




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
			//testing kung lagpas 8 ba hhid kung oo trim sa right by 8
			if($hhid > 8){
				$last8 = substr($hhid,-8);
			}else{
				$$last8 = $hhid;
			}
			
		//echo $last8;



$tmp_img_file_jpg = "bene_imgs/" . $last8 . ".jpg";
$tmp_img_file_jpeg = "bene_imgs/" . $last8 . ".jpeg";
$tmp_img_file_JPG = "bene_imgs/" . $last8 . ".JPG";
$tmp_img_file_JPEG = "bene_imgs/" . $last8 . ".JPEG";

$tester = file_exists($tmp_img_file_jpg); 
$tester2 = file_exists($tmp_img_file_jpeg);
$tester3 = file_exists($tmp_img_file_JPG);
$tester4 = file_exists($tmp_img_file_JPEG);



if ($tester==1)
{
    $final_img=$tmp_img_file_jpg;
}elseif($tester2==1){
	$final_img=$tmp_img_file_jpeg;
}
elseif($tester3==1){
	$final_img=$tmp_img_file_JPG;
}
elseif($tester4==1){
	$final_img=$tmp_img_file_JPEG;
}else{
	$final_img = "bene_imgs/default2.png";
}

		
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




































        <div style="background-color: #c5eafa; height:350px">


			<div class="container">
				<div class="row">
					<div class="profile-header-container">   
						<div class="profile-header-img">

<?php 
if($final_img == "bene_imgs/default2.png")
{
?>

							<img class="img-circle" src="<?php echo $final_img?>" alt= "No image available"/>
							</a><!-- badge -->

<?php }else{?>
	<img class="img-circle" src="<?php echo $final_img?>" alt= "BENE IMG" id="bene_img" style="cursor:pointer" title="Click to enlarge the beneficiary image"/>

<?php }?>

	<div class="modal fade modal-fluid" id="modal_bene">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<h4 class="modal-title">
<?php echo $complete_hhid?>
</h4>         
				<button type="button" class="close" data-dismiss="modal">×</button> 
			                                                    
			</div> 
			<div class="modal-body">
				
			<img style="width:400px;height:400px" src="<?php echo $final_img?>" alt= "BENE IMG">

			</div>   
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> &nbsp;Close</button>                        
			</div>
		</div>                                                                       
	</div>                                      
</div>













							<?php
							
								$sql="SELECT ul.id,ur.uct_id,ur.first_name1,ur.mid_name1,ur.last_name1,ur.ext_name1,ul.city_muni,ul.province,ul.barangay,ur.line_number,LEFT(ur.birthday, 10) as dob, sex_id
						from uct_roster ur
						inner join uct_list_110 ul on ul.hhid = ur.hh_id
						where ur.hh_id = ? and ur.rel_hh = '1'";
														
																		if($stmt = $mysqli->prepare($sql)){
																			
																		$stmt->bind_param("s", $param_hhid);
																		$param_hhid = $complete_hhid;
																			if($stmt->execute()){
																				$stmt->store_result();
																				if($stmt->num_rows != 0){                    
																				$stmt->bind_result($id,$uct_id,$first_name,$middle_name,$last_name,$ext,$muni,$province,$barangay,$line_number,$dob,$sex);
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
<H4><strong><?php echo $first_name . " " . $middle_name .  " " . $last_name . " " . $ext?><br></strong></H4>
	<hr class = "new4">


	<?php
$sql="select * from uct_list where hhid = '$complete_hhid' and pantawid_rpmo = 1";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
	
												 
$fantawid = "<span style='color:red'>-4P's";
					
}else
{
	$fantawid = "<span style='color:red'>";
	
}
?>
<H5><strong>	PERSONAL INFORMATION </strong></H5>






	<hr class = "new4">
													<strong>HOUSEHOLD ID:</strong><?php echo $uct_id?><br>
													
													
												
													<strong>BIRTHDAY:</strong><?php echo $dob?><br>
													<strong>AGE: </strong><?php echo $age?><br>
													<strong>SEX: </strong><?php echo $uri?><br>
													<strong>COMPLETE ADDRESS: </strong><a href="https://www.google.com/maps/place/<?php echo $barangay. " " . str_replace("(CAPITAL)", "" ,$muni) . " " . $province?>" target="_BLANK" title="Click here to view on Map (Up to barangay level only)"><i class="fas fa-map-marker-alt"></i><?php echo $barangay. ", " . $muni . ", " . $province?></a><br>
													

													<input type="hidden" id="editid" name="editid" value = <?php echo $id?> >
													<input type="hidden" id="editHHID" name="editHHID" value = <?php echo $complete_hhid?> >
													<input type="hidden" id="editfname" name="editfname" value = <?php echo $first_name?> >
													<input type="hidden" id="editmname" name="editmname" value = <?php echo $middle_name?> >
													<input type="hidden" id="editlname" name="editlname" value = <?php echo $last_name?> >
													<input type="hidden" id="editext" name="editext" value = <?php echo $ext?> >
													<input type="hidden" id="editbday" name="editbday" value = <?php echo $dob?> >
												
													<input type="hidden" id="editprov" name="editprov" value = <?php echo $province?> >

													<input type="hidden" id="editmuni" name="editmuni" value = <?php echo $muni?> >

													<input type="hidden" id="editbrgy" name="editbrgy" value = "<?php echo $barangay?>" >
													<input type="hidden" id="editid" name="editid" value = "<?php echo $id?>" >
													<input type="hidden" id="editext" name="editext" value = "<?php echo $ext?>" >
										
													<a target = "_Blank" href = "encodingFinal-Plug/searchcontroller2.php?hhid=<?php echo substr($hhid,0,8)?>"><button type = "button" class = "btn btn-info form-control"><i class="fas fa-pencil-alt"></i>&nbsp;UPDATE PROFILE</button></a>
													</form>
													<br><br><br>
												
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
								  













							
						</div>
					</div> 
				</div>
			</div>
			<br>
        </div>

<?php
}
}
}?>



		
		
		
																			
																			
																		
								  
	
								  
								  
								  
								  
								  
								  
								  
								  

							<div class = "container">
								<h2>HOUSEHOLD MEMBERS</h2>
								<table class = "table table-bordered table-condensed table-striped">	
																			
								<thead class="thead-light">
																		
																			<th>FIRST</th>
																			<th>MIDDLE </th>
																			<th>LAST</th>
																			
																			<th>BIRTHDAY</th>
																			<th>AGE</th>
																			<th>RELATIONSHIP</th>
																			<th>GENDER</th>
													
																			<th>BARANGAY</th>
																			<th>MUNICIPALITY</th>
																			<th>PROVINCE</th>
																			
																			
																			</thead>	
																			<tbody>
									
													
													
													
													
													
								
													
													
													
													
													
													
													
													
													
													
													
													
													
													
													
													
								
								
										<?php
									
								$sql="SELECT ur.uct_id,ur.rel_hh,ur.first_name1,ur.mid_name1,ur.last_name1,ur.ext_name1,ul.city_muni,ul.province,ul.barangay,ur.line_number,LEFT(ur.birthday, 10) as dob, sex_id
						from uct_roster ur
						inner join uct_list_110 ul on ul.hhid = ur.hh_id
						where ur.hh_id = ? and ur.rel_hh != '1'";
														
																		if($stmt = $mysqli->prepare($sql)){
																			
																		$stmt->bind_param("s", $param_hhid);
																		$param_hhid = $complete_hhid;
																			if($stmt->execute()){
																				$stmt->store_result();
																				if($stmt->num_rows != 0){                    
																				$stmt->bind_result($uct_id,$relationship,$first_name,$middle_name,$last_name,$ext,$muni,$province,$barangay,$line_number,$dob,$sex);
																					while($stmt->fetch()){
																					$taon = date("Y");
																					$year = substr($dob,0,4);
																					//echo $taon;
																					//echo $year;
																					$age = ($taon - $year);
																					if($relationship=="2"){
																					$relationship = "SPOUSE";
																					}
																					elseif($relationship=="3")
																					{
																						$relationship = "CHILD";
																					}
																					elseif($relationship=="4")
																					{
																						$relationship = "BROTHER/SISTER";
																					}
																					elseif($relationship=="5")
																					{
																						$relationship = "SON IN LAW/DAUGHTER IN LAW";
																					}
																					elseif($relationship=="6")
																					{
																						$relationship = "GRAND SON/GRAND DAUGHTER";
																					}
																					elseif($relationship=="7")
																					{
																						$relationship = "FATHER/MOTHER";
																					}
																					else
																					{
																						$relationship = "OTHER RELATIVE";
																					}
																					if($sex==1)
																					{
																						$uri = "MALE";
																		
																					}
																					else{
																						$uri = "FEMALE";
																					}
																				?>
																				
																				
																				
																						<tr>
																				
																				
																				<td><?php echo $first_name?></td>
																				<td><?php echo $middle_name?></td>
																				<td><?php echo $last_name . " " . $ext?></td>
																				
																				<td><?php echo $dob?></td>
																				<td><?php echo $age?></td>
																				<td><?php echo $relationship?>
																				<td><?php echo $uri?>
																			
																				<td><?php echo $barangay?></td>
																				<td><?php echo $muni?></td>
																				<td><?php echo $province?></td>
																				</td>
																				
																			
																			
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
	</tbody>
								</table>









<?php
																				}else
																				{
																					echo "<div class='alert alert-danger' align='center'><h1> <i class='fas fa-times fa-fw'></i>No results found on the list</h1></div>";	
																					?>
																				<a href="roster"><button type = "submit" class = "btn btn-info form-control"><i class = "fas fa-search"></i>&nbsp;Search Again</button></a>
																					<?php
																					exit();
																				}
																			}
																		}
																		?>






		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		

	
<?php
$statusQuery = "SELECT ul.status,uls.encoding, uls.notif_unpaid, uls.notif_2019, uls.validation, uls.tagging_2k_18_19
								FROM uct_listahanan_status uls
								join uct_list_110 ul on uls.hhid = ul.hhid
								WHERE uls.hhid = '$complete_hhid'";
$statusResult = $mysqli->query($statusQuery);
while($rowStatus = $statusResult->fetch_assoc()){
	$encoding = $rowStatus['encoding'];
	$notif_unpaid = $rowStatus['notif_unpaid'];
	$notif_2019 = $rowStatus['notif_2019'];
	$validation = $rowStatus['validation'];
	$tagging_unpaid = $rowStatus['tagging_2k_18_19'];
	$ul_status = $rowStatus['status'];?>

<h2>NOTIFICATION</h2>
<hr width="50%"
        size="50" 
        align="center" class = "new4"> 
<table class = "table table-bordered table-condensed">																			
	<thead class="thead-light">
		<th>BATCH OPENING</th>
		<th>UNPAID NOTIFICATION</th>
		<th>NOTIFICATION 2019</th>
		<th>VALIDATION</th>
		<th>REVALIDATION STATUS</th>
	</thead>	
	<tbody>								  
		<tr>
			<td><?php echo $encoding?></td>
			<td><?php echo $notif_unpaid?></td>
			<td><?php echo $notif_2019?></td>
			<td><?php echo $validation?></td>
			<td><?php echo $ul_status?></td>
		</tr>
	</tbody>
</table>

<?php }

/*$sql="SELECT sd.validation_status_description,sd.validation_status
FROM uct_list_110 ul 
INNER JOIN listahanan_statuses ls on ls.hhid = ul.hhid 
INNER JOIN status_description sd on sd.validation_status = ls.status  
where ul.hhid = '$hhid'";
 $result = $mysqli->query($sql);
                    if ($result->num_rows > 0) {
						  while($row = $result->fetch_assoc()) {
						$desc = $row['validation_status_description'];
						$status_code = $row['validation_status'];
                      if($status_code==100)
					  {
						  $divstyle = "<div class='alert alert-success'>";
					  }else
					  {
						   $divstyle = "<div class='alert alert-danger'>";
					  }*/
?>




<!--?php echo $divstyle;?>
		<h3>BENEFICIARY STATUS: <?php echo $desc;?></h3><h6><i>Status was based on December 2019 validation or 2019 payroll</i></h6>
		</div-->

		<?php
						  /*}
}else
{*/?>
<!--div class='alert alert-danger'>
<h3>BENEFICIARY DATA FOR VALIDATION</h3>
</div-->

<?php //}?>



<?php
/*$sql="SELECT bo.hhid,bo.last_name,bo.first_name,bo.middle_name,bo.ext,bo.status,bons.status_description
FROM `batch_opening` bo
inner join batch_opening_notification_statuses bons on bons.status_code = bo.status
where bo.hhid = '$hhid'";
 $result = $mysqli->query($sql);
                    if ($result->num_rows > 0) {
						  while($row = $result->fetch_assoc()) {
						$desc_bo = $row['status_description'];*/
						?>
						<!--div class='alert alert-info'>
BENEFICIARY STATUS BASED ON BATCH OPENING TEMPLATE:&nbsp;<strong><u><?php //echo $desc_bo;?></u></strong>
</div-->
					
						<?php
						  /*}
					}else
					{*/
						?>
						<!--div class='alert alert-info'>BENEFICIARY STATUS BASED ON BATCH OPENING TEMPLATE:&nbsp;<strong><u>NOT ENCODED ON THE DATABASE</u></strong></div-->
						
					<?php //}?>











<br>
<h4>PAYMENT HISTORY</h4>
<table class = "table table-bordered table-condensed" id = "payment_history">																			
	<thead class="thead-light">

<tr>
	<th>2018</th>
	<th>2019</th>
	<th>2020</th>
</tr>
</thead>
<tbody>
<tr>
<?php
$sql="select * from uct_listahanan_paid where hhid = '$complete_hhid' and year = 2018";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
	
												 
echo "<td style='color:green'>2,400</td>";
					
}else
{
	echo "<td style='color:red'>UNPAID</td>";
}
?>

<?php
$sql="select * from uct_listahanan_paid where hhid = '$complete_hhid' and year = 2019";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
	
												 
echo "<td style='color:green'>3,600</td>";
					
}else
{
	echo "<td style='color:red'>UNPAID</td>";
}
?>
<td>NO PAYOUT YET</td>
</tr>
</tbody>
</table>
<BR>






<h4>UPDATE HISTORY</h4>
<table class = "table table-bordered table-condensed">																			
	<thead class="thead-light">

<tr>
	<th>TYPE OF UPDATE</th>
	<th>UPDATED NAME</th>
	<th>RELATION TO GRANTEE</th>
	<th>DATE OF UPDATE</th>
	<th>SUPPORTING DOCS</th>
	<th>UPDATED BY</th>
</tr>
</thead>
<tbody>
<tr>


<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "dbencoding2");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 $updatedby = "";
// Attempt select query execution
$sql = "SELECT r.description as r_desc,concat(last_name, ' ', first_name, ' ', middle_name) as fullname, rs.description as rel_desc,date_updated,updated_by 
FROM `batch_opening` bo
join remarks r on r.id = bo.remarks_id
join relationship rs on rs.id = bo.relationship_id
where uct_id = '$complete_hhid'";

if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){

        while($row = mysqli_fetch_array($result)){
			
			if($row['updated_by']==13){
				$updatedby = "nyxpricus";
			}
            echo "<tr>";
                echo "<td>" . $row['r_desc'] . "</td>";
                echo "<td>" . $row['fullname'] . "</td>";
                echo "<td>" . $row['rel_desc'] . "</td>";
                echo "<td>" . $row['date_updated'] . "</td>";
				echo "<td>NO SUPP DOCS</td>";
				echo "<td>" . $updatedby . "</td>";

	
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
         echo "<tr>";
                echo "<td colspan = '6'>NO CHANGE HISTORY</td>";
           

	
            echo "</tr>";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>

	





</tbody>
</table>


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




<h4>UPLOADED SUPPORTING DOCUMENTS</h4>
<?php



				
$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "dbencoding2";

// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}




// Get images from the database
$query = $db->query("SELECT * FROM images where hhid = '$complete_hhid'");

if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $imageURL = 'uploads/'.$row["file_name"];
?>

                                      
                                        <a target="_blank" href="./encodingFinal-Plug/<?php echo $imageURL?>" title = '<?php echo $row["file_name"]; ?>'>
                                        <img src="./encodingFinal-Plug/<?php echo $imageURL?>" class="img-responsive img-thumbnail" width="150" height="150">
										
                                        </a>
                                  
<?php }
}else{ ?>
    <p>No image(s) found...</p>
 <?php }  ?>







<script language=JavaScript>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip({title: "Hooray!", animation: true, delay: {show: 500, hide: 1000}});   
 });

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