<!--
File name: home.php
Date created: 20/04/2017
Purpose of file:
    > Serve as landing page post-login
    > Act as first instance of user access control
    > Do things
-->

<head>
    <?PHP
        /*
            What's going on in this PHP bracket:
                session_start() so we can use the superglobal session values.
                include() so we can reference previously written functions.
                if(empty()) looks to see if there's a previously logged in user.
                    If there isn't, we log into the database, take the previously entered
                    details and verify them.
                Once there is a user logged in, we define their UAC (done in the tail end of
                verifyUser(), when is then passed into the writeMenu function which creates 
                the table based on what UAC level the user has.
        */

        session_start();
        include_once("functions.php");

         if(empty($_SESSION)){
            loginDB();
            $user = $_POST['userName'];
            $pass = $_POST['passWord'];

            verifyUser($user, $pass); 
         }
         writeMenu();
		 //print_r($_SESSION);
		 echo("<form action='contact.php'><input type='submit' value='Contact Us' /></form>	");
            echo("<form action='MyProperties.php'><input type='submit' value='My Properties' /></form>	");

    ?>
    
    <title>
        Home Page
    </title>
    <link rel='stylesheet'  type='text/css' href='stylesheet.css'>
</head>

<body>

</body>