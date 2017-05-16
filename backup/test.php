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
		

		
		
		echo crypt ('catpassword',"pourAchunkOfSaltAllOverThis"). " = cat" . "<br>";
		echo encryptPassword('catpassword') . " = cat<br>";
		echo crypt ('wolfpassword',"pourAchunkOfSaltAllOverThis"). " = wolf" . "<br>";
		echo encryptPassword('wolfpassword') . " = wolf<br>";
		echo crypt ('dogpassword',"pourAchunkOfSaltAllOverThis"). " = dog" . "<br>";
		echo encryptPassword('dogpassword') . " = dog<br>";
		echo crypt ('foxpassword',"pourAchunkOfSaltAllOverThis"). " = fox" . "<br>";
		echo encryptPassword('foxpassword') . " = fox<br>";
		
		
		
		
		 
    ?>
    
    <title>
        Test Page
    </title>

</head>

<body>

</body>