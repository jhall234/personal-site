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
		$title = "Ajax Shop";
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
	<form id="instrument" action="ajax_submit.php" method="post" onreset="resetInstrument()">
        <fieldset id="contact_info">
            <legend> Contact Information </legend>
            First Name: <input type="text" id="firstName" name="first" onkeyup="showResult(this.value, 0)" pattern="^[a-zA-Z, ]*$" title="only letters, spaces and apostorphes allowed" required><span class="error">*</span><br>
            <div id = "livesearch_first"></div>
            Last Name: <input type="text" id="lastName" name="last" onkeyup="showResult(this.value, 1)" pattern="^[a-zA-Z, ]*$" title="only letters, spaces and apostorphes allowed" required><span class="error">*</span><br>
            <div id = "livesearch_last"></div>
            Email: <input type="email" id="email" name="email" size ="40" onkeyup="showResult(this.value, 2)" required><span class="error">*</span>
            <div id = "livesearch_email"></div> 
        </fieldset>
            
        <fieldset id='instrument_select'>
            <legend> Order Details </legend>
            Instrument:
            <span class="error">*</span>
            <select id= "instrumentlist" name="instrumentlist" form = "instrument" required>
                <option value="">Select One...</option>
                <?php
                    //NOTE: I created a schema called store to hold all of my tables
                    $sql = "SELECT ProductName, Price, ProductImage, Quantity FROM store.Products";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {                            
                            $option = "<option ";
                            $dropdownData  = "value=" . $row["ProductImage"] . ">" . $row["ProductName"] . " $" . $row["Price"] . "/month";
                            if ($row["Quantity"] <= 0){
                                $dropdownData = $option."disabled = 'disabled' ".$dropdownData . " (OUT OF STOCK) </option>";
                            }
                            else {
                                $dropdownData = $option.$dropdownData . "</option>";
                            }
                            echo $dropdownData;
                        }
                    } 
                    else {
                        echo "0 results";
                    }
                    $conn->close();
                ?>
            </select>            
            <img id="image" src="/images/FFFFFF-0.png" width = "225" height = "225" alt="Instrument Image">
            <br>
            Quantity:
            <input type="number" name="quantity" min="1" required><span class="error">*</span>
        </fieldset>

        <fieldset id="donation_info">
            <legend> Donation </legend>
            <p> Do you wish to round up to the nearest dollar and donate? <span class="error">*</span></p>
            <input type="radio" name="donation" value="donate" required>Yes Donate!<br>
            <input type="radio" name="donation" value="none" required> No thanks
        </fieldset>
        <input type="hidden" name="date" value="">
        <span id='required_value_text' class="error">* Indicates that these values are required</span> 
        <input class='form_button' type="reset">
        <input class='form_button' type="submit" value="Purchase">
    </form>        
    <?php include '../templateFooter.php';?>

<script> 
    function showResult(str, choice) {
        var search;
        switch(choice){
            case 0:
                search = "livesearch_first";
                break;
            case 1:
                search = "livesearch_last";
                break;
            case 2:
                search = "livesearch_email";
                break;
        }
        if (str.length==0) { 
            document.getElementById(search).innerHTML="";
            document.getElementById(search).style.border="0px";
            return;
        }
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        } 
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
            document.getElementById(search).innerHTML=this.responseText;
            document.getElementById(search).style.border="1px solid #A5ACB2";
            }
        }
        xmlhttp.open("GET","gethint.php?box="+choice+"&q="+str,true);
        xmlhttp.send();
    }
</script>
<script>
    function setInstrument() {
        var image = document.getElementById("image");
        image.src = this.value;
        return false;
    }
    function resetInstrument() {
        document.getElementById("image").src = "/images/FFFFFF-0.png";        
        return false; 
    }
    document.getElementById("instrumentlist").onchange = setInstrument;   
</script>
<script>
    function populateForm(id){
        var text = id.innerHTML;
        
        text = text.replace("<b>", "");
        text = text.replace("</b>", "");
        
        textArray = text.trim().split(/\ +/);
        var firstName = textArray[0];
        var lastName = textArray[1];
        var email = textArray[2];
        
        document.getElementById("firstName").value = firstName;
        document.getElementById("lastName").value = lastName;
        document.getElementById("email").value = email;

        document.getElementById("livesearch_first").style.display = "none";
        document.getElementById("livesearch_last").style.display = "none";
        document.getElementById("livesearch_email").style.display = "none";
    }
</script>
</body>
</html>