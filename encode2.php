<?php
include 'includes/session_encoding.php';
//include 'includes/header_encoding.php';
include 'helper/helper_encoding.php';

$bene = getBene($conn,$_GET['hhid']);

$lname = $bene['last_name'];
$fname = $bene['first_name'];
$mname = $bene['middle_name'];

$lname = str_replace("?","Ñ",$lname);
$fname = str_replace("?","Ñ",$fname);
$mname = str_replace("?","Ñ",$mname);

$psgc = getPSGC($bene['province'],$bene['city'],$bene['barangay'],$conn);

//get appropriate remarks to lessen probability of errors.
//hindi na nagamit
function getRemarksType($remarks_id,$conn){
    $sql ="select change_bene from remarks where id = $remarks_id";
    $query = $conn->query($sql);
    $type = $query->fetch_assoc();
    return $type;
}

if(strlen($psgc) < 1){
    $_SESSION['searchError'] = 'PSGC Code not found. Please contact system administrator!';
    header('location:search2.php'); 
    exit();
}

$lbp = getLBPcode($bene['province'],$bene['city'],$conn);
if(strlen($lbp) < 1){
    $_SESSION['searchError'] = 'LBP Branch Code Code not found. Please contact system administrator!';
    header('location:search2.php'); 
    exit();
}

