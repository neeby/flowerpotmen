<?php

	define("DB_NAME", "FlowerPotMen");
	define("DB_USER", "root");
	define("DB_PASSWORD", "password");
	define("DB_HOST", "localhost");

/*
	Connects to database defined as DB_NAME
*/
function connectToDatabase ( ) {
	
	$db = mysqli_connect(DB_HOST ,DB_USER ,DB_PASSWORD ,DB_NAME)
	or die("Error connecting to MySQL server.");

	return $db	
	
}


 
 /*
	query DB table to see if value is found in a specified column
 */
function queryTable ($table, $column, $value) {
	
		 $ID = $_POST["userName"];
		$Password = $_POST["password"];

		 $query = "SELECT * FROM {$table} WHERE {$column} = '{$ID}'";
		mysqli_query($db, $query) or die('Error querying database.');

		$result = mysqli_query($db, $query);
		$row = mysqli_fetch_array($result);
	
	
}
 
 
 
 
 ?>
 
