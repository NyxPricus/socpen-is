<?php
session_start();
require_once './config/config.php';
require_once './include/auth_validate.php';
if(isset($_POST['save'])){
$id = $_POST['id'];
$hhid = $_POST['hhid'];
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$remarks = $_POST['remarkss'];
$ext = $_POST['editext'];

$newprovince = $_POST['inputProvince'];



$newmuni = $_POST['inputCity'];
$newbarangay = $_POST['inputBarangay'];
$newdob = $_POST['dob'];


	if(empty($fname) or empty($mname) or empty($lname) and (!isset($fname)))
	{
		header("location:edit_bene");
		exit();
	}
	else
	{
			$today1 = date("d-m-Y h:i:s"); 		
		
/*		
$filename = $_FILES["file"]["name"];
	//$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
	$file_basename = $id . $today1;
	$file_ext = substr($filename, strripos($filename, '.')); // get file name
	$filesize = $_FILES["file"]["size"];
	$allowed_file_types = array('.jpeg','.jpg','.pdf','.png');	

	if (in_array($file_ext,$allowed_file_types) && ($filesize < 1000000))
	{	
		// Rename file
		$newfilename = md5($file_basename) . $file_ext;
		if (file_exists("upload/" . $newfilename))
		{
			// file already exists error
			echo "You have already uploaded this file.";
		}
		else
		{		
			move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/" . $newfilename);
			echo "File uploaded successfully.";		
		}
	}
	elseif (empty($file_basename))
	{	
		// file selection error
		echo "Please select a file to upload.";
	} 
	elseif ($filesize > 1000000)
	{	
		// file size error
		echo "The file you are trying to upload is too large.";
	}
	else
	{
		// file type error
		echo "Only these file typs are allowed for upload: " . implode(', ',$allowed_file_types);
		unlink($_FILES["file"]["tmp_name"]);
	}
	
	*/
		
		


		
		
		//echo $id;
		//echo "<br>" . $hhid;

				$newfilename = 1;	//pansamantagal
	$sql="SELECT id,hhid,last_name,first_name,middle_name,ext,province,city_muni,barangay FROM uct_list_110 where id = ?";
	
	if($stmt = $mysqli->prepare($sql)){
		
		$stmt->bind_param("i", $param_uName);
		$param_uName = $id;
		if($stmt->execute()){
			$stmt->store_result();
			if($stmt->num_rows != 0){                    
			$stmt->bind_result($oldid,$oldhhid,$oldlname,$oldfname,$oldmname,$oldext,$oldprovince,$oldcity_muni,$oldbaranagay);
				if($stmt->fetch()){
				//echo $oldid;
				////echo "<br>" . $oldbaranagay;
					}
				}
			} else{
			echo "Error loading page";
			}
		} else{
			echo "Oops! Something went wrong. Please try again later.";
			$stmt->close(); 
		}
		


		if($newprovince=="")
		{
			$newprovince = $oldprovince;
			$newmuni = $oldcity_muni;
			$newbarangay = $oldbaranagay;
		}

					
				
				
	$today = date("d/m/Y h:i:s"); 		
	$sql2="INSERT INTO uct_list_edit_history(id,hhid,last_name,first_name,middle_name,ext,province,city_muni,barangay,remarks,status,edited_by,edited,supporting_document,dob) VALUES('$id','$hhid','$lname','$fname','$mname','$ext','$newprovince','$newmuni','$newbarangay','$remarks',1,'$_SESSION[user_id]',NOW(),'$newfilename',$newdob)";
	
	if($stmt2 = $mysqli->prepare($sql2)){
		
		
		
		if($stmt2->execute()){
			$stmt2->store_result();
			if($stmt2->num_rows != 0){                    
			//$stmt2->bind_result($oldid,$oldhhid,$oldlname,$oldfname,$oldmname,$oldext,$oldprovince,$oldcity_muni,$oldbaranagay,$oldpurok_sitio,$oldstreet,$oldencoded1,$oldfrom_excel,$oldedited);
				if($stmt->fetch()){
				echo $oldid;
				//echo "<br>" . $oldbaranagay;
				//echo "SAVeD";
					}
				}
			} else{
			echo "Error loading page";
			}
		} else{
			echo "Oops! Something went wrong. Please try again later.";
		}
		//$stmt2->close();   
		
		
		
		
		
		
		
		
		$_SESSION['okay']=$hhid;
		
		header("location:beneficiaries");
		

		
		
		
	
	
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
			
			$mysqli->close();			
		
	}			
	}

else{
header("location:beneficiaries");
}

?>