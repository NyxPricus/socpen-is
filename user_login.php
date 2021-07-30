<?php
session_start();
require_once './config/config.php';

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SOCPEN IS - Login</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

  </head>

  <body style="background-color:gray">
 
    <div class="container" >
      <div class="card card-login mx-auto mt-5" style="opacity: 0.95">
        <div class="card-header"><H3>SOCPEN FO III INFORMATION SYSTEM (SOCPEN-IS)</H3></div>
        <div class="card-body">
          <form class="form loginform" method="POST" action="user_authenticate.php">
		  <?php if (isset($_SESSION['login_failure'])) {?>
				<div class="alert alert-danger alert-dismissable ">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<?php echo $_SESSION['login_failure'];unset($_SESSION['login_failure']); ?>
				</div>
			<?php }
			echo '<input type="hidden" name="location" value="';
if(isset($_GET['location'])) {
    echo htmlspecialchars($_GET['location']);
}
echo '" />';
			
			
			?>
            <div class="form-group">
              <div class="form-label-group">				
                <input type="text" id="username" name="username" class="form-control" placeholder="Username" required="required" autofocus="autofocus">
                <label for="username">Username</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="passwd" name="passwd" class="form-control" placeholder="Password" required="required">
                <label for="passwd">Password</label>
              </div>
            </div>
            <button type="submit" class="btn btn-success btn-block loginField" >Login</button>
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="user_register">Register an Account</a>
           
          </div>
          <div class="text-center">
       
           <a href = "https://fo3.dswd.gov.ph" target = "_blank"><img src = "icons/dswd-logo.png" style = "width:11=0px;height:100px"></a><br><h6>DEPARTMENT OF SOCIAL WELFARE AND DEVELOPMENT FIELD OFFICE III</h6>
			<hr>
			<div class = "small">Developed by: UCT RPMO</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<style>
.foo
{
	color:white;
}
.foo:hover

{
	color:#42f489;
}
.foo{
    display: inline;
    position: relative;
}


.foo:hover:after{
    background: #333;
    background: rgba(0,0,0,.8);
    border-radius: 5px;
    bottom: 26px;
    color: #fff;
    content: attr(title);
    left: 20%;
    padding: 5px 15px;
    position: absolute;
    z-index: 98;
    width: 220px;
	content: attr(title);
}



.tooltip:hover:before{
    border: solid;
    border-color: #333 transparent;
    border-width: 6px 6px 0 6px;
    bottom: 20px;
    content: "";
    left: 50%;
    position: absolute;
    z-index: 99;
}

</style>


    
  </body>

</html>
