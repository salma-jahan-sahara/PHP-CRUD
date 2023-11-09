<?php
    include 'connect.php';
    if(isset($_POST['displaySend'])){
        $table='<table class="table table-hover text-center">
                    <thead class="table table-primary">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Operations</th>
                        </tr>
                    </thead>';

                    $sql = "Select * from `crud`";
                    $result = mysqli_query($con, $sql);
                    while($row = mysqli_fetch_assoc($result)){
                        $id=$row['id'];
                        $name=$row['name'];
                        $table.='<tr>
                                    <td scope="row">'.$id.'</td>
                                    <td>'.$name.'</td>
                                    <td>
                                        <button class="btn btn-success" onclick="updateUser('.$id.')">Update</button>
                                        <button class="btn btn-danger" onclick="deleteUser('.$id.')">Delete</button>
                                    </td>
                                </tr>';
                    }
                    $table.='</table>';
                    echo $table;
    }
?>

