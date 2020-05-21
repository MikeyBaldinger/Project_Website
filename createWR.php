<?php
	$username = "student";
	$password = "CompSci364";
	$database = "student";
	$conn = new mysqli("localhost", $username, $password, $database);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

	<script defer src="createSuccess.js"></script>

	<h2>Create a WR</h2>

    <form class="newWR" id="newWR" action="createWR.php" method="post" onsubmit="return createSuccess();">
		<label for="playerName">Player Name</label>
		<input type="text" name="playerName" id="playerName" required /><br />
		<label for="recYards">Receiving Yards</label>
		<input type="number" name="recYards" id="recYards" required /><br />
		<label for="recTds">Receiving Touchdowns</label>
		<input type="number" name="recTds" id="recTds" min="0" required /><br />
		<label for="receptions">Receptions</label>
		<input type="number" name="receptions" id="receptions" min="0" required /><br />
		<br>

		<input type="submit" value="Submit" />
	</form>

</html>

<?php

//variables when new widereceiver is created
if (isset($_POST['recYards']))  {
	$playerName = $_POST['playerName'];
	$recYards = $_POST['recYards'];
	$recTds = $_POST['recTds'];
	$receptions = $_POST['receptions'];
	$wr_insert = array( "INSERT INTO Widereceiver (player_name, rec_yards, rec_tds, receptions) VALUES ('$playerName', '$recYards', '$recTds', '$receptions'); ",);
	foreach ($wr_insert as $query) {
  		if (! $conn->query($query)) {
    			echo "Error: ".$conn->error."\n";
  		}
	}
	header("Location: main.html");
}
	
?>
