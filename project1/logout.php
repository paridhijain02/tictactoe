<?php

    session_start();

    include 'database1.php';
    $username=$_SESSION['username'];
    $status='deactivate';
    $sql1="UPDATE `users` SET `s_out` = CURDATE() WHERE `users`.`username` = '$username'";
    $result1=mysqli_query($conn,$sql1);
    $sql2="UPDATE `users` SET `s_out` = CURTIME() WHERE `users`.`username` = '$username'";
    $result2=mysqli_query($conn,$sql2);
    $sql="UPDATE `users` SET `status` = '$status' WHERE `users`.`username` = '$username'";
    $result=mysqli_query($conn,$sql);

    session_unset();
    session_destroy();

    header("location: login.php");
    exit;
?>