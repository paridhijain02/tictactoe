<?php
    include 'database.php';
    $sql="Select `status` from users";
    $result=mysqli_query($conn,$sql);
    $num=mysqli_num_rows($result);
    $count=0;
    for ($i=0; $i < $num; $i++) 
	{ 
		$row=mysqli_fetch_assoc($result);
        if($row['status']=="activate")
        {
            $count=$count+1;
	}
    }
    if($count>0)
    {
        header("location: welcome.php");
    }
?>

<?php
    $login=false;
    $showerror=false;
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {

        include 'database.php';
        $username=$_POST['username'];
        $password=$_POST['password'];
        
	$sql1="UPDATE `users` SET `s_in` = CURDATE() WHERE `users`.`username` = '$username'";
        $result1=mysqli_query($conn,$sql1);

        $sql2="UPDATE `users` SET `s_in` = CURTIME() WHERE `users`.`username` = '$username'";
        $result2=mysqli_query($conn,$sql2);

        $sql="Select * from users where username='$username' AND password='$password'";
        $result=mysqli_query($conn,$sql);
        $num=mysqli_num_rows($result);

        
        if($num==1)
        {
            $login=true;
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['username']=$username;
            header("location: welcome.php");

        }
        else
        {
            $showerror=true;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="CSS/style.css">
    </head>
    <body>
        <?php
            if($_SERVER["REQUEST_METHOD"]=="POST")
            {
                include 'database.php';
                $username=$_POST['username'];
                $status='activate';
                if($login)
                {
                    $sql="UPDATE `users` SET `status` = '$status' WHERE `users`.`username` = '$username'";
                    $result=mysqli_query($conn,$sql);
                }
                if($showerror)
                {
                    echo '<script>alert("Error! Invalid credentials.")</script>';
                }
            }   
        ?>


        <div id="contact">
            <div class="box">
                <form action="/tictactoe/login.php" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" placeholder="Enter username" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" placeholder="Enter password" class="form-control" id="password" name="password">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                Want to signup?<button onclick="window.location.href='signup.php'"  class="btn btn-primary">Signup</button>
            </div>
        </div>
    </body>
</html>
