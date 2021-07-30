<?php
session_start();
require_once './config/config.php';
require_once './include/auth_validate.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
	echo "post";
	$description = $_POST['description'];
	$withPay = $_POST['withpay'];

	// Prepare an insert statement
	$sql = "INSERT INTO notificationstatus(description,withPay)VALUES (?,?)";
	 
	if($stmt = $mysqli->prepare($sql)){
		// Bind variables to the prepared statement as parameters	
		$stmt->bind_param("ss",$param_description,$param_withPay);
		
		// Set parameters
		$param_description = $description;
		$param_withPay = $withPay;
		
		//check natin kung existing na status
		$sql = "SELECT notificationStatusId FROM notificationstatus WHERE description = ?";        
		if($stmtDescr = $mysqli->prepare($sql)){
			$stmtDescr->bind_param("s", $param_description);            
			$param_description = $description;            
			if($stmtDescr->execute()){
				$stmtDescr->store_result();			
				if($stmtDescr->num_rows == 1){
					$_SESSION["notification_failure"] = "Notification Status already exists.";					
					header("location:status_notification.php");
					exit;
				}
			} else{				
				$_SESSION["notifier_failure"] = "Oops! 	. Please try again later." . $mysqli->error;
				header("location:status_notification.php");
				exit;
			}
			$stmtDescr->close();
		}
		
		
		// Attempt to execute the prepared statement
		if($stmt->execute()){
			$_SESSION['notification_success'] = "Notification Status Successfully added.";		
		} else{
			$_SESSION["notification_failure"] = "Oops! Something went wrong. Please try again later. " . $mysqli->error;
		}
		header("location:status_notification.php");	
		
		// Close statement
        $stmt->close();
	}else{
		echo "Error: " . $mysqli->error;
	}	
    // Close connection
    $mysqli->close();
}
?>