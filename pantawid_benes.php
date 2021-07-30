
<?php
session_start();
require_once 'config/config.php';
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

    <title>UCT - LISTAHANAN | PANTAWID</title>

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
		
		
		
		
	

		
		
		
		
		
		
		
		
		
		
<H2>LIST OF PANTAWID BENEFICIARIES IDENTIFIED BY 4PS RPMO</H2>    

<div class="container" id="content-wrapper">
					<div class='table-responsive'>
        <table id="dtBasicExample" class="table table-striped table-bordered">
<thead>
    

		<th>HHID</th>
    <th>FULLNAME</th>
    <th>BARANGAY</th>
        <th>MUNICIPALITY</th>
        <th>PROVINCE</th>
       

       
	</thead>	
	<tbody>								  
    
    <?php
$countquery = "SELECT b.hhid, concat(b.last_name, ' ' , b.first_name , ' ' , ifnull(b.middle_name,'') , ' ' , ifnull(b.ext,'')) as fullname , b.city_muni, b.province,b.barangay
FROM `pantawid` a
join uct_list_110 b on a.hhid = b.hhid";
$countresult = $mysqli->query($countquery);
$totalcounter=0;
while($rowStatus = $countresult->fetch_assoc()){
//	$bid = $rowStatus['id'];
	$fname = $rowStatus['fullname'];
  $city_muni = $rowStatus['city_muni'];
  $barangay = $rowStatus['barangay'];
    $province = $rowStatus['province'];
$bhhid = $rowStatus['hhid'];
//$c = $rowStatus['city'];
 
	//$tagging_unpaid = $rowStatus['tagging_2k_18_19'];?>
    




<tr>

<td><?php echo $bhhid?></td>
<td><?php echo $fname?></td>
<td><?php echo $barangay?></td>
<td><?php echo $city_muni?></td>

<td><?php echo $province?></td>



</tr>






<?php }



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