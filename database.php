<?php
    $servername='localhost';
    $username='root';
    $password="";
    $conn = mysqli_connect($servername, $username, $password);
    mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS tictactoe");
    $database="tictactoe";
    $conn=mysqli_connect($servername,$username,$password,$database);
    if($conn)
    {
        //echo "Database success ";
    }
    else
    {
        echo "Database unsuccessful ";
    }
?>
