<?php
session_start();
require_once './config/config.php';
require_once './include/auth_validate.php';
$rd_id = $_POST['editid'];
$rd_hhid = $_POST['editHHID'];
$rd_fname = $_POST['editfname'];
$rd_mname = $_POST['editmname'];
$rd_lname = $_POST['editlname'];
$rd_extname = $_POST['editext'];
$rd_bday = $_POST['editbday'];

$rd_province = $_POST['editprov'];
$rd_muni = $_POST['editmuni'];
$rd_brgy = $_POST['editbrgy'];

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
            <li class="breadcrumb-item active">Edit</li>
          </ol>
		 
	  
	  
	  
	  




<form action="save_bene" method="post" enctype="multipart/form-data">

			<input type = "hidden" class = "form-control" value =<?php echo $rd_id;?> readonly name = "id">
					Household ID: <input type = "text" class = "form-control" value =<?php echo $rd_hhid?> readonly name = "hhid">

					Beneficiary's First Name: <input type = "text" class = "form-control" value =<?php echo $rd_fname;?> name = "fname">
					Beneficiary's Middle Name:<i>if not applicable please enter N/A</i> <input type = "text" class = "form-control" value ="<?php echo $rd_mname;?>" name = "mname">
					Beneficiary's Last Name: <input type = "text" class = "form-control" value =<?php echo $rd_lname;?> name = "lname">
          Beneficiary's Extension Name: 
          <select name = "editext" class = "form-control">
        <option value = "" <?php if($rd_extname==NULL){ echo 'selected="selected"'; }?> >N/A</option>
        <option value = "JR." <?php if($rd_extname=="JR."){ echo 'selected="selected"'; }?>>JR</option>
        <option value = "SR." <?php if($rd_extname=="SR."){ echo 'selected="selected"'; }?>>SR</option>
        <option value = "III" <?php if($rd_extname=="III"){ echo 'selected="selected"'; }?>>III</option>
        <option value = "IV" <?php if($rd_extname=="IV"){ echo 'selected="selected"'; }?>>IV</option>
        <option value = "V" <?php if($rd_extname=="V"){ echo 'selected="selected"'; }?>>V</option>
          </select>











						
                        <label for="inputProvince" class="control-label">REMARKS</label>
	<select id="remarkss" class="form-control" data-live-search="true" data-live-search-style="begins" title="Choose Remarks" name = "remarkss" required>
				
					<?php
					//require_once 'select_option.php';
					echo loadreamrks($mysqli);
					
					?>
				
				</select>

					
        <br>
 Present address registered on the database: <?php echo $rd_brgy. ", " . $rd_muni . ", " . $rd_province?><br>


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
					
        



				
            Birthdate <input type = "date" class = "form-control" value =<?php echo $rd_bday;?> name = "dob">
				
					
					
					<button type = "submit" class = "btn btn-info form-control" name ="save">SAVE</button>
					
					</form>
					
					

		
			</div>
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
	<script src="custom/js/encoding.js"></script>
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
