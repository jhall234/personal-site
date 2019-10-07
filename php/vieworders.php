<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Orders</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Josh Hallinan" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../general_style.css">
    <link rel="stylesheet" type="text/css" href="php_style.css">
</head>

<body>
	<?php	
		$title = "View Orders";
		include '../templateHeader.php';
	?>
	<?php
        if (filesize("orders.csv")){
            $myfile = fopen("orders.csv", "r") or die("Unable to open file!");
            // Store each line as a string in an array, and sort the array
            $array = [];
            while(!feof($myfile)) {
                $line = fgets($myfile);            
                $array[] = $line;           
            }
            fclose($myfile);            
            sort($array);
                     
            //Start creating the list
            echo "<ul>";
            //Loop through the array of lines
            $line = explode(",", $array[0]);
            $current_name = $line[0];
            echo "<li>".$current_name;
            echo "<ul>"; 
            $customerTotal = $grandTotal = 0;
            foreach ($array as $line){
                $lineArray = explode(",", $line);
                if ($lineArray[0] != $current_name){
                    echo "</ul>";
                   
                    echo "Customer Total: $".number_format($customerTotal,2);
                    $customerTotal = 0;
                    echo "</li>";
                    echo "<li>".$lineArray[0];
                    echo "<ul>";
                    $current_name = $lineArray[0];
                }
                echo("<li> On ".$lineArray[1]." ".$lineArray[2]. 
                    " ordered ".$lineArray[4]." " .$lineArray[3]. 
                    ". Total: ".$lineArray[5]."</li>");
                $customerTotal += (float)$lineArray[5];
            }
            echo "</ul>";
            echo "Customer Total: $".number_format($customerTotal,2);
            echo "</li>";
            echo "</ul>";
                   
        }
        else {
            echo("<p>There are no orders created</p>");
        }
    ?>  
<?php include '../templateFooter.php';?>
</body>
</html>