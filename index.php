<!DOCTYPE html>
<html>
	<head>
		<title> index </title>
		<style>
			body{
				font-family: Arial Helvetica, sans-serif;
				color: white;
				background-color: #24478f;
			}
			h1{
				font-size: 75px;
				text-decoration: underline;
			}
			#Title{
				padding-top: 150px;
				text-align: center;
			}
			#buttons{
				text-align: center;
			}
			.b1, .b2, .b3, .b4{
				width: 300px;
				padding: 20px;
				cursor: pointer;
				font-weight: bold;
				font-size: 150%;
				background: #3366cc;
				color: #fff;
				border: 1px solid #3366cc;
				border-radius: 10px;
				-moz-box-shadow:: 6px 6px 5px #999;
				-webkit-box-shadow:: 6px 6px 5px #999;
				box-shadow:: 6px 6px 5px #999;
			}
			.b5{
				width: 300px;
				padding: 10px;
				cursor: pointer;
				font-size: 75%;
				background: red;
				color: #fff;
				border: 1px solid #3366cc;
				border-radius: 10px;
				-moz-box-shadow:: 6px 6px 5px #999;
				-webkit-box-shadow:: 6px 6px 5px #999;
				box-shadow:: 6px 6px 5px #999;
			}
			
		</style>
	</head>
	<body>
		<div id="Title">
			<h1> WELCOME TO PICROSS-130 </h1>
		</div>
		<form id="buttons">
			<a href="picros.php" class="b1">Play Game</a>
			<a href="Tutorial.php" class="b2">Tutorial</a>
			<a href="leaderboard.php" class="b4">Leaderboards</a>
		</form>
	</body>
</html>