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
//no entry in login will validate - fix via not submitting if username/passwod not completed at login

$ID = $_POST['userName'];
$Password = $_POST['password'];

 $query = "SELECT * FROM Users WHERE userName = '{$ID}'";
mysqli_query($db, $query) or die('Error querying database.');

$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);

if ($row['userName'] == $ID) {
	echo ("Username " . $ID . " found <br>");
	if ($row['password'] == $Password) {
		echo ("password correct");
		
	} else {
		echo ("password not correct");
	}
} else {
	echo ("Username " . $ID . " not found <br>");
}



//Step 4
mysqli_close($db);



?>
 
</body>
</html>