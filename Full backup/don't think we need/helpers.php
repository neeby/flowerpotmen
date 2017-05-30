<?php

	define("DB_NAME", "FlowerPotMen");
	define("DB_USER", "root");
	define("DB_PASSWORD", "password");
	define("DB_HOST", "localhost");

/*
	Connects to database defined as DB_NAME
*/
function connectToDatabase ( ) {
	
	$DB = mysqli_connect(DB_HOST ,DB_USER ,DB_PASSWORD ,DB_NAME)
	or die("Error connecting to MySQL server.");
	
	return $DB;
}//end connectToDatabase

/*
	query DB table to see if value is found in a specified column
*/
function queryTable ($table, $column, $value, $db) {


		$query = "SELECT * FROM {$table} WHERE {$column} = '{$value}'";
		mysqli_query($db, $query) /*or die('Error querying database.')*/;

		$result = mysqli_query($db, $query);
		$row = mysqli_fetch_array($result);

		echo ($row["{$column}"]);
}//end queryTable
 
/*
	query DB table to see if username & password are correct
*/
function checkPassword ($userName, $password, $db) {


		 $query = "SELECT * FROM Users WHERE userName = '{$userName}'";
		mysqli_query($db, $query) /*or die('Error querying database.')*/;

		$result = mysqli_query($db, $query);
		$row = mysqli_fetch_array($result);
		
	if ($row["userName"] == $userName) {
		//echo ("Username " . $userName . " found <br>");
		if ($row["password"] == $password) {
			//echo ("password correct");
			return true;
		} else {
			//echo ("password not correct");
		}
	} else {
		//echo ("Username " . $userName . " not found <br>");
	}		
		return false;
	
}//end checkPassword
 
 
 /*
	
 */
 function insertToDB ($table, $db ) {

	//placeholder values - will need to amend to add values as arg
	$sql = "INSERT INTO {$table} (ID, userName, password, staff) VALUES ('2','extra','jdshf','1')";
	if (mysqli_query($db, $sql)){
		echo ("data added<br>");
	} else {
		echo ("nope<br>");
	}
	 
 }//end insertToDB
 
 
 /*
 
 */
 function deleteFromDB ($table, $db ) {
	 
	//placeholder values - will need to amend to add values as arg
	$sql = "DELETE FROM {$table} WHERE ID='2'";
	
	if (mysqli_query($db, $sql)){
		echo ("data deleted<br>");
	} else {
		echo ("nah<br>" . mysqli_error($db));
	}
	 
 }//end deleteFromDB
 
 
 /*
 
 */
 function amendDB ($table, $db ) {
	
	//placeholder values - will need to amend to add values as arg
	$sql = "UPDATE {$table} SET userName='edited' WHERE ID='2'";
	
	if (mysqli_query($db, $sql)){
		echo ("data updated<br>");
	} else {
		echo ("iie<br>" . mysqli_error($db));
	}
	 
 }//end amendDB
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 ?>
 
