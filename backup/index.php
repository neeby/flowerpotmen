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
		include_once('userFunctions.php');
        /*
        Checking for _GET value 'Logout', if this is true, we call the logout function
        which will kill a lot of session stuffs.
        */

        if(isset($_GET['logout'])){
            Logout();
        } 
        if(isset($_SESSION['UAC_Level'])){
            header("Location: home.php");
        }
/*move to signin page
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
		*/
		writeMenu();

		//print_r($_SESSION)		
		
    ?>

</body>