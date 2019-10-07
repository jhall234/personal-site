<!DOCTYPE html>
<html lang="en">

<head>
    <title>Drawing and Mouse Events</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Josh Hallinan" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../general_style.css">
</head>

<body>
	<?php 
		$title = "Drawing and Mouse Events";
		include '../templateHeader.php';
	?>
	<section id= "hello">
		<h2>HTML Canvas</h2>
		<canvas id="myCanvas" width="400" height="400"></canvas>
		<button id="canvasButton">Make me Sad</button>		
	</section>
    <?php include '../templateFooter.php';?>
	<script src="jsmouse.js"></script>
</body>

</html>