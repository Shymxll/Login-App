<?php
@include("connection.php");
session_start();
if (isset($_POST["index"])) {

  $name = $_POST["name"];
  $password = $_POST["password"];
  if ($name == "" || $password == "") {
    echo '<div class="alert alert-warning" role="alert">
      Please fill in the fields
    </div>';
    header("Refresh:2; url=index.php");

  }
  $findQuery = "SELECT * FROM user WHERE name = '$name' AND password = '$password' ";
  $result = mysqli_query($connection, $findQuery);

  if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);

    if ($row['name'] === $name && $row['password'] === $password) {

      $_SESSION['username'] = $row['name'];
      $_SESSION['id'] = base64_encode($row['id']);
      echo $_SESSION['username'];

      echo '<div class="alert alert-success" role="alert">
       Success
      </div>
      ';

      #get id parameter

      $path = "note.php";
      #redirect to node.php
      header("Location: $path");
    }

  } else {
    echo '<div class="alert alert-warning" role="alert">
      Unsuccess
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>

  <div class="wrapper fadeInDown">
    <div id="formContent">
      <!-- Tabs Titles -->

      <!-- Icon -->


      <!-- Login Form -->
      <div class="container col-4 align-center">
        <div class="card col">
          <div class="card-body">
            <form method="POST" action="">
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="name" class="form-control" name="name" id="name" aria-describedby="nameHelp">

              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
              </div>

              <button type="submit" name="index" class="btn btn-primary">Log in</button>
            </form>
            <a href="register.php"> <button class="btn btn-success">Register</button></a>
          </div>
        </div>
      </div>


    </div>
  </div>




  <style>
  </style>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
</body>

</html>