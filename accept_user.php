<?php
session_start();
require_once './config/config.php';
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

    <title>User Types</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

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
              <a href="#">Users</a>
            </li>
            <li class="breadcrumb-item active">Accept User Account Request</li>
          </ol>

          <!-- DataTables Example -->
   
   
      
      <div id="content-wrapper">

        <div class="container-fluid">

         

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-user"></i>
             
   
   <?php
   
   $uid = $_GET['request_id'];

   
   
   $sql = "SELECT firstName,lastName, address, uDate, uEmail,uName,utype FROM fo3user WHERE fo3UserId = ? and uStatus = 0";
	
	if($stmt = $mysqli->prepare($sql)){
		
		$stmt->bind_param("s", $paramID);
		$paramID = $uid;
		if($stmt->execute()){
			$stmt->store_result();
			if($stmt->num_rows == 1){                    
				$stmt->bind_result($firstName,$lastName, $address,$udate,$uEmail,$uName,$uType);
                                
				if($stmt->fetch()){
					
					
					echo "<b>" .$firstName. " " .$lastName ."</b>";
					
					
				}
			} else{
				// Display an error message if username doesn't exist
				echo "Problem in loading the page";
					
			}
		} else{
			echo "Oops! Something went wrong. Please try again later.";
			
		}
		$stmt->close();   
	}
	$mysqli->close();
   
  
   ?>
   
   

			 
			 
			 
			 
			 </div>
            <div class="card-body">
   
   <?php
 
   if(isset($address)){
   
   echo "<b>Requesting User Name:</b> ". $uName . "<br>";
   echo "<b>Requesting User Address:</b	> 	". $address . "<br>";
   echo "<b>Requesting Email Address:</b> 	". $uEmail . "<br>";
   echo "<b>Date and Time Requested:</b> 	". $udate . "<br>";
   ?>
   <b>User Type Requested: </b>
   
   <? if ($uType=='1')
									  {
										 echo "Admin";  
									  }
									 elseif($uType=='2'){
										  echo "Reviewer";  
									 }
									  elseif($uType=='3'){
										  echo "TEV";  
									 }
									   elseif($uType=='4'){
										  echo "Encoder";  
									 }
									 elseif($uType=='5'){
										  echo "Notifier";  
									 }
									 
									 ?>
   <br>
<form action = "accept_user_final.php" method = "POST">
Select user type you want <?php echo $firstName . " " . $lastName; ?> to be assigned<br>
                <select name = "inputType">
				<option value = "" disabled>---SELECT SOMETHING---</option>
				<option value = "2">Encoder</option>
				<option value = "3">TEV</option>
				<option value = "4">Reviewer</option>
				<option value = "5">Notifier</option>
				<option value = "1">Admin</option>
				</select>
               <input type = "hidden" name = "idval" value = "<?php echo $uid?>">
    <script>
function confirmDelete(delUrl,firstName) {
  if (confirm("Are you sure you want to Decline " + firstName + " request?")) {
    document.location = delUrl;
  }
}
function confirmUpdate(delUrl,firstName) {
  if (confirm("Are you sure you want to Accept " + firstName + " request?")) {
    document.location = delUrl;
  }
}
</script>
   <br><br>	
   <a href="javascript:confirmUpdate('accept_user_final?request_id=<?php echo $uid?>','<?PHP echo $firstName?>')"><button class="btn btn-success" class = "form-control"><i class="fa fa-check"></i>Accept Request</button></a>&nbsp; 
<a href="javascript:confirmDelete('decline_user?uid=<?php echo $uid?>', '<?PHP echo $firstName?>')"><button class="btn btn-danger"><i class="fa fa-window-close"></i> Decline Request</button></a> </td>
   
   
   </form>
   
   
   
   
   <?php
   }
   else
   {
	   echo "Problem in loading the page";
   }
   ?>
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   </div>
   
   </div>
   
   </div>
   
   </div>
   </div>
   
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

	<?php include("include/footer.php")?>

  </body>

</html>
