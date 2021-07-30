<?php
session_start();
require_once './config/config.php';
require_once './include/auth_validate.php';

$firstName=$lastName=$contactNo=$inputEmail=$middleName=$inputProvince=$inputCity=$inputBarangay=$areaAssigment=$dob=$areaProvince=$areaCity="";
if(isset($_SESSION["notifier_data"])){
	$firstName = $_SESSION["notifier_data"][0];
	$middleName = $_SESSION["notifier_data"][1];
	$lastName = $_SESSION["notifier_data"][2];
	$nameSuffix = $_SESSION["notifier_data"][3];
	$contactNo = $_SESSION["notifier_data"][4];
	$inputEmail = $_SESSION["notifier_data"][5];
        $dob= $_SESSION["notifier_data"][6];
        $inputProvince= $_SESSION["notifier_data"][7];
        $inputCity="";
        $inputBarangay = "";      
        $$areaProvince="";
        $areaCity = "";
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
        
        <title>Add Notifier</title>
        
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
	<?php require_once './include/header.php'; ?>
        <div id="content-wrapper">
            <div class="container-fluid">
                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html">Notifier</a>
                    </li>
                    <li class="breadcrumb-item active">Add notifier</li>
                </ol>		
                <div class="card mb-3">
                    <div class="card-header"><i class="fas fa-user-plus"></i> &nbsp; Notifiers Profile</div>
                    <div class="card-body">
			<?php if (isset($_SESSION["notifier_failure"])) {?>
                        <div class="alert alert-danger alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $_SESSION["notifier_failure"];unset($_SESSION["notifier_failure"]); ?>
                        </div>
			<?php }?>
			<?php if (isset($_SESSION["notifier_success"])) {?>
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                           <?php echo $_SESSION["notifier_success"];unset($_SESSION["notifier_success"]); ?>
                        </div>
			<?php }?>
                        <form id="notifierForm" method="POST" action="notifier_create.php">
                            <div class="form-group form-row">						  
                                <div class="col-md-4">
                                    <div class="form-group">								
                                        <label for="firstName">FIRSTNAME:</label>
                                        <input type="text" id="firstName" name="firstName" style="text-transform:uppercase" class="form-control" placeholder="First name" value="<?php echo $firstName; ?>" required="required" <?php echo !isset($_SESSION["notifier_field"])? 'autofocus="autofocus"':''?>>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="middleName">MIDDLENAME:</label>
                                        <input type="text" id="middleName" name="middleName" style="text-transform:uppercase" class="form-control" placeholder="Middle name" value="<?php echo $middleName; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="lastName">LASTNAME:</label>
                                        <input type="text" id="lastName" name="lastName" style="text-transform:uppercase" class="form-control" placeholder="Last name" value="<?php echo $lastName; ?>" required="required">                   
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group"> <!-- State Button -->
                                        <label for="nameSuffix" class="control-label">EXT.</label>
                                        <select class="form-control" id="nameSuffix" name="nameSuffix">
                                            <option value="">--SELECT--</option>
                                            <option value="SR">SR</option>
                                            <option value="JR">JR</option>
                                            <option value="II">II</option>
                                            <option value="III">III</option>
                                            <option value="IV">IV</option>							
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-row">
                                <!--Contact Number-->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contactNo">CONTACT NUMBER:</label>
                                        <input type="text" id="contactNo" name="contactNo" placeholder="09876543210" maxlength="11" onkeypress="return isNumberKey(event)" value="<?php echo $contactNo; ?>" required="required" <?php echo (isset($_SESSION["notifier_field"]) && $_SESSION["notifier_field"] == "CONTACTNO")? 'class="form-control is-invalid" autofocus="autofocus"':'class="form-control"'?>>
                                    </div>
                                </div>
                                <!--Email Address-->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputEmail">EMAIL ADDRESS:</label>
                                        <input type="email" id="inputEmail" name="inputEmail" placeholder="Email address" value="<?php echo $inputEmail; ?>" required="required" <?php echo (isset($_SESSION["notifier_field"]) && $_SESSION["notifier_field"] == "EMAIL")? 'class="form-control is-invalid" autofocus="autofocus"':'class="form-control"'?>>
                                    </div>
                                </div>
                                <!--DOB-->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="dob">DATE OF BIRTH:</label>
                                        <input type="date" id="dob" name="dob" class="form-control" placeholder="01/01/1990" value="<?php echo $dob; ?>" required="required"> <!--?php echo (isset($_SESSION["notifier_field"]) && $_SESSION["notifier_field"] == "EMAIL")? 'class="form-control is-invalid" autofocus="autofocus"':'class="form-control"'?>-->
                                    </div>
                                </div>                                 
                            </div>
                            
                            
                            <!--ADDRESS-->
                            ADDRESS:
                            <div class="card mb-3">
                                <!--div class="card-header"><i class="fas fa-user-plus"></i> &nbsp; Address</div-->
                                <div class="card-body">
                                    <div class="form-group form-row">
                                        <!--Province-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                    <?php
                                                    require_once 'select_option.php';
                                                    $provinces = loadProvince($mysqli);
                                                    foreach($provinces as $province){
                                                        //echo "<option value='.$fo3ProvinceId.'>'.$description.'</option>";
                                                        echo $province;
                                                    }
                                                    ?>
                                                <label for="inputProvince" class="control-label">PROVINCE</label>
                                                <select class="form-control" id="inputProvince" name="inputProvince">
                                                    <option value="">--SELECT--</option>                                                    
                                                    <?php
                                                    $sql="SELECT fo3ProvinceId, description FROM fo3province";
                                                    $stmt = $mysqli->prepare($sql);
                                                    if($stmt->execute()){
                                                        $stmt->bind_result($fo3ProvinceId,$description); 
                                                        while($stmt->fetch()){
                                                            echo '<option value='.$fo3ProvinceId.'>'.$description.'</option>';
                                                       }
                                                    }else{
                                                        echo $mysqli->error;
                                                    }
                                                    ?>					
                                                </select>
                                            </div>
                                        </div>
                                        <!--Muni/City-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="inputCity">CITY/MUNICIPALITY:</label>
                                                <input type="text" id="inputCity" name="inputCity" placeholder="City/Municipality" value="<?php echo $inputCity; ?>" required="required" <?php echo (isset($_SESSION["notifier_field"]) && $_SESSION["notifier_field"] == "CITY")? 'class="form-control is-invalid" autofocus="autofocus"':'class="form-control"'?>>
                                            </div>
                                        </div>
                                        <!--Barangay-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="inputBarangay">BARANGA:</label>
                                                <input type="text" id="inputBarangay" name="inputBarangay" placeholder="Barangay" value="<?php echo $inputBarangay; ?>" required="required" <?php echo (isset($_SESSION["notifier_field"]) && $_SESSION["notifier_field"] == "CITY")? 'class="form-control is-invalid" autofocus="autofocus"':'class="form-control"'?>>
                                            </div>
                                        </div>                                
                                    </div>
                                </div>
                            </div>
                            
                            
                            AREA OF DEPLOYMENT
                            <!--Area of Assignment-->
                             <div class="card mb-3">
                                <!--div class="card-header"><i class="fas fa-user-plus"></i> &nbsp; Area of Deploment</div-->
                                <div class="card-body">
                                    <div class="form-group form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="areaProvince">Province:</label>
                                                <input type="text" id="areaProvince" name="areaProvince" placeholder="Area Province" value="<?php echo $areaProvince; ?>" required="required" <?php echo (isset($_SESSION["notifier_field"]) && $_SESSION["notifier_field"] == "EMAIL")? 'class="form-control is-invalid" autofocus="autofocus"':'class="form-control"'?>>
                                            </div>
                                        </div>                                
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="areaCity">City/Municipality:</label>
                                                <input type="text" id="areaCity" name="areaCity" placeholder="Area City/Municipality" value="<?php echo $areaCity; ?>" required="required" <?php echo (isset($_SESSION["notifier_field"]) && $_SESSION["notifier_field"] == "EMAIL")? 'class="form-control is-invalid" autofocus="autofocus"':'class="form-control"'?>>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Create</button>
                            <!-- type="button" class="btn btn-secondary btn-block" onclick="resetForm()" value="Reset Form"-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
                /*function resetForm() {
                  document.getElementById("notifierForm").reset();
                  alert("reset");
                }*/

                function isNumberKey(evt){
                        var charCode = (evt.which) ? evt.which : evt.keyCode;
                        if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) return false;
                        if(charCode.length > 11) return false;
                        return true;
                } 
        </script>
	<?php require_once './include/footer.php'; ?>
    </body>
    
</html>
