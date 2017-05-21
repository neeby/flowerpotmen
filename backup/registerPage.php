<?php
	include_once("functions.php");
	include_once('userFunctions.php');
	
//check if submit is set
   if ( isset( $_POST['Submit'] ) ) {

	loginDB();
	if(queryUser ($_POST['userName'])){
		echo ('User name already exists - please try a different user name.');

	} else {
		//todo ensure form completed in full
		$fieldsCompleted = 0;
		//yes i know - missing conPwd but the if pwd == conPwd ensures it must be completed & otherName is optional
		$fields = array('userName', 'pwd', 'firstName', 'surname', 'dob', 'email', 'tel', 'add');

	foreach($fields AS $fieldname) { //Loop trough each field
		if(isset($_POST[$fieldname]) && !empty($_POST[$fieldname])) {
			$fieldsCompleted++;
		} else {
			//construct message here RE which fields incomplete if i feel like it - not really required for such a small form
			break;
		}
	}//foreach	 
	if ($fieldsCompleted == 8){
		if ($_POST['pwd'] == $_POST['conPwd']){
			$UAC_User = 1;
			addUser ( $_POST['userName'], $_POST['pwd'], $UAC_User, $_POST['firstName'], $_POST['otherName'], $_POST['surname'], $_POST['dob'] , $_POST['email'] , $_POST['tel'] , $_POST['add'] );
			
			defineUAC($UAC_User);
			$_SESSION['POST_User'] = $_POST['userName'];
			$_SESSION['POST_Pass'] = $_POST['pwd'];	
//logging in as visitor - should be logging in as User			
			header("Location: home.php");
		} else {
			
			echo ('Please ensure password and confirm password fields match.');
		  }		
	 } else {
		echo ('Please ensure all fields are completed'); 
	 }

	}
   }//end isset[Submit]

?>

<html>
<head>
<title>Page Title</title>
</head>
<body>


	<div align="center">
		<form action='' method='POST'>
		
			<table>

				<tr>
					<td><label for="userName">Username *: </label></td>
					<td><input type="text" name="userName" value="<?php echo $_POST['userName'] ?>" /><br /></td>
				</tr>
				<tr>
					<td><label for="pwd">Password *: </label></td>
					<td><input type="password" name="pwd" /><br /></td>
				</tr>
				<tr>
					<td><label for="conPwd">Confirm Password *: </label></td>
					<td><input type="password" name="conPwd" /><br /></td>
				</tr>
				<tr>
					<td><label for="firstName">First Name *: </label></td>
					<td><input type="text" name="firstName" value="<?php echo $_POST['firstName'] ?>" /><br /></td>
				</tr>
				<tr>
					<td><label for="otherName">Other Names *: </label></td>
					<td><input type="text" name="otherName" value="<?php echo $_POST['otherName'] ?>" /><br /></td>
				</tr>	
				<tr>
					<td><label for="surname">Surname *: </label></td>
					<td><input type="text" name="surname" value="<?php echo $_POST['surname'] ?>" /><br /></td>
				</tr>				
				<tr>
					<td><label for="dob">Date of Birth *: </label></td>
					<td><input type="date" name="dob" value="<?php echo $_POST['dob'] ?>" /><br /></td>
				</tr>				
				<tr>
					<td><label for="email">Email *: </label></td>
					<td><input type="email" name="email" value="<?php echo $_POST['email'] ?>" /><br /></td>
				</tr>				
				<tr>
					<td><label for="tel">Telephone: </label></td>
					<td><input type="text" name="tel" value="<?php echo $_POST['tel'] ?>" /><br /></td>
				</tr>				
				<tr>
					<td><label for="add">Address *: </label></td>
					<td><input type="text" name="add" value="<?php echo $_POST['add'] ?>" /><br /></td>
				</tr>							
			</table>

			<input type="submit" name="Submit" />
		</form>
	</div>
	
<p>Note: Please make sure your details are correct before submitting form and that all fields marked with * are completed!.</p>

<?php

//check if submit is set



//ensure username is unique

//add new user 



?>

</body>
</html>