<?php
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true)
    {
        header("location: login.php");
        exit;
    }
?>

<?php
	$winner = 'n';
	$xwin=0;
	$box = array('','','','','','','','','');
	//if (isset($_POST["next"]))
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		$box[0] = $_POST["box0"];
		$box[1] = $_POST["box1"];
		$box[2] = $_POST["box2"];
		$box[3] = $_POST["box3"];
		$box[4] = $_POST["box4"];
		$box[5] = $_POST["box5"];
		$box[6] = $_POST["box6"];
		$box[7] = $_POST["box7"];
		$box[8] = $_POST["box8"];

		if(($box[0] == 'x' && $box[1] == 'x' && $box[2] == 'x')  || ($box[3] == 'x' && $box[4] == 'x' && $box[5] == 'x') || ($box[6] == 'x' && $box[7] == 'x' && $box[8] == 'x') || ($box[0] == 'x' && $box[3] == 'x' && $box[6] == 'x')  || ($box[1] == 'x' && $box[4] == 'x' && $box[7] == 'x') || ($box[2] == 'x' && $box[5] == 'x' && $box[8] == 'x') || ($box[0] == 'x' && $box[4] == 'x' && $box[8] == 'x') || ($box[2] == 'x' && $box[4] == 'x' && $box[6] == 'x') )
		{
			$winner = 'x';
			echo "<script>alert('X Wins')</script>";
			$xwin=1;

			include 'database.php';
			$username=$_SESSION['username'];
			$sql1="SELECT sno FROM `users` WHERE `username`='$username'";
            $result1=mysqli_query($conn,$sql1);
            $row=mysqli_fetch_assoc($result1);
            $sno_other_table=$row['sno'];
			$sql="UPDATE `score_table` SET `score` = score+1 WHERE `sno` = '$sno_other_table'";
			$result=mysqli_query($conn,$sql);
		}
		$blank = 0;
		for ($i = 0; $i <= 8 ; $i++)
		{
			if($box[$i] == '')
			{
				$blank = 1;
			}
		}
			
		if($blank == 1)
		{
			$d = rand() % 8;
			while($box[$d] != '')
			{
				$d = rand() % 8;
			}
			$box[$d] = 'o';
		}
		if(($box[0] == 'o' && $box[1] == 'o' && $box[2] == 'o')  || ($box[3] == 'o' && $box[4] == 'o' && $box[5] == 'o') || ($box[6] == 'o' && $box[7] == 'o' && $box[8] == 'o') || ($box[0] == 'o' && $box[3] == 'o' && $box[6] == 'o')  || ($box[1] == 'o' && $box[4] == 'o' && $box[7] == 'o') || ($box[2] == 'o' && $box[5] == 'o' && $box[8] == 'o') || ($box[0] == 'o' && $box[4] == 'o' && $box[8] == 'o') || ($box[2] == 'o' && $box[4] == 'o' && $box[6] == 'o') )
		{
			if($xwin==0)
			{
				$winner = 'o';
				echo "<script>alert('O Wins')</script>";
				include 'database.php';
				$username=$_SESSION['username'];
				$sql1="SELECT sno FROM `users` WHERE `username`='$username'";
				$result1=mysqli_query($conn,$sql1);
				$row=mysqli_fetch_assoc($result1);
				$sno_other_table=$row['sno'];
				$sql="UPDATE `score_table` SET `loss` = loss+1 WHERE `sno` = '$sno_other_table'";
				$result=mysqli_query($conn,$sql);
			}
			
		}				
		
		if ($winner == 'n' && $blank==0)
		{
			$winner = 't';
			echo "<script>alert('Game Tied!')</script>";
			include 'database.php';
			$username=$_SESSION['username'];
			$sql1="SELECT sno FROM `users` WHERE `username`='$username'";
			$result1=mysqli_query($conn,$sql1);
			$row=mysqli_fetch_assoc($result1);
			$sno_other_table=$row['sno'];
			$sql="UPDATE `score_table` SET `draw` = draw+1 WHERE `sno` = '$sno_other_table'";
			$result=mysqli_query($conn,$sql);
		}
		include 'database.php';
		$username=$_SESSION['username'];
		$sql1="SELECT sno FROM `users` WHERE `username`='$username'";
		$result1=mysqli_query($conn,$sql1);
		$row=mysqli_fetch_assoc($result1);
		$sno_other_table=$row['sno'];
		$sql="UPDATE `score_table` SET `total` = score+loss+draw WHERE `sno` = '$sno_other_table'";
		$result=mysqli_query($conn,$sql);
	}
	//<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
