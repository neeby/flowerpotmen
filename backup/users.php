<!--
File name: users.php
Date created: 22/04/2017
Purpose of file: 
    > Displays a lists of users. 
    > Allows staff/admins/owners to add/change/delete users.
-->

<html>
    <head>
        <?PHP
            global $debugBool;
            $debugBool = false;

            include_once("functions.php");
			include_once("userFunctions.php");
            session_start();
            writeMenu();
            loginDB();
            checkDB(0);
        
            function debug($input){
                global $debugBool;
                
                if($debugBool == true){
                    echo $input;
                }
            }
        ?>

        <title>
            Users
        </title>
    </head>

    <body>
        <?PHP
            writeLeftSidebar('users');
			
			if(isset($_POST['userToEdit'])){//only change atm is username - extend to other fields
				$userToEdit = $_POST['userToEdit'];

				/*Get user details from DB*/

				$query = "SELECT * FROM Users WHERE userName = '" . $userToEdit . "'";
				$result = mysqli_query($_SESSION['db'], $query) or die('Error querying database when trying to input new user.');
				$results = mysqli_fetch_array($result);

				$Staff = $results['Staff'];
				$userName = $results['userName'];
				$password = $results['password'];
				
				$firstName = $results['firstName'];
				$otherName = $results['otherName'];
				$surname = $results['surName'];
				$dob = $results['DOB'];
				$email = $results['email'];
				$telephone = $results['phone'];
				$address = $results['address'];

            $EditUserOutput = <<<EOL
<form action='users.php' method='POST'>

Please enter updated user details for User {$_POST['userToEdit']}:<br>
<input type='hidden' name='originalUser' value="{$_POST['userToEdit']}">

<table>
	<tr>
		<td><label for="userName">Username: </label></td>
		<td><input type="text" name="editUser_username" value="{$_POST['userToEdit']}"/><br /></td>
	</tr>
	<tr>
		<td><label for="pwd">Password: </label></td>
		<td><input type="password" name="editUser_password_1" /><br /></td>
	</tr>
	<tr>
		<td><label for="conPwd">Confirm Password: </label></td>
		<td><input type="password" name="editUser_password_2" /><br /></td>
	</tr>
	<tr>
		<td><label for="firstName">First Name: </label></td>
		<td><input type="text" name="firstName" value="{$firstName}" /><br /></td>
	</tr>
	<tr>
		<td><label for="otherName">Other Names: </label></td>
		<td><input type="text" name="otherName" value="{$otherName}" /><br /></td>
	</tr>	
	<tr>
		<td><label for="surname">Surname: </label></td>
		<td><input type="text" name="surname" value="{$surname}" /><br /></td>
	</tr>				
	<tr>
		<td><label for="dob">Date of Birth: </label></td>
		<td><input type="date" name="dob" value="{$dob}" /><br /></td>
	</tr>				
	<tr>
		<td><label for="email">Email: </label></td>
		<td><input type="email" name="email" value="{$email}"/><br /></td>
	</tr>				
	<tr>
		<td><label for="tel">Telephone: </label></td>
		<td><input type="text" name="tel" value="{$telephone}"/></td>
	</tr>				
	<tr>
		<td><label for="add">Address: </label></td>
		<td><input type="text" name="add" value="{$address}"/></td>
	</tr>	


EOL;
//print_r($_POST);
            debug($_SESSION['UAC_Level']);
            switch ($_SESSION['UAC_Level']){
                case 'User':
                    $EditUserOutput = $EditUserOutput . 'User Access Level: <select name="editUser_uacLevel" id="uacLevel"><option value="1 (User)">1 (User)</option><option value="2 (Staff)">2 (Staff)</option></select>';
                    break;
                case 'Admin':
                    $EditUserOutput = $EditUserOutput . 'User Access Level: <select name="editUser_uacLevel" id="uacLevel"><option value="1 (User)">1 (User)</option><option value="2 (Staff)">2 (Staff)</option><option value="3 (Admin)">3 (Admin)</option></select>';
                    break;
                case 'Owner':
                    $EditUserOutput = $EditUserOutput . 'User Access Level: <select name="editUser_uacLevel" id="uacLevel"><option value="1 (User)">1 (User)</option><option value="2 (Staff)">2 (Staff)</option><option value="3 (Admin)">3 (Admin)</option><option value="4 (Owner)">4 (Owner)</option></select>';
                    break;
            }

            $EditUserOutput = $EditUserOutput . <<<EOL
			
	<tr>
		<td></td>
		<td><input type='submit' value='Submit'></td>
	</tr>
</table>

</form>
EOL;

				echo ("$EditUserOutput");
			}			

            $NewUserOutput = <<<EOL
<form action='users.php' method='POST'>
		Please enter new user details:	
