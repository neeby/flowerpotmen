<!--
File name: propertylisting.php
Date created: 21/04/2017
Purpose of file: 
-->

<html>
    <head>
        <link rel='stylesheet'  type='text/css' href='stylesheet.css'>
        <?PHP
        global $db;

        define('DB_NAME', 'FlowerPotMen');
        define('DB_USER', 'root');
        define('DB_PASSWORD', 'password');
        define('DB_HOST', 'localhost');

        $db = mysqli_connect(DB_HOST ,DB_USER ,DB_PASSWORD ,DB_NAME)
        or die('Error connecting to MySQL server.');

        $_SESSION['db'] = $db;
            include("functions.php");
            session_start();
            writeMenu();
        
            $PropertyID = $_GET['id'];
            $time = $_POST['Booking'];

        ?>

        <title>
            Property Listing - <?PHP echo $PropertyID; ?>
        </title>
    </head>

    <body class='propertyListing'>
        <?PHP
            loginDB();
        
        
     //----------------------------------
    
    
               if ( isset( $_POST['Submit'] ) ) {
                   if(!isset($_SESSION['UAC_Level'])){
                       $user = "guest";			
                   }else {
                       $user=$_SESSION['POST_User'];
                   }
                   $sql = "INSERT INTO `".$PropertyID."`(Username, inspectionTime) VALUES ('".$user."', '".$time."');";
                               mysqli_query($db, $sql) or die('Error querying database.');
                   
                   echo ("Inspection booked at : ".$time." : 9 - 11 am, <br> See you there!");
               }
    
    
    
    //-----------------
            $query = "SELECT * FROM Properties WHERE Code = '{$PropertyID}'";
            mysqli_query($db, $query) or die('Error querying database.');

            $queryResult = mysqli_query($db, $query);
            while ($row = $queryResult->fetch_assoc()) {
                $address = $row['Address'];
                $suburb = $row['Suburb'];
                $postcode = $row['PostCode'];
                $bed = $row['BedRooms'];
                $bath = $row['BathRooms'];
                $car = $row['CarPorts'];
                $description = $row['Description'];
                if ($row['Image'] == ""){
                    $image = "images/pingu.jpg";
                } else {
                    $image = $row['Image'];
                }
            }
?>    Enter a date to book your inspection :<br>
    (note : inspections are run as open houses daily between 9-11. If no inspections are booked then it will not be run)<br>
    <form action='' method='POST'>
  <input type="date" name="Booking" min=<?PHP echo('"'.date("Y-m-d").'"');?> required><br>
<input type="submit" name = "Submit" value="Book Now!" />
</form>
<?PHP

            echo "<div style='text-align: left;' class='listings'><br>";
            echo "Address: " . $address . "<br>";
            echo "Suburb: " . $suburb . "<br>";
            echo "Postcode: " . $postcode . "<br>";
            echo "Bedrooms: " . $bed . "<br>";
            echo "Bathrooms: " . $bath . "<br>";
            echo "Carports: " . $car . "<br>";
                          

            echo "Description: " . $description . "<br>";
            echo "<img src=" . $image . "><br>";

            $MapAddress = $address . ", " . $suburb;
            echoMap($MapAddress);
            echo "</div>";
        ?>
        
    </body>
</html>