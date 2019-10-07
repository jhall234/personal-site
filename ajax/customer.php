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
		$title = "Form";
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
        
        //Recieve the customer id
        

        //Create prepared statement for the customer's orders 
        $stmtOrders = $conn->prepare("SELECT ordertime, productname, quantity, tax, donation 
        FROM store.orders WHERE customerid = ?");
        $stmtOrders->bind_param("i", $_GET['id']);

        //Create prepared statement for the customer contact info 
        $stmtContact = $conn->prepare("SELECT firstname, lastname, email 
        FROM store.customers WHERE customerid = ?");
        $stmtContact->bind_param("i", $_GET['id']);
    ?>
    <?php
        
        $stmtContact->execute();
        $resultCustomer = $stmtContact->get_result();
        //Check if that customer id is in database        
        if ($resultCustomer->num_rows === 0){
            exit("<h3>Sorry, customer not found.</h3>");
        }
        $rowCustomer = $resultCustomer->fetch_assoc();
        $firstname = $rowCustomer["firstname"];
        $lastname = $rowCustomer["lastname"];
        $email = $rowCustomer["email"];
        echo "<h2>".$firstname." ".$lastname."'s Orders:</h2>";
        echo "<h3> Contact Info: ".$email."</h3>";

        //Create the headers for the table
        echo '<table>
        <tr>
            <th>Order #</th>
            <th>Purchase Date</th> 
            <th>Instrument</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>Tax</th>
            <th>Donation</th>
            <th>Total</th>
        </tr>';

        //Create variables to calc grand total and average
        $totalOrders=$totalQuantity=$totalSubtotal=$totalTax=$totalDonation=$totalTotal= 0;

        $stmtOrders->execute();
        $resultOrders = $stmtOrders->get_result();
        
        while ($rowOrders = $resultOrders->fetch_assoc()){
            $time = date("m/d/y h:i a", strtotime($rowOrders["ordertime"]));            
            $name = $rowOrders["productname"];
            
            $quantity = $rowOrders["quantity"];
            $totalQuantity += $quantity;
                        
            $tax = $rowOrders["tax"];
            $totalTax += $tax;

            $donation = $rowOrders["donation"];
            $totalDonation += $donation;

            $stmt = $conn->prepare("SELECT price FROM store.products WHERE productname = ?");
            $stmt->bind_param("s", $name);
            $stmt->execute();
            $result = $stmt->get_result(); 
            $row = $result->fetch_assoc();
            $price = $row["price"];            

            $subtotal = $quantity*$price;
            $total = $subtotal  + $tax + $donation;
            $totalSubtotal += $subtotal;
            $totalTotal += $total;
            $totalOrders++;           

            echo "<tr>";
            echo "<td>".$totalOrders."</td>";
            echo "<td>".$time."</td>"; 
            echo "<td>".$name."</td>";
            echo "<td>".$quantity."</td>";
            echo "<td> $".number_format($subtotal,2). "</td>";
            echo "<td> $" .number_format($tax,2). "</td>";
            echo "<td> $" .number_format($donation,2). "</td>";
            echo "<td> $" .number_format($total,2). "</td>";
            echo "</tr>";
        }
        //Print out grand total and average
        echo "<tr class='total'>";
        echo "<td>Grand Total</td>";
        echo "<td></td>"; 
        echo "<td></td>";
        echo "<td>".$totalQuantity."</td>";
        echo "<td> $".number_format($totalSubtotal,2). "</td>";
        echo "<td> $" .number_format($totalTax,2). "</td>";
        echo "<td> $" .number_format($totalDonation,2). "</td>";
        echo "<td> $" .number_format($totalTotal,2). "</td>";
        echo "</tr>";

        echo "<tr class='total'>";
        echo "<td>Average</td>";
        echo "<td></td>"; 
        echo "<td></td>";
        echo "<td>".number_format($totalQuantity/$totalOrders,2)."</td>";
        echo "<td> $".number_format($totalSubtotal/$totalOrders,2). "</td>";
        echo "<td> $" .number_format($totalTax/$totalOrders,2). "</td>";
        echo "<td> $" .number_format($totalDonation/$totalOrders,2). "</td>";
        echo "<td> $" .number_format($totalTotal/$totalOrders,2). "</td>";
        echo "</tr>";

        echo "</table>"
    ?>
    <?php include '../templateFooter.php';?>

</body>
</html>