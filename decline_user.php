<?php
session_start();
require_once './config/config.php';
require_once './include/auth_validate.php';

	$uid = $_GET['uid'];
	echo $uid;
	// Prepare an insert statement
	$sql = "Delete from fo3user where fo3UserId = ?";
	 
	if($stmt = $mysqli->prepare($sql)){
		// Bind variables to the prepared statement as parameters
		$stmt->bind_param("s", $uid);
		
		// Set parameters
		if($stmt->execute()){
			// Redirect to login page
			
			$_SESSION["register_deleted"]="User Request Deleted Successfully";
			header("location:pending_users");
		} else{
			$_SESSION["register_deleted"] = "Something went wrong. Please try again later.";
			header("location:register");
			exit;
		}
		// Close statement
        $stmt->close();
	}    
    // Close connection
    $mysqli->close();

?>