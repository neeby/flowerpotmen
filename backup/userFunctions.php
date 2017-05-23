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
	
	//safeguard to ensure only David/admin can create higher access levels
	if ($_SESSION['UAC_Level'] !== "Owner" && $_SESSION['UAC_Level'] !== "Admin"){
		$Staff = 1;
	}
	
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
//still needs check to ensure no one can delete David
	if ($_SESSION['UAC_Level'] == "Owner" || $_SESSION['UAC_Level'] == "Admin"){
		foreach ($updatedUserDetails as $key => $value) {
			
			$sql = "UPDATE Users SET {$key}='{$value}' WHERE userName='{$userName}'";
			//echo $sql . "<br>";
			if (mysqli_query($db, $sql)){
				//return true;
			} else {
				echo $key;
				return false;
			}
		}	
		return true;		
	}
	echo("Access level insuficient.");
	return false;	

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
	
	if ($_SESSION['UAC_Level'] == "Owner" || $_SESSION['UAC_Level'] == "Admin"){	
		$sql = "DELETE FROM Users WHERE userName='{$user}'";
		
		if (mysqli_query($db, $sql)){
			return true;
		} else {
			return false;
		}
	}
	echo("Access level insuficient.");
	return false;
	
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
 
 /*
    <summary>
		Modified version of Cam's function to display database in view/edit/delete forms
		from Functions.php so i can modify things without breaking 
    </summary>
    <param name="$options">string to choose which table to display 
	Edit - Displays Edit table form
	Delete - Displays Delete table form
	Anything else displays view table form
	</param>
*/
function writeUserListFull($options){//name changed or will break with Cam's

	//TODO
	//add Access level checks - so someone can only edit/delete/create the appropriate lvl

	$db = $_SESSION['db'];
	$query = "SELECT * FROM Users";
	$queryResult = mysqli_query($db, $query) or die('Error querying database.');

	//create table headings
	$tableHead = "<form action='users.php' method='POST'>";
	switch ($options){
		case 'Edit':
			$tableHead .= "<div class='usersTable'><table><th>User to Edit</th>";
			break;
		case 'Delete':
			$tableHead .= "<div class='usersTable'><table><th>User(s) to Delete</th>";
			break;	
		default:
		//view
		$tableHead = "<div class='usersTable'><table>";
	}
	
	$tableHead .="<th>User Name</th>";
	$tableHead .="<th>Access Level</th>";
	$tableHead .="<th>First Name</th>";
	$tableHead .="<th>Other Name</th>";
	$tableHead .="<th>Surname</th>";
	$tableHead .="<th>DOB</th>";
	$tableHead .="<th>Email</th>";
	$tableHead .="<th>Phone</th>";
	$tableHead .="<th>Address</th>";

	echo $tableHead;
	
//contents of table	
	while ($row = $queryResult->fetch_assoc()){
		
		switch ($options){
			case 'Edit':
				$tableBody = "<tr><td><input type='radio' name='userToEdit' value='" . $row['userName'] . "'></td>";
				break;
			case 'Delete':
				$tableBody = "<tr><td><input type='checkbox' name='userToDelete[]' value='" . $row['userName'] . "'></td>";
				break;	
			default:
			//view
			$tableBody = "<tr>";
		}
		$tableBody .= "<td>";
		$tableBody .= $row['userName'];
		$tableBody .= "</td><td>";
		$tableBody .= returnUACName($row['Staff']) ;
		$tableBody .= "</td><td>";
		$tableBody .= $row['firstName'];
		$tableBody .= "</td><td>";
		$tableBody .= $row['otherName'];
		$tableBody .= "</td><td>";
		$tableBody .= $row['surName'];
		$tableBody .= "</td><td>";
		$tableBody .= $row['DOB'];
		$tableBody .= "</td><td>";
		$tableBody .= $row['email'];
		$tableBody .= "</td><td>";
		$tableBody .= $row['phone'];
		$tableBody .= "</td><td>";
		$tableBody .= $row['address'];
		$tableBody .= "</td>";	
		
		echo $tableBody;
	}
	echo "</table>";
	switch ($options){
		case 'Edit':                
			echo "<br><input type='submit' value='Edit Selected User'></form>";
			break;
		case 'Delete':
			echo "<br><input type='submit' value='Delete Selected User'></form></div>";
			break;
	}
 }//end writeUserListFull
 
 

?>