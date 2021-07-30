<?php
session_start();
require_once 'config/config.php';
require_once './include/auth_validate.php';
if(isset($_GET['del'])){
$acc_id_del = $_GET['del'];

echo $acc_id_del;


        $sql = "delete from uct_listahanan_paid where id = ?";
if($stmt = $mysqli->prepare($sql)){

$stmt->bind_param("i", $acc_id_del);
if($stmt->execute()){

    $_SESSION["register_okay"] = "DATA DELETED!";

    header("location:accomplishment_tagging.php");
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