?>
<style>
a.pempem{
	color:red;
}
a.pempem:hover{
	cursor: help;
}
</style>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  	<?php include 'includes/navbar.php'; ?>
  	<?php include 'includes/menubar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Encode
        <small>Beneficiary</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Encode</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <h4 class="float-right">ENYE - Ñ</h4>
      <div class="box box-info">
            <div class="box-header with-border">
                <h4 class="box-title"><strong>NAME / HHID: <Font color="Red"><?php echo $bene['last_name']  . ', ' .$bene['first_name'] . ' ' . $bene['middle_name'] . ' ' . $bene['name_ext'] . '--' . $bene['hhid']?></font></strong></h4>
            </div>
            <div class="box-body">

            <?php
                if(isset($_SESSION['saveError'])){
                    echo "
                        <div class='callout callout-danger text-center mt20'>
                            <p>".$_SESSION['saveError']."</p> 
                        </div>
                    ";
                    unset($_SESSION['saveError']);
                }
            ?>
                
                <form method="POST" id="formEncode"  action="encodecontroller2.php">
                <!--check box onSubmit="return checkdate(this.dob);"-->
                <div class="form-group">
                    <div class="input-group">
                     <label><input type="checkbox" id="change1" name="change1" onclick="enableText(this.checked); resetRemarks();">&nbsp<label><font color="gray"><i>Change/Edit Grantee</i></font></label>

                    </div>
                    <!-- /.input group -->
                </div>
                
                <input type="hidden" class="form-control" name="hhid" value="<?php echo $bene['hhid']; ?>" required>
                <input type="hidden" class="form-control" name="psgc" value="<?php echo $psgc; ?>" required>
                <input type="hidden" class="form-control" name="lbp" value="<?php echo $lbp; ?>" required>

                <div class="row">
                    <div class="form-group col-md-3">
                        <label><font color="gray"><i>Lastname:</i></font></label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </div>
                            <input type="text" class="form-control" id="changelName" name="lastname"
                                value="<?php echo $lname?>" required readOnly
                                style="text-transform:uppercase" onkeyup="this.value =  $lname.toUpperCase();">
                        </div>
                        <!-- /.input group -->
                    </div>

                    <div class="form-group col-md-4">
                        <label><font color="gray"><i>Firstname:</i></font></label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </div>
                            <input type="text" class="form-control" id="changeName" name="firstname" 
                                value="<?php echo $fname?>" required readOnly
                                style="text-transform:uppercase" onkeyup="this.value = $fname.toUpperCase();">
                        </div>
                        <!-- /.input group -->
                    </div>

                    <div class="form-group col-md-3">
                        <label><font color="gray"><i>Middlename:</i></font></label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </div>
                            <input type="text" class="form-control" id="changemName" name="middlename"
                                value="<?php echo $mname?>" readOnly
                                style="text-transform:uppercase" onkeyup="this.value = $mname.toUpperCase();">
                        </div>
                        <!-- /.input group -->
                    </div>                    

                    <div class="form-group col-md-2">
                        <label><font color="gray"><i>Name Ext:</i></font></label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </div>
                            <input type="text" class="form-control" id="changeextName" name="ext"
                                value="<?php echo $bene['name_ext']?>" readOnly
                                style="text-transform:uppercase" onkeyup="this.value = $bene['name_ext'].toUpperCase();">
                        </div>
                        <!-- /.input group -->
                    </div>                    
                </div>
                <!--row-->

                <div class="row">
                <div class="form-group col-md-3">
                    <label><font color="gray"><i>Registered:</font></i> <span style = "color:red"><a href = "#" data-toggle="tooltip" title="Required, and can be found on General Intake Sheet form" class = "pempem">*</a></span></label>

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-question"></i>
                        </div>
                        <select class="form-control" onchange="registered();resetRemarks();" id="register" name="register" style="width: 100%;" required autofocus>
                            <!--?php echo loadStatus($conn); ?-->
                            <option value="">~~SELECT~~</option>
                            <option value="1">YES</option>
                            <option value="0">NO</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group col-md-3">
                        <label><font color="gray"><i>Gender:</i></font><span style = "color:red"><a href = "#" data-toggle="tooltip" title="Required, and can be found on General Intake Sheet form" class = "pempem">*</a></span></label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-intersex"></i>
                            </div>
                            <select class="form-control" name="gender" id="gender" style="width: 100%;" required>
                                <option value="">~~SELECT~~</option>
                                <option value="1">MALE</option>
                                <option value="2">FEMALE</option>
                            </select>
                        </div>
                    </div>

                    <!--div class="form-group col-md-3">
                        <label><font color="gray"><i>Date of Birth:</i></font></label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" id="dob" name="dob" value="01/01/1900">
                        </div>
                    </div-->

                    <div class="form-group col-md-3">
                        <label><font color="gray"><i>Contact No.:</i></font></label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <input type="text" class="form-control" id="contactno" name="contactno">
                        </div>
                        <!-- /.input group -->
                    </div>

                    <div class="form-group col-md-3">
                         <label><font color="gray"><i>Occupation:</i></font></label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </div>
                            <input type="text" class="form-control" id="occupation" name="occupation"
                                style="text-transform:uppercase" onkeyup="this.value = this.value.toUpperCase()">
                        </div>
                        <!-- /.input group -->
                    </div>

	
                </div>
                <!--row-->

                <div class="row">

                    <!--div class="form-group col-md-4 hidden">
                        <label><font color="gray"><i>Nationality:</font></i><span style = "color:red"><a href = "#" data-toggle="tooltip" title="Required, and can be found on General Intake Sheet form" class = "pempem">*</a></span></label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-flag"></i>
                            </div>
                            <select class="form-control" name="nationality" style="width: 100%;" required>
                                < <//?php echo loadNationalities($conn); ?>
                            </select>
                        </div>
                    </div-->

                    <div class="form-group col-md-4" id="remarks" style="display:none;">
                         <label><font color="gray"><i>Remarks</i></font></label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-comments"></i>
                            </div>
                            <select class="form-control" id="remarksss" name="remarks" onchange="remarksChange()" style="width: 100%;">
                                <?php echo loadRemarks($conn); ?>
                            </select>
                        </div>
                        <!-- /.input group -->
                    </div>

                    <div class="form-group col-md-3" id="kaarawan" style="display:none;">
                        <label><font color="gray"><i>Date of Birth:</i></font></label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" class="form-control" id="dob" name="dob"> 
                        </div>
                    </div>

                    <div class="form-group col-md-4" id="relationship" style="display:none;">
                         <label><font color="gray"><i>Rel to Beneficiary</i></font></label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-comments"></i>
                            </div>
                            <select class="form-control" id="rel" name="rel" style="width: 100%;">
                                <?php echo getRelation($conn); ?>
                            </select>
                        </div>
                        <!-- /.input group -->
                    </div>

                    <div class="form-group col-md-4">
                        <label>Update Remarks:</label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-comments"></i>
                            </div>
                            <select class="form-control" id = "update_remarks" name="update_remarks" style="width: 100%;">
                                <?php echo loadUpdateRemarks($conn,$bene['update_remarks_id']); ?>
                            </select>
                        </div>
                        <!-- /.input group -->
                    </div>

                </div>
                <!--row-->

                <hr>
                <h4>Supporting Docs</h4>
                <?php
                    $sql = "SELECT file_name, cfolder FROM supporting_docs WHERE uct_id = '".$bene['hhid']."'";
                    $query = $conn->query($sql);
                    if($query->num_rows < 1){
                        echo "No uploaded Supporting Document";
                    }else{
                        while($row = $query->fetch_assoc()){
                            $image = $row['cfolder'].$row['file_name'];
                            echo ' <div class="col-md-4 col-xs-6">
                                        <lable>'.$row['file_name'].'</label>
                                        <a target="_blank" href="'.$image.'">
                                        <img src="'.$image.'" class="img-responsive img-thumbnail" width="150" height="150">
                                        </a>
                                    </div>';
                        }
                    }
                ?>
                <br><br><br>
                

                <div class="form-group">
                   
                    <button type="submit" class="btn btn-info col-sm-3 form-control" class = ""><i class = "fa fa-save" name = "save" id = "save"></i>&nbsp;Save</button>
					 <a href="search2.php" onclick="return confirm('Do you want to Cancel?');" class="btn btn-danger col-sm-3 form-control"><i class = "fa fa-times"></i>&nbsp;Cancel</a>	
                </div>
            </form>
            </div>
            <!-- /.box-body -->
          </div>
    </section>
    <!-- /.content -->
        
    </div>
    <?php include 'includes/footer.php'; ?>

