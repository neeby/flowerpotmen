<!--
File name: index.php
Date created: 20/04/2017
Purpose of file: Serve as landing page for visitors, allows for login to home.
*/
-->

<head>
    <title>
        Welcome
    </title>
    <link rel='stylesheet'  type='text/css' href='stylesheet.css'>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZ9Cvf5punc60HM2DoyPlI69E1fnPqIgc&callback=myMap"></script>
	<script src="map.js" async></script>
</head>

<body class="home">

    <?PHP
        session_start();
        include_once('functions.php');
		include_once('userFunctions.php');
        /*
        Checking for _GET value 'Logout', if this is true, we call the logout function
        which will kill the session.
        */

        if(isset($_GET['logout'])){
            Logout();
        } 
        if(isset($_SESSION['UAC_Level'])){
            header("Location: home.php");
        }

		writeMenu();

		//print_r($_SESSION)		
		
    ?>
	<h1>Davids Property Rentals </h1>
	
	<div id="map"></div>
	
	</div>

</body>
