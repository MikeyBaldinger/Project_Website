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
			<div class="dropdown">
				<button class="dbutton" name="dbutton">Create
					<i class="fa fa-caret-down"></i>
				</button>
				<div class="dcontent">
					<a href="createPlayer.php">Player</a>
					<a href="createTeam.php">Team</a>
				</div>
			</div>
    </div>

    <h2>Stats</h2>
  <ul>
	 
	 <?php

      $team_input = $_POST["input"];

      $team_query = "SELECT * ".
               "FROM Team ".
	       "WHERE team_name = '$team_input' ";
      $team_results = $connection->query($team_query);
	  if ($team_results->num_rows > 0)
	  {
		  while ($team = $team_results->fetch_assoc()) {
			  $name = $team['team_name'];
			  $city = $team['city'];
			  $coach = $team['coach'];
			  $wins = $team['wins'];
			  $losses = $team['losses'];
			  $ties = $team['ties'];

     ?>   
	   <?php echo "$city"; ?> <?php echo "$name"; ?> <br>
	   Coach: <?php echo "$coach"; ?> <br>
	   Wins: <?php echo "$wins"; ?> <br>
	   Losses: <?php echo "$losses"; ?> <br>
	   Ties: <?php echo "$ties"; ?> <br>
	   <?php
      }
	  }
     ?>


    <?php

      $user_input = $_POST["input"];

      $query = "SELECT * ".
               "FROM Player ".
	       "WHERE player_name = '$user_input' ";
      $player_results = $connection->query($query);
	  if ($player_results->num_rows > 0)
	  {
		  while ($player = $player_results->fetch_assoc()) {
        $p_name = $player['player_name'];
		$num = $player['player_num'];
		$height = $player['height'];
		$weight = $player['weight'];
		$yrs_pro = $player['yrs_pro'];
		$abbreviation = $player['abbreviation'];
     ?>
	 
	<?php echo "$p_name"; ?> - #<?php echo "$num"; ?> <br>
	Position: <?php echo "$abbreviation"; ?> <br>
	Height: <?php echo "$height"; ?> <br>
	Weight: <?php echo "$weight"; ?> <br>
	Years Pro: <?php echo "$yrs_pro"; ?> <br>
	
    <?php
      }
	  }
     ?>
	 
	  <?php

      $user_input = $_POST["input"];

      $query = "SELECT * ".
               "FROM Quarterback ".
	       "WHERE player_name = '$user_input' ";
      $qb_results = $connection->query($query);
	  if ($qb_results->num_rows > 0)
	  {
		  while ($qb = $qb_results->fetch_assoc()) {
        $p_name = $qb['player_name'];
		$pass_yards = $qb['pass_yards'];
		$pass_tds = $qb['pass_tds'];
		$interceptions = $qb['interceptions'];
		$qb_rating = $qb['qb_rating'];
     ?>
	 
	<br>
	2019-2020 Stats <br>
	Passing Yards: <?php echo "$pass_yards"; ?> <br>
	Passing Touchdowns: <?php echo "$pass_tds"; ?> <br>
	Interceptions: <?php echo "$interceptions"; ?> <br>
	QB Rating: <?php echo "$qb_rating"; ?> <br>
	
    <?php
      }
	  }
     ?>
	 
	   <?php

      $user_input = $_POST["input"];

      $query = "SELECT * ".
               "FROM Runningback ".
	       "WHERE player_name = '$user_input' ";
      $rb_results = $connection->query($query);
	  if ($rb_results->num_rows > 0)
	  {
		  while ($rb = $rb_results->fetch_assoc()) {
        $p_name = $rb['player_name'];
		$rush_yards = $rb['rush_yards'];
		$touchdowns = $rb['touchdowns'];
		$fumbles = $rb['fumbles'];
		$carries = $rb['carries'];
     ?>
	 
	<br>
	2019-2020 Stats <br>
	Rushing Yards: <?php echo "$rush_yards"; ?> <br>
	Touchdowns: <?php echo "$touchdowns"; ?> <br>
	Fumbles: <?php echo "$fumbles"; ?> <br>
	Carries: <?php echo "$carries"; ?> <br>
	
    <?php
      }
	  }
     ?>

    </ul>
   </body>
</html>
