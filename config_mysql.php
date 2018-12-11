<?php
/* Database credentials.*/
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'mypass123');
define('DB_NAME', 'accounts');

//Connect to MySQL database
$mysqli = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

//Check connection
if ($mysqli === false) {
	die("Error: Could not connect. " . mysqli_connect_error());
}

?>