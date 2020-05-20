<?php

$servername = "localhost";
$username = "student";
$password = "CompSci364";
$database = "student";

$conn = new mysqli($servername, $username, $password, $database);
//Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$tables = <<<SQL
DROP TABLE IF EXISTS Quarterback;
DROP TABLE IF EXISTS Runningback;
DROP TABLE IF EXISTS Widereceiver;
DROP TABLE IF EXISTS Tightend;
DROP TABLE IF EXISTS Roster;
DROP TABLE IF EXISTS Team;
DROP TABLE IF EXISTS Player;
DROP TABLE IF EXISTS Position;

CREATE TABLE Team (
  team_name CHARACTER VARYING(50) NOT NULL,
  city CHARACTER VARYING(50) NOT NULL,
  coach CHARACTER VARYING(50) NOT NULL,
  wins INTEGER NOT NULL,
  losses INTEGER NOT NULL,
  ties INTEGER,

  PRIMARY KEY (team_name)
);

CREATE TABLE Position (
  abbreviation CHARACTER VARYING(2) NOT NULL,

  PRIMARY KEY (abbreviation)
);

CREATE TABLE Player (
  player_name CHARACTER VARYING(50) NOT NULL,
  player_num INTEGER NOT NULL,
  height CHARACTER VARYING(7) NOT NULL,
  weight INTEGER NOT NULL,
  yrs_pro INTEGER NOT NULL,
  abbreviation CHARACTER VARYING(2) NOT NULL,

  PRIMARY KEY (player_name),
  FOREIGN KEY (abbreviation) REFERENCES Position (abbreviation)
      ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE Roster (
  player_name CHARACTER VARYING(50) NOT NULL,
  team_name CHARACTER VARYING(50) NOT NULL,

  PRIMARY KEY (player_name, team_name),
  FOREIGN KEY (player_name) REFERENCES Player (player_name)
    ON UPDATE CASCADE ON DELETE RESTRICT,
  FOREIGN KEY (team_name) REFERENCES Team (team_name)
    ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE Quarterback (
  player_name CHARACTER VARYING(50) NOT NULL,
  pass_yards INTEGER NOT NULL,
  pass_tds INTEGER NOT NULL,
  interceptions INTEGER NOT NULL,
  qb_rating NUMERIC(4,1) NOT NULL,

  PRIMARY KEY (player_name),
  FOREIGN KEY (player_name) REFERENCES Player (player_name)
	ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE Runningback (
  player_name CHARACTER VARYING(50) NOT NULL,
  rush_yards INTEGER NOT NULL,
  touchdowns INTEGER NOT NULL,
  fumbles INTEGER NOT NULL,
  carries INTEGER NOT NULL,

  PRIMARY KEY (player_name),
  FOREIGN KEY (player_name) REFERENCES Player (player_name)
	ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE Widereceiver (
  player_name CHARACTER VARYING(50) NOT NULL,
  rec_yards INTEGER NOT NULL,
  rec_tds INTEGER NOT NULL,
  receptions INTEGER NOT NULL,

  PRIMARY KEY (player_name),
  FOREIGN KEY (player_name) REFERENCES Player (player_name)
	ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE Tightend (
  player_name CHARACTER VARYING(50) NOT NULL,
  rec_yards INTEGER NOT NULL,
  rec_tds INTEGER NOT NULL,
  receptions INTEGER NOT NULL,

  PRIMARY KEY (player_name),
  FOREIGN KEY (player_name) REFERENCES Player (player_name)
	ON UPDATE CASCADE ON DELETE RESTRICT
);

SQL;

// normally only a single query is executed, but batch table creation
$conn->multi_query($tables)
    or die("Error: ".$conn->error);

// ensure that all the queries executed correctly
while ($conn->more_results())
  if (! $conn->next_result())
    echo "Error: ".$conn->error."\n";

$data = array(

"INSERT INTO Team (team_name, city, coach, wins, losses, ties) VALUES ".
	"('Chiefs', 'Kansas City', 'Andy Reid', 12, 4, 0), ".
	"('Eagles', 'Philadelphia', 'Doug Pederson', 9, 7, 0), ".
	"('Patriots', 'New England', 'Bill Belichick', 12, 4, 0), ".
	"('Vikings', 'Minnesota', 'Mike Zimmer', 10, 6, 0), ".
	"('49ers', 'San Francisco', 'Kyle Shanahan', 13, 3, 0); ",
	/*"('$tname', '$city', '$coach', '$wins', '$losses', '$ties');",*/
"INSERT INTO Position (abbreviation) VALUES ".
	"('QB'), ".
    "('RB'), ".
    "('WR'), ".
    "('TE');",
"INSERT INTO Player (player_name, player_num, height, weight, yrs_pro, abbreviation) VALUES ".
	/*Chiefs*/
    "('Patrick Mahomes', 15, '6-3', 230, 4, 'QB'), ".
	"('Damien Williams', 26, '5-11', 224, 7, 'RB'), ".
	"('Tyreek Hill', 10, '5-10', 185, 5, 'WR'), ".
	"('Travis Kelce', 87, '6-5', 260, 8, 'TE'),".
	/*Eagles*/
	"('Carson Wentz', 11, '6-5', 237, 5, 'QB'), ".
	"('Miles Sanders', 26, '5-11', 211, 2, 'RB'), ".
	"('Alshon Jeffery', 17, '6-3', 218, 9, 'WR'), ".
	"('Zach Ertz', 86, '6-5', 250, 8, 'TE'), ".
	/*Patriots*/
	"('Tom Brady', 12, '6-4', 225, 21, 'QB'), ".
	"('Sony Michel', 26, '5-11', 215, 3, 'RB'), ".
	"('Julian Edelman', 11, '5-10', 198, 12, 'WR'), ".
	"('Benjamin Watson', 84, '6-3', 255, 17, 'TE'), ".
	/*Vikings*/
	"('Kirk Cousins', 8, '6-3', 202, 9, 'QB'), ".
	"('Dalvin Cook', 33, '5-10', 210, 4, 'RB'), ".
	"('Adam Thielen', 19, '6-2', 200, 7, 'WR'), ".
	"('Kyle Rudolph', 82, '6-6', 265, 10, 'TE'), ".
	/*49ers*/
    "('Jimmy Garoppolo', 10, '6-2', 225, 5, 'QB'), ".
	"('Raheem Mostert', 31, '5-10', 205, 6, 'RB'), ".
	"('Emanuel Sanders', 17, '5-11', 180, 11, 'WR'), ".
	"('George Kittle', 85, '6-4', 250, 4, 'TE');",
    /*"('$pname', '$num', '$height', '$weight', 0, '$pos');",*/
"INSERT INTO Quarterback (player_name, pass_yards, pass_tds, interceptions, qb_rating) VALUES ".
    "('Patrick Mahomes', 4031, 26, 5, 105.3), ".
	"('Carson Wentz', 4039, 27, 7, 93.1), ".
	"('Tom Brady', 4057, 24, 8, 88.0), ".
	"('Kirk Cousins', 3603, 26, 6, 107.4), ".
    "('Jimmy Garoppolo', 1000, 1, 5, 10);",
"INSERT INTO Runningback (player_name, rush_yards, touchdowns, fumbles, carries) VALUES ".
	"('Damien Williams', 498, 5, 1, 111), ".
	"('Miles Sanders', 818, 3, 0, 179), ".
	"('Sony Michel', 912, 7, 2, 247), ".
	"('Dalvin Cook', 1135, 13, 3, 250), ".
	"('Raheem Mostert', 772, 8, 1, 137); ",
"INSERT INTO Widereceiver (player_name, rec_yards, rec_tds, receptions) VALUES ".
	"('Tyreek Hill', 860, 7, 58), ".
	"('Alshon Jeffery', 490, 4, 43), ".
	"('Julian Edelman', 1117, 6, 100), ".
	"('Adam Thielen', 418, 6, 30), ".
	"('Emanuel Sanders', 869, 5, 66); ",
"INSERT INTO Tightend (player_name, rec_yards, rec_tds, receptions) VALUES ".
	"('Travis Kelce', 1229, 5, 97), ".
	"('Zach Ertz', 916, 6, 88), ".
	"('Benjamin Watson', 173, 0, 17), ".
	"('Kyle Rudolph', 367, 6, 39), ".
	"('George Kittle', 1053, 5, 85); ",
"INSERT INTO Roster (player_name, team_name) VALUES ".
    /*Chiefs*/
    "('Patrick Mahomes', 'Chiefs'), ".
	"('Damien Williams', 'Chiefs'), ".
	"('Tyreek Hill', 'Chiefs'), ".
	"('Travis Kelce', 'Chiefs'),".
	/*Eagles*/
	"('Carson Wentz', 'Eagles'), ".
	"('Miles Sanders', 'Eagles'), ".
	"('Alshon Jeffery', 'Eagles'), ".
	"('Zach Ertz', 'Eagles'), ".
	/*Patriots*/
	"('Tom Brady', 'Patriots'), ".
	"('Sony Michel', 'Patriots'), ".
	"('Julian Edelman', 'Patriots'), ".
	"('Benjamin Watson', 'Patriots'), ".
	/*Vikings*/
	"('Kirk Cousins', 'Vikings'), ".
	"('Dalvin Cook', 'Vikings'), ".
	"('Adam Thielen', 'Vikings'), ".
	"('Kyle Rudolph', 'Vikings'), ".
	/*49ers*/
    "('Jimmy Garoppolo', '49ers'), ".
	"('Raheem Mostert', '49ers'), ".
	"('Emanuel Sanders', '49ers'), ".
	"('George Kittle', '49ers');"
);

foreach ($data as $query) {
  if (! $conn->query($query)) {
    echo "Error: ".$conn->error."\n";
  }
}

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

}
/*
	if ($conn->query($team_insert) == TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $team_insert . "<br>" . $conn->error;
}
*/
/*
//variables when new player is created
if (isset($_POST['pname']))  {
	$pname = $_POST["pname"];
	$num = $_POST["num"];
	$height = $_POST["height"];
	$weight = $_POST["weight"];
	$pos = $_POST["pos"];
	$player_insert = "INSERT INTO Player (player_name, player_num, height, weight, yrs_pro, abbreviation) VALUES ('$pname', '$num', '$height', '$weight', 0, '$pos')";
}

if ($conn->query($player_insert) == TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $player_insert . "<br>" . $conn->error;
}
*/
$conn->close();

// closing PHP tag intentionally omitted
