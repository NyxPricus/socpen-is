<?php
session_start();
require_once 'config/config.php';
require_once './include/auth_validate.php';
if(isset($_POST['myButt_edit'])){
    $y2018 = 0;
    $y2019 = 0;
    $y2020 = 0;
    $id = $_POST['txt_id'];
    if(isset($_POST['y2018_c']))
    {
        $y2018 = 1;
    }
    if(isset($_POST['y2019_c']))
    {
        $y2019 = 1;
    }
    if(isset($_POST['y2020_c']))
    {
        $y2020 = 1;
    }  

        if($y2018==0 && $y2019==0 && $y2020==0)
        {
            $_SESSION['register_failure']="CANNOT UPDATE IF YEARS ARE BLANK";
            header("location:accomplishment_tagging");
        }else
        {
                      

            $sql = "UPDATE uct_list_of_unpaid SET y2018 = ? , y2019 = ? , y2020 = ? where id = ?";
            if($stmt = $mysqli->prepare($sql)){
            
            $stmt->bind_param("iiii", $y2018,$y2019,$y2020,$id);
            if($stmt->execute()){
            
                $_SESSION["register_okay"] = "DATA UPDATED!";
            echo $y2018 . "<br>" . $y2019. "<br>" . $y2020;
              header("location:accomplishment_tagging.php");
            } else{
                $_SESSION["register_failure"] = "Something went wrong. Please try again later.";
                echo $mysqli->error;
            //	header("location:paid_tagging.php");
                exit;
            }
            // Close statement
            $stmt->close();
            }    
            // Close connection
            $mysqli->close();










        }

}else
{
    echo "adas";
}
?>