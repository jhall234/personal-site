<header class="bg">
	<h1><?php echo $title; ?></h1>        
</header>
<hr>
<nav class="navbar">
	<a <?php if($title == "Josh Hallinan's Website") {echo 'class="active"';}?> href="/index.php">Home</a>
	<a <?php if($title == "All About Josh Hallinan") {echo 'class="active"';}?> href="/aboutme/aboutme.php">About Me</a>
	<div class="dropdown">
		<button class="css_button">CSS Tutorial</button>
		<div class="dropdown_content">				
			<a href="/csstutorials/turtlecoders.html">Turtle Coders</a>
			<a href="/csstutorials/posEx.html">Position Example</a>
			<a href="/csstutorials/floatExBoxes.html">The Box Model</a>
			<a href="/csstutorials/clearEx.html">Float and Clear</a>
		</div>
	</div>
	<div class="dropdown">
		<button class="css_button">JavaScript</button>
		<div class="dropdown_content">
			<a <?php if($title == "Image Movement") {echo 'class="active"';}?> href="/javascript/jskeyboard.php">Image Movement</a>
			<a <?php if($title == "Drawing and Mouse Events") {echo 'class="active"';}?> href="/javascript/jsmouse.php">Drawing/Mouse Events</a>		
		</div>
	</div>
	<a href="/jquery/quiz.php">JQuery</a>
	<div class="dropdown">
		<button class="css_button">PHP</button>
		<div class="dropdown_content">				
			<a <?php if($title == "Form") {echo 'class="active"';}?> href="/php/form.php">Form</a>
			<a <?php if($title == "File I/O") {echo 'class="active"';}?> href="/php/io.php">File I/O</a>
			<a <?php if($title == "View Orders") {echo 'class="active"';}?> href="/php/vieworders.php">View Orders</a>			
		</div>
	</div>
	<div class="dropdown">
		<button class="css_button">MySQL</button>
		<div class="dropdown_content">				
			<a <?php if($title == "Shop") {echo 'class="active"';}?> href="/mysql/orderform.php">Shop</a>
			<a <?php if($title == "All Orders") {echo 'class="active"';}?> href="/mysql/allorders.php">All Orders</a>						
		</div>
	</div>
	<div class="dropdown">
		<button class="css_button">AJAX</button>
		<div class="dropdown_content">				
			<a <?php if($title == "Ajax Shop") {echo 'class="active"';}?> href="/ajax/orderform.php">Shop</a>
			<a <?php if($title == "Ajax All Orders") {echo 'class="active"';}?> href="/ajax/allorders.php">All Orders</a>						
		</div>
	</div>		
</nav>
<hr>
