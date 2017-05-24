<!--
File name: staff.php
Date created: 23/05/2017
Purpose of file:


-->

<head>
    <?PHP
     global $db;

        define('DB_NAME', 'FlowerPotMen');
        define('DB_USER', 'root');
        define('DB_PASSWORD', 'password');
        define('DB_HOST', 'localhost');

        $db = mysqli_connect(DB_HOST ,DB_USER ,DB_PASSWORD ,DB_NAME)
        or die('Error connecting to MySQL server.');

        $_SESSION['db'] = $db;
    session_start();

			if(!isset($_SESSION['UAC_Level'])){
				header("Location: signInPage.php?error=signInRequired");
			}		
		include_once('functions.php');
	loginDB();
    $query = "SELECT * FROM Properties";
        mysqli_query($db, $query) or die('Error querying database.');

        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_array($result);
      
while ($row = mysql_fetch_assoc($result)) {
    echo $row["Address"];
    echo $row["Suburb"];
    echo $row["PostCode"];
}
		echo("Placeholder for Staff page");
		
echo("<form action='AddProperty.php'><input type='submit' value='Add property' /></form>	");		
	
		 
    ?>
    
    <title>
        Staff Page
    </title>

</head>

<body>

</body>