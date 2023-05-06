<?php

session_start();

//get id parameter and name parameter
$userId = base64_decode($_SESSION['id']);
$name = $_SESSION['username'];
include_once("connection.php");
include("NoteFunction.php");


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Note</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>

<body>
    <div class="container-fluid" id="alertDiv"></div>
    <div class="container-sm" id="updateModal"></div>
    <div class="mb-3">
        <div class="mb-3">
            <form method="POST">
                <label for="exampleFormControlTextarea1 h1" name="note" class="form-label">
                    <h1>Note</h1>
                </label>
                <input type="text" id="noteText" class="form-control mx-1" name="noteText" id="noteText"
                    id="exampleFormControlTextarea1" value="" rows="3"></input>
        </div>
        <button type="button" name="noteAddBtn" id="noteAddBtn" value class="btn btn-primary">Submit</button>
        <?php ?>
        </form>
    </div>
    <div class="container-sm ">
        <table class="table table-success table-striped-columns">
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
                            $id = $row['id'];
                            $userId = $row['user_id'];
                            $createdDate = $row['created_date'];
                            $name = $row['name']; 
                            $note = cleanNote($row['note']);//clean note and replace characters to smile
                              echo "<tr id='row ".$id."'>";
                              echo "<td>".$name."</td>";
                              echo "<td>".$note."</td>";
                              echo "<td>".$createdDate."</td>";
                          
                              if($userId == base64_decode($_SESSION['id'])){
                                echo 
                                "<td>
                                <form method = 'POST' >
                                <input type='hidden' name='id' value='".$id."'>
                                <button type='button'name='updateButton' id='updateBtn' class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#exampleModal'>
                                  Update
                                </button>
                                <button type='button' name='deleteButton' id='".$id."' class='btn btn-danger btn-sm' >Delete</button>
                                </div>
                                </form>
                                </td>";                   
                              
                               }

                              echo "</tr>";
                              
                            
                          }
                          
                        }

                        
                      

                   ?>

            </tbody>
        </table>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Note</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">New Note:</label>
                                <input type="text" class="form-control" id="noteUptText">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="noteUptMdlBtn" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
            integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
            integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous">
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script>
        //add button click function 
        $(document).on("click", "button[name='noteAddBtn']", function() {
            var noteText = $("#noteText").val();
            var userId = <?php echo (int)base64_decode($_SESSION['id']); ?>;
            console.log(noteText, userId)
            $.ajax({
                url: "NoteFunction.php",
                type: "POST",
                data: {
                    noteText: noteText,
                    userId: userId,

                },
                success: function(data) {
                    $("#alertDiv").html(data).fadeIn().delay(500).fadeOut().delay(500);
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                },
                done: function() {

                }

            });
        });
        //delete button click function
        $(document).on("click", "button[name='deleteButton']", function() {
            var id = $(this).closest('tr').attr('id').split(" ")[1];
            
            $.ajax({
                url: "NoteFunction.php",
                type: "POST",
                data: {
                    deleteRowId: id,
                },
                success: function(data) {

$(this).closest('tr').remove();                    //set alert message to alertDiv
                    $("#alertDiv").html(data).fadeIn().delay(500).fadeOut();

                },
                done: function(data) {
                    consele.log(data);
                }


            });


        });

        //update button click function
        $(document).on("click", "button[id='updateBtn']", function() {
            console.log("update button clicked");
            var id = $(this).closest('tr').attr('id').split(" ")[1];
            console.log(id);
            //when noteUptMdlBtn button clicked
            $("#noteUptMdlBtn").click(function() {
                var noteUptText = $("#noteUptText").val();

                $.ajax({
                    url: "NoteFunction.php",
                    type: "POST",
                    data: {
                        noteUptText: noteUptText,
                        id: id,
                    },
                    success: function(data) {
                        $("#exampleModal").modal('hide');
                        if (data == 1) {
                            //set alert message to alertDiv
                            $("#alertDiv").html(
                                "<div class='alert alert-success' role='alert'>Success</div>"
                                ).fadeIn().delay(500).fadeOut();
                            //reload page
                            setTimeout(function() {
                                location.reload();
                            }, 1000);

                        } else {
                            //set alert message to alertDiv
                            $("#alertDiv").html(
                                "<div class='alert alert-danger' role='alert'>Unsuccess</div>"
                                ).fadeIn().delay(500).fadeOut();
                        }


                    },
                    done: function(data) {
                        consele.log(data);
                    }


                });
            });




        });
        </script>


</body>

</html>