<?php
session_start();



	include_once("functions.php");
//check if submit is set

	loginDB();
	
?>

<html>
<head>
<title>Page Title</title>
</head>
<body>


    Enter a date to book your inspection :<br>
    (note : inspections are run as open houses daily between 9-11. If no inspections are booked then it will not be run)<br>
  <input type="date" name="Booking" min=<?PHP echo('"'.date("Y-m-d").'"');?>><br>


    
    
    

</body>
</html>