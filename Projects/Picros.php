<!DOCTYPE html>
<html>
<head>
	<title>Picros</title>
	<style type="text/css">
		.cell {
			width: 30px;
			height: 30px;
			background-color: black;
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
		}
	</style>
</head>
<body onload="makeTable()">
	<h1> Welcome to Picross-130 </h1>
    <div id="textOptions">
		<label>Size</label> 
		<select id="selectTable">
			<option value="7">7</option>
			<option value="13">13</option>	
		</select>
		<button onclick="makeTable()">NewTable</button>
	</div>
	<table id="tableCreate"></table>
	<script
			  src="https://code.jquery.com/jquery-3.3.1.min.js"
			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			  crossorigin="anonymous"></script>

	<script type="text/javascript">
		var sampleArray = [];
		var topNums = [];
		var sideNums = [];
		function makeTable() {
			$('#tableCreate').empty();
			var options = $('#selectTable option:selected');
			var values = $.map(options ,function(option) {
   		 		return option.value;
			});
			var tableSet = values;
			makePico(tableSet);
			$('#tableCreate').append("<tbody>");
			$('#tableCreate').append("<tr id=\"tr" + 0 + "" + 0 + "\"></tr>");
			$("#tr00").append("<td></td>");
			for (var i = 0; i < tableSet; i++) {
				$("#tr00").append("<td>" + 1+ "</td>");
			}
			for (var i = 0; i < tableSet; i++) {
				$('#tableCreate').append("<tr id=\"tr" + i + "\"></tr>");
				for(var j = 0; j < tableSet; j++) {
					if(j==0)  $("#tr"+i).append("<td>" + sideNums[i] + "</td>");
					$("#tr"+i).append("<td id=\"td" + i + "_" + j + "\" class=\"cell\" onclick=\"changeColor(" + i + "," + j + ")\"></td>");
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
				sampleArray[i] = []
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
			console.log(sampleArray);
			console.log(sideNums);
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
	</script>
</body>
</html>