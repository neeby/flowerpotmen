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
$Address =$_POST[Address];
$Suburb =$_POST[Suburb];
$PostCode=$_POST[PostCode];
$BedRooms=$_POST[BedRooms];
$BathRooms=$_POST[BathRooms];
$CarPorts=$_POST[CarPorts];
$Description=$_POST[Description];
$Image=$_POST[Image];
$WeeklyRent=$_POST[WeeklyRent];
//$Owner=$_POST[Owner];
//$query = "CREATE TABLE PLEASWORK ( UserName varchar(255), inspectionTime varchar(255))";
     
//if(!mysqli_query($db, $query)){
 //  echo "Shit didn't work.";
//} else {
  //  echo "Well it must have worked.";
//}
//echo($query);
//$sql="INSERT INTO properties ( address,suburb,postcode,bed,bath,car,description,image,weeklyRent,Owner) VALUES($_POST['Address']','$_POST['Suburb']','$_POST['PostCode']','$_POST['BedRooms']','$_POST[' BathRooms']','$_POST['CarPorts']','$_POST['Description']','$_POST['Image']','$_POST['Rent']',me)";
//$sql2="INSERT INTO properties (address,suburb,postcode,bed,bath,car,description,image,weeklyRent,Owner) VALUES('t',1,1,1,1,1,1,1,1,1)";
/*$sql="INSERT INTO properties (address, suburb,postcode,bed,bath,car,description,image,weeklyRent,Owner) VALUES($_)";
	$sql .= "'{$Address}', ";
	$sql .= "'{$Suburb}', ";
	$sql .= "'{$PostCode}', ";
	$sql .= "'{$BedRooms}', ";
	$sql .= "'{$otherName}', ";
	$sql .= "'{$BathRooms}', ";
	$sql .= "'{$CarPorts}', ";
	$sql .= "'{$Description}', ";
	$sql .= "'{$Image}', ";	
	$sql .= "'{$Owner}'";								
	$sql .= ')';
if(!mysqli_query($db, $sql)){
    echo "Shit didn't work.";
} else {
    echo "Well it must have worked.";
}
    // echo($sql);
     
     ?>
     */
     
     
     
    // echo $Address;
    // echo $Suburb;
     
    </body>
</html>