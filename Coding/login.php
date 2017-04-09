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
//Step2
$query = "SELECT * FROM Users";
mysqli_query($db, $query) or die('Error querying database.');

$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);

while ($row = mysqli_fetch_array($result)) {
 echo $row['ID'] . ' ' . $row['userName'] . ': ' . $row['password'] . ' ' . $row['Staff'] .'<br />';
 echo '1';
}
//Step 4
mysqli_close($db);
?>
 
</body>
</html>