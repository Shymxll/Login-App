<?php

session_start();
include_once("connection.php");
include_once("NoteFunction.php");
//get id parameter and name parameter
$userId = base64_decode($_SESSION['id']);
$name = $_SESSION['username'];

if(isset($_POST["noteAdd"])) {

    $noteText = $_POST["noteText"];
    $date = date("Y-m-d H:i:s");

    if($_POST["noteText"] != "") {
        createNote($userId, $noteText, $date, $connection);

    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Note</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>
        <div class="mb-3">   
                        
            <div class="mb-3">
              <form method = "POST" action="note.php">
            <label for="exampleFormControlTextarea1" name="note" class="form-label">Example textarea</label>
            <input type="text" id="noteText" class="form-control" name="noteText" id="exampleFormControlTextarea1" value="" rows="3" ></input>
            <?php 
              
             
            ?>
           </div>
            <button type="submit" name="noteAdd" class="btn btn-primary">Submit</button>
            
            </form>
            </div>
            <div class="container-sm ">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Note</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  
                    <?php
                    
                     // join user table and note table query, use user_id parameter and note parameter
                      $query = "SELECT * FROM user JOIN notes ON notes.user_id =  user.id";
                      //execute query
                      $result = mysqli_query($connection,$query);
                      //fetch result
                      if($result){
                          
                        while($row = mysqli_fetch_assoc($result)){
                            $rowId = $row['id'];
                            $userId = $row['user_id'];
                            $createdDate = $row['created_date'];
                            $name = $row['name']; 
                            $note = cleanNote($row['note']);
                              echo "<tr>";
                              echo "<td>".$name."</td>";
                              echo "<td>".$note."</td>";
                              echo "<td>".$createdDate."</td>";
                              //delete form and button for delete note
                              if($userId == base64_decode($_SESSION['id'])){
                                echo "<td><form method = 'POST' action=''>
                                <input type='hidden' name='rowId' value='".$rowId."'>
                                <button  type='button' class='btn btn-sm btn-primary' data-bs-toggle='modal' data-bs-target='#exampleModal'>
                                Update
                                </button>
                                <button type='submit' name='deleteNote' class='btn btn-danger btn-sm'>
                                Delete
                                </button>
                                </form></td>";
                               }

                              echo "</tr>";
                              
                            
                          }
                        }

                        if(isset($_POST["deleteNote"])){
                          //get note id from note table query, use id parameter
                          deleteNote($rowId,$connection);
                        }
                      

                   ?>
                  
                </tbody>
              </table>
              <!--Modal for Update Button-->
              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form method = "POST" action="note.php">
                          <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                            <input type="text" id="noteText" class="form-control" name="noteUptText" id="exampleFormControlTextarea1" value="" rows="3" ></input>
                           
                           </div>
                            <button type="submit" name="noteUpdateModal" class="btn btn-primary">Submit</button>
                            <?php 
                              if(isset($_POST["noteUpdateModal"]))
                                  //get note id from note table query, use id parameter
                                  updateNote($rowId,$_POST["noteUptText"],$connection);
                            ?>
                            </form>
                      </div>
                    </div>
                  </div>
                </div>

            </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>

