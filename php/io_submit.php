<!DOCTYPE html>
<html lang="en">

<head>
    <title>Form</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Josh Hallinan" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../general_style.css">
    <link rel="stylesheet" type="text/css" href="php_style.css">
</head>

<body>
    <?php	
		$title = "File I/O";
        include '../templateHeader.php';        
	?>
    <?php 
    $first = $_POST["first"];
    $last = $_POST["last"];
    $email = $_POST["email"];
    $instrument = $_POST["instrumentlist"];
    $quantity = $_POST["quantity"];
    $unit_price = 0;
    $donation = 0;
    switch ($instrument) { 
        case "/images/clarinet.jpg": 
            $instrument = "Clarinet";
            $unit_price = 25.00;
            break;
        case "/images/flute.jpg":
            $instrument = "Flute";
            $unit_price = 25.00;
            break;
        case "/images/saxophone.jpg": 
            $instrument = "Saxophone";
            $unit_price = 45.00;
            break;
        case "/images/trumpet.jpg": 
            $instrument = "Trumpet";
            $unit_price = 25.00;
            break;
        case "/images/french_horn.jpg": 
            $instrument = "French Horn";
            $unit_price = 50.00;
            break;
        case "/images/trombone.jpg": 
            $instrument = "Trombone";
            $unit_price = 30.00;
            break;
        case "/images/tuba.jpg": 
            $instrument = "Tuba";
            $unit_price = 60.00;
            break;
        default:
            $instrument = "No instrument selected";
    }
    $subtotal = $quantity*$unit_price;
    $tax = $subtotal*0.07;
    $total = $subtotal + $tax;
    if ($_POST["donation"] == "donate"){
        $donation = ceil($total) - $total;
    }
    $total  = $total + $donation;
    date_default_timezone_set("America/Denver");
    $myfile = fopen("orders.csv", "a");
    
    
   
    $txt = $first . ' ' . $last . ',' . date(" l M d, Y h:i a") . ',' . $instrument . ',' . $quantity . ',' .number_format($total, 2). "\r\n";
    fwrite($myfile, $txt);
    echo "<h2>Music Instrument Rental</h2>";
    echo '<section id="contact">';
        echo '<section id="contact_label">';
        echo "<p>First Name:</p>";
        echo "<p>Last Name:</p>";
        echo "<p>Email:</p>";
        echo "</section>";

        echo '<section id="submitted_contact">';
        echo "<p>".$first."</p>";
        echo "<p>".$last."</p>";
        echo "<p>".$email."</p>";
        echo "</section>";
    echo "</section>";

    echo '<section id="pricing">';
        echo '<section id="pricing_label">';
        echo "<p>Instrument:</p>";
        echo "<p>Price Per Unit:</p>";
        echo "<p>Quantity:</p>";
        echo "<p>Subtotal:</p>";
        echo "<p>Tax:</p>";
        echo "<p>Donation:</p>";
        echo "<p>Total:</p>";
        echo "</section>";

        echo '<section id="submitted_pricing">';
        echo "<p>".$instrument."</p>";
        echo "<p>".$unit_price."</p>";
        echo "<p>".$quantity."</p>";
        echo "<p>$".number_format($subtotal,2)."</p>";
        echo "<p>$".number_format($tax,2)."</p>";
        echo "<p>$".number_format($donation,2)."</p>";
        echo "<p>$".number_format($total,2)."</p>";
        echo "</section>";
    echo "</section>";
    echo "<br>";

    echo '<p class="bold">Thank you for ordering! Click here to <a href="vieworders.php">view all orders</a></p>';
    echo "<br>";    
    ?>
    <?php include '../templateFooter.php';?>
</body>
</html>