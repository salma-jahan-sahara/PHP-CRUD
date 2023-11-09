<?php
    include 'connect.php';
    extract($_POST);

    if(isset($_POST['nameSend'])){
        $sql = "insert into crud (name) values ('$nameSend')";
        $result = mysqli_query($con, $sql);
        // echo json_encode(['data' => $nameSend, 'status' => 'success']);
        // return->json(['data' => $nameSend, 'status' => 'success']);
    }
?>