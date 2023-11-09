<?php
    include 'connect.php';
    if(isset($_POST['updateid'])){
        $user_id = $_POST['updateid'];

        $sql = "Select * from `crud` where id = $user_id";
        $result = mysqli_query($con, $sql);
        $response = array();
        while($row=mysqli_fetch_assoc($result)){
            $response = $row;
        }
        echo json_encode($response);
    }
    else{
        $response['status']=200;
        $response['message']="Data not found";
    }

    // Query to update data
    if(isset($_POST['hiddendata'])){
        $uniqueid = $_POST['hiddendata'];
        $name = $_POST['updatename'];

        $sql = "Update `crud` set name = '$name' where id=$uniqueid";
        $result = mysqli_query($con, $sql);
    }
?>