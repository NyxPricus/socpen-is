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
	
	<!-- datatables css -->

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="bootstrap-select2/dist/css/bootstrap-select.css">


    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
	<?php
	if(isset($_SESSION['province']))
	{
		?>
	<title>LIST OF BENE'S IN <?php echo $_SESSION['province'];?></title>
	<?php
}
else{
	?>
<title>LIST OF BENE'S</title>
	<?php }?>
  </head>

  <body id="page-top">

   <?php include("include/header.php");
   if(isset($_POST['rem']))
   {
	   unset($_SESSION['province']);
	   unset($_SESSION['muni']);
	   unset($_SESSION['brgy']);
	   //unset($_POST['rem']);
   }   
   ?>
   <!--
	<script type='text/javascript'>

	
var explode = function(){
  window.close();
};
setTimeout(explode, 3000);
</script>
-->
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Beneficiaries</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
          </ol>
		  <?php if(isset($_SESSION['okay']))
		  {?>
	  
	  
	  
	  

		
		<?php include("include/popup_style.php")?>
		<div id="charan"><i class = "fa fa-check"></i> Successfully Updated <?php echo $_SESSION['okay'];?>!</div>
		<script>

  var x = document.getElementById("charan");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);


</script>
		
		<?php
		  unset($_SESSION['okay']);
		  }?>
          <!-- DataTables Example -->
		   <div class="card mb-3">
            <div class="card-header">
			<i class="fas fa-filter"></i>
			
			
			
			
			Filter the data to start searching
			
			</div>
			  <div class="card-body">
						<form action ="" method = "POST">
						<input type="text" name = "txtall"><br>
						
						
						
				<!---	Province 
					<select name = "prov" class = "form-control">
					<option value = "">---CHOOSE PROVINCE---</option>
					<option value = "AURORA">AURORA</option>
					<option value = "BATAAN">BATAAN</option>
					<option value = "BULACAN">BULACAN</option>
					<option value = "TARLAC">TARLAC</option>
					<option value = "NUEVA ECIJA">NUEVA ECIJA</option>
					<option value = "PAMPANGA">PAMPANGA</option>
					<option value = "ZAMBALES">ZAMBALES</option>
					
					</select>-->
					


				 <label for="inputProvince" class="control-label">PROVINCE</label>
	<select id="inputProvince" class="form-control provinceAction" data-live-search="true" data-live-search-style="begins" title="Choose Province" name = "inputProvince">
				
					<?php
					require_once 'select_option.php';
					echo loadProvince($mysqli);
					
					?>
				
				</select>
					
					
					<label for="inputCity" class="control-label">CITY/MUNICIPALITY:</label>
					<select class="form-control cityAction" id="inputCity" name="inputCity">
						<option value="">~~SELECT PROVINCE FIRST~~</option>
						
					</select>
					
					
					<label for="inputBarangay">BARANGAY:</label>
						 <select class="form-control" id="inputBarangay" name="inputBarangay">
							<option value="">~~SELECT CITY/MUNICIPALITY FIRST~~</option>
						</select>
					
				
					
					
					
					
					
					
					
					
					
					<br>
					<button type = "submit" name = "sub" class = "btn btn-success" onclick="window.location.href='http://www.google.com/'"><I class="fas fa-filter"></I>&nbsp;Filter</button>

					
					<form action ="" method = "POST">
					<button type = "submit" name = "rem" class = "btn btn-danger"><span class="fas fa-times"></span>&nbsp;Remove Filter</button>
					</form>
									</form>
					<?php
					
					if(isset($_POST['sub']))
					{
						echo "<script>window.location.href='all_bene?prov=$_POST[inputProvince]'</script>";
						$_SESSION['province']= getProvinceName($mysqli,$_POST['inputProvince']);
						$_SESSION['muni']= getCity($mysqli,$_POST['inputCity']);
						$_SESSION['brgy']= getBarangay($mysqli,$_POST['inputBarangay']);
						$_SESSION['all']= $_POST['txtall'];
					}	
			
					
					?>
			</div>
			</div>
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              List of Listahanan Beneficiaries
			  <?php if(isset($_SESSION['province']))
			  {
			  if(isset($_SESSION['muni'])&& isset($_SESSION['province']) && isset($_SESSION['brgy']))
			  {
				  echo " from<b> " . $_SESSION['brgy'] . ", " . $_SESSION['muni'] . ", " . $_SESSION['province']. "</b>";
			  }
			  elseif(isset($_SESSION['muni'])&& isset($_SESSION['province']) && !isset($_SESSION['brgy']))
			  {
				  echo "from <b>" . $_SESSION['muni'] . ", " . $_SESSION['province']. "</b>";
			  }
			   elseif(isset($_SESSION['province'])&& !	isset($_SESSION['muni']) && !isset($_SESSION['brgy']))
			  {
				  echo "from <b>". $_SESSION['province']. "</b>";
			  }
			  else{
				  echo "from <b>". $_SESSION['province']. "</b>";
			  }
			  }
			  
			  ?>
			  
			</div>
		<div class="card-body">
        <div class="row">
			
					<div class="col-md-12">
						<div class="edit-messages"></div>
						<?php 
						if(isset($_SESSION['province'])){?>
						<table class="table" id="manageMemberTable">		
<?php
						}
						else
						{
							?>
							<table class="table" id="">	
							<?php
						}?>						
							<thead>
								<tr>
									
									<th>HHID</th>	
									<th>LAST 8 HHID</th>													
									<th>Full Name</th>
									
									<th>Address</th>								
									<th>Option</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>	
