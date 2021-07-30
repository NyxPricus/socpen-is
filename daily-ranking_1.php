
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
		
		
					<!-- START COPYING HERE -->
					
<H2>ACCOMPLISHMENT OF TAGGED PER DAY - 08/27/2020</H2>
<hr width="50%"
        size="50" 
        align="center" class = "new4"> 
<table class = "table table-bordered table-condensed">																			
	<thead class="thead-light">

    

		<th>RANK</th>
        <th>USER NAME</th>
        <th>TOTAL TAGGED</th>
	</thead>	
	<tbody>								  
    
    <?php
  
$countquery = "SELECT u.firstname,u.lastname,u.uName,sum(case when year = 2018 then 1 else 0 end) as y2018,sum(case when year = 2019 then 1 else 0 end) as y2019, sum((case when year = 2018 then 1 else 0 end) + (case when year = 2019 then 1 else 0 end)) as total
from uct_listahanan_paid ulop
join fo3user u on u.fo3UserId = ulop.updated_by
where ulop.date_updated = '2020-08-27'
GROUP BY u.fo3UserId, ulop.date_updated
order by total desc";
$countresult = $mysqli->query($countquery);
$totalcounter=0;
$rank = 0;
while($rowStatus = $countresult->fetch_assoc()){
	$uname = $rowStatus['uName'];
	$y2018 = $rowStatus['y2018'];
	$y2019 = $rowStatus['y2019'];
    $total = $rowStatus['total'];
    $totalcounter += $total;
    $rank += 1;
	//$tagging_unpaid = $rowStatus['tagging_2k_18_19'];?>
    




    <tr>
<td><?php echo $rank?></td>
<?php if($rank==1){
?>
            <td><?php echo $uname?><img src="piksur/trophy1-1.gif" style="width: 80px;height: 80px"></td>
<?php
}elseif($rank==2){
?>
 <td><?php echo $uname?><img src="piksur/trophy2.gif" style="width: 60px;height: 60px"></td>
<?php
}elseif($rank==3)

{ ?>
<td><?php echo $uname?><img src="piksur/trophy3.gif" style="width: 60px;height: 60px"></td>
<?php
}else
{?>
<td><?php echo $uname?></td>

<?php

}?>



<td><?php echo $total?></td>
</tr>
<?php }
?>
<tr>
    <td></td>

    <td style="text-align: right;"><strong>TOTAL:</strong></td>
    <td><strong><?php echo $totalcounter?></strong></td>
</tr>

	</tbody>
</table>					
					
		
<H2>ACCOMPLISHMENT OF TAGGED PER DAY - 08/26/2020</H2>
<hr width="50%"
        size="50" 
        align="center" class = "new4"> 
<table class = "table table-bordered table-condensed">																			
	<thead class="thead-light">

    

		<th>RANK</th>
        <th>USER NAME</th>
        <th>TOTAL TAGGED</th>
	</thead>	
	<tbody>								  
    
    <?php
  
$countquery = "SELECT u.firstname,u.lastname,u.uName,sum(case when year = 2018 then 1 else 0 end) as y2018,sum(case when year = 2019 then 1 else 0 end) as y2019, sum((case when year = 2018 then 1 else 0 end) + (case when year = 2019 then 1 else 0 end)) as total
from uct_listahanan_paid ulop
join fo3user u on u.fo3UserId = ulop.updated_by
where ulop.date_updated = '2020-08-26'
GROUP BY u.fo3UserId, ulop.date_updated
order by total desc";
$countresult = $mysqli->query($countquery);
$totalcounter=0;
$rank = 0;
while($rowStatus = $countresult->fetch_assoc()){
	$uname = $rowStatus['uName'];
	$y2018 = $rowStatus['y2018'];
	$y2019 = $rowStatus['y2019'];
    $total = $rowStatus['total'];
    $totalcounter += $total;
    $rank += 1;
	//$tagging_unpaid = $rowStatus['tagging_2k_18_19'];?>
    




    <tr>
<td><?php echo $rank?></td>
<?php if($rank==1){
?>
            <td><?php echo $uname?><img src="piksur/trophy1-1.gif" style="width: 80px;height: 80px"></td>
<?php
}elseif($rank==2){
?>
 <td><?php echo $uname?><img src="piksur/trophy2.gif" style="width: 60px;height: 60px"></td>
<?php
}elseif($rank==3)

{ ?>
<td><?php echo $uname?><img src="piksur/trophy3.gif" style="width: 60px;height: 60px"></td>
<?php
}else
{?>
<td><?php echo $uname?></td>

<?php

}?>



<td><?php echo $total?></td>
</tr>
<?php }
?>
<tr>
    <td></td>

    <td style="text-align: right;"><strong>TOTAL:</strong></td>
    <td><strong><?php echo $totalcounter?></strong></td>
