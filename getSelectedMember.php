<?php 
session_start();
include('connect.php');
	

$memberId = $_POST['member_id'];

$sql = "SELECT id, hhid,
			CONCAT(ifnull(last_name,'') ,', ', ifnull(first_name,''), ' ', ifnull(middle_name,''), ' ' ,ifnull(ext,'')) AS full_name,
			CONCAT(ifnull(street,''), ' ', ifnull(purok_sitio,''), ' ', ifnull(barangay,''), ' ', ifnull(city_muni,''), ' ', ifnull(province,'')) AS address
			FROM uct_list_110 WHERE id = $memberId";
//$query = $db->query($sql);
//$result = $query->fetch_assoc();
$query = mysqli_query($db,$sql);
$result = mysqli_fetch_array($query,MYSQLI_ASSOC);

//
$hhid = $result['hhid'];
//$sql2="select hhid from encoded where hhid = '$hhid'";
//$query2 = mysqli_query($db,$sql2);
//if(mysqli_num_rows($query2)==0){
	//not yet encoded continue process
	echo $db->error;
	$db->close();
	echo safe_json_encode($result);
//}else{
	//aready encoded stop update
	//$db->close();
	//$result['hhid'] = 'encoded';
	//echo safe_json_encode($result);
//}

function safe_json_encode($output){
	$uctList = json_encode($output);
	switch (json_last_error()) {
		case JSON_ERROR_NONE:
			return $uctList;
		case JSON_ERROR_DEPTH:
			return 'Maximum stack depth exceeded'; // or trigger_error() or throw new Exception()
		case JSON_ERROR_STATE_MISMATCH:
			return 'Underflow or the modes mismatch'; // or trigger_error() or throw new Exception()
		case JSON_ERROR_CTRL_CHAR:
			return 'Unexpected control character found';
		case JSON_ERROR_SYNTAX:
			return 'Syntax error, malformed JSON'; // or trigger_error() or throw new Exception()
		case JSON_ERROR_UTF8:
			$clean = utf8ize($output);
			return safe_json_encode($clean, 0, 512);
		default:
			return 'Unknown error'; // or trigger_error() or throw new Exception()

	}
}

function utf8ize($mixed) {
	if (is_array($mixed)) {
		foreach ($mixed as $key => $output) {
			$mixed[$key] = utf8ize($output);
		}
	} else if (is_string ($mixed)) {
		return utf8_encode($mixed);
	}
	return $mixed;
}

?>