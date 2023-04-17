<?php

session_start();

//get id parameter
$userId = base64_decode($_SESSION['id']);

if(isset($_POST["noteAdd"])){
  
  $noteText = $_POST["noteText"];
  

  if($_POST["noteText"] != ""){
      include_once("connection.php");
      //insert query note table query, use user_id parameter, use noteText parameter
      $query = "INSERT INTO notes (user_id,note) VALUES ('$userId','$noteText')";
      //execute query
      $result = mysqli_query($connection,$query);
      //fetch result
      if ($result) {
        echo '<div class="alert alert-success" role="alert">
        Success
       </div>
       ';
       
      } else {
          
      }
  }
  else{
    
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
        <div class="mb-3">   
                        
            <div class="mb-3">
              <form method = "POST" action="">
            <label for="exampleFormControlTextarea1" name="note" class="form-label">Example textarea</label>
            <input type="text" class="form-control" name="noteText" id="exampleFormControlTextarea1" rows="3"></i>
           </div>
            <button type="submit" name="noteAdd" class="btn btn-primary">Submit</button>
            </div>
            </form>
            </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>