</tr>

	</tbody>
</table>
		
		
				<!-- STOP COPYING HERE -->
		
		
		
		
		
		
		
		
			<!-- START COPYING HERE -->
		
		<H2>ACCOMPLISHMENT OF TAGGED PER DAY - 08/25/2020</H2>
<hr width="50%"
        size="50" 
        align="center" class = "new4"> 
<table class = "table table-bordered table-condensed">																			
	<thead class="thead-light">

    

		<th>RANK</th>
        <th>USER NAME</th>
        <th>TOTAL TAGGED</th>
	</thead>	
	<tbody>								  
    
    <?php
  
$countquery = "SELECT u.firstname,u.lastname,u.uName,sum(case when year = 2018 then 1 else 0 end) as y2018,sum(case when year = 2019 then 1 else 0 end) as y2019, sum((case when year = 2018 then 1 else 0 end) + (case when year = 2019 then 1 else 0 end)) as total
from uct_listahanan_paid ulop
join fo3user u on u.fo3UserId = ulop.updated_by
where ulop.date_updated = '2020-08-25'
GROUP BY u.fo3UserId, ulop.date_updated
order by total desc";
$countresult = $mysqli->query($countquery);
$totalcounter=0;
$rank = 0;
while($rowStatus = $countresult->fetch_assoc()){
	$uname = $rowStatus['uName'];
	$y2018 = $rowStatus['y2018'];
	$y2019 = $rowStatus['y2019'];
    $total = $rowStatus['total'];
    $totalcounter += $total;
    $rank += 1;
	//$tagging_unpaid = $rowStatus['tagging_2k_18_19'];?>
    




    <tr>
<td><?php echo $rank?></td>
<?php if($rank==1){
?>
            <td><?php echo $uname?><img src="piksur/trophy1-1.gif" style="width: 80px;height: 80px"></td>
<?php
}elseif($rank==2){
?>
 <td><?php echo $uname?><img src="piksur/trophy2.gif" style="width: 60px;height: 60px"></td>
<?php
}elseif($rank==3)

{ ?>
<td><?php echo $uname?><img src="piksur/trophy3.gif" style="width: 60px;height: 60px"></td>
<?php
}else
{?>
<td><?php echo $uname?></td>

<?php

}?>



<td><?php echo $total?></td>
</tr>
<?php }
?>
<tr>
    <td></td>

    <td style="text-align: right;"><strong>TOTAL:</strong></td>
    <td><strong><?php echo $totalcounter?></strong></td>
</tr>

	</tbody>
</table>
		
		
				<!-- STOP COPYING HERE -->
		
		
		
		
		
		
		
		
		
		
		
		
		
		<!-- START COPYING HERE -->
		
		<H2>ACCOMPLISHMENT OF TAGGED PER DAY - 08/24/2020</H2>
<hr width="50%"
        size="50" 
        align="center" class = "new4"> 
<table class = "table table-bordered table-condensed">																			
	<thead class="thead-light">

    

		<th>RANK</th>
        <th>USER NAME</th>
        <th>TOTAL TAGGED</th>
	</thead>	
	<tbody>								  
    
    <?php
  
