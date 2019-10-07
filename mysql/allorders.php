<!DOCTYPE html>
<html lang="en">

<head>
    <title>Form</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Josh Hallinan" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../general_style.css"/>
    <link rel="stylesheet" type="text/css" href="mysql_style.css"/>
</head>

<body>
    <?php	
		$title = "All Orders";
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
    ?>
    <?php 
        echo "<ul>";
        $sql = 'SELECT firstname, lastname, customerid FROM store.customers';    
        $result = mysqli_query($conn, $sql);
        while($row = $result->fetch_assoc()){            
            $first =$row["firstname"];
            $last =$row["lastname"];
            $customerid =$row["customerid"];
            echo "<li>Customer <a href='customer.php?id=" .$customerid. "'>" . $first . " " . $last . "</a>";            
            //call function to print all occurences of respective customer id
            printorders($customerid, $conn);
            echo "</li>";
        }
        echo "</ul>";
        echo "<br>";
        //need to print out the table
        echo '<table>
        <tr>
            <th></th>
            <th>Total Amount</th> 
            <th>Average Amount Per Order</th>
            <th>Average Amount Per Customer</th>
        </tr>';
        //Customers row
        $sql = 'SELECT COUNT(customerid) FROM store.customers';
        $row = mysqli_query($conn, $sql);
        $row = $row->fetch_assoc();
        $total_customers = $row["COUNT(customerid)"];        
        echo "<tr>";
        echo "<td>Customers</td>";
        echo "<td>" .$total_customers. "</td>"; 
        echo "<td>N/A</td>";
        echo "<td>N/A</td>";
        echo "</tr>";

         //Orders row
         $sql = 'SELECT COUNT(orderid) FROM store.orders';
         $row = mysqli_query($conn, $sql);
         $row = $row->fetch_assoc();
         $total_orders = $row["COUNT(orderid)"];        
         echo "<tr>";
         echo "<td>Orders</td>";
         echo "<td>" .$total_orders. "</td>"; 
         echo "<td>N/A</td>";
         echo "<td>" .$total_orders/$total_customers. "</td>";
         echo "</tr>";

         //Number of Units row
         $sql = 'SELECT SUM(quantity) FROM store.orders';
         $row = mysqli_query($conn, $sql);
         $row = $row->fetch_assoc();
         $total_units = $row["SUM(quantity)"];        
         echo "<tr>";
         echo "<td>Number of Units</td>";
         echo "<td>" .$total_units. "</td>"; 
         echo "<td>" .number_format($total_units/$total_orders,2). "</td>";
         echo "<td>" .number_format($total_units/$total_customers,2). "</td>";
         echo "</tr>";

         //Subtotal row
         $sql = 'SELECT SUM(store.products.price*store.orders.quantity) FROM store.orders, store.products WHERE store.products.productname = store.orders.productname';
         $row = mysqli_query($conn, $sql);
         $row = $row->fetch_assoc();
         $total_subtotal = $row["SUM(store.products.price*store.orders.quantity)"];        
         echo "<tr>";
         echo "<td>Subtotal</td>";
         echo "<td> $" .number_format($total_subtotal,2). "</td>"; 
         echo "<td> $" .number_format($total_subtotal/$total_orders,2). "</td>";
         echo "<td> $" .number_format($total_subtotal/$total_customers,2). "</td>";
         echo "</tr>";

         //Tax row
         $sql = 'SELECT SUM(tax) FROM store.orders';
         $row = mysqli_query($conn, $sql);
         $row = $row->fetch_assoc();
         $total_tax = $row["SUM(tax)"];        
         echo "<tr>";
         echo "<td>Tax</td>";
         echo "<td> $" .number_format($total_tax,2). "</td>"; 
         echo "<td> $" .number_format($total_tax/$total_orders,2). "</td>";
         echo "<td> $" .number_format($total_tax/$total_customers,2). "</td>";
         echo "</tr>";
        
        //Donation row
        $sql = 'SELECT SUM(donation) FROM store.orders';
        $row = mysqli_query($conn, $sql);
        $row = $row->fetch_assoc();
        $total_donation = $row["SUM(donation)"];        
        echo "<tr>";
        echo "<td>Donation</td>";
        echo "<td> $" .number_format($total_donation,2). "</td>"; 
        echo "<td> $" .number_format($total_donation/$total_orders,2). "</td>";
        echo "<td> $" .number_format($total_donation/$total_customers,2). "</td>";
        echo "</tr>";

        //Grand total
        echo '<tr class="total">';
        echo "<td>Grand Total</td>";
        echo "<td> $" .number_format($total_subtotal+$total_tax+$total_donation,2). "</td>"; 
        echo "<td> $" .number_format($total_subtotal+$total_tax+$total_donation/$total_orders,2). "</td>";
        echo "<td> $" .number_format($total_subtotal+$total_tax+$total_donation/$total_customers,2). "</td>";
        echo "</tr>";

        echo "</table>";
    
    ?>
    <?php 
        function printorders($id, $conn){
            echo "<ul>";
            $sql = 'SELECT ordertime, productname, quantity, tax, donation 
            FROM store.orders WHERE customerid ="'.$id.'"';    
            $result = mysqli_query($conn, $sql);
            $running_total = 0;
            while($row = $result->fetch_assoc()){
                $time  = strtotime($row["ordertime"]);
                $time = date('l F m Y \a\t h:i a', $time);                
                $productname  = $row["productname"];
                $quantity  = $row["quantity"];
                $tax  = $row["tax"];
                $donation  = $row["donation"];
                $query = 'SELECT price FROM store.products 
                WHERE productname ="'.$productname.'"';
                $price = mysqli_query($conn, $query);
                $price = $price->fetch_assoc();
                $price = $price["price"];
                $subtotal = $quantity*$price;
                $total = $subtotal + $tax + $donation;
                $running_total += $total;
                //TODO: parse the time variable
                //now we have all of the values, print out the line 
                echo "<li> On " .$time. " ordered " .$quantity. " of " .$productname. ". Total: $" .number_format($total, 2). " (Donated: $" .number_format($donation, 2). ")</li>";                
            }
            echo "</ul> Total Purchases: $" .number_format($running_total, 2). "<br>";
        }
    ?>
    <?php include '../templateFooter.php';?>

</body>
</html>