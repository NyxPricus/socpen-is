
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
              <a href="#">Upload unpaid beneficiaries</a>
            </li>
          
          </ol>

          <!-- Icon Cards-->
          

<div class="container" id="content-wrapper">
<form action="file_save.php" method="post" enctype="multipart/form-data">
Upload Unpaid beneficiaries to database<br>



                                <input type="file" name="uploadFile[]" multiple class = "form-control"/>
                              








<label for = "yearofpayout">Year of Payout</label>
<select name = "yearofpayout" class = "form-control">
<option value = "2018">2018</option>
<option value = "2018">2019</option>
<option value = "2018">2020</option>
<option value = "2018">2021</option>
<option value = "2018">2022</option>
</select>
 <input type="submit" name="submit" value="Upload" class="btn btn-dark form-control"/>
 <?php 
 if(isset($_SESSION["meronna"]))
 {
 echo $_SESSION["meronna"];
	UNSET($_SESSION["meronna"]);
 }
 ?>
</form>
</div>


		 
		  
        </div>
		                            </form>
		
		
<?php















unset($_POST['encode_unpaid']);

						

?>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
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