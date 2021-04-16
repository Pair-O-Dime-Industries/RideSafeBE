<?php
session_start();

include_once './config.php';
include_once './functions.php';


    
    $driverID = $_SESSION['DriverID'];
    $response = mysqli_query($conn, "SELECT * from driver where DriverID ='$driverID'");
    if ($row = mysqli_fetch_array($response)) {
    $resp = $row['QrCode'];
    $result = array(
        'error' => false,
        'msg' => $resp,);
    

} else {
    $result = array(
       'error' => true,
        'msg' => 'Failed!',
    );
}
header('Content-type: application/json');
echo json_encode($result);

    
    
?>