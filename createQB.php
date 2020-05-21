<?php
	$username = "student";
	$password = "CompSci364";
	$database = "student";
	$conn = new mysqli("localhost", $username, $password, $database);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

	<script defer src="createSuccess.js"></script>
	
	<body>

	<h2>Create a QB</h2>

    <form class="newQB" id="newQB" action="createQB.php" method="post" onsubmit="return createSuccess();">
		<label for="playerName">Player Name</label>
		<input type="text" name="playerName" id="playerName" required /><br />
		<label for="passYards">Passing Yards</label>
		<input type="number" name="passYards" id="passYards" required /><br />
		<label for="passTds">Passing Touchdowns</label>
		<input type="number" name="passTds" id="passTds" min="0" required /><br />
		<label for="interceptions">Interceptions</label>
		<input type="number" name="interceptions" id="interceptions" min="0" required /><br />
		<label for="qbRating">QB Rating</label>
		<input type="number" name="qbRating" id="qbRating" placeholder="100.00" step="0.01" min="0" max="158.3" required /><br />
		<br>
		
		<input type="submit" value="Submit" />
	</form>

	</body>
	
</html>

<?php

//variables when new quarterback is created
if (isset($_POST['passYards']))  {
	$playerName = $_POST['playerName'];
	$passYards = $_POST['passYards'];
	$passTds = $_POST['passTds'];
	$interceptions = $_POST['interceptions'];
	$qbRating = $_POST['qbRating'];
	$qb_insert = array( "INSERT INTO Quarterback (player_name, pass_yards, pass_tds, interceptions, qb_rating) VALUES	('$playerName', '$passYards', '$passTds', '$interceptions', '$qbRating'); ",);
	foreach ($qb_insert as $query) {
  		if (! $conn->query($query)) {
    			echo "Error: ".$conn->error."\n";
  		}
	}
	header("Location: main.html");
}
	
?>
