<?php
/*
    <summary>
		Function to check if a username already exists
    </summary>
    <param name="$value">username to be checked for</param>
    <returns>True if username exists otherwise returns false</returns>
*/
function queryUser ($value) {

        $db = $_SESSION['db'];

        $query = "SELECT * FROM Users WHERE userName = '{$value}'";
		mysqli_query($db, $query) or die('Error querying database.');

        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_array($result);

		if (strlen ($row['userName'])>0) {
			return true;

		} else {
			return false;
		}
		
}//end queryUser

/*
    <summary>
		A function to add a user to the database
    </summary>
    <param name="$userName">Exactly what it looks to be.</param>
	<param name="$password">Non encrypted password</param>
	<param name="$Staff">Staff Access level.</param>
	<param name="$firstName">Users first name.</param>
	<param name="$otherName">Users middle name if applicable.</param>
    <param name="$surName">Users surname.</param>
	<param name="$DOB">Date of birth.</param>
	<param name="$email">Contact email address.</param>
	<param name="$phone">Contact phone #.</param>
	<param name="$address">Users address.</param>	
    <returns>True if user added to db successfully otherwise returns false</returns>
*/
 function addUser ( $userName, $password, $Staff, $firstName, $otherName, $surName, $DOB, $email, $phone, $address) {

	$db = $_SESSION['db'];
	$encryptedPassword = encryptPassword($password);

	$sql = "INSERT INTO `Users` (`userName`, `password`, `Staff`, `firstName`, `otherName`, `surName`, `DOB`, `email`, `phone`, `address`) VALUES (";
	$sql .= "'{$userName}', ";
	$sql .= "'{$encryptedPassword}', ";
	$sql .= "'{$Staff}', ";
	$sql .= "'{$firstName}', ";
	$sql .= "'{$otherName}', ";
	$sql .= "'{$surName}', ";
	$sql .= "'{$DOB}', ";
	$sql .= "'{$email}', ";
	$sql .= "'{$phone}', ";	
	$sql .= "'{$address}'";								
	$sql .= ")";
	
	if (mysqli_query($db, $sql)){
		return true;
	} else {
		return false;
	}
	 
 }//end addUser

 /*
    <summary>
		A function to update the details of a user
    </summary>
    <param name="$userName">The username of the user to be updated.</param>
	<param name="$updatedUserDetails[]">An array of the users new details
	keys [`userName`, `password`, `Staff`, `firstName`, `otherName`, `surName`, `DOB`, `email`, `phone`, `address`]
	</param>	
    <returns>True if user is updated successfully otherwise returns false</returns>
*/
 function editUser ( $userName, $updatedUserDetails) {

	$db = $_SESSION['db'];
	$encryptedPassword = encryptPassword($updatedUserDetails["password"]);
	print_r($updatedUserDetails);
	foreach ($updatedUserDetails as $key => $value) {
		
		$sql = "UPDATE Users SET {$key}='{$value}' WHERE userName='{$userName}'";
		echo $sql . "<br>";
		if (mysqli_query($db, $sql)){
			//return true;
		} else {
			echo $key;
			return false;
		}
	}	
	 
 }//end editUser

 /*
    <summary>
		Function to delete a user from the database.
    </summary>
    <param name="$user">The user to be deleted.</param>
    <returns>True if user is deleted, otherwise returns false</returns>
*/
 function deleteUser ($user) {
	
	$db = $_SESSION['db'];
	
	$sql = "DELETE FROM Users WHERE userName='{$user}'";
	
	if (mysqli_query($db, $sql)){
		return true;
	} else {
		return false;
	}
	 
 }//end deleteUser

 /*
    <summary>
		Function to update a users username.
    </summary>
    <param name="$user">The user to be amended.</param>
	<param name="$updatedUserDetails">The users new username.</param>
    <returns>True if user is updated, otherwise returns false</returns>
*/
 function editUserName ($user, $updatedUserDetails) {
	
	$db = $_SESSION['db'];
	
	$sql = "UPDATE Users SET userName='{$updatedUserDetails}' WHERE userName='{$user}'";
	
	if (mysqli_query($db, $sql)){
		return true;
	} else {
		return false;
	}
	 
 }//end editUserName
 
 /*
    <summary>
		Function to update a users username.
    </summary>
    <param name="$user">The user to be amended.</param>
	<param name="$updatedUserDetails">The users new password.</param>
    <returns>True if user is updated, otherwise returns false</returns>
*/
 function editUserPassword ($user, $updatedUserPassword) {
	
	$db = $_SESSION['db'];
	
	$updatedUserDetails = encryptPassword($updatedUserPassword);
	$sql = "UPDATE Users SET password='{$updatedUserDetails}' WHERE userName='{$user}'";
	
	if (mysqli_query($db, $sql)){
		return true;
	} else {
		return false;
	}
	 
 }//end editUserPassword 

?>