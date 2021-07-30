<?php
session_start();
require_once './config/config.php';
//require_once './include/auth_validate.php';

$today = getdate();
//echo date("y") . date("m") . date("d");
for($i=0;$i<count($_FILES["uploaded"]["name"]);$i++){
	if($_FILES["uploaded"]["name"][$i] != ""){
        $file_name = $_FILES["uploaded"]["name"][$i];
		$excelFile = $_FILES["uploaded"]["tmp_name"][$i];
		$handle = fopen($excelFile, "r");
		
		WHILE(($data = fgetcsv($handle,1000,",")) !== false){
			$notifierId		= $data[0] . " ";
			$hhid			= $data[1] . " ";
			$status			= $data[2] . " ";
			$dateNotified	= $data[3] . "<br>";
			echo $notifierId . $hhid . $status . $dateNotified;
		}
	}
}

?> 