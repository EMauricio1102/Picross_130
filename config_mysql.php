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

$createPlayers = "CREATE TABLE IF NOT EXISTS Players (
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
$createGames = "CREATE TABLE IF NOT EXISTS Games (
					id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
					player_username VARCHAR(30),
					duration VARCHAR(255),
					errors INT(6) UNSIGNED,
					levelsize VARCHAR(10),	
					score INT(6)
				)";
$createLevels = "CREATE TABLE IF NOT EXISTS Levels(
					id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,	
					levels text
				)";
$mysqli->query($createPlayers);
$mysqli->query($createGames);
$mysqli->query($createLevels);
?>