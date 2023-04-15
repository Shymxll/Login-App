<?php
 @include("connection.php");

 if(isset($_POST["register"])){
    $name=$_POST["name"];
    $password=$_POST["password"];
    $insert = "INSERT INTO user (name,password) VALUES ('$name','$password')";
    $addInsert = mysqli_query($connection,$insert);
    if($addInsert){
        echo '<div class="alert alert-success" role="alert">
       Success
      </div>';
    }else{
        echo '<div class="alert alert-warning" role="alert">
        A simple warning alert—check it out!
      </div>';
   }
 }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>
  
  <div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Login Form -->
    <div class="container col-4">
        <div class="card">
          <div class="card-body">
          <form action = "register.php" method="POST">
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp">
        
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
      </div>
     
      <button type="submit" name="register" class="btn btn-primary">Register</button>
    </form>
          </div>
        </div> 
        </div>

  
  </div>
</div>
  



    <style>
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>