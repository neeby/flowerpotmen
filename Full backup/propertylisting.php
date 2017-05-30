<!--
File name: propertylisting.php
Date created: 21/04/2017
Purpose of file: 
-->

<html>
    <head>
        <?PHP
            include_once("functions.php");
            session_start();
            writeMenu();
        
            $PropertyID = $_GET['id'];
        ?>

        <title>
            Property Listing - <?PHP echo $PropertyID; ?>
        </title>
    </head>

    <body>
        <?PHP
            loginDB();
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
                    $image = "images/" . $row['image'];
                }
            }


            echo "<div style='text-align: center'><br>";
            echo "Address: " . $address . "<br>";
            echo "Suburb: " . $suburb . "<br>";
            echo "Postcode: " . $postcode . "<br>";
            echo "Bedrooms: " . $bed . "<br>";
            echo "Bathrooms: " . $bath . "<br>";
            echo "Carports: " . $car . "<br>";
            echo "Description: " . $description . "<br>";
            echo "Image URL: " . $image . "<br>";

            $MapAddress = $address . ", " . $suburb;
            echoMap($MapAddress);
            echo "</div>";
        ?>
    </body>
</html>