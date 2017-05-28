<!--
File name: staff.php
Date created: 23/05/2017
Purpose of file:


-->

<head>
        <title>
        Staff Page
    </title>
    </head>
<body>
    <?PHP
    
    
    //-----------------------------------
            include_once("functions.php");
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
                writeMenu();

     writeLeftSidebar('staff');
    $type= $_GET['type'];
    if($type == "v"){
     echo "v";   
    }
    else if($type == "e"){
             echo "e";   

    }else if($type == "d"){
             echo "d";   

    }else{
        
    
    
    
    
    
    
    //------------------------------------
 
    
    

$sql = "SELECT * FROM Properties";
$result=mysqli_query($db,$sql);
    

		echo("Placeholder for Staff page");
		
	
		  echo '<table><tr>';
    echo "<td> <b>House Address</td>"."<td><b> Owner </td>"."<td><b>Suburb </td>";
    echo "</tr>";
  
    echo "</tr>";
      
//
    while ($row=mysqli_fetch_array($result,MYSQLI_NUM)) {
      //  echo "<td>".row[0]."</td>";
         echo "<tr><td><img src=".$row[8]." height='42' width='42'>".$row[0]."</td>"."<td>".$row[10]."</td>"."<td>".$row[2]."</td><td><a href='properties.php'><input type='button' value='Edit'></a></td><td><a href='properties.php'><input type='button' value='Delete'></a></td><td><a href='properties.php'><input type='button' value='Verify'></a></td><td><a href='staff.php?type=v&property=".$row[0]."'><input type='button' value='View Inspections'></a></td><td><a href='properties.php'><input type='button' value='View'></a></td>";
        
    echo "</tr>";
  //
    }
echo "</table>"; 
    }//here closes else
    ?>
    





</body>