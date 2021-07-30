<?php 
include 'includes/session.php';
include 'helper/helper.php';

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $hhid = ($_POST['searchKey']);
    $hhid = preg_replace('/\s+/', '', $hhid);
    $nagEncode = '';

    if(strlen($hhid) != 8){
        $_SESSION['searchError'] = 'Invalid seach key!';
        header('location:search2.php');
        exit();
    }

    $sqlPantawid = "select is_pantawid, first_name, middle_name, last_name, name_ext from uctlistahanan where short_id = '$hhid' and is_pantawid = 1";
    $queryPantawid = $conn->query($sqlPantawid);
    $result = $queryPantawid->fetch_assoc();
    if($queryPantawid->num_rows > 0){
        $_SESSION['searchError'] = "4Ps. \n Beneficiary Name(first,middle,last,ext): " . $result['first_name'].' '.$result['middle_name'].' '.$result['last_name'].' '.$result['name_ext'];
        header('location:search2.php');
        //$pantawid = true;
    }else{

        $bene = beneAlreadyEncoded($hhid,$conn,true);
        if($bene['updated_by']){
            $encoder = getUpate($conn,$bene['updated_by']);
            $_SESSION['searchError'] = 'Beneficiary already Updated by '.$encoder['firstname'].'  '.$encoder['lastname'] .  "\n\n\n Beneficiary Name(first,middle,last,ext): "  .$bene['last_name'].' '.$bene['first_name'].' '.$bene['middle_name'].' '.$bene['name_ext'] ;
            header('location:search2.php');
        }else{
            if($bene['bilang'] > 0){
                //lets check first if bene already encoded
                $encoder = getEncoder($conn,$bene['user_id']);
                //$_SESSION['searchError'] = 'Beneficiary already encoded by '.$encoder['firstname'].'  '.$encoder['lastname'] .  "\n\n\n Beneficiary Name(first,middle,last,ext): "  .$bene['last_name'].' '.$bene['first_name'].' '.$bene['middle_name'].' '.$bene['name_ext'] ;
                $nagEncode = $encoder['firstname'].'  '.$encoder['lastname'];
                //header('location:search2.php');
            }
    
    
            $sql = "select short_id from uctlistahanan where short_id = '$hhid'";
            $query = $conn->query($sql);
    
            if($query->num_rows < 1){
                $_SESSION['searchError'] = 'No data found!';
                header('location:search2.php');
            }else{
                if($nagEncode){
                    header('location:edit_bene2.php?hhid=' . $hhid . '&encoder=' .$nagEncode);
                }else{
                    header('location:encode2.php?hhid=' . $hhid . '&encoder=' .$nagEncode);
                }
            }
        }
    }
    
    
}