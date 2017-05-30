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
     
//$sql="INSERT INTO properties (uniqueCode,address,suburb,postcode,bed,bath,car,description,image,weeklyRent) VALUES('$_POST[uniqueCode]','$_POST[address]','$_POST[suburb]','$_POST[postcode]','$_POST[bed]','$_POST[bath]','$_POST[car]','$_POST[description]','$_POST[image]','$_POST[weeklyRent]')";
$query = "CREATE TABLE " . $_POST['ID'] . "( PersonID int, LastName varchar(255), FirstName varchar(255), Address varchar(255), City varchar(255) )";
     
//$query = "SELECT * FROM Users";
if(!mysqli_query($db, $query)){
    echo "Shit didn't work.";
} else {
    echo "Well it must have worked.";
}
echo($query);

/*
if(!mysqli_query($db, $query) or die('Error querying database.')){
    echo $query;
} else {
    echo "Ayyy it worked."
}
    
//$result = mysqli_query($db, $query);
//$row = mysqli_fetch_array($result);

         
      //   mysqli_query($db, $query) or die('Error querying database.');

     
     
//Step 4
mysqli_close($db);
?>
 
</body>
</html>