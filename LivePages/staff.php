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
    	<div align="center">

    <?PHP
    
    
    //----------------------------------- CONNECT TO DATABASE
            include_once("functions.php");
            global $db;

        define('DB_NAME', 'FlowerPotMen');
        define('DB_USER', 'root');
        define('DB_PASSWORD', 'password');
        define('DB_HOST', 'localhost');

        $db = mysqli_connect(DB_HOST ,DB_USER ,DB_PASSWORD ,DB_NAME)
        or die('Error connecting to MySQL server.');

        $_SESSION['db'] = $db;//open session
    session_start();
			if(!isset($_SESSION['UAC_Level'])|| ($_SESSION['UAC_Level'])=="Visitor"|| ($_SESSION['UAC_Level'])=="Owner"|| ($_SESSION['UAC_Level'])=="User"){
				header("Location: signInPage.php?error=signInRequired");
			}	//checks if user is allowed access
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
            //-----------------sets up variables for the page depending on which buttons are pressed
            
            if ( isset( $_POST['assign'] ) ) {//checks if staff have been assigned


                $sql="UPDATE Properties SET Staff='".$_POST['staff']."' WHERE Code = '".$property."'";
                mysqli_query($db,$sql);
            }//assigns staff to properties
                       
                   
           if ( isset( $_POST['Submit'] ) ) {//checks if changes were made in the edit function
               echo $_POST['Address'];
               $sql = "UPDATE Properties SET Address='".$_POST['Address']."',Suburb = '".$_POST['Suburb']."',PostCode = '".$_POST['PostCode']."',BedRooms = '".$_POST['BedRooms']."',BathRooms = '".$_POST['BathRooms']."',CarPorts = '".$_POST['CarPorts']."',Description = '".$_POST['Description']."',Image = '".$_POST['Image']."',WeeklyRent = '".$_POST['WeeklyRent']."' WHERE Code='".$_POST['Code']."';";

               
                mysqli_query($db,$sql);//runs query and reloads page
                header("Location:staff.php");

                }
            if($type == "v"){
                $sql = "UPDATE Properties SET Verified=1 WHERE Code='".$property."';";//runs verified code
                mysqli_query($db,$sql);
                header("Location:staff.php");//reload code

            }
            else if($type == "e"){//if edit button
                $sql = "SELECT * FROM Properties WHERE Code='".$property."';";
                $row=mysqli_query($db,$sql);//select all data to refill form
                //-----------------HTML FORM for edit
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

    }else if($type == "d"){//if delete button
                $sql="DELETE FROM Properties WHERE Code ='".$property."';";
                mysqli_query($db,$sql);//delete code from table and drop tables
                $sql=" DROP TABLE `".$property."`";
                mysqli_query($db,$sql);

                header("Location:staff.php");
        

            }  else{
        //-----------------fill inspection times
                if($type == "I"){
       
                $sql = "SELECT * FROM ".$property;
                $result=mysqli_query($db,$sql);
    

		          echo("Inspection Times for ".$property);
		//creates table for inspection times
	
		          echo '<table><tr>';
                echo "<td> <b>UserName</td>"."<td><b> Inspection Time </td>";
                echo "</tr>";
  
                echo "</tr>";
      
//
                while ($row=mysqli_fetch_array($result,MYSQLI_NUM)) {
                        echo "<tr><td>".$row[0]."</td>"."<td>".$row[1]."</td>";
                        echo "</tr>";
  //
                }
                echo "</table>"; 

                }
    //------------------------------------
 
    
    

                $sql = "SELECT * FROM Properties";
                $result=mysqli_query($db,$sql);
		        echo("Property view for Staff");
                echo '<table><tr>';
                echo "<td> <b>House Address</td>"."<td><b> Owner </td>"."<td><b>Address </td>";
                echo "</tr>";
                echo "</tr>";
      
//fill each table column and row
    while ($row=mysqli_fetch_array($result,MYSQLI_NUM)) {
      //  echo "<td>".row[0]."</td>";
         echo "<tr><td><img src=".$row[8]." height='42' width='42'>".$row[0]."</td>"."<td>".$row[11]."</td>"."<td>".$row[1]."</td><td><a href='staff.php?type=e&Address=".$row[1]."&Suburb=".$row[2]."&PostCode=".$row[3]."&Bed=".$row[4]."&Bath=".$row[5]."&Car=".$row[6]."&Description=".$row[7]."&Image=".$row[8]."&Rent=".$row[9]."&Code=".$row[0]."'><input type='button' value='Edit'></a></td><td><a href='staff.php?type=d&property=".$row[0]."'><input type='button' value='Delete'></a></td><td><a href='staff.php?type=I&property=".$row[0]."'><input type='button' value='View Inspections'></a></td>";
            if($row[10]==0){
                echo "<td><a href='staff.php?type=v&property=".$row[0]."'><input type='button' value='Verify'></a></td>";
            }else {
                echo "<td></td>";
            }
                echo "<td><a href='propertylisting.php?id=".$row[0]."'><input type='button' value='View'></a></td>";
       
        if(($_SESSION['UAC_Level'])=="David"||($_SESSION['UAC_Level'])=="Admin"){//if admin or david logged in
            echo("<td>");
            echo ("<form action='staff.php?type=s&property=".$row[0]."'method='POST'>");//make a drop down form to assign staff
            echo(" <select name='staff'>");
            $sql2 = "SELECT userName FROM Users WHERE Staff = 2";//get staff
            $result2=mysqli_query($db,$sql2);

                while ($row2=mysqli_fetch_array($result2,MYSQLI_NUM)) {//while there are staff members
                    if($row[12]==""){
                        echo("    <option disabled selected value> -- select an option -- </option>");//add empty option for no staff

        
                    }
                        echo(" <option value='".$row2[0]."'");//fill row
                if($row[12]==$row2[0]){
                        echo("selected>".$row2[0]."</option>");//if it is the current staff member then select it

                }else{
                       echo(">".$row2[0]."</option>");//else finish the option

                }

    

    }//close while

              echo("</select>");
              echo(" <input type='submit' name='assign' value='Submit'>");
              echo("</form>");
              echo("</td>");
              echo "</tr>";
        }else {
            echo("<td>".$row[12]."</td>");
        }

            echo "<td></td>";
        }
            echo "</table>"; 
    }//here closes else
    ?>
    





</body>
    </div>
</html>