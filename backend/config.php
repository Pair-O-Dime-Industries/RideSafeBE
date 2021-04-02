
<?php
define("DS", DIRECTORY_SEPARATOR);

defined('SITE_ROOT') ? null : define('SITE_ROOT', realpath(dirname(__FILE__)));

    $servername='localhost';
    $username='root';
    $password='';
    $dbname = 'micahb_ridesafe';
    $conn=mysqli_connect($servername,$username,$password,$dbname);
      if(!$conn){
          die('Could not Connect MySql Server:' .mysql_error());
        }
?>