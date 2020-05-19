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
      "('49ers', 'San Francisco', 'Kyle Shanahan', 13, 3, 0);",
  "INSERT INTO Position (abbreviation) VALUES ".
      "('QB'), ".
      "('RB');",
  "INSERT INTO Player (player_name, player_num, height, weight, yrs_pro, abbreviation) VALUES ".
      "('Patrick Mahomes', 15, '6-3', 230, 3, 'QB'), ".
      "('Jimmy Garoppolo', 10, '6-2', 225, 5, 'QB');",

  "INSERT INTO Quarterback (player_name, pass_yards, pass_tds, interceptions, qb_rating) VALUES ".
      "('Patrick Mahomes', 5000, 50, 10, 158.3), ".
      "('Jimmy Garoppolo', 1000, 1, 5, 10);",
  "INSERT INTO Roster (player_name, team_name) VALUES ".
      "('Patrick Mahomes', 'Chiefs'), ".
      "('Jimmy Garoppolo', '49ers');",
);

foreach ($data as $query) {
  if (! $conn->query($query))
    echo "Error: ".$conn->error."\n";
}

$conn->close();

// closing PHP tag intentionally omitted
