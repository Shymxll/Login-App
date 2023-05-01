<?php

include("connection.php");
//function for clean note
function cleanNote($note)
{
  $smileTexts = array(":)", ":(", ":o", ":D", ":/");
  $smileImages = array(
    "<img src='imgs/smiling-face.png' width='20px' height='20px'>",
    "<img src='imgs/sad.png' width='20px' height='20px'>",
    "<img src='imgs/surprised.png' width='20px' height='20px'>",
    "<img src='imgs/smile.png' width='20px' height='20px'>",
    "<img src='imgs/unknow.png' width='20px' height='20px'>"
  );

  $note = str_replace($smileTexts, $smileImages, $note);
  return $note;
}




//note delete function
if (isset($_POST['deleteRowId'])) {

  $id = $_POST['deleteRowId'];
  //delete query note table query, use id 
  $query = "DELETE FROM notes WHERE id = '$id'";
  //execute query
  $result = mysqli_query($connection, $query);

  //fetch result
  if ($result) {
    echo '<div class="alert alert-success" role="alert">
      Success
     </div>
     ';
  } else {
    echo '<div class="alert alert-success" role="alert">
      Unsuccess
      </div>
     ';
  }
}
//note add function
if (isset($_POST['noteText'])) {

  $noteText = $_POST["noteText"];
  $userId = $_POST["userId"];
  $date = date("Y-m-d H:i:s");

  if ($noteText != "") {
    //insert query note table query, use user_id parameter, use noteText parameter
    $query = "INSERT INTO notes (user_id,note,created_date) VALUES ('$userId','$noteText','$date')";
    //execute query

    $result = mysqli_query($connection, $query);
    //fetch result
    if ($result) {
      echo '<div class="alert alert-success" role="alert">
        Success
      </div>
      ';
    } else {
      echo '<div class="alert alert-success" role="alert">
        Unsuccess
        </div>
      ';
    }
  }
}

//note update function
if (isset($_POST["id"]) && isset($_POST["noteUptText"])) {
  $id = $_POST["id"];
  $noteText = $_POST["noteUptText"];
  if ($noteText != "") {
    //update query note table query, use noteText parameter, use id parameter
    $query = "UPDATE notes SET note = '$noteText' WHERE id = '$id'";
    //execute query
    $result = mysqli_query($connection, $query);
    //fetch result
    if ($result) {
      echo true;
    } else {
      echo false;
    }
  } else {
    echo false;
  }
}
