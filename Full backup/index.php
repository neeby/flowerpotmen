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
</head>

<body>

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
	<h1 style="text-align:center">Davids Property Rentals </h1>
	
	<div id="map" style="width:800px;height:600px;margin:auto;"></div>
	
	</div>
	
	
<script>
function myMap() {
    var mapOptions = {
        center: new google.maps.LatLng(-27.518819, 153.050280),
        zoom: 13,
        mapTypeId: google.maps.MapTypeId.HYBRID
    }
var map = new google.maps.Map(document.getElementById("map"), mapOptions);
}
</script>	

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZ9Cvf5punc60HM2DoyPlI69E1fnPqIgc&callback=myMap"></script>

</body>
