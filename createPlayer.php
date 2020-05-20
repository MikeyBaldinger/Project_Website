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

    <form class="newplayer" id="newplayer" action="populate.php" method="post"
          onsubmit="return checkForm();">
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
      <input type="text" name="pos" id="pos" placeholder="(QB) or (RB) or (WR) or (TE)" required /><br />
      <input type="submit" value="Submit" />
    </form>

  </body>
</html>
