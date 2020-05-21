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
		<title>createTeam</title>
		<link rel="stylesheet" href="nfl.css" />
		
		<script defer src="teamCreateSuccess.js"></script>

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
					<a href="createPlayer.php">Player</a>
					<a class="active" href="createTeam.php">Team</a>
				</div>
			</div>
		</div>

		<h2>Create a Team</h2>

		<form class="newteam" id="newteam" action="createTeam.php" method="post" onsubmit="return teamCreateSuccess();">
			<label for="tname">Team Name</label>
			<input type="text" name="tname" id="tname" required /><br />
			<label for="city">Hometown</label>
			<input type="text" name="city" id="city" required /><br />
			<label for="coach">Coach Name</label>
			<input type="text" name="coach" id="coach" required /><br />
			<label for="wins">Wins</label>
			<input type="number" name="wins" id="wins" min="0" max="16" required /><br />
			<label for="losses">Losses</label>
			<input type="number" name="losses" id="losses" min="0" max="16" required /><br />
			<label for="ties">Draws</label>
			<input type="number" name="ties" id="ties" min="0" max="16" required /><br />
			<input type="submit" value="Submit" />
		</form>

	</body>
</html>

<?php

//variables when new team is created
if (isset($_POST['tname']))  {
	$tname = $_POST["tname"];
	$city = $_POST["city"];
	$coach = $_POST["coach"];
	$wins = $_POST["wins"];
	$losses = $_POST["losses"];
	$ties = $_POST["ties"];
	$teaminsert = array( "INSERT INTO Team (team_name, city, coach, wins, losses, ties) VALUES ('$tname', '$city', '$coach', '$wins', '$losses', '$ties'); ",);
	foreach ($teaminsert as $query) {
  		if (! $conn->query($query)) {
    			echo "Error: ".$conn->error."\n";
  		}
	}
	header("Location: main.html");
}

$conn->close();

?>
