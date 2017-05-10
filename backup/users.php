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

            $NewUserOutput = <<<EOL
<form action='users.php' method='POST'>
<table>
Please enter new user details:<br>
Username: <input type='text' name='newUser_username'><br>
Password: <input type='password' name='newUser_password_1'><br>
Confirm Password: <input type='password' name='newUser_password_2'><br>
EOL;

            debug($_SESSION['UAC_Level']);
            switch ($_SESSION['UAC_Level']){
                case 'User':
                    $NewUserOutput = $NewUserOutput . 'User Access Level: <select name="newUser_uacLevel" id="uacLevel"><option value="1 (User)">1 (User)</option><option value="2 (Staff)">2 (Staff)</option></select>';
                    break;
                case 'Admin':
                    $NewUserOutput = $NewUserOutput . 'User Access Level: <select name="newUser_uacLevel" id="uacLevel"><option value="1 (User)">1 (User)</option><option value="2 (Staff)">2 (Staff)</option><option value="3 (Admin)">3 (Admin)</option></select>';
                    break;
                case 'Owner':
                    $NewUserOutput = $NewUserOutput . 'User Access Level: <select name="newUser_uacLevel" id="uacLevel"><option value="1 (User)">1 (User)</option><option value="2 (Staff)">2 (Staff)</option><option value="3 (Admin)">3 (Admin)</option><option value="4 (Owner)">4 (Owner)</option></select>';
                    break;
            }

            $NewUserOutput = $NewUserOutput . <<<EOL
</table>
<input type='submit' value='Submit'>
</form>
EOL;

            $EditUserOutput = <<<EOL
<form action='users.php' method='POST'>
<table>
Please enter updated user details:<br>
<input type='hidden' name='originalUser' value="{$_POST['userToEdit']}">
Username: <input type='text' name='editUser_username' value="{$_POST['userToEdit']}"><br>
Password: <input type='password' name='editUser_password_1'><br>
Confirm Password: <input type='password' name='editUser_password_2'><br>
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
</table>
<input type='submit' value='Submit'>
</form>
EOL;

            if(!empty($_POST)){
                if(isset($_POST['newUser_username'])){
                    $newUsername = $_POST['newUser_username'];
                    $newPassword1 = $_POST['newUser_password_1'];
                    $newPassword2 = $_POST['newUser_password_2'];
                    $newUAC = $_POST['newUser_uacLevel'];

                    /* Checking if Passwords match */

                    if($newPassword1 == $newPassword2){
                        /* Passwords match, creating user. */
                        $query = "INSERT INTO users (userName, password, Staff) VALUES ('" . $newUsername . "', '" . $newPassword1 . "', '" . $newUAC[0] . "')";
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
                if(isset($_POST['userToEdit'])){
                    $userToEdit = $_POST['userToEdit'];

                    /*Get user details from DB*/

                    $query = "SELECT * FROM users WHERE userName = '" . $userToEdit . "'";
                    $result = mysqli_query($_SESSION['db'], $query) or die('Error querying database when trying to input new user.');
                    $results = mysqli_fetch_array($result);

                    $userName = $results['userName'];
                    $password = $results['password'];
                    $Staff = $results['Staff'];
                    
                    //echo ("$EditUserOutput($userName, $password, $Staff)");
					echo ("$EditUserOutput");
                }
                if(isset($_POST['userToDelete'])){
                    echo "User {$_POST['userToDelete']} deleted.";//--------------------------------------------------add
					
					//works but need to turn into function
					$sql = "DELETE FROM users WHERE userName='{$_POST['userToDelete']}'";
					mysqli_query($db, $sql);
					//---
					
					
                }
                if (isset($_POST['newUser_username'])){
                    echo "We have a user to create.";
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
				$sql = "UPDATE users SET userName='{$_POST['editUser_username']}' WHERE userName='{$_POST['originalUser']}'";
				echo($sql);
				mysqli_query($db, $sql);	
			}
			
			
			

        
        ?>
    </body>
</html>