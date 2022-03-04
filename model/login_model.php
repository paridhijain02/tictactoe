<?php
require_once('model/login_model.php');
class User
{
    public function getlogin()
    {
        $server = "localhost";  
        $users = "root";  
        $password = "";  
        $db = "tictactoe";  
        
        $conn = mysqli_connect($server, $users, $password,$db);  
        
        if(!$conn) 
        {  
            die(mysqli_connect_error());  
        }  
    
        
        if(isset($_REQUEST['username']) && isset($_REQUEST['password']))
        {
            $username=$_REQUEST['username'];
            $password=$_REQUEST['password'];
            $sql = "SELECT * from `users` WHERE `username` = '$username' and `password` = '$password'";  
            $result = mysqli_query($conn, $sql);  
        
            $count = mysqli_num_rows($result);  
            
                if($count == 1)
                {
                    $status='activate';
                    $sql="UPDATE `users` SET `status` = '$status' WHERE `users`.`username` = '$username'";
                    $result=mysqli_query($conn,$sql);
                    
                    $sql1="UPDATE `users` SET `s_in` = CURDATE() WHERE `users`.`username` = '$username'";
                    $result1=mysqli_query($conn,$sql1);

                    $sql2="UPDATE `users` SET `s_in` = CURTIME() WHERE `users`.`username` = '$username'";
                    $result2=mysqli_query($conn,$sql2);
                    return 'login';
                }
                else
                {
                    return 'NONE';
                }
        }
    }
    public function getlogout()
    {
        return 'logout';
    }
}
?>