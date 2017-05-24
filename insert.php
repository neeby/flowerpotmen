<?php
define('DB_NAME', 'FlowerPotMen');
define('DB_USER', 'root');
define('DB_PASSWORD', 'password');
define('DB_HOST', 'localhost');
//Step1
 $db = mysqli_connect(DB_HOST ,DB_USER ,DB_PASSWORD ,DB_NAME)
 or die('Error connecting to MySQL server.');
?>

<html>
 <head>
 </head>
 <body>
 <h1>PHP connect to MySQL</h1>
 
<?php

$query = "CREATE TABLE " . $_POST['Address'] . "( UserName varchar(255), inspectionTime varchar(255))";
     
//$query = "SELECT * FROM Users";
if(!mysqli_query($db, $query)){
    echo "Shit didn't work.";
} else {
    echo "Well it must have worked.";
}
echo($query);
$sql="INSERT INTO Properties (uniqueCode, address,suburb,postcode,bed,bath,car,description,image,weeklyRent,Owner) VALUES('','$_POST[Address]','$_POST[Suburb]','$_POST[PostCode]','$_POST[BedRooms]','$_POST[ BathRooms]','$_POST[CarPorts]','$_POST[Description]','$_POST[Image]','$_POST[Rent]','$_SESSION["POST_User"]')";
if(!mysqli_query($db, $sql)){
    echo "Shit didn't work.";
} else {
    echo "Well it must have worked.";
}