<!DOCTYPE html>
<html lang="en">

<head>
    <title>Image Movement</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Josh Hallinan" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../general_style.css">
</head>

<body>
    <?php
        $title = "Image Movement";
        include '../templateHeader.php';
    ?>
	<section id= "hello">
		<canvas id="myCanvas" width="400" height="400"></canvas>
	</section>
    <?php include '../templateFooter.php';?>
    <script src="jskeyboard.js"></script>
</body>

</html>