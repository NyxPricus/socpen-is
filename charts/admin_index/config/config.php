
<?php

//Note: This file should be included first in every php page.
error_reporting(E_ALL);
ini_set('display_errors', 'On');
define('BASE_PATH', dirname(dirname(__FILE__)));
define('APP_FOLDER', 'uct-notification');
define('CURRENT_PAGE', basename($_SERVER['REQUEST_URI']));
date_default_timezone_set("Asia/Manila");

//require_once BASE_PATH . '/helpers/helpers.php';

/*
|--------------------------------------------------------------------------
| DATABASE CONFIGURATION AND FUNCTIONS
|--------------------------------------------------------------------------
 */

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'uct_fus');

$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if($mysqli === false){
	die("ERROR: Could not connect. " . $mysqli->connect_error);
}


function getAllotment($saa_id,$mysqli){
    $query = "SELECT SUM(amount_received) FROM tbl_allotment WHERE saa_id = $saa_id";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($total_allotment);
	$stmt->fetch();

    return $total_allotment;

}

function getTransaction($saa_id,$mysqli){
    $query = "SELECT SUM(exact_amount) FROM tbl_transactions WHERE trans_saa_id = $saa_id and deleted is false and trans_type = 'LUM'";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($total_trans);
	$stmt->fetch();

    return $total_trans;

}

function getAllotment_obj($obj_id,$saa_id,$mysqli){
    $query = "SELECT amount_received FROM tbl_allotment WHERE saa_id = $saa_id and obj_id = $obj_id ";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($total_allotment_obj);
	$stmt->fetch();

    return $total_allotment_obj;

}
function getTransaction_obj($obj_id,$saa_id,$mysqli){
    $query = "SELECT SUM(trans_amount) FROM tbl_transactions WHERE trans_saa_id = $saa_id and trans_obj_id = $obj_id AND deleted is false and trans_type = 'LUM'";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($total_trans_obj);
	$stmt->fetch();

    return $total_trans_obj;

}
function meow($from_saa_id,$mysqli){
    $query = "SELECT SUM(realignment_amount) FROM realignment_transactions WHERE from_saa_id = $from_saa_id and type = 'LUM'";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($total_realignment_amount);
	$stmt->fetch();

    return $total_realignment_amount;

}
function getTransaction_obj_trans($obj_id,$saa_id,$mysqli){
    $query = "SELECT trans_amount FROM tbl_transactions WHERE trans_saa_id = $saa_id and trans_obj_id = $obj_id AND deleted is false";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($total_trans_obj);
	$stmt->fetch();

    return $total_trans_obj;

}

function getObjDes($obj_id,$saa_id,$mysqli){
    $query = "SELECT obj_description from object where obj_id = $obj_id and saa_id = $saa_id";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($objdes);
	$stmt->fetch();

    return $objdes;

}
function getObjCode($obj_id,$saa_id,$mysqli){
    $query = "SELECT obj_code from object where obj_id = $obj_id and saa_id = $saa_id";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($objcode);
	$stmt->fetch();

    return $objcode;

}
function getUnit($unit_id,$mysqli){
    $query = "SELECT unit_acronym from unit where unit_id = $unit_id";
    $stmt = $mysqli->prepare($query);

    $stmt->execute();
    $stmt->bind_result($unit_id);
	$stmt->fetch();

    return $unit_id;

}


function getEarmarkTotal($obj_id,$saa_id,$mysqli){
    $query2 = "SELECT sum(trans_amount) from tbl_transactions where trans_obj_id = $obj_id and trans_saa_id = $saa_id and trans_type = 'EAR' and deleted = 0";
    $stmt2 = $mysqli->prepare($query2);
    $stmt2->execute();
  
    $stmt2->bind_result($earmarkTotal);
	$stmt2->fetch();

    return $earmarkTotal;
}

function getObligationToDate($obj_id,$saa_id,$mysqli){
    $query2 = "SELECT sum(trans_amount) from tbl_transactions where trans_obj_id = $obj_id and trans_saa_id = $saa_id and trans_type = 'OB' and deleted = 0";
    $stmt2 = $mysqli->prepare($query2);
    $stmt2->execute();
  
    $stmt2->bind_result($earmarkTotal);
	$stmt2->fetch();

    return $earmarkTotal;
}
function getSaaDesc($obj_id,$saa_id,$mysqli){
    $query2 = "SELECT saa_description from tbl_saa where saa_id = $saa_id";
    $stmt2 = $mysqli->prepare($query2);
    $stmt2->execute();
  
    $stmt2->bind_result($saa_desc);
	$stmt2->fetch();

    return $saa_desc;
}

function getTargetDisbursement($obj_id,$saa_id,$mysqli){
    $query2 = "SELECT sum(trans_amount) from tbl_transactions where trans_obj_id = $obj_id and trans_saa_id = $saa_id and deleted is false and trans_type = 'LUM'";
    $stmt2 = $mysqli->prepare($query2);
    $stmt2->execute();
  
    $stmt2->bind_result($target_disbursement);
	$stmt2->fetch();

    return $target_disbursement;
}
function getActualDisbursement($obj_id,$saa_id,$mysqli){
    $query2 = "SELECT sum(exact_amount) from tbl_transactions where trans_obj_id = $obj_id and trans_saa_id = $saa_id and deleted is false and trans_type = 'LUM'";
    $stmt2 = $mysqli->prepare($query2);
    $stmt2->execute();
  
    $stmt2->bind_result($exact_disbursement);
	$stmt2->fetch();

    return $exact_disbursement;
}
function getModificationAdd($obj_id,$saa_id,$mysqli){
    $query = "SELECT realignment_amount FROM realignment_transactions WHERE to_saa_id = $saa_id and to_obj_id = $obj_id";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($modifyadd);
	$stmt->fetch();

    return $modifyadd;

}
function getModificationSub($obj_id,$saa_id,$mysqli){
    $query = "SELECT realignment_amount FROM realignment_transactions WHERE from_saa_id = $saa_id and from_obj_id = $obj_id";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($modifysub);
	$stmt->fetch();

    return $modifysub;

}
function getFullname($uid,$mysqli){
    $query = "SELECT concat(firstname, ' ' , lastName) as fullname from users where uid = $uid";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($fullname);
	$stmt->fetch();

    return $fullname;

}
function getSaaDesc_final($saa_id,$mysqli){
    $query2 = "SELECT saa_description from tbl_saa where saa_id = $saa_id";
    $stmt2 = $mysqli->prepare($query2);
    $stmt2->execute();
  
    $stmt2->bind_result($saa_desc);
	$stmt2->fetch();

    return $saa_desc;
}
function getObjDes_final($obj_id,$mysqli){
    $query = "SELECT obj_description from object where obj_id = $obj_id";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($objdes);
	$stmt->fetch();

    return $objdes;

}
function getAllotment_unit($unit_id,$mysqli){
    $query = "SELECT sum(ta.amount_received) 
    FROM `tbl_allotment` ta
    join tbl_saa ts on ts.saa_id = ta.saa_id
    join unit u on ts.unit = u.unit_id
    where u.unit_id = $unit_id";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($total_unit);
	$stmt->fetch();

    return $total_unit;

}
function getDisburse_unit($unit_id,$mysqli){
    $query = "select sum(tt.exact_amount)
    from tbl_transactions tt
    join tbl_saa ts on ts.saa_id = tt.trans_saa_id
    join unit u on ts.unit = u.unit_id
    where u.unit_id = $unit_id and deleted is false";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($totaldisbursed_unit);
	$stmt->fetch();

    return $totaldisbursed_unit;

}

?>