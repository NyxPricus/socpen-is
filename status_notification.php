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

    <title>Notification Status</title>

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
                        <a href="#">Notification Status</a>
                    </li>
                    <li class="breadcrumb-item active">Overview</li>
                </ol>

                <!-- DataTable -->		 
                <div class="card card-register mx-auto mt-5">
                    <div class="card-header">
                        <i class="fas fa-table"></i>List Notification Status
                    </div>
                    <div class="card-body">
                        <a href="#" data-toggle="modal" data-target="#notificationModal">
                            <button type="button" class="btn btn-success">
                                <i class="fa fa-plus">&nbsp; STATUS</i>
                            </button>
                        </a> <div>&nbsp;</div>
                        
                        <?php if (isset($_SESSION['notification_failure'])) {?>
                        <div class="alert alert-danger alert-dismissable ">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $_SESSION['notification_failure'];unset($_SESSION['notification_failure']); ?>
                        </div>
                        <?php }?>
                        
                        <?php if (isset($_SESSION['notification_success'])) {?>
                        <div class="alert alert-success alert-dismissable ">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $_SESSION['notification_success'];unset($_SESSION['notification_success']); ?>
                            </div>
                        <?php }?>
                        <div class="table-responsive">				 
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>With Pay</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Description</th>
                                        <th>With Pay</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $sql = 'SELECT notificationStatusId, description, withPay FROM notificationStatus';
                                    if($stmt = $mysqli->prepare($sql)){							
                                        if($stmt->execute()){
                                            $stmt->bind_result($notificationStatusId, $description, $withPay);
                                            while($stmt->fetch()){ ?>
                                            <tr>
                                                <td><?php echo $description?></td>
                                                <td><?php echo ($withPay == 1? "YES":"NO")?></td>
                                                <td>
                                                    <a href="#edit_status<?php echo $notificationStatusId;?>" data-toggle="modal">
                                                        <button type="button" class="btn btn-success">
                                                        <i class="fa fa-edit">EDIT</i>
                                                        </button>
                                                    </a>
                                                </td>
                                                <!-- Edit Notification Status Modal-->
                                                <div class="modal fade" id="edit_status<?php echo $notificationStatusId;?>" tabindex="-1" role="dialog" aria-labelledby="uctmodal" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="uctmodal">Update Notification Status</h5>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="form loginform" method="POST" action="notification_stat_create.php">
                                                                    <div class="form-group">
                                                                        <label for="description"><?php echo $description?>:</label>
                                                                        <input type="text" id="description" name="description" value="<?php echo $description?>" class="form-control" placeholder="Enter Description" required="required" autofocus="autofocus">                
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="withpay" class="control-label">With Pay:</label>
                                                                        <select class="form-control" id="withpay" name="withpay" value="1" required>
                                                                            <option value="">Select</option>
                                                                            <option value="1" <?php echo $withPay==1? "Selected":""; ?>>YES</option>
                                                                            <option value="0" <?php echo $withPay==0? "Selected":""; ?>>NO</option>						
                                                                        </select>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                                        <button type="submit" class="btn btn-success">Create</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                           </tr>                        
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.cardbody-->
                    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->


        <?php include("include/footer.php")?>

	
	
	
	
	
	
	<!-- Create Notification Status Modal-->
        <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="uctmodal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uctmodal">Create Notification Status</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                <div class="modal-body">
                    <form class="form loginform" method="POST" action="notification_stat_create.php">
                        <?php if (isset($_SESSION['login_failure'])) {?>
                        <div class="alert alert-danger alert-dismissable ">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $_SESSION['login_failure'];unset($_SESSION['login_failure']); ?>
                        </div>
                        <?php }?>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <input type="text" id="description" name="description" class="form-control" placeholder="Enter Description" required="required" autofocus="autofocus">                
                        </div>
                        <div class="form-group">
                            <label for="withpay" class="control-label">With Pay:</label>
                            <select class="form-control" id="withpay" name="withpay" required>
                                <option value="">Select</option>
                                <option value="1">YES</option>
                                <option value="0">NO</option>						
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Create</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </body>
</html>