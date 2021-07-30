<?php
include("config/config.php");
//address of the server where db is installed
$servername = "localhost";

//username to connect to the db
//the default value is root
$username = "root";

//password to connect to the db
//this is the value you would have specified during installation of WAMP stack
$password = "";

//name of the db under which the table is created
$dbName = "uct_fus";

//establishing the connection to the db.
$conn = new mysqli($servername, $username, $password, $dbName);

//checking if there were any error during the last connection attempt
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//the SQL query to be executed
$query = "SELECT u.unit_id , u.unit_name,ts.saa_id
                                         from unit u
                                         join tbl_saa ts on ts.unit = u.unit_id
                                         GROUP BY u.unit_id , u.unit_name";
$result = $conn->query($query);										 
										 
					
					  

//storing the result of the executed query
//$result = $conn->query($query);

//initialize the array to store the processed data
$jsonArray = array();

//check if there is any data returned by the SQL Query
if ($result->num_rows > 0) {
  //Converting the results into an associative array
  while($row = $result->fetch_assoc()) {
	  
	  
					$saa_id = $row['saa_id'];
                      $unit_id = $row['unit_id'];
                      $unit_name = $row["unit_name"];
                      $total_allotment_unit = getAllotment_unit($unit_id,$mysqli); //raw total allotment

                      $total_used_allotment = getDisburse_unit($unit_id,$mysqli); //nagamit na allotment

                      $total_realignment_amount = meow($saa_id,$mysqli);   //realignment made

                      $adjusted_allotment = $total_allotment_unit - $total_realignment_amount; //adjusted - final data
                     $remaining_allotment = $adjusted_allotment - $total_used_allotment;//natitita  
                      $utilization = ($total_used_allotment / $adjusted_allotment) * 100;
					  
					  
					  
					  
    $jsonArrayItem = array();
    $jsonArrayItem['label'] = $unit_name;
    $jsonArrayItem['value'] = $remaining_allotment;
	//$jsonArrayItem['value'] = $utilization . "%";
    //append the above created object into the main array.
    array_push($jsonArray, $jsonArrayItem);
  }
}

//Closing the connection to DB
$conn->close();

//set the response content type as JSON
header('Content-type: application/json');
//output the return value of json encode using the echo function. 
echo json_encode($jsonArray);
?>
