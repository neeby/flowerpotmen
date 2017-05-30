<?php


/*
    <summary>
		A function to add a contact request to the database 
    </summary>
    <param name="$Name">the name of the person submitting the contact request.</param>
	<param name="$email">The preffered email address for replies.</param>
	<param name="$phone">Contact number for the person that submited the request</param>
	<param name="$callRequired">True or False if a return call is required.</param>
	<param name="$Priority">How urgent the request is.</param>
    <param name="$Type">The type of request (to help with alocation).</param>
	<param name="$Message">What the person submitting the contact has to say.</param>
	<param name="$requestDate">The date the contact request was submitted</param>
	<param name="$Status">String describing the progress of the request (submitted, completed etc)</param>
    <returns>True if the contact request has been added to db successfully otherwise returns false</returns>
*/
 function addContactRequest ( $Name, $email, $phone, $callRequired, $Priority, $Type, $Message, $requestDate, $Status) {

	$db = $_SESSION['db'];
	
	$sql = "INSERT INTO `Contacts`(`contactId`,`Name`, `email`, `phone`, `callRequired`, `Priority`, `Type`, `Message`, `requestDate`, `Status`) VALUES (";
	$sql .= "NULL, ";
	$sql .= "'{$Name}', ";
	$sql .= "'{$email}', ";
	$sql .= "'{$phone}', ";
	$sql .= "'{$callRequired}', ";
	$sql .= "'{$Priority}', ";
	$sql .= "'{$Type}', ";
	$sql .= "'{$Message}', ";
	$sql .= "'{$requestDate}', ";
	$sql .= "'{$Status}'";							
	$sql .= ")";
	
	if (mysqli_query($db, $sql)){
		return true;
	} else {
		return false;
	}
	 
 }//end addContactRequest

 /*
    <summary>
		A function to update the status of a request
    </summary>
    <param name="$Id">The contact request ID to be updated.</param>
	<param name="$status">What the new status of the request is.</param>
    <returns>True if status is updated successfully otherwise returns false</returns>
*/
 function updateRequestStatus ( $Id, $status) {

	$db = $_SESSION['db'];
		
	
	if ($_SESSION['UAC_Level'] == "David" || $_SESSION['UAC_Level'] == "Admin"){
			
			$sql = "UPDATE Contacts SET Status ='{$status}' WHERE contactId='{$Id}'";

			if (mysqli_query($db, $sql)){
				return true;
			} else {
				return false;
			}
	}
	echo("Access level insuficient.");
	return false;	

 }//end updateRequestStatus

 /*
    <summary>
		Function to delete a request from the contacts database.
    </summary>
    <param name="$Id">The contact request ID to be deleted.</param>
    <returns>True if the contact is deleted, otherwise returns false</returns>
*/
 function deleteRequest ($Id) {
	
	$db = $_SESSION['db'];
	
	if ($_SESSION['UAC_Level'] == "David" || $_SESSION['UAC_Level'] == "Admin"){	
		$sql = "DELETE FROM Contacts WHERE contactId='{$Id}'";
		
		if (mysqli_query($db, $sql)){
			return true;
		} else {
			return false;
		}
	}
	echo("Access level insuficient.");
	return false;
	
 }//end deleteRequest

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
	Function to display the contact requests as a table - Modified version of Cam's function to display User database
		from Functions.php 
    </summary>
*/
function writeContactRequests(){

	$db = $_SESSION['db'];
	$query = "SELECT * FROM Contacts";
	$queryResult = mysqli_query($db, $query) or die('Error querying database.');
	
	//create table headings
	$tableHead = "<form action='users.php' method='POST'><div class='contactsTable'><table>";
	
	$tableHead .="<th>Id #</th>";
	$tableHead .="<th>Name</th>";
	$tableHead .="<th>Email</th>";
	$tableHead .="<th>phone</th>";
	$tableHead .="<th>callRequired</th>";
	$tableHead .="<th>Priority</th>";
	$tableHead .="<th>Type</th>";
	$tableHead .="<th>Message</th>";
	$tableHead .="<th>requestDate</th>";
	$tableHead .="<th>Status</th>";

	echo $tableHead;
	
//contents of table	
	$tableBody = "";
	while ($row = $queryResult->fetch_assoc()){
		
		$tableBody .= "<tr><td>";	
		$tableBody .= $row['contactId'];
		$tableBody .= "</td><td>";
		$tableBody .= $row['Name'] ;
		$tableBody .= "</td><td>";
		$tableBody .= $row['email'];
		$tableBody .= "</td><td>";
		$tableBody .= $row['phone'];
		$tableBody .= "</td><td>";
		$tableBody .= $row['callRequired'];
		$tableBody .= "</td><td>";
		$tableBody .= $row['Priority'];
		$tableBody .= "</td><td>";
		$tableBody .= $row['Type'];
		$tableBody .= "</td><td>";
		$tableBody .= $row['Message'];//should really decouple this to a seperate table....//TODO if time permits
		$tableBody .= "</td><td>";
		$tableBody .= $row['requestDate'];
		$tableBody .= "</td><td>";
		$tableBody .= $row['Status'];
		$tableBody .= "</td></tr>";	
		
	}
	$tableBody .= "</table>";	
	echo $tableBody;
 }//end writeContactRequests
 
 

?>