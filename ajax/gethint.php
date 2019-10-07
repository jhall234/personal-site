<?php 
    //Will request the value of input text box
    $q = $_GET["q"];
    //Get which box user is typing into. 0= first name,  1=last name, 2=email
    $box = $_GET["box"];
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
    switch($box){
        case 0:
            $stmt = $conn->prepare("SELECT firstname, lastname, email FROM store.customers WHERE firstname LIKE ?");
            break;
        case 1:
            $stmt = $conn->prepare("SELECT firstname, lastname, email FROM store.customers WHERE lastname LIKE ?");
            break;
        case 2:
            $stmt = $conn->prepare("SELECT firstname, lastname, email FROM store.customers WHERE email LIKE ?");
            break;
    }
    $q .= '%';
    $stmt->bind_param("s", $q);
    
    $response="";
    if($stmt->execute()){
        $result = $stmt->get_result();
        
        if($result->num_rows > 0){
            // Fetch result rows as an associative array
            while($row = $result->fetch_assoc()){
                switch($box){
                    case 0:
                        $response .= '<p class="livesearch_result" onclick="populateForm(this)"><b>'.$row["firstname"].'</b> '.$row["lastname"].' '.$row["email"].'</p>';
                        break;
                    case 1:
                        $response .= '<p class="livesearch_result" onclick="populateForm(this)">'.$row["firstname"].' <b>'.$row["lastname"].'</b> '.$row["email"].'</p>';
                        break;
                    case 2:
                        $response .= '<p class="livesearch_result" onclick="populateForm(this)">'.$row["firstname"].' '.$row["lastname"].' <b>'.$row["email"].'</b></p>';
                        break;
                }
            }
        }
        else {
            $response = '<p class="livesearch_result">No Suggestions</p>';
        }
    }
    
  
    echo $response;
    //close connection
    mysqli_close($conn);
?>