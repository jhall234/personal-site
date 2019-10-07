<!DOCTYPE html>
<html lang="en">

<head>
    <title>Form</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Josh Hallinan" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../general_style.css">
    <link rel="stylesheet" type="text/css" href="ajax_style.css">
</head>

<body>
    <?php	
		$title = "Form Processing Submitted";
        include '../templateHeader.php';        
    ?>
    <?php
        //NOTE: I am using XAMPP Server to connect to MYSQLi
        $servername = "localhost";
        $username = "root";
        $password = "";

        // Create connection
        $conn = new mysqli($servername, $username, $password);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }        
        //Prepare query to get stock from database 
        $stmtGetStock = $conn->prepare("SELECT quantity FROM store.products WHERE productname = ?");
        $stmtGetStock->bind_param("s", $instrument);
        
        //preapare the Customer SQL query
        $stmtCustomer = $conn->prepare("INSERT INTO store.customers (FirstName, LastName, Email)
        VALUES (?,?,?)");
        $stmtCustomer->bind_param("sss", $first, $last, $email);

        //preapare the Order SQL query
        $stmtOrder = $conn->prepare("INSERT INTO store.orders (CustomerID, ProductName, Quantity, Tax, Donation)
        VALUES (?,?,?,?,?)");
        $stmtOrder->bind_param("isidd", $customerID, $instrument, $quantity, $tax, $donation);

        //Update the stock after an order
        $stmtUpdateStock = $conn->prepare("UPDATE store.products SET quantity = ? WHERE productname = ?");
        $stmtUpdateStock->bind_param("is", $newQuantity, $instrument); 

        //Prepare query to check duplicate orders
        $stmtCheckDuplicate = $conn->prepare("SELECT ordertime FROM store.orders WHERE customerid = ? 
        AND productname = ? AND quantity = ? AND donation = ?");
        $stmtCheckDuplicate->bind_param("isid", $customerID, $instrument, $quantity, $donation); 

    ?>
    <?php 
    $first = filter_var($_POST["first"], FILTER_SANITIZE_STRING);
    $last = filter_var($_POST["last"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $instrument = $_POST["instrumentlist"];    
    $quantity = filter_var($_POST["quantity"], FILTER_SANITIZE_NUMBER_INT);
    
    //see if first, last and email name match a pre-existing name in database
    $sql = 'SELECT customerid FROM store.customers WHERE firstname ="'.$first.'" AND lastname ="'.$last.'" AND email = "'.$email.'"';    
    $customerID = mysqli_query($conn, $sql);
    $customerID = $customerID->fetch_assoc();
    $customerID = $customerID["customerid"];
    
    if(!$customerID){
        $stmtCustomer->execute();
        $customerID = mysqli_query($conn, $sql);
        $customerID = $customerID->fetch_assoc();
        $customerID = $customerID["customerid"];
        echo "<h3>Welcome New Customer!!</h3>";       
    }
    else {
        echo "<h3>Thanks for shopping again with us!</h3>";
    }
        
    $sql = 'SELECT productname FROM store.products WHERE productimage ="'.$instrument.'"';
    $instrument = mysqli_query($conn, $sql);
    $instrument = $instrument->fetch_assoc();
    $instrument = $instrument["productname"];
        
    $sql = 'SELECT price FROM store.Products WHERE ProductName ="'.$instrument.'"';
    $unit_price = mysqli_query($conn, $sql);
    $unit_price = $unit_price->fetch_assoc();
    $unit_price = $unit_price["price"];
    
    $donation = 0;       
    $subtotal = $quantity*$unit_price;
    $tax = $subtotal*0.07;
    $total = $subtotal + $tax;
    
    if ($_POST["donation"] == "donate"){
        $donation = ceil($total) - $total;
    }

    //Calculate total and insert order information to database
    $total  = $total + $donation;
    
    //Checks if the customer id, instrument, quantity and donation are equal to an existing database entry. 
    $stmtCheckDuplicate->execute();
    $result = $stmtCheckDuplicate->get_result();    
    if ($result->num_rows > 0){        
            echo '<script>            
            alert("ERROR : Sorry, but this seems to be a duplicate order.");
            window.location.href="orderform.php";
            </script>';
    }

    $stmtGetStock->execute();
    $result = $stmtGetStock->get_result();
    $row = $result->fetch_assoc();
    $newQuantity = $row["quantity"];
    $newQuantity -= $quantity;

    $stmtOrder->execute();
    //make sure user can't order more than what's in stock
    if ($newQuantity >= 0){
        $stmtUpdateStock->execute();        
        echo "Order Submitted By: ".$first." ".$last."<br>";
        echo "Order Submitted At: ".date(" l M d, Y h:i a")."<br>";
        echo "Instrument Purchased: ".$instrument."<br>";
        echo "Price Per Unit: $".number_format($unit_price, 2)."<br>";
        echo "Quantity: ".$quantity."<br>";
        echo "Subtotal: $".number_format($subtotal, 2)."<br>";
        echo "Tax: $".number_format($tax, 2)."<br>";
        echo "Donation: $".number_format($donation, 2)."<br>";
        echo "Total: $".number_format($total, 2);        
    }
    else{        
        echo '<script>            
            alert("ERROR : Sorry, but we dont have that many items in stock");
            window.location.href="orderform.php";
            </script>';
    }
    ?>
    <?php include '../templateFooter.php';?>    
</body>
</html>