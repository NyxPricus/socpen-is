<?php

session_start();
require_once './config/config.php';
require_once './include/auth_validate.php';
require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
     if(isset($_FILES['uploadFile']['name']) && $_FILES['uploadFile']['name'] != "") {
        $allowedExtensions = array("xls","xlsx");
        $ext = pathinfo("/ulploads/". $_FILES['uploadFile']['name'], PATHINFO_EXTENSION);
        if(in_array($ext, $allowedExtensions)) {
           $file_size = $_FILES['uploadFile']['size'] / 1024;
           if($file_size < 50) {
               $file = $_FILES['uploadFile']['name'];
               $isUploaded = copy($_FILES['uploadFile']['tmp_name'], $file);
               if($isUploaded) {
                    try {
                        $objPHPExcel = PHPExcel_IOFactory::load($file);
                    } catch (Exception $e) {
                         die('Error loading file "' . pathinfo($file, PATHINFO_BASENAME). '": ' . $e->getMessage());
                    }
                    $sheet = $objPHPExcel->getSheet(0);
                    $total_rows = $sheet->getHighestRow();
                    $total_columns = $sheet->getHighestColumn();
					$notifierId = "";
					$mysqli->begin_transaction();
					$accomplishmentNo = generateUploadId("accomplishment","NE",$mysqli);
                    for($row =1; $row <= $total_rows; $row++) {
                        $single_row = $sheet->rangeToArray('A' . $row . ':' . $total_columns . $row, NULL, TRUE, FALSE);
						$UnotifierId = $single_row[0][0];
						$Uhhid = $single_row[0][1];
						$UstatusId = $single_row[0][2];						
						$UdateNotified = DateTime::createFromFormat('Y-m-d', $single_row[0][3])->format('Y-m-d');
						//$prov = $single_row[0][4];
						
						//mag dagdag pa ng validation dito(this code assumes that uploaded data is ok)						
						$sqlDtl = "insert into accomplishmentDtl(socpenListId, notificationStatusId, dateNotified, accomplishmentId, accomplishmentStatId) values(?,?,?,?,?)";
						$stmtDtl=$mysqli->prepare($sqlDtl);
						$stmtDtl->bind_param('sissi',$socpenListId, $notificationStatusId, $dateNotified,$accomplishmentId, $accomplishmentStatId);
						//$accomplishmentDtlId = generateUploadId("accomplishmentDtl",$prov,$mysqli);
						$socpenListId = $Uhhid;
						$notificationStatusId = $UstatusId;
						$dateNotified = $UdateNotified;
						$accomplishmentId = $accomplishmentNo;
						$accomplishmentStatId = 1;
						if(!$stmtDtl->execute()){
							echo "Error " . $mysqli->error;
							$mysqli->rollback();
							exit();
						}
						
                    }
					
					$sqlhdr = "insert into accomplishment(accomplishmentId, fo3notifierId, uploadedBy, dateUploaded) values(?,?,?,?)";
					$stmtHdr= $mysqli->prepare($sqlhdr);
					$stmtHdr->bind_param('ssss',$accomplishmentId,$param_notifId,$param_uploadedBy,$param_date);
					$accomplishmentId = $accomplishmentNo;
					$param_notifId = $UnotifierId;
					$param_uploadedBy = $_SESSION["user_id"];
					$param_date =  date("Y-m-d H:i:s");
					echo $mysqli->error;
					if(!$stmtHdr->execute()){
						echo "Error " . $mysqli->error;
						$mysqli->rollback();
						exit();
					}
					
					/*$sqlfile = "insert into uploadedfile(uploadedFileId, accomplishmentId) values(?,?)";
					$stmtFile= $mysqli->prepare($sqlfile);
					echo $mysqli->error;
					$stmtFile->bind_param('ss',$param_uploadedFileId, $param_accomplishmentId);
					$param_uploadedFileId = $file;
					$param_accomplishmentId = $accomplishmentNo;
					echo $mysqli->error;
					if(!$stmtFile->execute()){
						echo "Error " . $mysqli->error;
						$mysqli->rollback();
						exit();
					}*/
					
					$stmtHdr->close();
					$stmtDtl->close();
					//$stmtFile->close();
                    $mysqli->commit();
					$mysqli->close();
					$_SESSION['upload_error'] = "File Successfully uploaded to database " . $file;
                    unlink($file);
                } else {
					$_SESSION['upload_error'] = "Failed to upload file " . $file;					
                }
            } else {
				$_SESSION['upload_error'] = "Maximum file size should not exceed 50 KB!";
            }
        } else {
			$_SESSION['upload_error'] = "Invalid file type. Please upload xls or xlsx file only!";
        }
	} else {
        $_SESSION['upload_error'] = "Select an excel file first!";
    }
}
header('location:data_uploading.php');
?>