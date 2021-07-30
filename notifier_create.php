<?php
session_start();
require_once './config/config.php';
require_once './include/auth_validate.php';

if($_SERVER["REQUEST_METHOD"] === "POST"){
	$firstName = $_POST['firstName'];
	$middleName = $_POST['middleName'];
	$lastName = $_POST['lastName'];
	$nameSuffix = $_POST['nameSuffix'];
	$contactNo = $_POST['contactNo'];
	$inputEmail = $_POST['inputEmail'];
	$dob = $_POST['dob'];
        $inputProvince = $_POST['inputProvince'];
                
	$notifier_data = array($firstName,$middleName,$lastName,$nameSuffix,$contactNo,$inputEmail);
	$_SESSION["notifier_data"] = $notifier_data;
	
	//check natin kung valid ba contact number (11 digits dapat)
	if(strlen(trim($contactNo)) != 11){
		$_SESSION["notifier_field"] = "CONTACTNO";
		$_SESSION["notifier_failure"] = "Invalid contact number, should be 11 digit!";
		header("location:notifier_add.php");
		exit;
	}
	
	//check natin kung existing na contact number
	$sql = "SELECT fo3notifierId FROM fo3notifier WHERE contactNo = ?";        
	if($stmt = $mysqli->prepare($sql)){
		$stmt->bind_param("s", $param_contactNo);            
		$param_contactNo = $contactNo;            
		if($stmt->execute()){
			$stmt->store_result();			
			if($stmt->num_rows == 1){
				$stmt->close();
				$_SESSION["notifier_field"] = "CONTACTNO";
				$_SESSION["notifier_failure"] = "A notifier already has this contact number.";
				header("location:notifier_add.php");
				exit;
			}
		} else{				
			$_SESSION["notifier_failure"] = "Oops! 	. Please try again later." . $mysqli->error;
			$stmt->close();
			header("location:notifier_add.php");
			exit;
		}		
	}
	
	//check natin kung existing na email add
	$sql = "SELECT fo3notifierId FROM fo3notifier WHERE emailadd = ?";        
	if($stmt = $mysqli->prepare($sql)){
		$stmt->bind_param("s", $param_nEmail);            
		$param_nEmail = $inputEmail;            
		if($stmt->execute()){
			$stmt->store_result();
			
			if($stmt->num_rows == 1){
				$_SESSION["notifier_field"] = "EMAIL";
				$_SESSION["notifier_failure"] = "A notifier already has this email address.";
				header("location:notifier_add.php");
				exit;
			}
		} else{				
			$_SESSION["notifier_failure"] = "Oops! Something went wrong. Please try again later." . $mysqli->error;
			header("location:notifier_add.php");
			exit;
		}
		$stmt->close();
	}

	// Prepare an insert statement
	$sql = "INSERT INTO fo3notifier(firstName,lastName,middleName,nameSuffix,contactNo,emailAdd,address1,encodedBY,	dateEncoded,dob)
			VALUES (?,?,?,?,?,?,?,?,?,?,?)";
	 
	if($stmt = $mysqli->prepare($sql)){
		// Bind variables to the prepared statement as parameters	
		$stmt->bind_param("ssssssssss",$paramFirstName,$paramLastName,$paramMiddleName,$paramNameSuffix,$paramContactNo,$paramEmailAdd,$paramAddress1,$paramEncodedBY,$paramDateEncoded,$paramDOB);
		
		// Set parameters
		$paramFirstName = $firstName;
		$paramLastName = $lastName;
		$paramMiddleName = $middleName;
		$paramNameSuffix = $nameSuffix;
		$paramContactNo = $contactNo;
		$paramEmailAdd = $inputEmail;
		$paramAddress1 = "";//to be updated
		$paramEncodedBY = $_SESSION['user_id'];
		$paramDateEncoded = date('Y-m-d H:i:s');
                $paramDOB = $dob;
		// Attempt to execute the prepared statement
		if($stmt->execute()){
			unset($_SESSION["notifier_data"]);
			unset($_SESSION["notifier_field"]);
			$_SESSION['notifier_success'] = "Notifier Successfully added.";
			header("location: notifier_add.php");			
		} else{
			$_SESSION["notifier_failure"] = "Oops! Something went wrong. Please try again later. " . $mysqli->error;
			header("location:notifier_add.php");
			exit;
		}
		// Close statement
        $stmt->close();
	}    
    // Close connection
    $mysqli->close();
}
?>