$countquery = "SELECT u.firstname,u.lastname,u.uName,sum(case when year = 2018 then 1 else 0 end) as y2018,sum(case when year = 2019 then 1 else 0 end) as y2019, sum((case when year = 2018 then 1 else 0 end) + (case when year = 2019 then 1 else 0 end)) as total
from uct_listahanan_paid ulop
join fo3user u on u.fo3UserId = ulop.updated_by
where ulop.date_updated = '2020-08-24'
GROUP BY u.fo3UserId, ulop.date_updated
order by total desc";
$countresult = $mysqli->query($countquery);
$totalcounter=0;
$rank = 0;
while($rowStatus = $countresult->fetch_assoc()){
	$uname = $rowStatus['uName'];
	$y2018 = $rowStatus['y2018'];
	$y2019 = $rowStatus['y2019'];
    $total = $rowStatus['total'];
    $totalcounter += $total;
    $rank += 1;
	//$tagging_unpaid = $rowStatus['tagging_2k_18_19'];?>
    




    <tr>
<td><?php echo $rank?></td>
<?php if($rank==1){
?>
<td><?php echo $uname?><img src="piksur/GrBo.gif" style="width: 60px;height: 60px"></td>
<?php

}else
{?>
<td><?php echo $uname?></td>

<?php

}?>
<td><?php echo $total?></td>
</tr>
<?php }
?>
<tr>
    <td></td>

    <td style="text-align: right;"><strong>TOTAL:</strong></td>
    <td><strong><?php echo $totalcounter?></strong></td>
</tr>

	</tbody>
</table>
		
		
				<!-- STOP COPYING HERE -->
		

		
		
		




	<!-- START COPYING HERE -->
		
    <H2>ACCOMPLISHMENT OF TAGGED PER DAY - 08/20/2020</H2>
<hr width="50%"
        size="50" 
        align="center" class = "new4"> 
<table class = "table table-bordered table-condensed">																			
	<thead class="thead-light">

    

		<th>RANK</th>
        <th>USER NAME</th>
        <th>TOTAL TAGGED</th>
	</thead>	
	<tbody>								  
    
    <?php
  
$countquery = "SELECT u.firstname,u.lastname,u.uName,sum(case when year = 2018 then 1 else 0 end) as y2018,sum(case when year = 2019 then 1 else 0 end) as y2019, sum((case when year = 2018 then 1 else 0 end) + (case when year = 2019 then 1 else 0 end)) as total
from uct_listahanan_paid ulop
join fo3user u on u.fo3UserId = ulop.updated_by
where ulop.date_updated = '2020-08-20'
GROUP BY u.fo3UserId, ulop.date_updated
order by total desc";
$countresult = $mysqli->query($countquery);
$totalcounter=0;
$rank = 0;
while($rowStatus = $countresult->fetch_assoc()){
	$uname = $rowStatus['uName'];
	$y2018 = $rowStatus['y2018'];
	$y2019 = $rowStatus['y2019'];
    $total = $rowStatus['total'];
    $totalcounter += $total;
    $rank += 1;
	//$tagging_unpaid = $rowStatus['tagging_2k_18_19'];?>
    




    <tr>
<td><?php echo $rank?></td>
<?php if($rank==1){
?>
<td><?php echo $uname?></td>
<?php

}else
{?>
<td><?php echo $uname?></td>

<?php

}?>
<td><?php echo $total?></td>
</tr>
<?php }
?>
<tr>
    <td></td>

    <td style="text-align: right;"><strong>TOTAL:</strong></td>
    <td><strong><?php echo $totalcounter?></strong></td>
</tr>

	</tbody>
</table>
		
		
				<!-- STOP COPYING HERE -->
		

		
		


		
			<!-- START COPYING HERE -->
		
            <H2>ACCOMPLISHMENT OF TAGGED PER DAY - 08/19/2020</H2>
