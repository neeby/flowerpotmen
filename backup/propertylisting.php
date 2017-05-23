<!--
File name: propertylisting.php
Date created: 21/04/2017
Purpose of file: 
-->

<html>
    <head>
        <?PHP
            include("functions.php");
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
            $query = "SELECT * FROM properties WHERE uniqueCode = '{$PropertyID}'";
            mysqli_query($db, $query) or die('Error querying database.');

            $queryResult = mysqli_query($db, $query);
            while ($row = $queryResult->fetch_assoc()) {
                $address = $row['address'];
                $suburb = $row['suburb'];
                $postcode = $row['postcode'];
                $bed = $row['bed'];
                $bath = $row['bath'];
                $car = $row['car'];
                $description = $row['description'];
                if ($row['image'] == ""){
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