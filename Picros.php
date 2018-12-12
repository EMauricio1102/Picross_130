<!DOCTYPE html>
<html>
<head>
	<title>Picros</title>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"
			integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			crossorigin="anonymous"></script>
	<style type="text/css">
		html body {
			margin: 0;
			padding: 0;
		}

		.cell {
			width: 30px;
			height: 30px;
		}

		.vertical-text {
			transform: rotate(90deg);
			transform-origin: left top 0;
		}

		body{
			font-family: Arial Helvetica, sans-serif;
			background-color: #24478f;
			color: white;
		}

		h1{
			font-size: 40px;
			font-family: Arial, Helvetica, sans-serif;
			text-align: center;
			text-decoration: underline;
		}
		h2{
			text-decoration: underline;
		}

		table{
			text-align: center;
			margin-left: auto;
			margin-right: auto;
			border-collapse: collapse;
		}

		.cell {
			border: 1px solid black;
		}

		.Timer, .ScoreBoard, .TotalBlocks{
			font-size: 20px;
			margin-left: 40%
		}

		.hidden td:hover {
			background-color: black;
		}

		.displayHint {
			width: 30px;
			height: 20px;
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
		#gameOptions{
			text-align: center;
			width: 175px;
			margin: 10px;
			padding: 20px;
			border-top-style: dotted;
			border-bottom-style: dotted;
			border-left-style: solid;
			border-right-style: solid;
			position: absolute;
		}
		#tableCreate{
			margin-top: 25px;	
		}

	</style>
