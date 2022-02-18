<?php
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true)
    {
        header("location: login.php");
        exit;
    }
?>

<?php
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        include 'database1.php';
        $username=$_SESSION['username'];
        //$username=$_POST['username'];
        $oldpass=$_POST['oldpass'];
        $newpass=$_POST['newpass'];
        $sql="Select * FROM `users` WHERE username= '$username'";
        //echo "yeaaaaahhhhhh<br>";
        $result=mysqli_query($conn,$sql);  
        //$numexist=mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        //echo $numexist;       
        //if($numexist==1)
        if($row['password']==$oldpass)
        {
            echo "<script>alert('Your PASSWORD is changed')</script>";
            //echo "Your PASSWORD is changed";
            $sql2="UPDATE `users` SET `password` = '$newpass' WHERE `users`.`username` = '$username'";
            $result=mysqli_query($conn,$sql2);
        }
        else 
        {
            echo "<script>alert('INCORRECT PASSWORD')</script>";
            //echo "INCORRECT PASSWORD";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <button class="btn btn-primary" onclick="window.location.href='welcome.php'">Welcome Page</button>
    <br><br>
    <div id="contact">
        <div class="box">
            <form action="/project1/password1.php" method="post">          

                <div class="mb-3">
                    <label for="oldpass" class="form-label">Old password</label>
                    <input type="password" class="form-control" id="oldpass" name="oldpass">
                </div>

                <div class="mb-3">
                    <label for="newpass" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="newpass" name="newpass">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</html>