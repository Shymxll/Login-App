<?php
$host = "localhost";
$username = "root";
$password = "";
$vt = "tasks";

$connection = new mysqli($host,$username,$password,$vt);

if($connection){
    echo "Connected";
}
?>