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
        include 'database.php';
        $username=$_SESSION['username'];
        $newname=$_POST['fullname'];
        $sql="Select * FROM `users` WHERE username= '$username'";
        $result=mysqli_query($conn,$sql);  
        $row = mysqli_fetch_assoc($result);

        echo "<script>alert('Your NAME is changed')</script>";
        $sql2="UPDATE `users` SET `fullname` = '$newname' WHERE `users`.`username` = '$username'";
        $result=mysqli_query($conn,$sql2);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Name change</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <div class="wrapper">
        <div class="sidebar">
            <ul>
                <li>
                    <a href="welcome.php">
                        <span class="item">Game</span>
                    </a>
                </li>
                <li>
                    <a href="others.php" >
                        <span class="item">Users Details</span>
                    </a>
                </li>
                <li>
                    <a href="password.php" >
                        <span class="item">Change password</span>
                    </a>
                </li>
                <li>
                    <a href="fullname.php" class="active"> 
                        <span class="item">Change name</span>
                    </a>
                </li>
                <li>
                    <a href="contact.php">
                        <span class="item">Change contact number</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <span class="item">Logout</span>
                    </a>
                </li>               
            </ul>
        </div>
    </div>	
    <div id="contact">
        <div class="box">
            <form action="/tictactoe/fullname.php" method="post">          

                <div class="mb-3">
                    <label for="fullname" class="form-label">New name</label>
                    <input type="text" placeholder="Enter new name" class="form-control" id="fullname" name="fullname">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</html>