</div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>

        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content-wrapper -->

    </div>
<div class="modal fade" tabindex="-1" role="dialog" id="viewHistory">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
		  <H2>BENEFICIARY DATA HISTORY</H2>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span></h4>
	      </div>

		<form class="form-horizontal" action="bene_edit_history" method="POST" id="" target="_blank">	      
	      <div class="modal-body">
	        	
	        <div class="edit-messages"></div>
			<input type="hidden" class="form-control" id="historyID" name="historyID" placeholder="ID">
			<input type="hidden" class="form-control" id="historyHHID" name="historyHHID" placeholder="HH ID">
			<input type="hidden" class="form-control" id="historyFullName" name="historyFullName" placeholder="Address">
			<input type="hidden" class="form-control" id="historyAddress" name="historyAddress" placeholder="Address">
			
			
			<div class="fullname"></div>
			
			
	      </div>
	      <div class="modal-footer viewHistory">
		  <button type = "submit" name = "history" class = "btn btn-info"><i class="fa fa-history" aria-hidden="true"></i>&nbsp;Show Bene's data History</button>
		  
	        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Close</button>
	     
	      </div>
	      </form>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div>
	
	
	
	
	
	<!-- edit modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="editMemberModal">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
		  <H2>BENEFICIARY DATA</H2>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span></h4>
	      </div>

		<form class="form-horizontal" action="edit_bene" method="POST" id="frm" target="_blank">
	      <div class="modal-body">
	        	
	        <div class="edit-messages"></div>
			<input type="hidden" class="form-control" id="editID" name="editID" placeholder="ID">
			<input type="hidden" class="form-control" id="editHHID" name="editHHID" placeholder="HH ID">
			<input type="hidden" class="form-control" id="editFullName" name="editFullName" placeholder="Address">
			<input type="hidden" class="form-control" id="editAddress" name="editAddress" placeholder="Address">
			<div class="id"></div>
			<div class="hhid"></div>
			<div class="fullname"></div>
			<div class="address"></div>
			
	      </div>
	      <div class="modal-footer editMemberModal">
			
		   <button type="submit" class="btn btn-success" id = "submit"><i class="fa fa-edit"></i>&nbsp;Edit Beneficiary data</button>
	         <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Close</button>
	     
	      </div>
	      </form>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div>
	
	
	<!-- /.modal -->
	<!-- /edit modal -->
			<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>	
    <!-- /#wrapper -->
<script src="assets/js/jquery-1.10.2.js"></script>	
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
	<!-- include custom index.js -->
	<script src="custom/js/encoding_all.js"></script>
	<!-- datatables js -->
	<script src="assests/datatables/datatables.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
<script src="bootstrap-select2/dist/js/bootstrap-select.js"></script>
	<?php include("include/footer.php")?>
<script>
$(document).ready(function(){
    //para to sa dynamic dropdown ng address province
    $('.provinceAction').change(function(){    	
		
        var provinceAction = $(this).attr("id");
        var query = $(this).val();
        if(query){
            $.ajax({
                url:"select_option.php",
                method:"POST",
                data:{provinceAction:provinceAction, query:query},
                success:function(data){
                    $('#inputCity').html(data);
                    $('#inputBarangay').html('<option value="">~~SELECT CITY/MUNICIPALITY FIRST~~</option>');                            
                }
            });
        }else{
            $('#inputCity').html('<option value="">~~SELECT PROVINCE FIRST~~</option>');
            $('#inputBarangay').html('<option value="">~~SELECT CITY/MUNICIPALITY FIRST~~</option>');                 
        }
    });
    
    //para to sa dynamic dropdown ng address city/muni
    $('.cityAction').change(function(){        
        var cityAction = $(this).attr("id");
        var query = $(this).val();
        if(query){
            $.ajax({
                url:"select_option.php",
                method:"POST",
                data:{cityAction:cityAction, query:query},
                success:function(data){
                    $('#inputBarangay').html(data);
                }
            });
        }else{
            $('#inputBarangay').html('<option value="">~~SELECT CITY/MUNICIPALITY FIRST~~</option>');                 
        }
    });
});


</script>

  </body>

</html>
