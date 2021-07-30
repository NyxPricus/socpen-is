<?php
session_start();
$firstName = $lastName = $inputUsername = $inputEmail = "";
if(isset($_SESSION["register_data"])){
	$firstName = $_SESSION["register_data"][1];
	$lastName = $_SESSION["register_data"][2];
	$inputUsername = $_SESSION["register_data"][0];
	$inputEmail = $_SESSION["register_data"][3];
	$inputAddress = $_SESSION["register_data"][4];
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

    <title>SOCPEN INFORMATION SYSTEM | REGISTER</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

  </head>

  <body style="background-color:gray">

    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header"><h4>SOCPEN FO III INFORMATION SYSTEM</h4> Register User Account<BR><I>**After clicking the submit button, your account will be forwarded to SOCPEN RPMO III for approval</i></div>
        <div class="card-body">
		<?php if (isset($_SESSION["register_failure"])) {?>
			<div class="alert alert-danger alert-dismissable ">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<?php echo $_SESSION["register_failure"];unset($_SESSION["register_failure"]); ?>
			</div>
		<?php }?>
          <form method="POST" action="create_user.php">
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
                <input type="text" id="inputAddress" name="inputAddress" placeholder="Address" value="" required="required" <?php echo (isset($_SESSION["register_field"]) && $_SESSION["register_field"] == "ADRESS")? 'class="form-control is-invalid" autofocus="autofocus"':'class="form-control"'?>>
                <label for="inputAddress">Address</label>
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
          <div class="text-center">
            <a class="d-block small mt-3" href="user_login">Login Page</a>
      
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>
