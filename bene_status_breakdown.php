
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

    <title>UCT - LISTAHANAN | STATUS BREAKDOWN</title>

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

				
				
				
				
				
				
				
				
				
				
				
				
				<div class='table-responsive'>
        <table id="dtBasicExample" class="table table-striped table-bordered">
            <thead>
                <tr>
                   
                    
                   
					
					<th>HHID</th>
					<th>NAME</th>
					<th>STATUS</th>
					
                   
                </tr>
            </thead>
            <tfoot>
                <tr>
                       
                    
                   
					<th>HHID</th>
					<th>NAME</th>
					<th>STATUS</th>
                </tr>
            </tfoot>
            <tbody>
                
                   <?php
				   $status_id = $_GET['status_code'];
					  $sql = "SELECT ul.hhid, concat(ul.first_name, ' ', ifnull(ul.middle_name,''), ' ', ul.last_name, ' ',ifnull(ul.ext,'')) as fullname, sd.validation_status_description, count(ul.hhid) as bilang,sd.validation_status
						FROM uct_list_110 ul 
						INNER JOIN listahanan_statuses ls on ls.hhid = ul.hhid 
						INNER JOIN status_description sd on sd.validation_status = ls.status
						where sd.validation_status = '$status_id' 
						group by ul.hhid";
                    $result = $mysqli->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
							$hhid = $row['hhid'];
							$fullname = $row['fullname'];
							$bilang = $row['bilang'];
							$status = $row['validation_status_description'];
							

					
						
                    ?>					
                <tr>
                 


					
					<td>
                       <font size="3px"> <a href = "roster_data?txthhid=<?php echo $hhid;?>" title = "Click to view bene information and roster"><?php echo $hhid; ?></a></font>
                    </td>
					<td>
                       <font size="3px"> <?php echo $fullname; ?></font>
                    </td>
					<td>
                       <font size="3px"> <?php echo $status; ?></font>
                    </td>
					
					</div>
					</div>
					
			
		
		
		

		
		
		
		
		
			<?php }
					}
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


$(document).ready(function () {
$('#dtBasicExample').DataTable();
$('.dataTables_length').addClass('bs-select');
});
</script>