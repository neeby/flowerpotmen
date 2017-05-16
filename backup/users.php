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
            session_start();
            writeMenu($_SESSION['UAC_Level']);
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
		<td><input type="text" name="tel" /><br value="{$telephone}"/></td>
	</tr>				
	<tr>
		<td><label for="add">Address: </label></td>
		<td><input type="text" name="add" /><br value="{$address}"/></td>
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
						//replace with userAdd or whatever i called it
							$query = "INSERT INTO `Users` (`userName`, `password`, `Staff`, `firstName`, `otherName`, `surName`, `DOB`, `email`, `phone`, `address`) VALUES (";
							$query .= "'{$newUsername}', ";
							$query .= "'{$newPassword1}', ";
							$query .= "'{$newUAC[0]}', ";
							$query .= "'{$_POST['firstName']}', ";
							$query .= "'{$_POST['otherName']}', ";
							$query .= "'{$_POST['surName']}', ";
			
							$query .= "'{$_POST['dob']}', ";
							$query .= "'{$_POST['email']}', ";
							$query .= "'{$_POST['tel']}', ";	
							$query .= "'{$_POST['add']}'";								
							$query .= ')';

							echo $query;

							if(mysqli_query($_SESSION['db'], $query) or die('Error querying database when trying to input new user.')){
								
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

                    echo "User {$_POST['userToDelete']} deleted.";//------------------add loop to delete every user ticked - include unable to delete above your access lvl(inclusive?)
					// loop through deleting each or add to an array if to be deleted - then cycle through array - 1st option probably
					//deleteUser($_POST['userToDelete']);
					
					if(!empty($_POST['userToDelete'])){
					// Loop to store and display values of individual checked checkbox.
						foreach($_POST['userToDelete'] as $selected){
						//echo $selected."</br>";
						deleteUser($selected);
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
                        writeUserList('View');
                        break;
                    case 'Edit':
                        writeUserList('Edit');
                        break;
                    case 'Delete':
                        writeUserList('Delete');
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
				$sql = "UPDATE Users SET userName='{$_POST['editUser_username']}' WHERE userName='{$_POST['originalUser']}'";
				echo($sql);
				mysqli_query($db, $sql);	
			}

        ?>
    </body>
</html>