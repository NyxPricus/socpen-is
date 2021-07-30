<?php
session_start();
require_once './config/config.php';
require_once './include/auth_validate.php';


$uid = $_GET['uid'];
if($_SESSION["user_id"]!=$uid)
{


echo $uid;

$sql = "delete from fo3user where fo3UserId = ?";
	
	 
	if($stmt = $mysqli->prepare($sql)){
		// Bind variables to the prepared statement as parameters
		$stmt->bind_param("s", $paramid);
		
		// Set parameters
		$paramid = $uid;
		$paramuType = $utype;
		if($stmt->execute()){
			// Redirect to login page
			$_SESSION["register_success"]="USER DELETED SUCCESSFULLY";
			header("location:users");
		} else{
			echo "Something went wrong. Please try again later.";
			
		}
		// Close statement
        $stmt->close();
	}    
    // Close connection
    $mysqli->close();
}else
	
	{
		$_SESSION["register_success"]="CANNOT DELETE OWN ACCOUNT";
			header("location:users");
	}
	?>