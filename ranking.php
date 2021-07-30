
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
		
		
		
		
	
		
		
		

		
		
		
		
		
		
<H2><center>STAFF RANKING</center></H2>
<hr width="50%"
        size="50" 
        align="center" class = "new5"> 
<table class = "table table-bordered table-condensed">																			
	<thead class="thead-light">

    
    <th>RANK</th>
		<th>USERNAME</th>
		<th>NAME</th>
        <th>2018</th>
        <th>2019</th>
        <th>TOTAL TAGGED</th>
	</thead>	
	<tbody>								  
    
    <?php
  $rank = 0;
$countquery2 = "SELECT u.firstname,u.lastname,u.uName,sum(case when year = 2018 then 1 else 0 end) as y2018,sum(case when year = 2019 then 1 else 0 end) as y2019, sum((case when year = 2018 then 1 else 0 end) + (case when year = 2019 then 1 else 0 end)) as total
from uct_listahanan_paid ulop
join fo3user u on u.fo3UserId = ulop.updated_by
GROUP BY u.fo3UserId
order by total desc";
$countresult2 = $mysqli->query($countquery2);
$totalcounter=0;
$total2018 = 0;
$total2019 = 0;
while($rowStatus2 = $countresult2->fetch_assoc()){
	$fullname = strtoupper($rowStatus2['firstname']) . " " . strtoupper($rowStatus2['lastname']);
	$y2018 = $rowStatus2['y2018'];
	$y2019 = $rowStatus2['y2019'];
    $total = $rowStatus2['total'];
    $uname = $rowStatus2['uName'];
    $totalcounter += $total;
    $rank += 1 ;
    $total2018 += $y2018;
    $total2019 += $y2019;
	?>
    



<tr>
<td><?php echo $rank?></td>
<td><?php echo $uname?></td>
<td><?php echo $fullname?></td>
<td><?php echo $y2018?></td>
<td><?php echo $y2019?></td>
<td><?php echo $total?></td>
</tr>
<?php }
?>
<tr>
    <td></td>
    <td></td> 
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