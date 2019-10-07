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
		$title = "Form Processing Submitted";
        include '../templateHeader.php';        
	?>
    <?php 
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
    ?> 
    Order Submitted By: <?php echo $_POST["first"];?> <?php echo $_POST["last"];?><br>
    Order Submitted At: <?php 
            date_default_timezone_set("America/Denver");    
            echo date(" l M d, Y h:i a"); 
    ?><br>
    Instrument Purchased: <?php echo $instrument;?><br>
    Price Per Unit: <?php echo '$' . number_format($unit_price, 2);?><br>
    Quantity: <?php echo $quantity;?><br>
    Subtotal: <?php echo '$' . number_format($subtotal, 2);?><br>
    Tax: <?php echo '$' . number_format($tax, 2);?> <br>
    Donation: <?php echo '$'. number_format($donation, 2);?><br>
    Total: <?php echo '$' . number_format($total, 2);?>
    <?php include '../templateFooter.php';?>
</body>
</html>