  <?php
    include_once './config.php';
    include_once './functions.php';

    $DriverImgPath = SITE_ROOT . DS . '..' . DS . 'images/driver/driverImg';
    $carImgPath = SITE_ROOT . DS . '..' . DS . 'images/driver/carImg';

    $fname =  test_input($_POST['fname']);
    $lname = test_input($_POST['lname']);
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);
    $mobile = test_input($_POST['phone']);
    $image = test_input($_FILES ['profileImg']['name']);
    $license = test_input($_FILES ['License']['name']);
    $LicensePlate = test_input($_POST ['LicensePlate']);
    $make = test_input($_POST['Make']);
    $model = test_input($_POST['Model']);
    $carImg = test_input($_FILES['CarPhoto']['name']);
    $certCpy = test_input($_FILES['CcpyScn']['name']);
    $reg = test_input ($_POST['Regno']);
    $QrCode = md5($email.$license);
    
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

       
        $sql = "INSERT INTO driver (FName,LName,Email,Password,PhNum,ProfileImg,LicenseScn,QrCode)
        VALUES ('$fname','$lname','$email','$password','$mobile', '$image','$license', '$QrCode')";
        
        if (mysqli_query($conn, $sql)) {
            $result = mysqli_query($conn, "SELECT DriverID from driver where Email = '$email'");
            $owner = mysqli_fetch_array($result);
            $owner = $owner['DriverID'];
            $sql2 = "INSERT INTO car (LicensePlate,Make,Model,CarPhoto,CertifiedCpyScn,RegNo,Owner) VALUES ('$LicensePlate','$make','$model','$carImg','$certCpy','$reg','$owner')";
            if (mysqli_query($conn, $sql2)){
            echo 1;
            move_uploaded_file($_FILES['profileImg']['tmp_name'],$DriverImgPath.'/'.$image);
            move_uploaded_file($_FILES['License']['tmp_name'],$DriverImgPath.'/'.$license);
            move_uploaded_file($_FILES['CarPhoto']['tmp_name'],$carImgPath.'/'.$carImg);
            move_uploaded_file($_FILES['CcpyScn']['tmp_name'],$carImgPath.'/'.$certCpy);
            }
            
        } else {
            echo "Error: " . $sql . ":-" . mysqli_error($conn);
        }
    }else{
        if(carExists($LicensePlate) == true){
            echo 2;
        }
        else if(driverExists($email,$mobile,$LicensePlate) == true){
            echo 4;

        }
        
    }
    mysqli_close($conn);

    ?>