</div>
<!-- ./wrapper -->


<?php include 'includes/scripts.php'; ?>

</body>
</html>


<script >
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    });
	
	
	function registered(){
        var registered = document.getElementById("register").value;
        if(registered == "1"){ //yes
            //document.getElementById('dob').required = true;
            document.getElementById('contactno').required = true;
            document.getElementById('occupation').required = true;
            document.getElementById('gender').required = true;
			document.getElementById('remarksss').required = false;
			var changeClick = document.getElementById("change1");
            $('#remarks').hide();
            $('#relationship').hide();
            $('#kaarawan').hide();
			if(changeClick.checked){
				document.getElementById('remarksss').required = true;
                $('#remarks').show();
			}
        }else if(registered == "0"){ //no
            //document.getElementById('dob').required = false;            
            document.getElementById('contactno').required = false;            
            document.getElementById('occupation').required = false;            
            document.getElementById('gender').required = false;
            document.getElementById('remarksss').required = true;
            $('#remarks').show();
        }else{
            $('#remarks').hide();
            $('#relationship').hide();
            $('#kaarawan').hide();

        }
    }

    function enableText(checked){
        if(!checked){ //no checked
            document.getElementById('changeName').readOnly = true;
            document.getElementById('changemName').readOnly = true;
            document.getElementById('changelName').readOnly = true;
            document.getElementById('changeextName').readOnly = true;
            document.getElementById('remarksss').required = false;
			$('#remarks').hide();
            $('#relationship').hide();
            $('#kaarawan').hide();
			var registered = document.getElementById("register").value;
			if(registered == "0"){ //NO
				document.getElementById('remarksss').required = true;
                $('#remarks').show();
			}
        }
        else{ //checked
            document.getElementById('changeName').readOnly = false;
            document.getElementById('changemName').readOnly = false;
            document.getElementById('changelName').readOnly = false;
            document.getElementById('changeextName').readOnly = false;
            document.getElementById('remarksss').required = true;
            $('#remarks').show();
        }
    }

    function remarksChange(){
        var remarks_id = document.getElementById("remarksss").value;
        //hardcode muna pansamantagal.. Sorry na mabilisan kasi
        if(remarks_id==8 || remarks_id==10 || remarks_id==11 || remarks_id==12 || remarks_id==13 || 
            remarks_id==14 || remarks_id==15 || remarks_id==16 || remarks_id==19 || remarks_id==27){
            $('#relationship').show();
            $('#kaarawan').show();
            document.getElementById('rel').required = true;
            document.getElementById('dob').required = true;
        }else{
            $('#relationship').hide();
            $('#kaarawan').hide();
            document.getElementById('rel').required = false;
            document.getElementById('dob').required = false;
        }
    }

    function resetRemarks(){
        var dropDownRemarks = document.getElementById("remarksss");
        dropDownRemarks.selectedIndex = '';

        var dropDownRel = document.getElementById("rel");
        dropDownRel.selectedIndex = '';
    }

    //date validation
    function checkdate(input){
        var myForm = document.getElementById("formEncode");
        var beneRegistered = myForm.register.value;
        if(beneRegistered == 1){
            var year = new Date(myForm.dob.value).getFullYear();
            if (year.toString().length != 4) {
                alert("Length: Invalid date of birth. Please check");
                return false;
            }
            var current_year=new Date().getFullYear();
            if((year < 1920) || (year > current_year)){
                alert("Invalid date of birth. Please check");
                return false;
            }
            return true;
        }
    }


</script>