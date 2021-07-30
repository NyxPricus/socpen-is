<!--?php $con = mysql_connect("localhost","root","QWdF94"); if (!$con) { die('Could not connect: ' . mysql_error()); } mysql_select_db("bfsdemo", $con); $result = mysql_query("SELECT name, val FROM web_marketing"); $rows = array(); while($r = mysql_fetch_array($result)) { $row[0] = $r[0]; $row[1] = $r[1]; array_push($rows,$row); } print json_encode($rows, JSON_NUMERIC_CHECK); mysql_close($con); ?-->
<?php
$con = mysql_connect("localhost","root","");
 
if (!$con) {
die('Could not connect: ' . mysql_error());
}
 
mysql_select_db("uct_dbms", $con);
 
$result = mysql_query("SELECT sum(case when sex_id = 1 then 1 else 0 end) as male,sum(case when sex_id = 2 then 1 else 0 end) as female
from uct_roster");
 
$rows = array();
while($r = mysql_fetch_array($result)) {
$row[0] = $r[0];
$row[1] = $r[1];
array_push($rows,$row);
}
 
print json_encode($rows, JSON_NUMERIC_CHECK);
 
mysql_close($con);
?>