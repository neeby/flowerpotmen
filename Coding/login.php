<?php
/*
define("DB_NAME", "FlowerPotMen");
define("DB_USER", "root");
define("DB_PASSWORD", "password");
define("DB_HOST", "localhost");

*/
include "helpers.php";

//Step1
 $db = connectToDatabase ( );
?>

<html>
 <head>
 </head>
 <body>
 <h1>PHP connect to MySQL</h1>
 
<?php


	$ID = $_POST["userName"];
	$Password = $_POST["password"];

	//queryTable (Users, userName, $ID, $db);
	$validated = checkPassword ($ID, $Password, $db);
	insertToDB (Users, $db );
	//deleteFromDB (Users, $db );
	amendDB (Users, $db );
	
	if ($validated) {
		echo ("validated");
	} else {
		echo ("Not validated");
	}

	mysqli_close($db);

?>
 
</body>
</html>
</html>