<?php
	$username = "student";
	$password = "CompSci364";
	$database = "student";
	$conn = new mysqli("localhost", $username, $password, $database);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>createPlayer</title>
		<link rel="stylesheet" href="nfl.css" />
	</head>
	<body>
		
		<h1><img src="NFL_logo.jpg" height="125" width="125">Skill Players Database</h1>

		<div class="topnav">
		<a href="main.html">Home</a>
		<a href="about.html">About</a>
		<a href="stats.php">Stats</a>
			<div class="dropdown">
				<button class="dbutton" name="dbutton">Create
					<i class="fa fa-caret-down"></i>
				</button>
				<div class="dcontent">
					<a class="active" href="createPlayer.php">Player</a>
					<a href="createTeam.php">Team</a>
				</div>
			</div>
		</div>

		<h2>Create a Player</h2>

		<form class="newplayer" id="newplayer" action="createPlayer.php" method="post" onsubmit="main.html">
			<label for="pname">Player Name</label>
			<input type="text" name="pname" id="pname" required /><br />
			<label for="tname">Team Name</label>
			<input type="text" name="tname" id="tname" required /><br />
			<label for="num">Player Number</label>
			<input type="number" name="num" id="num" min="0" max="99" required /><br />
			<label for="height">Height (ft-in)</label>
			<input type="text" name="height" id="height" placeholder="6-3" required /><br />
			<label for="weight">Weight</label>
			<input type="number" name="weight" id="weight" required /><br />
			<label for="pos">Position</label>
			<input type="radio" name="pos" value="QB" required>QB
			<input type="radio" name="pos" value="RB">RB
			<input type="radio" name="pos" value="WR">WR
			<input type="radio" name="pos" value="TE">TE
			<br>
			<br>

			<input type="submit" value="Submit" />
		</form>

	</body>
</html>

<?php

//variables when new player is created
if (isset($_POST['pname']))  {
	$pname = $_POST["pname"];
	$num = $_POST["num"];
	$height = $_POST["height"];
	$weight = $_POST["weight"];
	$pos = $_POST["pos"];
	$player_insert = array( "INSERT INTO Player (player_name, player_num, height, weight, yrs_pro, abbreviation) VALUES ('$pname', '$num', '$height', '$weight', 0, '$pos'); ",);
	foreach ($player_insert as $query) {
  		if (! $conn->query($query)) {
    			echo "Error: ".$conn->error."\n";
  		}
	}
	
	if ($pos == "QB") {
		include 'createQB.php';
	}
	else if ($pos == "RB") {
		include 'createRB.php';
	}
	else if ($pos == "WR") {
		include 'createWR.php';
	}
	else {
		include 'createTE.php';
	}
}
	
$conn->close();

?>
