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
    <title>stats</title>
    <link rel="stylesheet" href="nfl.css" />
  </head>

  <body>

    <h1><img src="NFL_logo.jpg" height="125" width="125">Skill Players Database</h1>

    <div class="topnav">
      <a href="main.html">Home</a>
      <a href="about.html">About</a>
      <a class="active" href="stats.php">Stats</a>
    </div>

    <h2>Stats</h2>

    <ul>
	<?php
    $n = 'Patrick Mahomes';
		$thisquery = "SELECT * ".
                 "FROM Player".
                 "WHERE player_name LIKE '%"Patrick Mahomes"%,";
		 $player_results = $connection->query($thisquery);
      while ($player = $player_results->fetch_assoc()) {
        $name = $player['player_name'];
        $number = $player['player_num'];
        $height = $player['height'];
        $weight = $player['weight'];
        $yrsPro = $player['yrs_pro'];
        $abbreviation = $player['abbreviation'];
     ?>

       <li><?php echo "$name, $number, $height".
                      "$weight, $yrsPro", "$abbreviation"; ?></li>
	  <?php
      }
     ?>
    </ul>

	After test...
	<ul>

	Updated: <?php echo $_POST["input"]; ?>
    <?php
      $query = "SELECT * ".
               "FROM Team";
      $team_results = $connection->query($query);
      while ($team = $team_results->fetch_assoc()) {
        $name = $team['team_name'];
        $city = $team['city'];
        $coach = $team['coach'];
        $wins = $team['wins'];
        $losses = $team['losses'];
        $ties = $team['ties'];
     ?>

       <li><?php echo "$name, $city, $coach".
                      "$wins, $losses", "$ties"; ?></li>
    <?php
      }
     ?>
    </ul>

   </body>
</html>
