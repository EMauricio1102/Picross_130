<?php
require_once 'config_mysql.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$player_username = $mysqli->real_escape_string($_POST['player_username']);
	$errors = $_POST['errors'];
	$duration = $_POST['duration'];
	$levelsize = $_POST['levelsize'];					
 	$score = $_POST['score'];

 	$sql = "INSERT INTO Games (player_username, duration, errors, levelsize, score) VALUES ('$player_username', $duration, $errors, $levelsize, $score)";
 	echo $sql;
 	$mysqli->query($sql);
}

?>