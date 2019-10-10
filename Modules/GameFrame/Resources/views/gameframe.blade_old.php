<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Maze</title>
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="viewport"
		content="user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, minimal-ui">
	<link rel="stylesheet" href="/maze/css/main.css" />
</head>

<body>
	<div class="modal_window">
		<div class="modal_window_container">
			<div class="input">
				<input type="number" id="width">
				<label for="width">Width</label>
			</div>
			<div class="input">
				<input type="number" id="height">
				<label for="height">Height</label>
			</div>
			<div class="input">
				<input type="number" id="camera-size" min="12">
				<label for="camera-size">camera size</label>
			</div>
			<button onclick="submitForm()">Send</button>
		</div>
	</div>

	<script>
		console.log("gameframe.OLD")
		let BasicGame = {
			orientated: false
		};
		function submitForm() {
			let width = document.body.querySelector('#width').value;
			let height = document.body.querySelector('#height').value;
			let cameraSize = document.body.querySelector('#camera-size').value;
			if (!(width & 1)) {
				width++
			}
			if (!(height & 1)) {
				height++
			}
			BasicGame.width = cameraSize * 32;
			BasicGame.height = cameraSize * 32;
			BasicGame.mapWidth = width * 32;
			BasicGame.mapHeight = height * 32;
			BasicGame.cameraSize = cameraSize;
			let xhr = new XMLHttpRequest();
			xhr.open("GET", `orthogonal?width=${width}&height=${height}`);
			xhr.onload = function (e) {
				if (xhr.readyState == 4 && xhr.status == 200) {

					BasicGame.dataJSON = xhr.responseText;
					let modal = document.body.querySelector('.modal_window');
					modal.remove();
					startGame();
				}
			};
			xhr.send(null);
		}
	</script>
	<script src="/maze/js/phaser.min.js"></script>
	<script src="/maze/js/pathfinding.js"></script>
	<script src="/maze/js/detect.js"></script>
	<script src="/maze/js/functions.js"></script>
</body>

</html>