?>

<!DOCTYPE html>
<html lang="en">
	<head>   
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Welcome</title>
		<link rel='stylesheet' href='CSS/style.css'>
	</head>
	<body>
		<div class="wrapper">
			Hello
			<div class="sidebar">
				<ul>
					<li>
						<a href="#" class="active">
							<span class="item">Game</span>
						</a>
					</li>
					<li>
						<a href="others.php">
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
				<form name = "ticktactoe" method = "post" action = '/tictactoe/welcome.php'>
				<h1 class="center"> <?php echo "Welcome " . $_SESSION['username']?></h1>
					<?php
						echo "<h2 class='h-s'>Tic Tac Toe</h2>";
						echo "<h3 class='h-s'>You can only use x</h3>";
						for($i = 0; $i <=8; $i++)
						{
							if($i == 0 || $i == 3 || $i == 6)
							{
								printf('<input type = "text" id = "ip1" name = "box%s" value = "%s">',$i , $box[$i]);
							}
							else
							{
								printf('<input type = "text" id = "ip" name = "box%s" value = "%s">',$i , $box[$i]);
							}
							if ($i == 2 || $i == 5 || $i == 8)
							{
							echo("<br>");
							}
						}
						for($i = 0; $i <=8; $i++)
						{
							if($i == 0 || $i == 3 || $i == 6)
							{
								printf('<input type="submit" id="ip1" name="box%s" class="btn1" value="x">',$i );
							}
							else
							{
								printf('<input type="submit" id="ip" name="box%s"	class="btn1" value="x">',$i );
							}
							if ($i == 2 || $i == 5 || $i == 8)
							{
							echo("<br>");
							}
						}
						if($winner == 'n')
						{
							//echo "<br>";
							//echo('<input type = "submit" class="btn" name = "next" value = "Next Move" id = "go">');
						}	
						//echo "<br><br>";
						echo('<input type = "button" class="btn" name = "newgamebtn" value = "Play Again" id = "go" onclick = "window.location.href=\'welcome.php\'">');
						//echo '<hr/><div class="wline"></div>';
						
						include 'database.php';
						//$sql="select * from `users`";
						$sql="SELECT * FROM `users` u INNER JOIN `score_table` s ON u.sno = s.sno";
						$result=mysqli_query($conn,$sql);
						$num=mysqli_num_rows($result);
						
						//echo $num;
						echo "<h2 class='h-s'>Leaderboard</h2>";
						//$row=mysqli_fetch_assoc($result);
						//echo var_dump($row);
						echo'	
						
							<table id="leader">
							<tr>
								<th>Name</th>
								<th>Score</th>
								<th>Loss</th>
								<th>Draw</th>
								<th>Total</th>
							</tr>';
							for ($i=0; $i < $num; $i++) 
							{ 
								$row=mysqli_fetch_assoc($result);
								echo "<tr>
								<td>" . $row["fullname"]. "</td>								
								<td>" . $row["score"]. "</td>
								<td>" . $row["loss"]. "</td>								
								<td>" . $row["draw"]. "</td>
								<td>" . $row["total"]. "</td>";
								
								//<td>" . $row["score"]. "</td>";
							}
							echo "</table>";
						/*for ($i=0; $i < $num; $i++) 
						{ 
							$row=mysqli_fetch_assoc($result);
							echo $row['username'] ." has scored " . $row['score'] . ". The session is " .$row['status'];
							echo "<br>";
							if($row['status']=='activate')
							{
								echo "The session time in is " . $row['s_in'] ;
							}
							else
							{
								echo "The session time in was " . $row['s_in'] . " and session time in was ". $row['s_out'];
							}
							echo "<br><br>";
						}	*/			
					?>				
				</form>
			</div>
		</div>
		<!--<button class="btn" onclick="window.location.href='others.php'">Users details</button>
		<button class="btn" onclick="window.location.href='manage.php'">Profile management</button>
		<button class='btn' onclick="window.location.href='logout.php'">LOGOUT</button>
		<br><br>
		
		<div class="container signin">
			<p>Want to logout? <a href="/project1/logout.php">Logout</a>.</p>
		</div>
					-->
	</body>
</html>