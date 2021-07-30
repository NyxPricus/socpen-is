
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

    <title>UCT - LISTAHANAN | TAGGING OF PAID</title>

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

		
		
		
		
		
		
		
		    
        <?php include("include/popup_style.php")?>


        <?php 
 if(isset($_SESSION["register_failure"]))
 {
   
  

  ?>
<div id="mali"><i class = "fa fa-times"></i> <?php echo $_SESSION["register_failure"]; ?></div>
<?php unset($_SESSION["register_failure"]);?></div>

<?php }?>


<script>

  var x = document.getElementById("mali");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 1000000);


</script>
<?php 
 if(isset($_SESSION["register_okay"]))
 {?>
				
		<div id="charan"><i class = "fa fa-check"></i> <?php echo $_SESSION['register_okay'];?>!</div>

 <?php 
unset($_SESSION['register_okay']);

}?>

<script>

  var x = document.getElementById("charan");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 1000000);


</script>
		
		
		
		
		
		<H2>ACCOMPLISHMENT OF TAGGED PER DAY</H2>
<hr width="50%"
        size="50" 
        align="center" class = "new4"> 
<table class = "table table-bordered table-condensed">																			
	<thead class="thead-light">

    

		<th>DATE</th>
        <th>2018</th>
        <th>2019</th>
        <th>TOTAL TAGGED</th>
	</thead>	
	<tbody>								  
    
    <?php
  
$countquery = "SELECT date_updated,sum(case when year = 2018 then 1 else 0 end) as y2018,sum(case when year = 2019 then 1 else 0 end) as y2019
from uct_listahanan_paid
where updated_by = " . $_SESSION['user_id'] .  "
GROUP BY date_updated 
order by date_updated desc";
$countresult = $mysqli->query($countquery);
$totalcounter=0;
while($rowStatus = $countresult->fetch_assoc()){
	$date_updated = $rowStatus['date_updated'];
	$y2018 = $rowStatus['y2018'];
	$y2019 = $rowStatus['y2019'];
    $subtotal = $y2018 + $y2019;
    $totalcounter += $subtotal;
	//$tagging_unpaid = $rowStatus['tagging_2k_18_19'];?>
    




<tr>
<td><?php echo $date_updated?></td>
<td><?php echo $y2018?></td>
<td><?php echo $y2019?></td>
<td><?php echo $subtotal?></td>
</tr>
<?php }
?>
<tr>
    <td></td>
    <td></td>
    <td style="text-align: right;"><strong>TOTAL:</strong></td>
    <td><strong><?php echo $totalcounter?></strong></td>
</tr>

	</tbody>
</table>
		
		
		
		

		
		
		
		
		
		
		
		
		
		
<H2>DETAILED ACCOMPLISHMENT</H2>
<div class="container" id="content-wrapper">
					<div class='table-responsive'>
        <table id="dtBasicExample" class="table table-striped table-bordered">
<thead>
    

		<th>HHID</th>
        <th>FIRST NAME</th>
        <th>MIDDLE NAME</th>
        <th>LAST NAME</th>

        <th>CITY/MUNI</th>
        <th>PROVINCE</th>
        <th>YEAR</th>
        <th>DATE TAGGED</th>
        <th>ACTION</th>
	</thead>	
	<tbody>								  
    
    <?php
