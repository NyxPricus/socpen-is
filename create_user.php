<?php
session_start();
require_once './config/config.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$username = $_POST['inputUsername'];
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$userEmail = $_POST['inputEmail'];
	$passwd = $_POST['inputPassword'];
	$address = $_POST['inputAddress'];
	$confirmPasswd = $_POST['confirmPassword'];
	
	$register_data = array($username,$firstName,$lastName,$userEmail,$address);	
	$_SESSION["register_data"] = $register_data;
	
	//check natin kung existing na username
	$sql = "SELECT fo3UserId FROM fo3user WHERE uName = ?";        
	if($stmt = $mysqli->prepare($sql)){
		$stmt->bind_param("s", $param_uName);            
		$param_uName = $username;            
		if($stmt->execute()){
			$stmt->store_result();
			
			if($stmt->num_rows == 1){
				$_SESSION["register_field"] = "USERNAME";
				$_SESSION["register_failure"] = "This username is already taken.";
				header("location:user_register.php");
				exit;
			}
		} else{				
			$_SESSION["register_failure"] = "Oops! Something went wrong. Please try again later.";
			header("location:user_register.php");
			exit;
		}
		$stmt->close();
	}
	
	//check natin kung existing na email add
	$sql = "SELECT fo3UserId FROM fo3user WHERE uEmail = ?";        
	if($stmt = $mysqli->prepare($sql)){
		$stmt->bind_param("s", $param_uEmail);            
		$param_uEmail = $userEmail;            
		if($stmt->execute()){
			$stmt->store_result();
			
			if($stmt->num_rows == 1){
				$_SESSION["register_field"] = "USEREMAIL";
				$_SESSION["register_failure"] = "This email address is already taken.";
				header("location:user_register.php");
				exit;
			}
		} else{				
			$_SESSION["register_failure"] = "Oops! Something went wrong. Please try again later.";
			header("location:user_register.php");
			exit;
		}
		$stmt->close();
	}

    // Validate password
    if(strlen(trim($passwd)) < 6){
		$_SESSION["register_field"] = "PASSWORD";
		$_SESSION["register_failure"] = "Password must have atleast 6 characters.";
		header("location:user_register.php");
		exit;
    } 
    // Validate confirm password
    if($passwd != $confirmPasswd){
		$_SESSION["register_field"] = "PASSWORD";
		$_SESSION["register_failure"] = "Password did not match.";
		header("location:user_register.php");
		exit;
    } 
	// Prepare an insert statement
	$sql = "INSERT INTO fo3user (uName,uPword,uType,firstName,lastName,uEmail,uStatus,address) VALUES (?, ?,?,?,?,?,?,?)";
	 
	if($stmt = $mysqli->prepare($sql)){
		// Bind variables to the prepared statement as parameters
		$stmt->bind_param("ssssssss", $paramuName,$paramuPword,$paramuType,$paramfirstName,$paramlastName,$paramuEmail,$paramuStatus,$paramuAddress);
		
		// Set parameters
		$paramuName = $username;
		$paramuPword = password_hash($passwd, PASSWORD_DEFAULT);
		$paramuType = 5; //default(for activation by admin)
		$paramfirstName = $firstName;
		$paramlastName = $lastName;
		$paramuEmail = $userEmail;
		$paramuAddress = $address;
		$paramuStatus = 0;
		//$paramuDate = date_default_timezone_get();
		// Attempt to execute the prepared statement
		if($stmt->execute()){
			// Redirect to login page
			unset($_SESSION["register_data"]);
			unset($_SESSION["register_field"]);
			header("location:user_login.php");
		} else{
			$_SESSION["register_failure"] = "Something went wrong. Please try again later.";
			header("location:user_register.php");
			exit;
		}
		// Close statement
        $stmt->close();
	}    
    // Close connection
    $mysqli->close();
}
?>