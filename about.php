<!DOCTYPE html>
<html>
	<head>
		<title> Picross Tutorial </title>
		<style>
			html body {
				margin: 0;
				padding: 0;
			}
			h1 { 
				text-align: center;
				text-decoration: underline;
			}
			h2 {
				background-color: #00aeff; 
				padding: 10px;
			}
			h3{
				text-decoration: underline;
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
				echo "<a href=\"leaderboard.php\">Leaderboards</a>";
				echo "<a class=\"active\" href=\"about.php\">About Us</a>";
				echo "<a href=\"logout.php\">Logout</a>";
				echo "<aside>".$user."</aside>";
				echo "</div>";
				echo "<img src=\"".$_SESSION['avatar']."\" height=\"50\" width=\"50\">";
			} else {
				header("location: Login.php");
			}
		?>	
		<h1> About Us </h1>
			<h3> Robert Garza </h3>
			<p> I am a senior set to graduate in Spring 2019. I enjoy web development and have recently started using Laravel to develop websites. I plan to make a portfolio website during the winter break using Laravel and hosting on heroku.</p>
			<p>I love video games, and I like me a good meme!</p>
			<h3> Ernest Mauricio </h3>
			<p> A little bit about myself. I am a fourth year student expected to graduate Fall of 2019. 
			This is my first time learning anything about web development and design. I like to play video
			games and was recently exposed to video game development in software engineering. I don't have 
			a specific number of favorite games as I like a wide variety of video games. </p>
			<p> In regards to web development and this project, I can say that I personally need more work in understanding 
			all these different platforms of web programming. Patienced tested, my partner/mentor during this project development, Robert Garza, 
			carried most if not the entirety of this project while I worked mostly on the CSS and decorative portions of the project.</p>
			
	</body>
</html>