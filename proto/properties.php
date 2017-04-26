<!--
File name: properties.php
Date created: 20/04/2017
Purpose of file:
    > Show list of properties, presumably.
-->

<?PHP
    session_start();
    include('functions.php');
    writeMenu($_SESSION['UAC_Level']);
?>

<html>
    <head>
        <title>
            Property List
        </title>
        <link rel='stylesheet'  type='text/css' href='stylesheet.css'>
    </head>

    <body>
        <br><br><form action="properties.php" method="GET" style='text-align: center;'>
            Search By: <select name='searchParam'>
                <option value='Suburb'>Suburb</option>
                <option value='Post'>Post Code</option>
                <option value='Bed'>Bedroom Number</option>
                <option value='Bath'>Bathroom Number</option>
                <option value='Car'>Carport Number</option>
            </select>
            <input type='text' name='searchValue'>
            <br>
            <input type='submit' value='Search'>
            <?PHP 
                if($_SESSION['UAC_Level'] == 'Owner'){ 
                    echo "<a href='properties.php?searchParam=*&searchValue=nothing'><input type='button' value='View All Properties'></a>";
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

        if(!empty($_GET['searchParam']) AND isset($_GET['searchValue'])){
            /*
                Now that there is a search paramater and a search value,
                we can safely assume that there has been a search conducted.
            */
            returnShortPropertyList($_GET['searchParam'], $_GET['searchValue']);
        }
        ?>
    </body>
</html>