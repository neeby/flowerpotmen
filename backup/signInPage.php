<!--
File name: signInPage.php
Date created: 06/05/2017
Purpose of file: Serve as landing page for visitors, allows for login to home.
*/
-->

<head>
    <title>
        Welcome
    </title>
    <link rel='stylesheet'  type='text/css' href='stylesheet.css'>
</head>

<body>

	<?PHP
        session_start();
        include_once('functions.php');

		Logout();

        /*
            This section here checks for a GET error and actions accordingly.
            Good for providing feedback to the user.
        */

        if(isset($_GET["error"])){
            switch ($_GET['error']) {
                case 'invalidUsername':
                    echo "<div style='text-align: center;'>Sorry, that username is not valid.</div>";
                    break;
                case 'invalidPassword':
                    echo "<div style='text-align: center;'>Sorry, that password is not valid.</div>";
                    break;
                case 'signInRequired':
                    echo "<div style='text-align: center;'>Please sign in to view the requested page.</div>";
                    break;
                default:
                    echo "<div style='text-align: center;'>Sorry, I'm not sure what you did there.</div>";
                    break;
            }
        }
		//print_r($_SESSION);
    ?>

	<div align="center">
		<form action='home.php' method='POST'>
		
			<table>
				<tr>
					<td><label for="userName">Username: </label></td>
					<td><input type="text" name="userName" value="<?php echo $_POST['userName'] ?>" /><br /></td>
				</tr>
				<tr>
					<td><label for="pwd">Password: </label></td>
					<td><input type="password" name="passWord" /><br /></td>
				</tr>					
			</table>

			<input type="submit" name="Login" />
		</form>
		<p>Not a member yet？<a href="registerPage.php">Sign Up Now</a></p>
	</div>
	
	

    
<br><br>Available Usernames/Passwords/AccessLevels:<br><br>

Cat / catpassword / 1 (User)<br>
Wolf / wolfpassword / 2 (Staff)<br>
Dog / dogpassword / 3 (Admin)<br>
Fox / foxpassword / 4 (Owner)<br>

</body>