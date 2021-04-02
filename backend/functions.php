<?php
include_once './config.php';
function riderExists($username, $PhNum, $Email){
    global $conn;
    $value = mysqli_query($conn,"SELECT UserName, PhNum, Email from rider");
    foreach ($value as $val) {
        if($username == $val['UserName'] || $PhNum == $val['PhNum'] || $Email == $val['Email']){
            return true;
        }
        else{
            return false;
        }
    }

}
function driverExists($Email, $PhNum){
    global $conn;
    $value = mysqli_query($conn, "SELECT Email, PhNum from driver");
foreach ($value as $val) {
    if ($Email == $val['Email'] || $PhNum == $val['PhNum']) {
        return true;
    } else {
        return false;
    }
}

}
function carExists($LicensePlate){
    global $conn;
    $value = mysqli_query($conn, "SELECT LicensePlate from car");
foreach ($value as $val) {
    if ($LicensePlate == $val['LicensePlate']) {
        return true;
    } else {
        return false;
    }
}

}
?>