<?php
/* Database credentials.*/
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'password');
define('DB_NAME', 'picross');

//Connect to MySQL database
$mysqli = mysqli_connect("localhost", "root", "mypass123", "accounts");

//Check connection
if ($mysqli === false) {
	die("Error: Could not connect. " . mysqli_connect_error());
}

?>