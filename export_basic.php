<?php
require 'config/exportconnection.php';

function cleanData(&$str)
{
	$str = preg_replace("/\t/", "\\t", $str);
	$str = preg_replace("/\r?\n/", "\\n", $str);
	if(strstr($str, '"')) $str = '"' .str_replace('"', '""', $str). '"';
}



$filename = "change_grantee_" .date('Ymd'). ".xls";

header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");

$flag = false;

$sql1 = "select * from uct_list_edit_history where type_of_update = 'Change Basic information'";

$resultd = mysqli_query($db, $sql1);
 
while($row = mysqli_fetch_array($resultd,MYSQLI_ASSOC)){
	
	if(!$flag) {
		
		echo implode("\t", array_keys($row)). "\r\n";
		$flag = true;
		
	}
	array_walk($row, __NAMESPACE__ . '\cleanData');
	echo implode("\t", array_values($row)). "\r\n";
}
$db->close();
?>