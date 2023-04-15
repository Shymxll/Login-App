<?php
$host = "localhost";
$username = "root";
$password = "";
$vt = "tasks";

$connection = new mysqli($host,$username,$password,$vt);

if($connection){
    #log to console
    echo "Connection is successful";
}
?>

