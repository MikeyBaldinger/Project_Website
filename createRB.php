<?php
	$username = "student";
	$password = "CompSci364";
	$database = "student";
	$conn = new mysqli("localhost", $username, $password, $database);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

	<script defer src="createSuccess.js"></script>

    <h2>Create a RB</h2>

    <form class="newRB" id="newRB" action="createRB.php" method="post" onsubmit="return createSuccess();">
		<label for="playerName">Player Name</label>
		<input type="text" name="playerName" id="playerName" required /><br />
		<label for="rushYards">Rushing Yards</label>
		<input type="number" name="rushYards" id="rushYards" required /><br />
		<label for="tds">Touchdowns</label>
		<input type="number" name="tds" id="tds" min="0" required /><br />
		<label for="fumbles">Fumbles</label>
		<input type="number" name="fumbles" id="fumbles" min="0" required /><br />
		<label for="carries">Carries</label>
		<input type="number" name="carries" id="carries" min="0" required /><br />
		<br>

		<input type="submit" value="Submit" />
    </form>

</html>

<?php

//variables when new player is created
if (isset($_POST['rushYards']))  {
	$playerName = $_POST['playerName'];
	$rushYards = $_POST['rushYards'];
	$tds = $_POST['tds'];
	$fumbles = $_POST['fumbles'];
	$carries = $_POST['carries'];
	$rb_insert = array( "INSERT INTO Runningback (player_name, rush_yards, touchdowns, fumbles, carries) VALUES ('$playerName', '$rushYards', '$tds', '$fumbles', '$carries'); ",);
	foreach ($rb_insert as $query) {
  		if (! $conn->query($query)) {
    			echo "Error: ".$conn->error."\n";
  		}
	}
	header("Location: main.html");
}
	
?>
