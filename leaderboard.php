<!DOCTYPE html>
<html>
	<head>
		<title> index </title>
		<style>
			html body {
				margin: 0;
				padding: 0;
			}
			body{
				font-family: Arial Helvetica, sans-serif;
				color: white;
				background-color: #24478f;
			}
			.topnav {
				margin: 0;
				padding: 0;
				overflow: hidden;
				background-color: #173048;
			}
			.topnav a {
			  float: right;
			  color: #f2f2f2;
			  text-align: center;
			  padding: 14px 16px;
			  text-decoration: none;
			  font-size: 17px;
			}
			.topnav aside {
				float: left;
				color: #f2f2f2;
				text-align: center;
				padding: 14px 16px;
				text-decoration: none;
				font-size: 17px;
			}
			.topnav a:hover {
			  background-color: #ddd;
			  color: black;
			}
			.topnav a.active {
			  background-color: #21b0f1;
			  color: white;
			}
			table, th, td {
				border: 1px solid white;
				border-collapse: collapse;
			}
		</style>
	</head>
	<body>
		<?php
			//Config file
			require_once 'config_mysql.php';
			session_start();
			if(isset($_SESSION['user_name'])){
				$user = $_SESSION['user_name'];
				echo "<div class=\"topnav\">";
				echo "<a href=\"index.php\">Menu</a>";
				echo "<a href=\"Picros.php\">Game</a>";
				echo "<a href=\"Tutorial.php\">Tutorial</a>";
				echo "<a href=\"customize.php\">Customize</a>";
				echo "<a class=\"active\" href=\"leaderboard.php\">Leaderboards</a>";
				echo "<a href=\"logout.php\">Logout</a>";
				echo "<aside>".$user."</aside>";
				echo "</div>";
			} else {
				header("location: Login.php");
			}

			//make tables

			$getScoreBySeven = "select 10 from games where levelsize = 7 order by score";
			$results = $mysqli->query($getScoreBySeven);
			if($results->num_rows > 0) {
				echo "<table>";
				echo "<tr><th>Player</th><th>Level</th><th>Score</th><tr>";
				while($row = $results->fetch_assoc()) {
					echo "<tr><td>".$row['player_username']."</td>";
					echo "<td>".$row['levelsize']."x".$row['levelsize']."</td>";
					echo "<td>".$row['score']."</td></tr>";
				}
				echo "</table>";
			}
		?>	
		<img src="image/ChefBoyRD.jpeg" height="50" width="50">
	</body>
</html>