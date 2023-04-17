<?php
$host = "localhost";
$username = "root";
$password = "";
$vt = "tasks";

$connection = new mysqli($host,$username,$password,$vt);

if($connection){
    echo '<div class="alert alert-success" role="alert">
       Connection Success
      </div>
      ';}
else{
    echo '<div class="alert alert-danger" role="alert">
       Connection failed
      </div>
      ';
      
}
?>

