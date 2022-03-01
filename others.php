<?php
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true)
    {
        header("location: login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Others</title>
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
					<a href="others.php" class="active">
						<span class="item">Users Details</span>
					</a>
				</li>
				<li>
					<a href="password.php">
						<span class="item">Change password</span>
					</a>
				</li>
				<li>
					<a href="fullname.php">
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

        <div id="game">
            <div class="box2">
		<?php
                	echo "<h1 class='h-s'>Details </h1>";
                        include 'database.php';
			$sql="SELECT * FROM `users` u INNER JOIN `score_table` s ON u.sno = s.sno";
			$result=mysqli_query($conn,$sql);
			$num=mysqli_num_rows($result);
			echo "<br>";

                        echo'	
				<table id="leader1">
				<tr>
					<th>Username</th>
					<th>Name</th>
					<th>Contact Number</th>
					<th>Score</th>
					<th>Status</th>
					<th>Session in</th>
					<th>Session out</th>
				</tr>';
				for ($i=0; $i < $num; $i++) 
				{ 
					$row=mysqli_fetch_assoc($result);
					echo "<tr>
						<td>" . $row["username"]. "</td>
						<td>" . $row["fullname"]. "</td>
						<td>" . $row["contact"]. "</td>
						<td>" . $row["score"]. "</td>	
						<td>" . $row["status"]. "</td>
						<td>" . $row["s_in"]. "</td>";
						if($row["status"]=='deactivate')
						//if($row["username"]!=$_SESSION['username'])
						{
							echo"
							<td>" . $row["s_out"]. "</td>
							</tr>";
						}
						else
						{
							echo"
							<td> Present </td>
							</tr>";
						}
					}
				echo "</table>";
                    ?>
            </div>
        </div>
    </body>
</html>
