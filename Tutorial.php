<!DOCTYPE html>
<html>
	<head>
		<title> Picross Tutorial </title>
		<style>
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
				echo "<a href=\"Picros.php\">Game</a>";
				echo "<a class=\"active\" href=\"Tutorial.php\">Tutorial</a>";
				echo "<aside>".$user."</aside>";
				echo "</div>";
			} else {
				header("location: Login.php");
			}
		?>
		<h1> How to Play Picross </h1>
			<h2> What Is Picross? </h2>
				<p> Picross is a mix between sudoku and minesweeper. </p> 
				<p> The numbers on the axis let you, the player, know where each blue (correct) square is in consecutive order.
				Your job is to find those squares within the grid without triggering any gray (incorrect) squares. </p>
				<p> If there set of numbers on top of one another in each of the axis, that means there are multiple groups of blue squares
				separated by atleast one grey square. </p>
			<h2> How To Solve A Row. </h2>
				<p> There are a few circumstances that you could come across when approaching to solve this puzzle. 
				When viewing a single row of the entire graph you could either come across: </p>
				<h3> Empty Row </h3> 
					<p> If the number on the x-axis is 0, that means that there are no blue squares in the entirety of that row,
					and it should be left blank in order to avoid any grey squares. Keep this in mind when approaching the graph along the y-axis. </p>
				<h3> Single Number Row </h3>
					<p> If the number on the x--axis is anything but 0, that means there are 'n' numbers of blue squares in consecutive order within that row. 
				<h3> Multple Numbers Row </h3>
					<p> If there are multiple numbers labling a single row along the x-axis that means there are different sets of blue squares in conesecutive order
					according to the numbers labled on that row. </p>
					<p> Lets say a row is labeled "1 | 4 | 3". What you want to do to calculate the position of the blue squares is to add up all of the numbers plus 1
					for each white square in between and you'll get the total number of squares (which is 10) in that row which can be filled in one way. 
			<h2> Tips And Tricks </h2>
				<h3> Overlapping </h3> 
					<p> Overlapping is when you put a number of conesecutive blue squares along one side of the row and if there is the same number of blue squares a row above or beloe
					then you would set those consecutive blue squares along the other side of that row. This means that the number of squares in the middle will be filled in no matter where 
					the other blue squares are. 
					<p> Overlapping is utilized when you have trouble thinking about where the squares are in terms of the side of the grid at the beginning of the puzzle. 
				<h3> On Edge </h3>
					<p> There are some instances within Picross where overlapping may not work. This is when a number is smaller than the number of squares on the row. What you could do here is 
					to place the number of blue squares along the far right side of the grid, filling out the edge from right to left the number of blue squares labeled. 
				<h3> Marking Before Placing </h3> 
					<p> In Picross, you could add Xs in areas where you believe grey squares might be. This is so you could mark out your strategy before placing your answer. By adding marks,
					you could completely avoid any errors that you could come across when solving the puzzle. 
	</body>
</html>