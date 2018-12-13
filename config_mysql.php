<?php
/* Database credentials.*/
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'password');
define('DB_NAME', 'DBGarzaMaurico');

//Configure DB
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE DBGarzaMaurico";
$conn->query($sql);
$conn->close();


//Connect to MySQL database
$mysqli = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

//Check connection
if ($mysqli === false) {
	die("Error: Could not connect. " . mysqli_connect_error());
}

$createPlayers = "CREATE TABLE Players (
					id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
					username VARCHAR(30) NOT NULL UNIQUE,
					firstname VARCHAR(30) NOT NULL,
					lastname VARCHAR(30) NOT NULL,
					email VARCHAR(50),
					age INT(6) UNSIGNED,
					gender VARCHAR(1),
					location VARCHAR(100),
					password VARCHAR(255),
					avatar VARCHAR(100),
					reg_date TIMESTAMP
				)";
$createGames = "CREATE TABLE Games (
					id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
					player_username VARCHAR(30),
					duration VARCHAR(255),
					errors INT(6) UNSIGNED,
					levelsize VARCHAR(10),	
					score INT(6)
				)";
$createLevels = "CREATE TABLE Levels(
					id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,	
					levels text
				)";
if($mysqli->query($createPlayers)) {
	$insert1 = "INSERT INTO Players (username, firstname, lastname, email, age, gender, location, password, avatar) "
						. "VALUES ('JohnDoe', 'John', 'Doe', 'example@example.com', 20, 'M', 'US', 'example', 'image/example.jpg')";
	$insert2 = "INSERT INTO Players (username, firstname, lastname, email, age, gender, location, password, avatar) "
						. "VALUES ('JaneDoe', 'Jane', 'Doe', 'example2@example2.com', 20, 'F', 'US', 'example2', 'image/example2.jpg')";
	$mysqli->query($insert1);
	$mysqli->query($insert2);

};
if($mysqli->query($createGames)) {
	$insertGame1 = "INSERT INTO Games (player_username, duration, errors, levelsize, score) VALUES ('John', '100', '10', '7', '40')";
	$mysqli->query($insertGame1);
	$insertGame2 = "INSERT INTO Games (player_username, duration, errors, levelsize, score) VALUES ('Bob', '65', '15', '7', '20')";
	$mysqli->query($insertGame2);
	$insertGame3 = "INSERT INTO Games (player_username, duration, errors, levelsize, score) VALUES ('Jane', '100', '15', '7', '10')";
	$mysqli->query($insertGame3);
	$insertGame4 = "INSERT INTO Games (player_username, duration, errors, levelsize, score) VALUES ('John', '100', '12', '7', '20')";
	$mysqli->query($insertGame4);
	$insertGame5 = "INSERT INTO Games (player_username, duration, errors, levelsize, score) VALUES ('Jane', '100', '4', '7', '30')";
	$mysqli->query($insertGame5);
	$insertGame6 = "INSERT INTO Games (player_username, duration, errors, levelsize, score) VALUES ('Jill', '100', '53', '7', '25')";
	$mysqli->query($insertGame6);
	$insertGame7 = "INSERT INTO Games (player_username, duration, errors, levelsize, score) VALUES ('Joe', '100', '2', '7', '37')";
	$mysqli->query($insertGame7);
	$insertGame8 = "INSERT INTO Games (player_username, duration, errors, levelsize, score) VALUES ('July', '100', '4', '7', '5')";
	$mysqli->query($insertGame8);
	$insertGame9 = "INSERT INTO Games (player_username, duration, errors, levelsize, score) VALUES ('Jordan', '100', '5', '7', '10')";
	$mysqli->query($insertGame9);
	$insertGame10 = "INSERT INTO Games (player_username, duration, errors, levelsize, score) VALUES ('Beast', '100', '1', '7', '40')";
	$mysqli->query($insertGame10);
	$insertGame11 = "INSERT INTO Games (player_username, duration, errors, levelsize, score) VALUES ('Sam', '100', '4', '13', '21')";
	$mysqli->query($insertGame11);
	$insertGame12 = "INSERT INTO Games (player_username, duration, errors, levelsize, score) VALUES ('Jill', '100', '43', '13', '23')";
	$mysqli->query($insertGame12);
	$insertGame13 = "INSERT INTO Games (player_username, duration, errors, levelsize, score) VALUES ('John', '100', '23', '13', '9')";
	$mysqli->query($insertGame13);
	$insertGame14 = "INSERT INTO Games (player_username, duration, errors, levelsize, score) VALUES ('John', '100', '1', '13', '24')";
	$mysqli->query($insertGame14);
	$insertGame15 = "INSERT INTO Games (player_username, duration, errors, levelsize, score) VALUES ('John', '100', '5', '13', '14')";
	$mysqli->query($insertGame15);
	$insertGame16 = "INSERT INTO Games (player_username, duration, errors, levelsize, score) VALUES ('John', '100', '23', '13', '5')";
	$mysqli->query($insertGame16);
	$insertGame17 = "INSERT INTO Games (player_username, duration, errors, levelsize, score) VALUES ('Bobby', '100', '43', '13', '15')";
	$mysqli->query($insertGame17);
	$insertGame18 = "INSERT INTO Games (player_username, duration, errors, levelsize, score) VALUES ('Bobby', '100', '12', '13', '13')";
	$mysqli->query($insertGame18);
	$insertGame19 = "INSERT INTO Games (player_username, duration, errors, levelsize, score) VALUES ('Tim', '100', '4', '13', '40')";
	$mysqli->query($insertGame19);
	$insertGame20 = "INSERT INTO Games (player_username, duration, errors, levelsize, score) VALUES ('Jake', '100', '5', '13', '40')";
	$mysqli->query($insertGame20);
};
if($mysqli->query($createLevels)) {
	$insertLevel1 = "INSERT INTO Levels (levels) VALUES ('0101010 1010101 0101010 0101010 1010101 0101010 1010101')";
	$mysqli->query($insertLevel1);
};
?>