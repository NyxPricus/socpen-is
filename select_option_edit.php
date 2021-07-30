<?php

$connect = mysqli_connect("localhost", "root", "", "uct_fo3");
$output = '';

function loadProvince($mysqli){
	$connect = mysqli_connect("localhost", "root", "", "uct_fo3");
    $sql="SELECT fo3ProvinceId, description FROM fo3province";
    $province="";
	$result = mysqli_query($connect, $sql);
    $province .= '<option value="">~~SELECT ~~</option>';
     while($row = mysqli_fetch_array($result))  {
       $province .= "<option value=".$row['fo3ProvinceId'].">".$row['description']."</option>";
	   
   }
  
    //$province= mysqli_fetch_all($result,MYSQLI_ASSOC);

    return $province; 
}

if(isset($_POST["sub"])){
 if($_POST["sub"] == "inputProvince"){
  $query = "SELECT fo3CityMuniId,description FROM fo3citymuni WHERE fo3ProvinceId = '".$_POST["query"]."'";
  $result = mysqli_query($connect, $query);
  $output .= '<option value="">~~SELECT~~</option>';
  while($row = mysqli_fetch_array($result))  {
   $output .= '<option value="'.$row["fo3CityMuniId"].'">'.$row["description"].'</option>';
  }
 }
 if($_POST["sub"] == "inputCity") {
  $query = "SELECT fo3BarangayId,description FROM fo3barangay WHERE fo3citymuniId = '".$_POST["query"]."'";
  $result = mysqli_query($connect, $query);
  $output .= '<option value="">~~SELECT~~</option>';
  while($row = mysqli_fetch_array($result))  {
   $output .= '<option value="'.$row["fo3BarangayId"].'">'.$row["description"].'</option>';
  }
 }
 echo $output;
}

//address province change action
if(isset($_POST["provinceAction"])){
  $query = "SELECT fo3CityMuniId,description FROM fo3citymuni WHERE fo3ProvinceId = '".$_POST["query"]."'";
  $result = mysqli_query($connect, $query);
  $output .= '<option value="">~~SELECT~~</option>';
  while($row = mysqli_fetch_array($result))  {
   $output .= '<option value="'.$row["fo3CityMuniId"].'">'.$row["description"].'</option>';
  }
  echo $output;
}

if(isset($_POST["cityAction"])){
  $query = "SELECT fo3BarangayId,description FROM fo3barangay WHERE fo3citymuniId = '".$_POST["query"]."'";
  $result = mysqli_query($connect, $query);
  $output .= '<option value="">~~SELECT~~</option>';
  while($row = mysqli_fetch_array($result))  {
   $output .= '<option value="'.$row["fo3BarangayId"].'">'.$row["description"].'</option>';
  }
  echo $output;
}


//area province change action
if(isset($_POST["areaAction"])){
$query = "SELECT fo3CityMuniId,description FROM fo3citymuni WHERE fo3ProvinceId = '".$_POST["query"]."'";
  $result = mysqli_query($connect, $query);
  $output .= '<option value="">~~SELECT~~</option>';
  while($row = mysqli_fetch_array($result))  {
   $output .= '<option value="'.$row["fo3CityMuniId"].'">'.$row["description"].'</option>';
  }
  echo $output;
}
?>
