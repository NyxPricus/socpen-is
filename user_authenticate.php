<?php
session_start();
require_once './config/config.php';
require_once './include/auth_validate.php';
$redirect = NULL;
if($_POST['location'] != '') {
    $redirect = $_POST['location'];
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
 	$username = $_POST['username'];
	$passwd = $_POST['passwd'];
	
	$sql = "SELECT concat(firstName, ' ', lastName) as fullname,address, fo3UserId, uPword, uType FROM fo3user WHERE uName = ? and uType != '0'";
	
	if($stmt = $mysqli->prepare($sql)){
		
		$stmt->bind_param("s", $param_uName);
		$param_uName = $username;
		if($stmt->execute()){
			$stmt->store_result();
			if($stmt->num_rows == 1){                    
				$stmt->bind_result($fullname,$address,$id,$hashed_uPword,$type);
				if($stmt->fetch()){
					if(password_verify($passwd, $hashed_uPword)){
						// Store data in session variables
						$_SESSION['user_logged_in'] = TRUE;
						//$_SESSION['admin_type'] = $row[0]['admin_type'];
						$_SESSION["user_id"] = $id;
						$_SESSION["user_name"] = $username;
						$_SESSION["fullname"] = $fullname;
						$_SESSION["type"] = $type;
						$_SESSION["address"] = $address;
						$_SESSION['okay_L'] = 'OKAY';
						$_SESSION['admin'] = $id;
						$_SESSION['account'] = $id;
						// Redirect user to welcome page
						if(isset($redirect)){
						header("Location:". $redirect);
						}
						else{
							header("location:index");
						}
					} else{
						
						// Display an error message if password is not valid
						$_SESSION['login_failure'] = "The password you entered was not valid.";
						$url = 'user_login?p=2';
				if(isset($redirect)) {
					$url .= '&location=' . urlencode($redirect);
				}
			   header("Location:" . $url);
			   exit();
					}
				}
			} else{
				// Display an error message if username doesn't exist
				$_SESSION['login_failure'] = "No account found with username <strong>" . $username . "</strong><br><br><i><h6>If you registered your account, wait for the confirmation of UCT-RPMO sent to yourd email if your account is ready to use</i></h6>";
				//header("location:user_login.php");
				
				$url = 'user_login?p=3';
				if(isset($redirect)) {
					$url .= '&location=' . urlencode($redirect);
				}
			   header("Location:" . $url);
			   exit();
				

				
				
				
				
				
				
				
				
				
				
			}
		} else{
			echo "Oops! Something went wrong. Please try again later.";
		}
		$stmt->close();   
	}
	$mysqli->close();
}
?>