<?php
include_once './config.php';
include_once './functions.php';
$profileRPath = SITE_ROOT . DS . '..' . DS . 'images/riders/profileImg';
$idRPath = SITE_ROOT . DS . '..' . DS . 'images/riders/idImg';
$DriverImgPath = SITE_ROOT . DS . '..' . DS . 'images/driver/driverImg';
$carImgPath = SITE_ROOT . DS . '..' . DS . 'images/driver/carImg';

    $type = 1;
if ($type == 1) {
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
}
else if(isset($_POST['driver'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['psswrd'];
    $mobile = $_POST['phone'];
    $image = $_FILES ['profileImg']['name'];
    $license = $_FILES ['License']['name'];
    $LicensePlate = $_POST ['LicensePlate'];
    $make = $_POST['Make'];
    $model = $_POST['Model'];
    $carImg = $_FILES['CarPhoto']['name'];
    $certCpy = $_FILES['CcpyScn']['name'];
    $reg = $_POST['Regno'];
    $password = sha1($password);
    if(driverExists($email,$mobile,$LicensePlate) == false && carExists($LicensePlate) == false){
        //CODE TO ENSURE NO TWO IMAGES HAVE THE SAME NAME
        $image_ext =pathinfo($image, PATHINFO_EXTENSION);
        $License_ext =pathinfo($license, PATHINFO_EXTENSION);
        $car_ext =pathinfo($carImg, PATHINFO_EXTENSION);
        $cert_ext =pathinfo($certCpy, PATHINFO_EXTENSION);

        $image_base = pathinfo($image, PATHINFO_FILENAME);
        $License_base = pathinfo($license, PATHINFO_FILENAME);
        $car_base = pathinfo($carImg, PATHINFO_FILENAME);
        $cert_base = pathinfo($certCpy, PATHINFO_FILENAME);

        $carImg = $car_base.'_'.microtime(true).'.'.$car_ext;
        $image = $image_base . '_' . microtime(true) . '.' . $image_ext;
        $license = $License_base.'_'.microtime(true).'.'.$License_ext;
        $certCpy = $cert_base . '_' . microtime(true) . '.' . $cert_ext;

       
        $sql = "INSERT INTO driver (FName,LName,Email,Password,PhNum,ProfileImg,LicenseScn)
        VALUES ('$fname','$lname','$email','$password','$mobile', '$image','$license')";
        
        if (mysqli_query($conn, $sql)) {
            $result = mysqli_query($conn, "SELECT DriverID from driver where Email = '$email'");
            $owner = mysqli_fetch_array($result);
            $owner = $owner['DriverID'];
            $sql2 = "INSERT INTO car (LicensePlate,Make,Model,CarPhoto,CertifiedCpyScn,RegNo,Owner) VALUES ('$LicensePlate','$make','$model','$carImg','$certCpy','$reg','$owner')";
            if (mysqli_query($conn, $sql2)){
            $msg = "New record has been added successfully !";
            move_uploaded_file($_FILES['profileImg']['tmp_name'],$DriverImgPath.'/'.$image);
            move_uploaded_file($_FILES['License']['tmp_name'],$DriverImgPath.'/'.$license);
            move_uploaded_file($_FILES['CarPhoto']['tmp_name'],$carImgPath.'/'.$carImg);
            move_uploaded_file($_FILES['CcpyScn']['tmp_name'],$carImgPath.'/'.$certCpy);
            }
            
        } else {
            $msg = "Error: " . $sql . ":-" . mysqli_error($conn);
        }
    }else{
        if(carExists($LicensePlate) == true){
            $msg = "License Plate is already registered";
        }
        else if(driverExists($email,$mobile,$LicensePlate) == true){
            $msg = "Driver is already present in database";

        }
        
    }
}   

    mysqli_close($conn);
    
    ?>