<table>

	<tr>
		<td><label for="userName">Username: </label></td>
		<td><input type="text" name="newUser_username" /><br /></td>
	</tr>
	<tr>
		<td><label for="pwd">Password: </label></td>
		<td><input type="password" name="newUser_password_1" /><br /></td>
	</tr>
	<tr>
		<td><label for="conPwd">Confirm Password: </label></td>
		<td><input type="password" name="newUser_password_2" /><br /></td>
	</tr>
	<tr>
		<td><label for="firstName">First Name: </label></td>
		<td><input type="text" name="firstName" /><br /></td>
	</tr>
	<tr>
		<td><label for="otherName">Other Names: </label></td>
		<td><input type="text" name="otherName" /><br /></td>
	</tr>	
	<tr>
		<td><label for="surname">Surname: </label></td>
		<td><input type="text" name="surName" /><br /></td>
	</tr>				
	<tr>
		<td><label for="dob">Date of Birth: </label></td>
		<td><input type="date" name="dob" /><br /></td>
	</tr>				
	<tr>
		<td><label for="email">Email: </label></td>
		<td><input type="email" name="email" /><br /></td>
	</tr>				
	<tr>
		<td><label for="tel">Telephone: </label></td>
		<td><input type="text" name="tel" /><br /></td>
	</tr>				
	<tr>
		<td><label for="add">Address: </label></td>
		<td><input type="text" name="add" /><br /></td>
	</tr>	
	<tr>
	<td>
	User Access Level:
	</td>
	<td>
EOL;

		debug($_SESSION['UAC_Level']);
		switch ($_SESSION['UAC_Level']){
			case 'User':
				$NewUserOutput = $NewUserOutput . '<select name="newUser_uacLevel" id="uacLevel"><option value="1 (User)">1 (User)</option><option value="2 (Staff)">2 (Staff)</option></select>';
				break;
			case 'Admin':
				$NewUserOutput = $NewUserOutput . '<select name="newUser_uacLevel" id="uacLevel"><option value="1 (User)">1 (User)</option><option value="2 (Staff)">2 (Staff)</option><option value="3 (Admin)">3 (Admin)</option></select>';
				break;
			case 'Owner':
				$NewUserOutput = $NewUserOutput . '<select name="newUser_uacLevel" id="uacLevel"><option value="1 (User)">1 (User)</option><option value="2 (Staff)">2 (Staff)</option><option value="3 (Admin)">3 (Admin)</option><option value="4 (Owner)">4 (Owner)</option></select>';
				break;
		}

		$NewUserOutput = $NewUserOutput . <<<EOL
		</td>
	</tr>
	<tr>
		<td></td>
		<td><input type='submit' value='Submit'></td>	
	</tr>
</table>

</form>
EOL;


            if(!empty($_POST)){
                if(isset($_POST['newUser_username'])){
                    $newUsername = $_POST['newUser_username'];
                    $newPassword1 = $_POST['newUser_password_1'];
                    $newPassword2 = $_POST['newUser_password_2'];
                    $newUAC = $_POST['newUser_uacLevel'];

					//check userName doesn't exist
					

                    /* Checking if Passwords match */
					
						if($newPassword1 == $newPassword2){
							/* Passwords match, creating user. */
							
							if(addUser ( $newUsername, $newPassword1, $newUAC[0], $_POST['firstName'], $_POST['otherName'], $_POST['surName'], $_POST['dob'], $_POST['email'], $_POST['tel'], $_POST['add']) or die('Error querying database when trying to input new user.')){
								
								header("Location: users.php?message=newuserSuccess");
								exit();
							}							
							
						} else {
							/* Passwords don't match, return to users with error. */
							header("Location: users.php?message=newuserFailure");
							exit();
						}
                }
		
                if(isset($_POST['userToDelete'])){

                    
					
					if(!empty($_POST['userToDelete'])){

						foreach($_POST['userToDelete'] as $selected){
						deleteUser($selected);
						echo "User {$selected} deleted.<br>";
						}
					}
                }

            } else {
                debug("Ain't no POST round here.");
            }
           
            if (isset($_GET['action'])){
                switch ($_GET['action']){
                    case 'New':
                        echo $NewUserOutput;
                        break;
                    case 'View':
                        //writeUserList('View');
						writeUserListFull('View');
                        break;
                    case 'Edit':
                        //writeUserList('Edit');
						writeUserListFull('Edit');
                        break;
                    case 'Delete':
                        //writeUserList('Delete');
						writeUserListFull('Delete');
                        break;
                }   
            }

            if (isset($_GET['message'])){
                switch ($_GET['message']){
                    case 'newuserSuccess':
                        echo "Congratulations. New user was successfully created.";
                        break;
                    case 'newuserFailure':
                        echo "Sorry there was an issue creating a new user. Please try again.";
                        break;
                }
            }
			
			if (isset($_POST['editUser_username'])){ 
			//[`userName`, `password`, `Staff`, `firstName`, `otherName`, `surName`, `DOB`, `email`, `phone`, `address`]
			$updatedUserDetails = array(
				"userName" => "{$_POST['editUser_username']}",
				"password" => "{$_POST['editUser_password_1']}",
				"Staff" => 1,
				"firstName" => "{$_POST['firstName']}",
				"otherName" => "{$_POST['otherName']}",
				"surName" => "{$_POST['surname']}",
				"DOB" => date("Y-m-d", strtotime($_POST['dob'])),
				"email" => "{$_POST['email']}",	
				"phone" => "{$_POST['tel']}",
				"address" => "{$_POST['add']}",
			);
				
				if(editUser ( $_POST['originalUser'], $updatedUserDetails)){
					echo "User " . $_POST['originalUser'] . " details updated.<br>";	
				} else {
					echo "CARE - User " . $_POST['originalUser'] . " details not updated.<br>";
				}

			}
		//print_r($_SESSION);
        ?>
    </body>
</html>