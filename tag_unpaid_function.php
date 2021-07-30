<?php
session_start();
require_once './config/config.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$hhid = $_POST['txt_hhid'];
	$year = $_POST['txt_year'];
	$u_id = $_SESSION["user_id"];
	$date_update = date("yy-m-d");

	


	

	
								echo "<script>alert('dagdag bago')</script>";
							//insert new
							$sql = "INSERT INTO uct_listahanan_paid (hhid,updated_by,date_updated,year) VALUES (?, ?,?,?)";
					
					if($stmt = $mysqli->prepare($sql)){
						
						$stmt->bind_param("sssi", $hhid,$u_id,$date_update,$year);
						if($stmt->execute()){
							// Redirect to login page
							unset($_SESSION["register_data"]);
							
							//header("location: login.php");
							$_SESSION["register_okay"] = "SAVED! " . $hhid;
							header("location:paid_tagging");
						} else{
							$_SESSION["register_failure"] = "Something went wrong. Please try again later.";
							echo $mysqli->error;
						//	header("location:paid_tagging.php");
							exit;
						}
						// Close statement
						$stmt->close();
					}    
					// Close connection
					$mysqli->close();

	}
				

	

?>