<!--
File name: MyProperties.php
Date created: 23/05/2017
Purpose of file:


-->

<head>
        <title>
        Property Page
    </title>
    </head>
<body>
    	<div align="center">

    <?PHP
    
    
    //----------------------------------- Connect to database
        include_once("functions.php");
        global $db;
        define('DB_NAME', 'FlowerPotMen');
        define('DB_USER', 'root');
        define('DB_PASSWORD', 'password');
        define('DB_HOST', 'localhost');

        $db = mysqli_connect(DB_HOST ,DB_USER ,DB_PASSWORD ,DB_NAME)
        or die('Error connecting to MySQL server.');

        $_SESSION['db'] = $db;//start session
    session_start();
			if(!isset($_SESSION['UAC_Level'])){//check for access level
				header("Location: signInPage.php?error=signInRequired");
			}	
                writeMenu();


        $type= $_GET['type'];
        $property= $_GET['property'];
        $Address= $_GET['Address'];
        $Suburb= $_GET['Suburb'];
        $PostCode= $_GET['PostCode'];
        $Bed= $_GET['Bed'];
        $Bath= $_GET['Bath'];
        $Car= $_GET['Car'];
        $Description= $_GET['Description'];
        $Image= $_GET['Image'];
        $Rent= $_GET['Rent'];
        $Code= $_GET['Code'];
            //-----assign variables from url
            //check if anything has been edited
            if ( isset( $_POST['Submit'] ) ) {
                    echo $_POST['Address'];
                    $sql = "UPDATE Properties SET Address='".$_POST['Address']."',Suburb = '".$_POST['Suburb']."',PostCode = '".$_POST['PostCode']."',BedRooms = '".$_POST['BedRooms']."',BathRooms = '".$_POST['BathRooms']."',CarPorts = '".$_POST['CarPorts']."',Description = '".$_POST['Description']."',Image = '".$_POST['Image']."',WeeklyRent = '".$_POST['WeeklyRent']."' WHERE Code='".$_POST['Code']."';";
                    //reload page
                    mysqli_query($db,$sql);
                    header("Location:MyProperties.php");

                }
                if($type == "e"){//if edit is chosen
                        $sql = "SELECT * FROM Properties WHERE Code='".$property."';";//get all current information
                        $row=mysqli_query($db,$sql);
                    
            ?>
    <div align="center">
		<form action='' method='POST'>
		
			<table>

				<tr>
					<td><label for="Address">Address: </label></td>
					<td><input type="text" name="Address" value="<?php echo( $Address); ?>" required/><br /></td>
				</tr>
				<tr>
					<td><label for="Suburb">Suburb: </label></td>
					<td><input type="text" name="Suburb" value="<?php  echo( $Suburb); ?>"required/><br /></td>
				</tr>
				<tr>
					<td><label for="PostCode">PostCode: </label></td>
					<td><input type="text" name="PostCode" value="<?php  echo( $PostCode); ?>"required/><br /></td>
				</tr>
				<tr>
					<td><label for="BedRooms">BedRooms: </label></td>
					<td><input type="text" name="BedRooms" value="<?php  echo( $Bed); ?>" required/><br /></td>
				</tr>
				<tr>
					<td><label for="BathRooms">BathRooms: </label></td>
					<td><input type="text" name="BathRooms" value="<?php  echo( $Bath );?>" required/><br /></td>
				</tr>	
				<tr>
					<td><label for="CarPorts">CarPorts: </label></td>
					<td><input type="text" name="CarPorts" value="<?php  echo( $Car); ?>"required /><br /></td>
				</tr>				
				<tr>
					<td><label for="Description">Description: </label></td>
					<td><input type="text" name="Description" value="<?php  echo($Description); ?>" required/><br /></td>
				</tr>				
				<tr>
					<td><label for="Image">Image: </label></td>
					<td><input type="url" name="Image" value="<?php  echo( $Image); ?>" required/><br /></td>
				</tr>				
				<tr>
					<td><label for="WeeklyRent">WeeklyRent: </label></td>
					<td><input type="text" name="WeeklyRent" value="<?php  echo( $Rent); ?>"required /><br /></td>
				</tr>				
													<tr>
					<td><label for="Code">Code: </label></td>
					<td><input type="text" name="Code" value="<?php  echo( $Code); ?>"required readonly /><br /></td>
				</tr>		
			</table>

			<input type="submit" name="Submit" />
		</form>
	</div>
	<?PHP
//fill form with current data
    }else if($type == "d"){
        $sql="DELETE FROM Properties WHERE Code ='".$property."';";
        mysqli_query($db,$sql);
        header("Location:MyProperties.php");

    }else{
    
    //------------------------------------setup tables
 
            $sql = "SELECT * FROM Properties WHERE Owner ='".$_SESSION['POST_User']."'";
            $result=mysqli_query($db,$sql);
		        echo("Your Properties");
                echo '<table><tr>';
                echo "<td> <b>House Address</td>"."<td><b> Owner </td>"."<td><b>Address </td>";
                echo "</tr>";
  
                echo "</tr>";
      
//
    while ($row=mysqli_fetch_array($result,MYSQLI_NUM)) {//for each result
         echo "<tr><td><img src=".$row[8]." height='42' width='42'>".$row[0]."</td>"."<td>".$row[11]."</td>"."<td>".$row[1]."</td><td><a href='MyProperties.php?type=e&Address=".$row[1]."&Suburb=".$row[2]."&PostCode=".$row[3]."&Bed=".$row[4]."&Bath=".$row[5]."&Car=".$row[6]."&Description=".$row[7]."&Image=".$row[8]."&Rent=".$row[9]."&Code=".$row[0]."'><input type='button' value='Edit'></a></td><td><a href='MyProperties.php?type=d&property=".$row[0]."'><input type='button' value='Delete'></a></td><td>";
            if($row[10]==0){
                echo "<td>Not Verified</td>";
            }else {
                echo "<td>Verified</td>";
            }
                echo "<td><a href='propertylisting.php?id=".$row[0]."'><input type='button' value='View'></a></td>";
        
            echo "</tr>";
  //end table
            }
            echo "</table>"; 
            }//here closes else
    ?>
    





</body>
    </div>
</html>