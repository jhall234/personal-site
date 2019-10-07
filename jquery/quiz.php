<!DOCTYPE html>
<html lang="en">

<head>
    <title>JQuery</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Josh Hallinan" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../general_style.css">	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
	<?php 
		$title = "High School Knowledge Quiz";
		include '../templateHeader.php';
	?>
	<section class="main">
		<aside>
				<h2>Questions Answered</h2>		
				<ul id="answer_list"></ul>
		</aside>
		
		<article class="quiz">
		
			
			<h2>Question</h2>
			<section id="question_box">
				<p id="question"></p>
			</section>
			<h2>Answer</h2>
			<section id="answer">
				<form>
					<div class="radio_button">
						<input type="radio" id="true" 
							   name="answer" value="true">
						<label for="true">True</label>
					</div>

					<div class="radio_button">
						<input type="radio" id="false" 
						   name="answer" value="false" />
						<label for="false">False</label>
					</div>
				</form>
				<button id="check_answer">Check Answer</button>
				<p id="no_answer"></p>
			</section>
						
			<section class="question_number">
				<button class="question_number" id="math">Math</button>
				<button class="question_number" id="science">Science</button>
				<button class="question_number" id="history">History</button>
				<button class="question_number" id="english">English</button>
			</section>
		</article>
	</section>
	<div id="game_over"><p id="game_over_text">Game Over</p></div>
	
    <?php include '../templateFooter.php';?>
	<script src="quiz.js"></script>
</body>

</html>