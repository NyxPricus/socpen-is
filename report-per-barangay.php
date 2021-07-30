
<?php
session_start();
require_once 'config/config.php';
require_once './include/auth_validate.php';
unset($_SESSION['province']);
$province_get=$_GET['province'];
if($_GET['muni']=="CANDABA" OR $_GET['muni']=="OBANDO" OR $_GET['muni']=="PANDI" OR $_GET['muni']=="CITY OF SAN FERNANDO (Capital)"){
$muni_get = $_GET['muni'];
}else{
$muni_get=str_replace("AND","&" , $_GET['muni']);

}
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
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);


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
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);


</script>
		
		
		
		
	
		
		
		

		
		
		
		
		
		
<H2><center>REPORT OF PAID PER MUNI (<?php echo $province_get?>)</center></H2>
<hr width="50%"
        size="50" 
        align="center" class = "new5"> 
<table class = "table table-bordered table-condensed">																			
	<thead class="thead-light">

    
  
		<th>MUNICIPALITY</th>
        <th>2018</th>
        <th>2019</th>
        <th>TOTAL TAGGED</th>
	</thead>	
	<tbody>								  
    
    <?php
 // $rank = 0;
$countquery2 = "SELECT ul.city_muni,sum(case when ulop.year = 2018 then 1 else 0 end) as y2018,sum(case when ulop.year = 2019 then 1 else 0 end) as y2019, sum((case when ulop.year = 2018 then 1 else 0 end) + (case when ulop.year = 2019 then 1 else 0 end)) as total, ul.barangay
FROM `uct_listahanan_paid` ulop
join uct_list_110 ul on ul.hhid = ulop.hhid
where ul.province = '" . $province_get . "' and ul.city_muni = '" . $muni_get . "'
group by ul.barangay
order by ul.city_muni asc";
$countresult2 = $mysqli->query($countquery2);
$totalcounter=0;
$total2018 = 0;
$total2019 = 0;
while($rowStatus2 = $countresult2->fetch_assoc()){
 
	//$fullname = strtoupper($rowStatus2['firstname']) . " " . strtoupper($rowStatus2['lastname']);
	$y2018 = $rowStatus2['y2018'];
	$y2019 = $rowStatus2['y2019'];
    $total = $rowStatus2['total'];
    $muni = $rowStatus2['city_muni'];
    $muni_t=str_replace("&","AND" , $muni);
    $barangay = $rowStatus2['barangay'];
    $totalcounter += $total;
   // $rank += 1 ;
    $total2018 += $y2018;
    $total2019 += $y2019;
	?>
    



<tr>

<td><a href="report-per-bene?province=<?php echo $province_get?>&muni=<?php echo $muni_t?>&barangay=<?php echo $barangay?>" target="_Blank"><?php echo $barangay?></a></td>
<td><?php echo $y2018?></td>
<td><?php echo $y2019?></td>
<td><?php echo $total?></td>
</tr>
<?php }
?>
<tr>
   
    <td style="text-align: right;"><strong>TOTAL:</strong></td>
    <td><strong><?php echo number_format($total2018)?></strong></td>
    <td><strong><?php echo number_format($total2019)?></strong></td>
    
    <td><strong><?php echo number_format($totalcounter)?></strong></td>
</tr>

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