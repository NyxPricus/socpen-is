<?php 
session_start();
include('connect.php');

$province=$_SESSION['province'];
$muni=$_SESSION['muni'];
$brgy=$_SESSION['brgy'];
$lahat=$_SESSION['all'];






$output = array('data' => array());


	
			
$sql = "SELECT id, hhid,
			CONCAT(ifnull(last_name,'') ,', ', ifnull(first_name,''), ' ', ifnull(middle_name,''), ' ' ,ifnull(ext,'')) AS full_name,
			CONCAT(ifnull(street,''), ' ', ifnull(purok_sitio,''), ' ', ifnull(barangay,''), ' ', ifnull(city_muni,''), ' ', ifnull(province,'')) AS address
			FROM uct_list_110";
$query = mysqli_query($db,$sql);

$x = 1;
while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
	$actionButton = '
	<button type="button" class = "btn btn-success" data-toggle="modal" data-target="#editMemberModal" onclick="editMember('.$row['id'].')"> <span class="glyphicon glyphicon-edit"></span> <i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View</i></button> &nbsp;
	
	<button type="button" class = "btn btn-info" data-toggle="modal" data-target="#viewHistory" onclick="viewHistory('.$row['id'].')"> <span class="glyphicon glyphicon-edit"></span> <i class="fa fa-history" aria-hidden="true"></i>&nbsp;View History</i></button>&nbsp;
	
	

		';
	$hhid_roster_link = "<a title = 'Click to view complete information' href='roster_data?txthhid=". $row['hhid']."' target = '_blank'>" . $row['hhid'] . "</a>";
	$lasthhid = substr($row['hhid'],-8);
	$output['data'][] = array(
		//$x,
		$hhid_roster_link,
		$lasthhid,
		$row['full_name'],
		$row['address'],
		//$active,
		$actionButton
	);

	$x++;
}

// database connection close
$db->close();
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
echo safe_json_encode($output);
?>