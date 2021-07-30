<?php
session_start();
require_once './config/config.php';
require_once './include/auth_validate.php';


$firstName = $lastName = $inputUsername = $inputEmail = "";
if(isset($_SESSION["register_data"])){
	$firstName = $_SESSION["register_data"][1];
	$lastName = $_SESSION["register_data"][2];
	$inputUsername = $_SESSION["register_data"][0];
	$inputEmail = $_SESSION["register_data"][3];
	$inputAddress = $_SESSION["register_data"][4];
	$inputType = $_SESSION["register_data"][5];
	//$inputPassword = $_POST['inputPassword'];
	//$confirmPassword = $_POST['confirmPassword'];
	//unset($_SESSION["register_data"]);
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

    <title>Edit User</title>

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
            <li class="breadcrumb-item active">Update User </li>
          </ol>

          <!-- DataTables Example -->

   <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Update an Account</div>
        <div class="card-body">
		<?php if (isset($_SESSION["register_failure"])) {?>
		<?php if ($_SESSION["register_failure"]=='SAVED!') {?>
		
		
		<div class="alert alert-success" role="alert">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<?php echo $_SESSION["register_failure"];unset($_SESSION["register_failure"]); ?>
			</div>
			
			
		<?php }else
		{
			?>
			
			<div class="alert alert-danger alert-dismissable ">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<?php echo $_SESSION["register_failure"];unset($_SESSION["register_failure"]); ?>
			</div>
			
			<?php
		}
		}?>
          <form method="POST" action="admin_reg_user.php">
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" id="firstName" name="firstName" class="form-control" placeholder="First name" value="<?php echo $firstName; ?>" required="required" <?php echo !isset($_SESSION["register_field"])? 'autofocus="autofocus"':''?>>
                    <label for="firstName">First name</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" id="lastName" name="lastName" class="form-control" placeholder="Last name" value="<?php echo $lastName; ?>" required="required">
                    <label for="lastName">Last name</label>
                  </div>
                </div>
              </div>
            </div>
			<div class="form-group">
              <div class="form-label-group">
                <input type="text" id="inputUsername" name="inputUsername" placeholder="Username" value="<?php echo $inputUsername; ?>" required="required" <?php echo (isset($_SESSION["register_field"]) && $_SESSION["register_field"] == "USERNAME")? 'class="form-control is-invalid" autofocus="autofocus"':'class="form-control"'?>>
                <label for="inputUsername">Username</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="email" id="inputEmail" name="inputEmail" placeholder="Email address" value="<?php echo $inputEmail; ?>" required="required" <?php echo (isset($_SESSION["register_field"]) && $_SESSION["register_field"] == "USEREMAIL")? 'class="form-control is-invalid" autofocus="autofocus"':'class="form-control"'?>>
                <label for="inputEmail">Email address</label>
              </div>
            </div>
			<div class="form-group">
              <div class="form-label-group">
                <input type="text" id="inputEmail" name="inputAddress" placeholder="Address" value="<?php echo $inputEmail; ?>" required="required" <?php echo (isset($_SESSION["register_field"]) && $_SESSION["register_field"] == "ADRESS")? 'class="form-control is-invalid" autofocus="autofocus"':'class="form-control"'?>>
                <label for="inputEmail">Address</label>
              </div>
            </div>
			<div class="form-group">
              <div class="form-label-group">
                <select name = "inputType" class="form-control">
				<option value = "">---SELECT SOMETHING---</option>
				<option value = "1">Admin</option>
				<option value = "2">Encoder</option>
				<option value = "3">TEV</option>
				<option value = "4">Reviewer</option>
				<option value = "5">Notifier</option>
				</select>
               
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="password" id="inputPassword" name="inputPassword" placeholder="Password" required="required" <?php echo (isset($_SESSION["register_field"]) && $_SESSION["register_field"] == "PASSWORD")? 'class="form-control is-invalid" autofocus="autofocus"':'class="form-control"'?>>
                    <label for="inputPassword">Password</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm password" required="required"<?php echo (isset($_SESSION["register_field"]) && $_SESSION["register_field"] == "PASSWORD")? 'class="form-control is-invalid"':'class="form-control"'?>>
                    <label for="confirmPassword">Confirm password</label>
                  </div>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-success btn-block">Register</button>
          </form>
         
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