$countquery = "select ulop.date_updated, ulop.id,ulop.hhid,ul.last_name,ul.first_name,ul.middle_name,ul.barangay,ul.city_muni,ul.province,ulop.year
from uct_listahanan_paid ulop
join uct_list_110 ul on ul.hhid = ulop.hhid
where ulop.updated_by = " . $_SESSION["user_id"];
$countresult = $mysqli->query($countquery);
$totalcounter=0;
while($rowStatus = $countresult->fetch_assoc()){
	$hhid_comp = $rowStatus['hhid'];
	$last_name = $rowStatus['last_name'];
	$middle_name = $rowStatus['middle_name'];
    $first_name = $rowStatus['first_name'];
   // $barangay = $rowStatus['barangay'];
	$city_muni = $rowStatus['city_muni'];
	$province = $rowStatus['province'];
    //$yy2018 = $rowStatus['y2018'];
    //$yy2019 = $rowStatus['y2019'];
    $year = $rowStatus['year'];  
    $haydee = $rowStatus['id'];
    $date_tagged = $rowStatus['date_updated'];
 
	//$tagging_unpaid = $rowStatus['tagging_2k_18_19'];?>
    




<tr>
<td><?php echo $hhid_comp?></td>
<td><?php echo $last_name?></td>
<td><?php echo $first_name?></td>
<td><?php echo $middle_name?></td>

<td><?php echo $city_muni?></td>
<td><?php echo $province?></td>
<td><?php echo $year?></td>
<td><?php echo $date_tagged?></td>
<td>
<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal<?php echo $haydee?>">Update&nbsp;<i class="fa fa-edit"></i></button>
                            <a href="del_bene?del=<?php echo $haydee;?>" onclick="return confirm('Do you want to Delete');" class="btn btn-danger btn-sm edit btn-flat">DELETE &nbsp;<i class="fa fa-trash"></i></a>
                          
                        </td>
</tr>




<div class="modal fade" tabindex="-1" role="dialog" id = "myModal<?php echo $haydee?>">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">EDIT ACCOMPLISHMENT</h5>
        <form action="edit_bene2" method="POST">
        <input type="hidden" name = "txt_hhid" value="<?php echo $hhid_comp?>">
        <input type="hidden" name = "txt_id" value="<?php echo $haydee?>">
        </button>
      </div>
      <div class="modal-body">
        <p><?php echo $hhid_comp?><br></p>PAYOUT YEAR(S): 


        <br>EDIT NOT YET AVAILABLE


<?php
$sql="SELECT id,hhid,updated_by,date_updated,y2018,y2019,y2020 from uct_list_of_unpaid where id = ? limit 1";

																		
if($stmt = $mysqli->prepare($sql)){
																			
	$stmt->bind_param("s", $haydeex);
	$haydeex = $haydee;
		if($stmt->execute()){
			$stmt->store_result();
			if($stmt->num_rows != 0){                    
			$stmt->bind_result($id,$hhid,$updated_by,$date_updated,$y2018,$y2019,$y2020);
			$stmt->fetch();
            }
        }
    

?>

<?php
if($y2018==1){
?>
<div class="custon-control custom-checkbox">
<input type="checkbox" name="y2018_c" value="1" checked>
<label for="y2018_c">2018</label>
</div>
<?php } else {
?>
<div class="custon-control custom-checkbox">
<input type="checkbox" value="1" name="y2018_c">
<label for="y2018_c">2018</label>
</div>

<?php }
?>


<?php
if($y2019==1){
?>
<div class="custon-control custom-checkbox">
<input type="checkbox" name="y2019_c" value="1" checked>
<label for="y2019_c">2019</label>
</div>
<?php } else {
?>
<div class="custon-control custom-checkbox">
<input type="checkbox" value="1" name="y2019_c">
<label for="y2019_c">2019</label>
</div>

<?php }
?>

<?php
if($y2020==1){
?>
<div class="custon-control custom-checkbox">
<input type="checkbox" value="1" name="y2020_c" checked>
<label for="y2020_c">2020</label>
</div>
<?php } else {
?>
<div class="custon-control custom-checkbox">
<input type="checkbox" value="1" name="y2020_c">
<label for="y2020_c">2020</label>
</div>

<?php }
?>






      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" id = "myButt_edit" name = "myButt_edit" >Edit</button>
</form>
      </div>
    </div>
  </div>
</div>












<?php }

}

?>
	</tbody>
</table>
		
		
		
		
		
		
		
		
		
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