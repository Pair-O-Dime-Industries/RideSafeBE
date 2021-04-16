<?php
include_once './config.php';
include_once './functions.php';
$profileRPath = SITE_ROOT . DS . '..' . DS . 'images/riders/profileImg';
$idRPath = SITE_ROOT . DS . '..' . DS . 'images/riders/idImg';
$DriverImgPath = SITE_ROOT . DS . '..' . DS . 'images/driver/driverImg';
$carImgPath = SITE_ROOT . DS . '..' . DS . 'images/driver/carImg';
  

    $fname = test_input($_POST['fname']);
    $lname =test_input($_POST['lname']);
    $email =test_input($_POST['email']);
    $username =test_input($_POST['username']);
    $password =test_input($_POST['password']);
    $mobile = test_input($_POST['phone']);
    $image = test_input($_FILES ['profileImg']['name']);
    $card = test_input($_FILES['IDcard']['name']);
    
    
    if(riderExists($username,$mobile,$email) == false){
        //CODE TO ENSURE NO TWO IMAGES HAVE THE SAME NAME
        $image_ext =pathinfo($image, PATHINFO_EXTENSION);
        $card_ext =pathinfo($card, PATHINFO_EXTENSION);
        $image_base = pathinfo($image, PATHINFO_FILENAME);
        $card_base = pathinfo($card, PATHINFO_FILENAME);
        $card = $card_base.'_'.microtime(true).'.'.$card_ext;
        $image = $image_base . '_' . microtime(true) . '.' . $image_ext;

        
        $sql = "INSERT INTO rider (FName,LName,Email,UserName,Password,PhNum, ProfileImg,IDcard)
        VALUES ('$fname','$lname','$email','$username','$password','$mobile', '$image', '$card')";
        if (mysqli_query($conn, $sql)) {
            echo 1; // success
            move_uploaded_file($_FILES['profileImg']['tmp_name'],$profileRPath.'/'.$image);
            move_uploaded_file($_FILES['IDcard']['tmp_name'],$idRPath.'/'.$card);
        } else {
            echo "Error: " . $sql . ":-" . mysqli_error($conn);
        }
    }else{
        echo 4; //
    }
    exit;


  


    mysqli_close($conn);
    
    ?>