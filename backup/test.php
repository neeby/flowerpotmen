<!--
File name: test.php
Date created: 20/04/2017
Purpose of file:
    > test page
    > Do things
-->

<head>
    <?PHP
include_once('functions.php');
	    session_start();
   // loginDB();
	$_SESSION['test'] = 'something';
   echo "<h3> PHP List All Session Variables</h3>";

print_r($_SESSION);

    
	

		
		$password = "superEasyToBreakPassword";
		
		echo $password. '<br>';
		echo crypt ($password,"pourAchunkOfSaltAllOverThis");
		echo '<br>';
		echo '<br>';
		echo encryptPassword($password);
		 
    ?>
    
    <title>
        Test Page
    </title>

</head>

<body>

</body>