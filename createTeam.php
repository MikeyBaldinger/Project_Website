<?php
  $username = "student";
  $password = "CompSci364";
  $database = "student";
  $connection = new mysqli("localhost", $username, $password,
                         $database);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>createTeam</title>
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
					<a href="createPlayer.php">Player</a>
					<a class="active" href="createTeam.php">Team</a>
				</div>
			</div>
    </div>

  </body>
</html>
