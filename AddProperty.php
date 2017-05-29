<?php
session_start();

			if(!isset($_SESSION['UAC_Level'])){
				header("Location: signInPage.php?error=signInRequired");
			}			
			


	include_once("functions.php");
//check if submit is set
   if ( isset( $_POST['Submit'] ) ) {

	loginDB();
	
addHouse ( $_POST['Address'], $_POST['Suburb'], $_POST['PostCode'], $_POST['BedRooms'], $_POST['BathRooms'], $_POST['CarPorts'] , $_POST['Description'] , $_POST['Image'] , $_POST['WeeklyRent'],$_SESSION['POST_User'] );
			echo ($_SESSION['POST_User']);
			header("Location: home.php");

	
   }//end isset[Submit]

?>

<html>
<head>
<title>Page Title</title>
</head>
<body>


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
										
			</table>

			<input type="submit" name="Submit" />
		</form>
	</div>
	

</body>
</html>