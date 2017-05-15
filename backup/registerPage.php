<?php
	include_once("functions.php");
//check if submit is set
   if ( isset( $_POST['Submit'] ) ) {
	//ensure username is unique
	//Logout();
	print_r($_POST);
	loginDB();
	if(queryUser ($_POST['userName'])){
		echo ('User name already exists - please try a different user name.');
		//todo repopulate form
		
		
	} else {
		//todo add user 
		echo ('add user to DB');
		if ($_POST['pwd'] == $_POST['conPwd']){
			addUser(1);
			//redirect to loged in page
			$_SESSION['UAC_Level'] = "User";
			$_SESSION['POST_User'] = $_POST['userName'];
			$_SESSION['POST_Pass'] = $_POST['pwd'];			
			header("Location: home.php");
		} else {
			echo ('please confirm password matches');
			//todo repopulate form
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