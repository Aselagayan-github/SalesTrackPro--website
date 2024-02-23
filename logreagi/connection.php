<?php
error_reporting(0);
$serverName = "localhost";
$userName ="root";
$password = "";
$dbName = "SalesTrackPro";

$conn = mysqli_connect($serverName,$userName,$password,$dbName);

if(mysqli_connect_errno()){
    echo " failed to connect ";
    exit();
}
//echo "Connection sucessful";

?>