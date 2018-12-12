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
		</style>
	</head>
	<body>
		<?php
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
		?>	
		<img src="image/ChefBoyRD.jpeg" height="50" width="50">
	</body>
</html>