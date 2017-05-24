<!--
File name: properties.php
Date created: 20/04/2017
Purpose of file:
    > Show list of properties, presumably.
-->

<?PHP
    session_start();
    include_once('functions.php');
    writeMenu($_SESSION['UAC_Level']);
?>

<html>
    <head>
        <title>
            Property List
        </title>
        <link rel='stylesheet'  type='text/css' href='stylesheet.css'>
    </head>

    <body class="property">
        <br><br><form action="properties.php" method="GET" style='text-align: center;'>
		
			<table>
				<tr>
					<td>
						<label for="Suburb">Suburb:</label>
						<input type='text' name='Suburb' value="<?php echo $_GET['Suburb'];?>">					
					</td>
					<td>
						<label for="Post">Post:</label>
						<input type='number' name='Post' value="<?php echo $_GET['Post'];?>">					
					</td>
					<td>
						<label for="Bed">Bed:</label>
						<input type='number' name='Bed' min="0" value="<?php echo $_GET['Bed'];?>">						
					</td>
					<td>
						<label for="Bath">Bath:</label>
						<input type='number' name='Bath' min="0" value="<?php echo $_GET['Bath'];?>">					
					</td>
					<td>
						<label for="Car">Car:</label>
						<input type='number' name='Car' min="0" value="<?php echo $_GET['Car'];?>">					
					</td>
					<td>
						<label for="minWeeklyRent">Min Weekly Rent:</label>
						<input type='number' id='minWeeklyRent' name='minWeeklyRent' min="0" onchange="document.getElementById('maxWeeklyRent').min=this.value;" value="<?php echo $_GET['minWeeklyRent'];?>">					
					</td>
					<td>
						<label for="maxWeeklyRent">Max Weekly Rent:</label>
						<input type='number' id='maxWeeklyRent' name='maxWeeklyRent' min="0" onchange="document.getElementById('minWeeklyRent').max=this.value;" value="<?php echo $_GET['maxWeeklyRent'];?>">					
					</td>
					<td>
						<label for="gumTreeId">Gumtree Id:</label>
						<input type='text' name='gumTreeId'>					
					</td>
				</tr>		
			</table>
		
			<input type='hidden' name='searchParam' value=''>
            <br>
            <input type='submit' value='Search'>
            <?PHP 
                if($_SESSION['UAC_Level'] !== 'Visitor' && $_SESSION['UAC_Level'] !== 'User' ){ 
                    echo "<a href='properties.php?searchParam=*'><input type='button' value='View All Properties'></a>";
                }
            ?>
        </form>
        <br>
        <?PHP
            /*
                Just checking for any applicable error messages and showing them.
            */
        
        if(!empty($_GET['error'])){
            if ($_GET['error'] == "invalidSearchParam"){
                echo "<div style='color: red; text-align: center';>Sorry, there was an invalid search paramater. Please try again.</div>";
            }
        }

        /*
            This below checks to see if there has been a search and 
            if so then to call a function to search the DB and return
            relevant results.
        */

		
		if(!empty($_GET['searchParam'])){

            returnShortPropertyList();//return all
        }			
		
		if(!empty($_GET['Suburb']) or isset($_GET['Post']) or isset($_GET['Bed']) or isset($_GET['Bath']) or isset($_GET['Car']) or isset($_GET['minWeeklyRent']) or isset($_GET['minWeeklyRent'])){
            /*
                Now that there is a search paramater and a search value,
                we can safely assume that there has been a search conducted.
            */
			
            returnShortPropertyList(); 
        }
        ?>
    </body>
</html>