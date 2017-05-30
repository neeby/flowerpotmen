<?php

define('DB_NAME', 'FlowerPotMen');
define('DB_USER', 'root');
define('DB_PASSWORD', 'password');
define('DB_HOST', 'localhost');


//Step1
 $db = mysqli_connect(DB_HOST ,DB_USER ,DB_PASSWORD ,DB_NAME)
 or die('Error connecting to MySQL server.');
?>

<html>
 <head>
 </head>
 <body>
 <h1>PHP connect to MySQL</h1>
 
<?php
//no entry in login will validate - fix via not submitting if username/passwod not completed at login
//check that email is unique
     
$sql="INSERT INTO Users (fname, lname,password,email,mobile,address) VALUES('$_POST[fname]','$_POST[lname]','$_POST[password]','$_POST[email]','$_POST[mobile]','$_POST[address]')";
$query = "SELECT email FROM Users WHERE email = '$_POST[email]'";
     mysqli_query($db, $query) or die('Error querying database.');
$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);
     

     if ($row['email'] == $_POST[email]) {
	echo ("That email is already taken <br>");
     } else{
         
        
         
         mysqli_query($db, $sql) or die('Error querying database.');

         
         
     }


     
     

     

//Step 4
mysqli_close($db);



?>
 
</body>
</html>



