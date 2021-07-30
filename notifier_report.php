<?php
include 'include/controller.php';
$session_username = $_SESSION['user_name'];
//$session_role = $_SESSION['role'];
if(empty($_SESSION['user_name'])){
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>SMILE</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	
	  <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="DBITS/css/sb-admin.css" rel="stylesheet">

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="DBITS/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="DBITS/css/bootstrap-theme.min.css">
    <!-- Loader -->
    <link rel="stylesheet" href="DBITS/css/loader.css">
    <script src="DBITS/js/jquery-1.12.4.js"></script>
    <link rel="stylesheet" type="text/css" href="dashboard/vendor/font-awesome/css/font-awesome.min.css">
    <script>
        $(document).ready(function() {
                $('#example').DataTable({});
            });

        </script>
    <link rel="stylesheet" href="DBITS/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="DBITS/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="DBITS/css/responsive.bootstrap.min.css">
    <script src="DBITS/js/bootstrap.min.js"></script>
    <script src="DBITS/js/jquery.dataTables.min.js"></script>
	
	
	
	
	
	<style>
			.modal-content {
			background-color: #4e9da9;

			}
			
			
	</style> 
	
	
	
	
</head>

<body id="page-top">



    <nav class="navbar navbar-expand navbar-dark bg-info static-top">
			<div class="header">
				
						<a href="smile.php" class="logo"><img alt="Logo" src="img/smilepic.jpg" width="150px" height="60px" class="img-rounded" /> </a>
				</div>
			</div>
      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>
	  

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
          <div class="input-group-append">
           
            
        
          </div>
        </div>
      </form>

      <!-- Navbar -->
	  
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>

          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#logout" data-toggle="modal"><span class='glyphicon glyphicon-log-out' aria-hidden='true'></span> Logout</a>
           
            
        </li>
      </ul>

    </nav>

	  <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="smile.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
       <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Report</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header"><font size="1px">VIEW</font></h6>
            <a class="dropdown-item" href="raw_report.php"><font size="1px">Detailed Report</a></font>
			<a class="dropdown-item" href="prov_report.php"><font size="1px">Province Report</a></font>
          </div>
        </li>
		
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Notifier ARs</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header"><font size="1px">VIEW</font></h6>
			<a class="dropdown-item" href="notifier_report.php"><font size="1px">Consolidated</a></font>
          </div>
        </li>
        
      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="smile.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Notifier Accomplishment Report</li>
          </ol>

  

          <!-- Icon Cards-->

          <!-- Area Chart Example-->
        	
<div class="row">
<body onload="myFunction()" style="margin:0;">
    <div class="container">
      
	  
	  
						<form name="print_form" method="post" action="notifier_report.php" >
						
						<table>
						<tr>
						<div class="form-group">
						<div class="col-sm-4">
						<th><input type="text" class="form-control" name="date1" required placeholder="START DATE" onfocus="(this.type='date')"></th></div><th><font color="white">--</font></th>
						<div class="form-group">
						<div class="col-sm-7">
						<th><input type="text" class="form-control" name="date2" required placeholder="END DATE" onfocus="(this.type='date')"></th></div><th><font color="white">.</font></th>
						<th><input type="submit" name="submit" value="SUBMIT" class="btn btn-primary"></th>
						</tr>
						</div>
						</div>
						</form>		
						</table>
	  
	  
	    <br>
        <br>
		<div class='table-responsive'>
        <table id="example" class="display wrap" cellspacing="10" width="100%" height="0%">
				<thead>
                <tr>
					<th>START DATE</th>
					<th>END DATE</th>
                    <th>ENUMERATOR</th>
					<th>PROVINCE</th>
                    <th>ASSESSED</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
					<th>START DATE</th>
					<th>END DATE</th>
                    <th>ENUMERATOR</th>
					<th>PROVINCE</th>
                    <th>ASSESSED</th>
                </tr>
            </tfoot>
            <tbody>
			
						
                <?php 
							 if(isset($_POST['submit'])){
								$date1=$_POST['date1'];
								//$date2=$_POST['date2']; 
							
                    $sql ="SELECT * from uct_list where province = 'AURORA'";
                    $result = $conn->query($sql);       
                        // output data of each row
			
							while($row = $result->fetch_assoc())  {
								

							
							
                    ?>
					
                <tr>
					<td>
                        <font size="1px"><?php echo $date1; ?></font>
                    </td>
					
					<td>
                        <font size="1px"><?php echo$row['hhid']; ?></font>
                    </td>
					<td>
                        <font size="1px"><?php echo $row['first_name']; ?></font>
                    </td>
                    <td>
                       <font size="1px"> <?php echo $row['last_name']; ?></font>
                    </td>
                
					</div>
					</div>
				</tr>
					<?php				
						}
							
							 }
					?>
            
			  
			  
        </tfoot>
    </table>
			
					
				



           


						
               <?php
                        //Update Items
                        if(isset($_POST['update_item'])){
						$date_assessed = mysqli_real_escape_string($con, $_POST['date_assessed']);
                        $en_name = mysqli_real_escape_string($con, $_POST['en_name']);
                        $province = mysqli_real_escape_string($con, $_POST['province']);
						$municipality = mysqli_real_escape_string($con, $_POST['municipality']);
                        $barangay = mysqli_real_escape_string($con, $_POST['barangay']);
						$assessed = mysqli_real_escape_string($con, $_POST['assessed']);
                        $unlocated = mysqli_real_escape_string($con, $_POST['unlocated']);
						$transferred = mysqli_real_escape_string($con, $_POST['transferred']);
                         
                            $sql = "UPDATE tbl_raw SET 
								date_assessed='$date_assessed',
                                en_name='$en_name',
                                province='$province',
                                municipality='$municipality',
								barangay='$barangay',
                                assessed='$assessed',
                                unlocated='$unlocated',
                                transferred='$transferred'
                                WHERE id='$edit_item_id' ";
                            if ($conn->query($sql) === TRUE) {
								
								echo'<div class="alert alert-info alert-dismissable" id="flash-msg">
											<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
											<h4><i class="icon fa fa-check"></i>UPDATED!</h4>
											</div>';
                                echo '<script>window.location.href="smile.php"</script>';
                            } else {
                                echo "Error updating record: " . $conn->error;
                            }
                        }
						
						
                        
					
					 if(isset($_POST['add_accom'])){
                        $date_assessed = mysqli_real_escape_string($con, $_POST['date_assessed']);
                        $en_name = mysqli_real_escape_string($con, $_POST['en_name']);
                        $province = mysqli_real_escape_string($con, $_POST['province']);
						$municipality = mysqli_real_escape_string($con, $_POST['municipality']);
                        $barangay = mysqli_real_escape_string($con, $_POST['barangay']);
						$assessed = mysqli_real_escape_string($con, $_POST['assessed']);
                        $unlocated = mysqli_real_escape_string($con, $_POST['unlocated']);
						$transferred = mysqli_real_escape_string($con, $_POST['transferred']);
                       
						
						$sql = "INSERT INTO tbl_raw(date_assessed, en_name, province, municipality, barangay, assessed, unlocated, transferred)VALUES('$date_assessed','$en_name','$province','$municipality','$barangay','$assessed','$unlocated','$transferred')";
							 if ($conn->query($sql) === TRUE) {
								 
								 
								echo '<div class="alert alert-info alert-dismissable" id="flash-msg">
											<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
											<h4><i class="icon fa fa-check"></i>ADDED SUCCESSFULY!</h4>
											</div>';
                                echo '<script>window.location.href="prov_report.php"</script>';
                            } else {
                                echo "Error adding record: " . $conn->error;
                            }
                        
					
						
					}
					
                      
		?>
         
	
	<!--Edit Item Modal -->

						
					   </tbody>
					   </table>
						</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
    <!--Add Item Modal -->
    <div id="add" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <form method="post" class="form-horizontal" role="form">
                    <div class="modal-header">
                   
                        <h5 class="modal-title">ADD ACCOMPLISHMENT</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-sm-1" for="item_name"></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="item_name" name="date_assessed" autocomplete="off" required placeholder="DATE ASSESSED" onfocus="(this.type='date')" > </div>
                            <label class="control-label col-sm-2" for="item_code"></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="item_code" name="en_name" placeholder="ENUMERATOR" autocomplete="off" required oninput="this.value = this.value.toUpperCase()"> </div>
							</div>
                        <div class="form-group">
                            <label class="control-label col-sm-1" for="item_category"></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="item_category" name="province" placeholder="PROVINCE" autocomplete="off" required oninput="this.value = this.value.toUpperCase()"> </div>
                            <label class="control-label col-sm-2" for="item_critical_lvl"></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="item_critical_lvl" name="municipality" placeholder="MUNICIPALITY" autocomplete="off" required oninput="this.value = this.value.toUpperCase()"> </div>
							</div>
						<div class="form-group">
                            <label class="control-label col-sm-4"></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="item_category" name="barangay" placeholder="BARANGAY" autocomplete="off" required oninput="this.value = this.value.toUpperCase()"> </div>
                            </div>
							<div class="form-group">
							  <label class="control-label col-sm-4"></label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="item_critical_lvl" name="assessed" placeholder="# OF ASSESSED" autocomplete="off" value="0" required oninput="this.value = this.value.toUpperCase()"> </div>
							</div>
							<div class="form-group">
							  <label class="control-label col-sm-4"></label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="item_category" name="unlocated" placeholder="# OF UNLOCATED" autocomplete="off" value="0" required oninput="this.value = this.value.toUpperCase()"> </div>
                            </div>
							<div class="form-group">
							  <label class="control-label col-sm-4"></label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="item_critical_lvl" name="transferred" placeholder="# OF TRANSFERRED" autocomplete="off" value="0" required oninput="this.value = this.value.toUpperCase()"> </div>
								</div>	
								</div>
                 
				   <br>
				   <br>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="add_accom"><span class="glyphicon glyphicon-plus"></span> Add</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Logout Modal -->
    <div id="logout" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Logout</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="delete_id" value="<?php echo $id; ?>">
                    <div class="alert alert-danger">Are you Sure you want to logout
                        <strong>
                            <?php echo $_SESSION['user_name']; ?>?
                        </strong>
                    </div>
                    <div class="modal-footer">
                        <a href="logout.php">
                            <button type="button" class="btn btn-danger">YES </button>
                        </a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
