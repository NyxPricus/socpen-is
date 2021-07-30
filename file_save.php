<?php
session_start();
require_once 'config/config.php';
require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';
$accomplishmentStatId = 0;
$accomplishmentNo = "";
$uploadBene = 1;
//$_SESSION['upload_success'] = "";
$meronNa = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){
    
     if(isset($_FILES['uploadFile']['name']) && $_FILES['uploadFile']['name'][0] != "") {
        for($i=0;$i<count($_FILES['uploadFile']['name']);$i++){
            //$mysqli->begin_transaction();
            if($_FILES['uploadFile']['name'][$i] != ""){
                $allowedExtensions = array("xls","xlsx");
                $ext = pathinfo("/ulploads/". $_FILES['uploadFile']['name'][$i], PATHINFO_EXTENSION);
                if(in_array($ext, $allowedExtensions)) {
                   $file_size = $_FILES['uploadFile']['size'][$i] / 4096;
                   if($file_size < 150) {
                       $file = $_FILES['uploadFile']['name'][$i];
						$isUploaded = copy($_FILES['uploadFile']['tmp_name'][$i], $file);
						if($isUploaded) {
							 try {
								$objPHPExcel = PHPExcel_IOFactory::load($file);
							 } catch (Exception $e) {
								die('Error loading file "' . pathinfo($file, PATHINFO_BASENAME). '": ' . $e->getMessage());
							 }
							 $sheet = $objPHPExcel->getSheet(0);
							 $total_rows = $sheet->getHighestRow();
                             $total_columns = $sheet->getHighestColumn();
                             $mysqli->begin_transaction();
							 //$row=2 meaning magstart siya sa 2nd row ng excel
							 for($row =1; $row <= $total_rows; $row++) {
								 $single_row = $sheet->rangeToArray('A' . $row . ':' . $total_columns . $row, NULL, TRUE, FALSE);
                                 $hhid = trim($single_row[0][0]);
								 $dateofpayout = $_POST['yearofpayout'];
                                 //$user_id = trim($single_row[0][1]);
                
								 $sqlDtl = "insert into listahanan_unpaid(hhid,date_of_payout) values(?,?)";
								 $stmtDtl=$mysqli->prepare($sqlDtl);
								 $stmtDtl->bind_param('ss',$param_hhid,$param_dateofpayout);
								 $param_hhid = $hhid;
								 $param_dateofpayout = $dateofpayout;
								 $param_upoaded = 1;
								 
								 
								 
								 
								$lamankungmeronna = alreadyTagged($hhid,$dateofpayout,$mysqli);
								echo $hhid;
								echo $dateofpayout;
								//0 existing na
								echo $lamankungmeronna;
								//exit();
								
								IF($lamankungmeronna==0){
									$meronNa .= "<div class='alert alert-warning'><strong>Data already exist on line number: " .$row . " </strong></div>"; 
									continue;
								}

								 
								 
								 
								 
								 
								 
								 //$param_status = checkUCTID($uct_id,$mysqli);
								 if(!$stmtDtl->execute()){
                                         echo "Error " . $mysqli->error;
                                         $stmtDtl->close();
                                         $mysqli->rollback();
										 exit();
                                 }
                                 
                                 $stmtDtl->close();
                                 $mysqli->commit();
							 }
								if(strlen($meronNa)){
									 $_SESSION["meronna"] = $meronNa;
								 }
						 } else {//checks if file is uploaded
								 $_SESSION['upload_error'] = "Failed to upload file " . $file;
								 $_SESSION['upload_error'] = "Maximum file size should not exceed 50 KB!";
                                 unlink($file);
                                 //$mysqli->close();
                                 //$mysqli->rollback();
                                 header('location:upload_unpaid.php');
                                 exit();
						 }
                    } else {//check file size
                        $_SESSION['upload_error'] = "Maximum file size should not exceed 50 KB!";
                        unlink($file);
                        header('location:upload_unpaid.php');
                        exit();
                    }
                } else {//check file extension
                    $_SESSION['upload_error'] = "Invalid file type. Please upload xls or xlsx file type!";
                    unlink($file);
                    header('location:upload_unpaid.php');
                    exit();
                }  
            }//filename is not empty         
        }//loop through files     
    } else{//upload file isset?
        $_SESSION['upload_error'] = "Select an excel file first!";
        header('location:upload_unpaid.php');
        exit();
    }    
}//post
unlink($file);
$mysqli->close();
header('location:upload_unpaid.php');
$_SESSION['upload_success'].= "File Successfully uploaded<br>";
?>
