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
			background-color: black;
		}

		.cell:hover {
			background-color: #67C8FF;
		}

		.vertical-text {
			transform: rotate(90deg);
			transform-origin: left top 0;
		}

		body{
			background-color: #24478f;
			color: white;
		}

		h1{
			font-size: 40px;
			font-family: Arial, Helvetica, sans-serif;
			text-align: center;
			text-decoration: underline;
		}

		#textOptions{
			text-align: center;
			padding-bottom: 50px;
		}

		table{
			margin-left: auto;
			margin-right: auto;
			border-collapse: collapse;
		}

		.cell {
			border: 1px solid white;
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
	</style>
</head>
<body onload="changeTableSize(7);makeTable()">

	
	<?php
		session_start();
		if(isset($_SESSION['user_name'])){
			$user = $_SESSION['user_name'];
			echo "<div class=\"topnav\">";
			echo "<a class=\"active\" href=\"#Game\">Game</a>";
			echo "<a href=\"#Tuts\">Tutorial</a>";
			echo "<aside>".$user."</aside>";
			echo "</div>";
			echo "<h1> Welcome to Picross-130, ". $_SESSION['user_name'] ."! </h1>";
		} else {
			header("location: Login.php");
		}
	?>
	
    <div id="textOptions">
		<label>Size</label> 
		<select id="selectTable"  onChange="changeTableSize(this.options[this.selectedIndex].text);">
			<option value="7">7</option>
			<option value="13">13</option>	
		</select>
		<button onclick="makeTable()">NewTable</button>
	</div>
	<table id="tableCreate"></table>

	<script type="text/javascript">
		var sampleArray = [];
		var topNums = [];
		var sideNums = [];
		var tableSize;
		var displayHintSize;

		function changeTableSize(size) {
			tableSize = size;
			displayHintSize = tableSize/2;
		}

		function makeTable() {
			$('#tableCreate').empty();

			makePico(tableSize);

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

			for (var i = 0; i < tableSize; i++) {
				var topNumString = topNums[i].trim();
				var splitNums = topNumString.split(" ");
				var splitLength = splitNums.length;
				var adjustedHintNum = Math.floor(displayHintSize);
				for (var t = 0; t < splitLength; t++) {
					$("#td00"+(adjustedHintNum-t)+""+i).html(splitNums[(splitLength-t-1)]);
				}
			}

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
					$("#tr"+i).append("<td class=\"cell\" id=\"td" + i + "_" + j + "\" onclick=\"changeColor(" + i + "," + j + ")\"></td>");
				}
			}
			$('#tableCreate').append("</tbody>");
		}

		function changeColor(i,j) {
			var colorIndex = "#td"+i+"_"+j;
			if (sampleArray[i][j]) {
				$(colorIndex).css("background-color", "blue");
			} else {
				$(colorIndex).css("background-color", "grey");
			}
		}

		function makePico(dimensions) {

			hotSpoints = dimensions * (dimensions/3);

			for (var i = 0; i < dimensions; i++) {

				sampleArray[i] = [];

				for (var j = 0; j < dimensions; j++) {
					var hotSpot = Math.floor(Math.random() * Math.floor(2));
					if (hotSpot && hotSpoints > 0) {
						sampleArray[i][j] = hotSpot;
						hotSpoints--;
					} else {
						sampleArray[i][j] = 0;
					}
				}
			}

			getSideNums(sampleArray);
			getTopNums(sampleArray);
		}

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
	</script>
</body>
</html>