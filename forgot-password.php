<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>UCT - Reset Password</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

  </head>

  <body class="bg-dark">
<?php
require_once './config/config.php';
if (isset($_POST['submit']))
{
$sql = "SELECT * FROM fo3user WHERE uEmail = '$_POST[email]' ";
				  $result = mysqli_query($db,$sql);
				  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	  $count = mysqli_num_rows($result);			  
	$mess = '';
	if ($count == 1)
	{
		$code = (rand());
		$sql = "insert into fo3reset(reset_email,reset_verification_code) values('$_POST[email]','$code')";
		 $result = mysqli_query($db,$sql);
				  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		
		
$to = $_POST['email'];
$subject = "UCT Encoding System | Password Reset";

$message = "
<html>
<head>
<title>UCT Encoding System | Password Reset</title>
</head>
<body>
<p>You are now to reset your password</p>
Please paste this Verification Code to the text box<br> $code
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: UCT Encoding System Website' . "\r\n";


mail($to,$subject,$message,$headers);
		

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		header("location:verification.php?email=$_POST[email]");
	}
	else{
		$mess = "EMAIL NOT FOUND";
	}
}
?>
    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Reset Password</div>
        <div class="card-body">
          <div class="text-center mb-4">
            <h4>Forgot your password?</h4>
            <p>Enter your email address and we will send you instructions on how to reset your password.</p>
          </div>
          <form method="POST" action="">
            <div class="form-group">
              <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" placeholder="Enter email address" required="required" name = "email" autofocus="autofocus">
                <label for="inputEmail">Enter email address</label>
              </div>
            </div>
			<?php
			if(isset($_POST['submit']))
			{
				echo "<center><span style = 'color:red'>" . $mess . "</span></center>";
			}
			?>
            <button type = "submit" name = "submit" class="btn btn-primary btn-block">Reset Password</button>
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="register">Register an Account</a>
            <a class="d-block small" href="user_login">Login Page</a>
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
