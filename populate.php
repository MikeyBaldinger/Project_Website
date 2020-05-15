<?php

$username = "student";
$password = "CompSci364";
$database = "student";

$connection = new mysqli("localhost", $username, $password,
                         $database);

$tables = <<<SQL
DROP TABLE IF EXISTS Team;
DROP TABLE IF EXISTS Player;
DROP TABLE IF EXISTS Roster;
DROP TABLE IF EXISTS Position;
DROP TABLE IF EXISTS Quarterback;
DROP TABLE IF EXISTS Runningback;
DROP TABLE IF EXISTS Widereceiver;
DROP TABLE IF EXISTS Tightend;

CREATE TABLE Team (
  team_name CHARACTER VARYING(50) NOT NULL,
  city CHARACTER VARYING(50) NOT NULL,
  coach CHARACTER VARYING(50) NOT NULL,
  wins INTEGER NOT NULL,
  losses INTEGER NOT NULL,
  ties INTEGER,

  PRIMARY KEY (team_name)
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

CREATE TABLE Position (
  abbreviation CHARACTER VARYING(2) NOT NULL,

  PRIMARY KEY (abbreviation)
);

CREATE TABLE Quarterback (
  abbreviation CHARACTER VARYING(2) NOT NULL,
  pass_yards INTEGER NOT NULL,
  pass_tds INTEGER NOT NULL,
  interceptions INTEGER NOT NULL,
  qb_rating NUMERIC(1) NOT NULL,

  PRIMARY KEY (abbreviation),
  FOREIGN KEY (abbreviation) REFERENCES Position (abbreviation)
        ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE Runningback (
  abbreviation CHARACTER VARYING(2) NOT NULL,
  rush_yards INTEGER NOT NULL,
  touchdowns INTEGER NOT NULL,
  fumbles INTEGER NOT NULL,
  carries INTEGER NOT NULL,

  PRIMARY KEY (abbreviation),
  FOREIGN KEY (abbreviation) REFERENCES Position (abbreviation)
        ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE Widereceiver (
  abbreviation CHARACTER VARYING(2) NOT NULL,
  rec_yards INTEGER NOT NULL,
  rec_tds INTEGER NOT NULL,
  receptions INTEGER NOT NULL,

  PRIMARY KEY (abbreviation),
  FOREIGN KEY (abbreviation) REFERENCES Position (abbreviation)
        ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE Tightend (
  abbreviation CHARACTER VARYING(2) NOT NULL,
  rec_yards INTEGER NOT NULL,
  rec_tds INTEGER NOT NULL,
  receptions INTEGER NOT NULL,

  PRIMARY KEY (abbreviation),
  FOREIGN KEY (abbreviation) REFERENCES Position (abbreviation)
        ON UPDATE CASCADE ON DELETE RESTRICT
);

SQL;

// normally only a single query is executed, but batch table creation
$connection->multi_query($tables)
    or die("Error: ".$connection->error);

// ensure that all the queries executed correctly
while ($connection->more_results())
  if (! $connection->next_result())
    echo "Error: ".$connection->error."\n";

$data = array(
  "INSERT INTO Team (team_name, city, coach, wins, losses, ties) VALUES ".
      "('Chiefs', 'Kansas City', 'Andy Reid', 12, 4, 0), ".
      "('49ers', 'San Francisco', 'Kyle Shanahan', '13', '3', '0');",
  "INSERT INTO Player (player_name, player_num, height, weight, yrs_pro) VALUES ".
      "('Patrick Mahomes', 15, '6-3', 230, 3), ".
      "('Jimmy Garappolo', 10, '6-2', 225, 5);",
/*
  "INSERT INTO Author (id, surname, given_name) VALUES ".
      "(52258, 'Gillenson', 'Mark'), ".
      "(15396, 'Silberschatz', 'Avi'), ".
      "(16617, 'Korth', 'Henry F.'), ".
      "(184154, 'Sudarshan', 'S.');",
  "INSERT INTO Writes (author_id, isbn) VALUES ".
      "(15396, '9780073523323'), ".
      "(16617, '9780073523323'), ".
      "(184154, '9780073523323'), ".
      "(52258, '9780470624708');",
*/
);

foreach ($data as $query) {
  if (! $connection->query($query))
    echo "Error: ".$connection->error."\n";
}

$connection->close();

// closing PHP tag intentionally omitted
