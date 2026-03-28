<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "task_management";

    $conn = mysqli_connect($server, $username, $password, $database);

    if($conn){
        // echo "database connect";
    }
    else{
        die("fail" . mysqli_connect_error());
    }
?>