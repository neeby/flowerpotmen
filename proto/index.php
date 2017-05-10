<!--
File name: index.php
Date created: 20/04/2017
Purpose of file: Serve as landing page for visitors, allows for login to home.
*/
-->

<head>
    <title>
        Welcome
    </title>
    <link rel='stylesheet'  type='text/css' href='stylesheet.css'>
</head>

<body class="home">

    <?PHP
        session_start();
        include_once('functions.php');

        /*
        Checking for _GET value 'Logout', if this is true, we call the logout function
        which will kill a lot of session stuffs.
        */

        if(isset($_GET['logout'])){
            Logout();
        } 
    
        if(isset($_POST['signup_userName']) AND isset($_POST['signup_passWord'])){
            global $db;

            /*
                Because singup_userName + signup_passWord is set, we can assume the user has just submitted the 
                request to create an account because that POST would get destroyed at the end of this function.
            */

            $signupUser = $_POST['signup_userName'];
            $signupPass = $_POST['signup_passWord'];
            
            $query = "INSERT INTO `users`(`userName`, `password`, `Staff`) VALUES ('" . $signupUser . "','" . $signupPass . "','1')";
            echo $query;
            loginDB();
            /*checkDB(0);*/

            mysqli_query($_SESSION['db'], $query) or die('Error querying database.');
            
            /* So at this point the query should have gone through. Let's just check that. */

            $newQuery = "SELECT * FROM users WHERE userName = '{$signupUser}'";
            if(mysqli_query($db, $query)){
                /* 
                    This should mean that the entry worked. I'm gonna pass the acknowledgement
                    as a "error" message, but I'm just doing that because the error reporting
                    already has an established platform for feedback to the user.
                */
                header("Location: index.php?error=SignupSuccess");
                exit(); 
            } else {
                /*
                    Assume something went wrong. Send them back to the default page with a
                    generic error message and let them swear and punch their computer.
                */
                header("Location: index.php?error=SignupFailure");
                exit();
            }

            /* Destory the two POST variables when we're finished. */
            unset($_POST['signup_userName']);
            unset($_POST['signup_passWord']);
        }

/*
        $LoginForm = <<<EOL
<div class='LoginFormContain'>
<form action='home.php' method='POST'>
    Username: <input type='text' name='userName'><br/>
    Password: <input type='password' name='passWord'><br/>
    <input type='submit' value='Login'>
</form>
<a href="index.php?newUser=true">New User? Signup Here!</a>
</div>
EOL;
*/
    $SignupForm = <<<EOL
<div class='LoginFormContain'>
<form action='index.php' method='POST'>
    Username: <input type='text' name='signup_userName'><br/>
    Password: <input type='password' name='signup_passWord'><br/>
    <input type='submit' value='Signup'>
</form>
</div>
EOL;

        if(isset($_GET['newUser'])){
            echo $SignupForm;
        } else {
            echo $LoginForm;
        }

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
                case 'SignupSuccess':
                    echo "<div style='text-align: center;'>Congratulations, signup successful. Please sign in.</div>";
                    break;
                case 'SignupFailure':
                    echo "<div style='text-align: center;'Sorry, there was an issue when we tried to sign you up. Please try again.</div>";
                    break;
                default:
                    echo "<div style='text-align: center;'>Sorry, I'm not sure what you did there.</div>";
                    break;
            }
        }
		echo(hyper("SignIn") . "<br>" . hyper("Register"));
	
    ?>
	


</body>