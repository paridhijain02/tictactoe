<?php
$username=$fullname=$contact="";
$showalert=false;
$showerror=false;
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    include 'database.php';
    $username=$_POST['username'];
    $fullname=$_POST['fullname'];
    $contact=$_POST['contact'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];
    //$exist=false;
    $status='deactivate';
    $existsql="Select * FROM `users` WHERE username= '$username'";
    $result=mysqli_query($conn,$existsql);
    $numexist=mysqli_num_rows($result);
    
    if($numexist==1)
    {
        $showerror="This username already exists";
    }
    else
    {
        if($username=="")
        {
            $showerror="Username is mandatory";
        }
        elseif(($fullname)=="") 
        {          
            $showerror = "Name is required";
        } 
        elseif(!preg_match("/^[a-zA-Z-' ]*$/",$fullname)) 
        {
            $showerror = "Only letters and white space allowed in Fullname";
        }
        elseif(strlen($contact)!=0 || strlen($contact)!=0) 
        {
            $showerror = "10 numbers for contact";
        }
        elseif(!preg_match("/^[0-9-' ]*$/",$contact)) 
        {
            $showerror = "Only numbers are allowed in contact";
        }
        elseif($password=="")
        {
            $showerror="Password is mandatory";
        }
        
        elseif(($password==$cpassword) )
        {
            $sql="INSERT INTO `users` (`username`,`fullname`,`contact`, `password`, `regis_date`, `status`) VALUES ('$username','$fullname','$contact', '$password', CURRENT_TIMESTAMP, '$status')";
            $result=mysqli_query($conn,$sql);
            $sql1="SELECT sno FROM `users` WHERE `username`='$username'";
            $result1=mysqli_query($conn,$sql1);
            $row=mysqli_fetch_assoc($result1);
            $sno_other_table=$row['sno'];
            $zero=0;
            $sql2="INSERT INTO `score_table` (`sno`,`score`) VALUES ('$sno_other_table','$zero')";
            $result2=mysqli_query($conn,$sql2);
    
            if($result)
            {
               $showalert= true;
               $username=$fullname=$contact="";
               
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
                //header("location: login.php");
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
                <form action="/tictactoe/signup.php" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username*</label>
                        <input type="text" class="form-control" placeholder="Enter the username" id="username" name="username" value="<?php echo $username?>" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Fullname*</label>
                        <input type="text" class="form-control" placeholder="Enter your full name" id="fullname" name="fullname" value="<?php echo $fullname?>">
                    </div>

                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact Number</label>
                        <input type="text" class="form-control" placeholder="Enter your Contact Number" id="contact" name="contact" value="<?php echo $contact?>">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password*</label>
                        <input type="password" class="form-control" placeholder="Enter the password" id="password" name="password">
                    </div>
                    
                    <div class="mb-3">
                        <label for="cpassword" class="form-label">Confirm Password*</label>
                        <input type="password" class="form-control" placeholder="Enter the password again" id="cpassword" name="cpassword">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>  
                </form>
                Already have an account?<button class="btn btn-primary" onclick="window.location.href='login.php'">Login</button> 
            </div>    
        </div>
        
    </body>
</html>