<hr width="50%"
        size="50" 
        align="center" class = "new4"> 
<table class = "table table-bordered table-condensed">																			
	<thead class="thead-light">

    

		<th>RANK</th>
        <th>USER NAME</th>
        <th>TOTAL TAGGED</th>
	</thead>	
	<tbody>								  
    
    <?php
  
$countquery = "SELECT u.firstname,u.lastname,u.uName,sum(case when year = 2018 then 1 else 0 end) as y2018,sum(case when year = 2019 then 1 else 0 end) as y2019, sum((case when year = 2018 then 1 else 0 end) + (case when year = 2019 then 1 else 0 end)) as total
from uct_listahanan_paid ulop
join fo3user u on u.fo3UserId = ulop.updated_by
where ulop.date_updated = '2020-08-19'
GROUP BY u.fo3UserId, ulop.date_updated
order by total desc";
$countresult = $mysqli->query($countquery);
$totalcounter=0;
$rank = 0;
while($rowStatus = $countresult->fetch_assoc()){
	$uname = $rowStatus['uName'];
	$y2018 = $rowStatus['y2018'];
	$y2019 = $rowStatus['y2019'];
    $total = $rowStatus['total'];
    $totalcounter += $total;
    $rank += 1;
	//$tagging_unpaid = $rowStatus['tagging_2k_18_19'];?>
    




    <tr>
<td><?php echo $rank?></td>
<?php if($rank==1){
?>
<td><?php echo $uname?></td>
<?php

}else
{?>
<td><?php echo $uname?></td>

<?php

}?>
<td><?php echo $total?></td>
</tr>
<?php }
?>
<tr>
    <td></td>

    <td style="text-align: right;"><strong>TOTAL:</strong></td>
    <td><strong><?php echo $totalcounter?></strong></td>
</tr>

	</tbody>
</table>
		
		
				<!-- STOP COPYING HERE -->
		

		
		
		
			<!-- START COPYING HERE -->
		
            <H2>ACCOMPLISHMENT OF TAGGED PER DAY - 08/18/2020</H2>
<hr width="50%"
        size="50" 
        align="center" class = "new4"> 
<table class = "table table-bordered table-condensed">																			
	<thead class="thead-light">

    

		<th>RANK</th>   
        <th>USER NAME</th>
        <th>TOTAL TAGGED</th>
	</thead>	
	<tbody>								  
    
    <?php
  
$countquery = "SELECT u.firstname,u.lastname,u.uName,sum(case when year = 2018 then 1 else 0 end) as y2018,sum(case when year = 2019 then 1 else 0 end) as y2019, sum((case when year = 2018 then 1 else 0 end) + (case when year = 2019 then 1 else 0 end)) as total
from uct_listahanan_paid ulop
join fo3user u on u.fo3UserId = ulop.updated_by
where ulop.date_updated = '2020-08-18'
GROUP BY u.fo3UserId, ulop.date_updated
order by total desc";
$countresult = $mysqli->query($countquery);
$totalcounter=0;
$rank = 0;
while($rowStatus = $countresult->fetch_assoc()){
	$uname = $rowStatus['uName'];
	$y2018 = $rowStatus['y2018'];
	$y2019 = $rowStatus['y2019'];
    $total = $rowStatus['total'];
    $totalcounter += $total;
    $rank += 1;
	//$tagging_unpaid = $rowStatus['tagging_2k_18_19'];?>
    




<tr>
<td><?php echo $rank?></td>
<?php if($rank==1){
?>
<td><?php echo $uname?></td>
<?php

}else
{?>
<td><?php echo $uname?></td>

<?php

}?>
<td><?php echo $total?></td>
</tr>
<?php }
?>
<tr>
    <td></td>

    <td style="text-align: right;"><strong>TOTAL:</strong></td>
    <td><strong><?php echo $totalcounter?></strong></td>
</tr>

	</tbody>
</table>
		
		
				<!-- STOP COPYING HERE -->
		

		
		
		
		
		
		
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