<?php
session_start();
include_once './config.php';
include_once './functions.php';


    
    if(isset($_POST['email'])){
    $email = test_input($_POST['email']);
    $pass = test_input($_POST['password']);
     $result = mysqli_query($conn,"SELECT * from rider where Email='$email' and Password='$pass'");

    if ($row = mysqli_fetch_array($result)) {
        $_SESSION['RiderID'] = $row['RiderID'];
        echo 1;
    } else {
        echo 0;
    }
    }
   $data = json_decode(file_get_contents("php://input"));


  
    if(isset($data->check)){
        checklogin();

    }
        
    
//    if(isset($data->logout)){
//      unset($_SESSION['RiderID']);
//     echo true;
//    }
   


//     exit();
//    mysqli_close($conn);


?>
