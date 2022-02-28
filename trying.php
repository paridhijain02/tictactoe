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
			}
			
		}				
		if ($winner == 'n' && $blank==0)
		{
			$winner = 't';
			echo "<script>alert('Game Tied!')</script>";
		}
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
		<div id="game">
			<div class="box2">
				<form name = "ticktactoe" method = "post" action = '/tictactoe/trying.php'>
					<?php
						echo "<h2 class='h-s'>Tic Tac Toe</h2>";
						echo "<h3 class='h-s'>You can only use x</h3>";
						for($i = 0; $i <=8; $i++)
						{
							printf('<input type = "text" id = "ip" name = "box%s" value = "%s">',$i , $box[$i]);
							if ($i == 2 || $i == 5 || $i == 8)
							{
							echo("<br>");
							}
						}
						for($i = 0; $i <=8; $i++)
						{
                            printf('<input type="submit" id="ip" name="box%s"	class="button" value="x">',$i );
							if ($i == 2 || $i == 5 || $i == 8)
							{
							echo("<br>");
							}
						}
						if($winner == 'n')
						{
							echo "<br>";
							echo('<input type = "submit" class="btn" name = "next" value = "Next Move" id = "go">');
						}	
						//echo "<br><br>";
						echo('<input type = "button" class="btn" name = "newgamebtn" value = "Play Again" id = "go" onclick = "window.location.href=\'trying.php\'">');					
					?>				
				</form>
			</div>
		</div>
	</body>
</html>