</head>
<body onload="changeTableSize(7);makeTable()">

	
	<?php
		session_start();
		if(isset($_SESSION['user_name'])){
			$user = $_SESSION['user_name'];
			echo "<div class=\"topnav\">";
			echo "<a href=\"index.php\">Menu</a>";
			echo "<a class=\"active\" href=\"Picross.php\">Game</a>";
			echo "<a href=\"Tutorial.php\">Tutorial</a>";
			echo "<a href=\"leaderboard.php\">Leaderboards</a>";
			echo "<a href=\"logout.php\">Logout</a>";
			echo "<aside>".$user."</aside>";
			echo "</div>";
			echo "<img src=\"".$_SESSION['avatar']."\" height=\"50\" width=\"50\">";
			echo "<div class=\"Timer\">&emsp; &emsp;Time: &emsp; &emsp; 0 seconds</div>";
			echo "<div class=\"ScoreBoard\">Correct: 0 &emsp; &emsp; &emsp; Wrong: 0 </div>";
			echo "<div class=\"TotalBlocks\">Correct: 0 &emsp; &emsp; &emsp; Wrong: 0 </div>";
		} else {
			header("location: Login.php");
		}
	?>
	
	<!--Board Size options 7x7, 13x13-->
	<div id="gameOptions">
		<h2> Game Options </h2>
			<label>Size</label> 
			<select id="selectTable"  onChange="changeTableSize(this.options[this.selectedIndex].text);">
				<option value="7">7</option>
				<option value="13">13</option>	
			</select><br>
			<button onclick="pauseOff();makeTable()">New Random Game</button>
		<br><br>
		<!--Change Board -->
			<label><u>Board Color</u></label><br>
			<label>Red (0-255)  </label>
			<input class="floatLeft" type="number" id="red" name="red" min="0" max="255" value="255"><br><br>
			<label>Blue (0-255) </label>
			<input class="floatLeft" type="number" id="blue" name="red" min="0" max="255" value="255"><br><br>
			<label>Green (0-255)</label>
			<input class="floatLeft" type="number" id="green" name="red" min="0" max="255" value="255"><br><br>
			<button onclick="updateBlocks()">Update Picross Blocks</button><br>
			<button onclick="updateGrid()">Update Grid</button>
	</div>

	<div style="float: left; width:95%;margin:0;overflow: hidden;">
		<table id="tableCreate" align="center"></table>
	</div>

	<!--Picros Game Script-->
	<script type="text/javascript">
		<?php
			if (isset($_SESSION['user_name'])) {
				echo "var player_username = \"".$_SESSION['user_name']."\";";
			};
		?>
		//Grid variables
		var sampleArray = [];
		var topNums = [];
		var sideNums = [];
		var tableSize;
		var displayHintSize;
		//Color Vars
		var BlockR = BlockG = BlockB = 255;
		var GridR = GridG = GridB = 0;
		//Time Variables
		var totalTime = 0;
		var timer;
		//Game variables
		var totalWinSpace = 0;
		var Correct = 0;
		var Wrong = 0;
		var Score = 0;
		var BoardSize = 0;
		var pauseGame = true;
		var TotalBlocks;
		var Revealed = 0;
		//Adjust the table size from select option
		function changeTableSize(size) {
			tableSize = size;
			displayHintSize = tableSize/2;
		}

		//Unpause
		function pauseOff() { pauseGame = false;}

		//use JQuery add table rows and td to tableCreate id
		function makeTable() {
			$('#tableCreate').empty();

			makeRandomPico(tableSize);

			//Create table body with adjusted top and sides for displaying hints
			$('#tableCreate').append("<tbody>");
			for(var i = 0; i < displayHintSize; i ++) {
				$('#tableCreate').append("<tr id=\"tr" + 0 + "" + 0 + "" + i + "\"></tr>");
				for(var j = 0; j < displayHintSize; j++) {
					$("#tr00"+i).append("<td></td>");
				}
				for(var j = 0; j < tableSize; j++) {
					$("#tr00"+i).append("<td class=\"hintDisplay\" id=\"td00"+i+""+j+"\"></td>");
				}
			}

			//Display top hints (from top to bottom)
			for (var i = 0; i < tableSize; i++) {
				var topNumString = topNums[i].trim();
				var splitNums = topNumString.split(" ");
				var splitLength = splitNums.length;
				var adjustedHintNum = Math.floor(displayHintSize);
				for (var t = 0; t < splitLength; t++) {
					$("#td00"+(adjustedHintNum-t)+""+i).html(splitNums[(splitLength-t-1)]);
				}
			}

			//Display side hints (from left to right)
			for (var i = 0; i < tableSize; i++) {
				var sideNumsString = sideNums[i].trim();
				var splitNums = sideNumsString.split(" ");
				var splitLength = splitNums.length;
				$('#tableCreate').append("<tr id=\"tr" + i + "\"></tr>");
				for (var t = Math.floor(displayHintSize); t >= 0; t--) {
					if (t < splitLength) {
						$("#tr"+i).append("<td class=\"hintDisplay\">" + splitNums[(splitLength-t-1)] + "</td>");
					} else {
						$("#tr"+i).append("<td class=\"hintDisplay\"></td>");
					}
				}

				for(var j = 0; j < tableSize; j++) {
					$("#tr"+i).append("<td class=\"cell hidden\" id=\"td" + i + "_" + j + "\" onclick=\"changeColor(" + i + "," + j + ")\"></td>");
				}
			}
			$('#tableCreate').append("</tbody>");

			//Change table size on large tables
			if (tableSize > 10) {
				$(".cell").css("width", "20px");
				$(".cell").css( "height", "20px");
			}

			$('.hidden').css('background-color', 'rgb('+BlockR+','+BlockG+','+BlockB+')');
			$('.cell').css('border-color', 'rgb('+GridR+','+GridG+','+GridB+')');
			if(!pauseGame) start();
			$('.ScoreBoard').html("Correct: 0 &emsp; &emsp; &emsp; Wrong: 0");
			Correct = Wrong = 0;
			$('.TotalBlocks').html("Total Blocks: " + TotalBlocks + " &emsp; &emsp; Revealed: 0");
		}

		//Change color of cells on click
		function changeColor(i,j) {
			if(!pauseGame) {
				var colorIndex = "#td"+i+"_"+j;
				if($(colorIndex).hasClass('hidden')) {
					if (sampleArray[i][j]) {
						$(colorIndex).css("background-color", "blue");
						Correct++;
						if (Correct == totalWinSpace) {
							clearInterval(timer);
							var calcScore = Math.max(((BoardSize -Correct) - Wrong), 0)/(BoardSize -Correct);
							Score = (calcScore.toFixed(2) *100);
							$('.Timer').text("Final time: " + totalTime + " seconds");
							$('.TotalBlocks').text(" Score: " + Score);
							pauseGame = true;
							var winGameData = { 
								'player_username': player_username,
								'duration': totalTime,
								'errors': Wrong, 
								'levelsize': tableSize,
								'score': Score
							};

							console.log(winGameData);
							$.ajax({
								url: 'SaveGame.php',
								type: 'post',
								data: winGameData,
								success: function(data) {
									console.log("Saved!");
								},
								error: function(err) {
									console.log("Failed!");
								}
							});
						}
					} else {
						Wrong++;
						$(colorIndex).css("background-color", "silver");
						$(colorIndex).css("background-color", "grey");
						$(colorIndex).html("X");
						$(colorIndex).css("color", "red");
						$(colorIndex).css("text-align", "center");
						if(tableSize < 10) $(colorIndex).css("font-size", "25px");
						else $(colorIndex).css("font-size", "10px");
						Revealed++;
					}
					$(colorIndex).toggleClass('hidden');
					$('.ScoreBoard').html("Correct: " + Correct + " &emsp; &emsp; &emsp; Wrong: " + Wrong);
					if(!pauseGame) $('.TotalBlocks').html("Total Blocks: " + TotalBlocks + " &emsp; &emsp; Revealed: " + Revealed);
				}
			} else {
				alert("Please start a new game!");
			}
		}

		//Make a random Pico board
		function makeRandomPico(dimensions) {
			totalWinSpace = 0;
			for (var i = 0; i < dimensions; i++) {
				sampleArray[i] = [];
				for (var j = 0; j < dimensions; j++) {
					var hotSpot = Math.floor(Math.random() * Math.floor(2));
					if (hotSpot) {
						sampleArray[i][j] = hotSpot;
						totalWinSpace++;
					} else {
						sampleArray[i][j] = 0;
					}
				}
			}
			getSideNums(sampleArray);
			getTopNums(sampleArray);
			TotalBlocks = BoardSize = dimensions * dimensions;
		}

		//Get the consecutive numbers (left to right) as a string
		function getSideNums(PicoArray) {
			sideNums = [];
			for (var i = 0; i < PicoArray.length; i++) {
				sideNums[i] = "";
				var conNum = 0;
				for (var j = 0; j < PicoArray.length; j++) {
					if (sampleArray[i][j]) {
						conNum++;
						if (j == (PicoArray.length-1)) {
								sideNums[i] +=  conNum + " ";
								conNum = 0;
						}
					} else {
						if (conNum > 0) {
							sideNums[i] +=  conNum + " ";
							conNum = 0;
						}
					}
				}
				if (sideNums[i] == "") {
					sideNums[i] = "0";
				}
			}
		}

		//Get consecutive numbers (top to bottom) as a string
		function getTopNums(PicoArray) {
			topNums = [];
			for (var i = 0; i < PicoArray.length; i++) {
				topNums[i] = "";
				var conNum = 0;
				for (var j = 0; j < PicoArray.length; j++) {
					if (sampleArray[j][i]) {
						conNum++;
						if (j == (PicoArray.length-1)) {
								topNums[i] +=  conNum + " ";
								conNum = 0;
						}
					} else {
						if (conNum > 0) {
							topNums[i] +=  conNum + " ";
							conNum = 0;
						}
					}
				}
				if (topNums[i] == "") {
					topNums[i] = "0";
				}
			}
		}

		//Update Block Color
		function updateBlocks(){
			BlockR = $('#red').val();
			BlockG = $('#green').val();
			BlockB = $('#blue').val();

			$('.hidden').css('background-color', 'rgb('+BlockR+','+BlockG+','+BlockB+')');
		}

		//Update Grid Color
		function updateGrid() {
			GridR = $('#red').val();
			GridG = $('#green').val();
			GridB = $('#blue').val();

			$('.cell').css('border-color', 'rgb('+GridR+','+GridG+','+GridB+')');
		}

		//Toggle the timer
		function start() {
			$('.Timer').html("&emsp; Time: &emsp; &emsp; 0 seconds");
			clearInterval(timer);
			var start = new Date;

			timer = setInterval(function() {
				totalTime = Math.round((new Date - start) / 1000);
    			$('.Timer').html("&emsp; Time: &emsp; &emsp;" + totalTime + " seconds");
			}, 1000);
		}
	</script>
</body>
</html>