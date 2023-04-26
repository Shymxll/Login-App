<?php

function cleanNote($note){
    $smileTexts = array(":)", ":(", ":o", ":D", ":/");
    $smileImages = array("<img src='imgs/smiling-face.png' width='20px' height='20px'>"
     ,"<img src='imgs/sad.png' width='20px' height='20px'>"
     , "<img src='imgs/surprised.png' width='20px' height='20px'>"
     , "<img src='imgs/smile.png' width='20px' height='20px'>"
     , "<img src='imgs/unknow.png' width='20px' height='20px'>");

    $note = str_replace($smileTexts, $smileImages, $note);
    return $note;
}

//update note function
 function updateNote($id, $noteUptText, $connection){
     

    //update query note table query, use id parameter, use noteText parameter
    $query = "UPDATE notes SET note = '$noteUptText' WHERE id = '$id'";
    //execute query
    $result = mysqli_query($connection,$query);
    //fetch result
    if($result) {
        echo '<div class="alert alert-success" role="alert">
            Success
        </div>
        ';
    }
    
   header("Refresh:1; url=note.php"); 
}

//note delete function
function deleteNote($id, $connection)
{
    $rowId = $_POST["rowId"];
    //get user id from note table query, use id parameter
    $query = "SELECT user_id FROM notes WHERE id = '$rowId'";
    //execute query
    $result = mysqli_query($connection, $query);
    //fetch result
    $row = mysqli_fetch_assoc($result);
    $userId = $row['user_id'];
    if($userId == base64_decode($_SESSION['id'])) {

        //delete query note table query, use id
        $query = "DELETE FROM notes WHERE id = '$rowId'";
        //execute query
        $result = mysqli_query($connection, $query);

        //fetch result
        if($result) {
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
    } else {
        echo '<div class="alert alert-danger" role="alert">
                          You can delete only your note
                          </div>';
    }

    header("Refresh:1; url=note.php");
}
//create note function
function createNote($userId,$noteText,$date,$connection)
{
    
      //insert query note table query, use user_id parameter, use noteText parameter
      $query = "INSERT INTO notes (user_id,note,created_date) VALUES ('$userId','$noteText','$date')";
      //execute query
      
      $result = mysqli_query($connection,$query);
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
        header("Refresh:1; url=note.php");
  }

?>