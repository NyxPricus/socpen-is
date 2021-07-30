<?php
session_start();
require_once './config/config.php';
require_once './include/auth_validate.php';


$uid = $_POST['idval'];
$utype = $_POST['inputType'];


echo $uid. " " . $utype;

$sql = "update fo3user set uType = ?, uStatus = 1 where fo3UserId = ?";
	
	 
	if($stmt = $mysqli->prepare($sql)){
		// Bind variables to the prepared statement as parameters
		$stmt->bind_param("ss", $paramuType,$paramid);
		
		// Set parameters
		$paramid = $uid;
		$paramuType = $utype;
		if($stmt->execute()){
			// Redirect to login page
			header("location:pending_users");
		} else{
			echo "Something went wrong. Please try again later.";
			
		}
		// Close statement
        $stmt->close();
	}    
    // Close connection
    $mysqli->close();
	
		?>