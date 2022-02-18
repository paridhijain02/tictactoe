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
	if (isset($_POST["gobtn"]))
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
			include 'database1.php';
			$username=$_SESSION['username'];
			//$score=$_SESSION['score']; 
			$sql="UPDATE `users` SET `score` = score+1 WHERE `users`.`username` = '$username'";
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
			if(($box[0] == 'o' && $box[1] == 'o' && $box[2] == 'o')  || ($box[3] == 'o' && $box[4] == 'o' && $box[5] == 'o') || ($box[6] == 'o' && $box[7] == 'o' && $box[8] == 'o') || ($box[0] == 'o' && $box[3] == 'o' && $box[6] == 'o')  || ($box[1] == 'o' && $box[4] == 'o' && $box[7] == 'o') || ($box[2] == 'o' && $box[5] == 'o' && $box[8] == 'o') || ($box[0] == 'o' && $box[4] == 'o' && $box[8] == 'o') || ($box[2] == 'o' && $box[4] == 'o' && $box[6] == 'o') )
			{
				if($xwin==0)
				{
					$winner = 'o';
					echo "<script>alert('O Wins')</script>";
				}
				
			}				
		}
		else if ($winner == 'n')
		{
			$winner = 't';
			Print "<h1>Game Tied!</h1>";
		}
	}
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
		<h1 class="h-p">Welcome  <?php echo $_SESSION['username']?> to your profile</h1>
		<br>
		

		<div id="game">
			<div class="box2">
				<form name = "ticktactoe" method = "post" action = '/project1/welcome.php'>
					<?php
						echo "<h2 class='h-p'>Tic Tac Toe</h2>";
						echo "<h3 class='h-p'>You can only use x</h3>";
						for($i = 0; $i <=8; $i++)
						{
							printf('<input type = "text" id = "ip" name = "box%s" value = "%s">',$i , $box[$i]);
							if ($i == 2 || $i == 5 || $i == 8)
							{
							echo("<br>");
							}
						}
						if($winner == 'n')
						{
							echo "<br>";
							echo('<input type = "submit" class="btn" name = "gobtn" value = "Next Move" id = "go">');
						}	
						//echo "<br><br>";
						echo('<input type = "button" class="btn" name = "newgamebtn" value = "Play Again" id = "go" onclick = "window.location.href=\'welcome.php\'">');
						//echo '<hr/><div class="wline"></div>';
						echo '<hr/>';
						include 'database1.php';
						$sql="select * from `users`";
						$result=mysqli_query($conn,$sql);
						$num=mysqli_num_rows($result);
						//echo $num;
						echo "<br>";
						echo "<h2 class='h-p'>Leaderboard</h2>";
						//$row=mysqli_fetch_assoc($result);
						//echo var_dump($row);
						for ($i=0; $i < $num; $i++) 
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
						}				
					?>				
				</form>
			</div>
		</div>
		<button class="btn" onclick="window.location.href='password1.php'">Change Password</button>
		<button class='btn' onclick="window.location.href='logout.php'">LOGOUT</button>
		<br><br>
		<div class="container signin">
			<p>Want to logout? <a href="/project1/logout.php">Logout</a>.</p>
		</div>
	</body>
</html>