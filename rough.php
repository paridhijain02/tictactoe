<?php

    include 'database.php';
    //$sql1="INSERT INTO `score_table` (`sno`) VALUES ('3')";
    //$result1=mysqli_query($conn,$sql1);
/*
    $b=8;
    $sql1="INSERT INTO `score_table` (`sno`,`score`) VALUES ('$b','$b')";
    $result1=mysqli_query($conn,$sql1);
*/

    $sql1="INSERT INTO `hell` (`name`,`roll`) VALUES ('pari','41')";
    $result1=mysqli_query($conn,$sql1);
    
    
    //$sql2="SELECT * FROM `score_table` where sno=6";
    $sql2="SELECT * FROM `users` u INNER JOIN `score_table` s ON u.sno = s.sno";
    $result2=mysqli_query($conn,$sql2);
    //echo var_dump $result2;
    $row=mysqli_fetch_assoc($result2);
	echo var_dump($row);
?>