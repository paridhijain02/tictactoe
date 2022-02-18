<?php
$showalert=false;
$showerror=false;
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    include 'database1.php';
    $username=$_POST['username'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];
    //$exist=false;
    $status='deactivate';
    $score=0;
    $existsql="Select * FROM `users` WHERE username= '$username'";
    $result=mysqli_query($conn,$existsql);
    $numexist=mysqli_num_rows($result);
    
    if($numexist==1)
    {
        $showerror="This username already exists";
    }
    else
    {
        if(($password==$cpassword) )
        {
            $sql="INSERT INTO `users` (`username`, `password`, `date`, `status`,`score`) VALUES ('$username', '$password', CURRENT_TIMESTAMP, '$status', '$score')";
            $result=mysqli_query($conn,$sql);
            if($result)
            {
                $showalert= true;
            }
        }
        else
        {
            $showerror="Both passwords do not match";
        }
    }   
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">     
        <title>Signup</title>
        <link rel="stylesheet" href="CSS/style.css">
    </head>
    <body>
        <?php
            if($showalert)
            {
                echo "<script>alert('Your account is created.');</script>";
            }
            if($showerror)
            {
                function function_alert($a) 
                {
                    echo "<script>alert('$a');</script>";
                }
                function_alert($showerror);
            }   
        ?>
        <div id="contact">
            <div class="box">
                <form action="/project1/signup.php" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" placeholder="Enter the username" id="username" name="username" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" placeholder="Enter the password" id="password" name="password">
                    </div>
                    
                    <div class="mb-3">
                        <label for="cpassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" placeholder="Enter the password again" id="cpassword" name="cpassword">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>  
                </form>
                <button class="btn btn-primary" onclick="window.location.href='login.php'">Login</button> 
            </div>    
        </div>
        
    </body>
</html>