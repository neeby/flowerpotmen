<?php
$serverName = "hostname or ip"; 
$connInfo = array("Database"=>"FlowerPotMen", "UID"=>"root", "PWD"=>"password");
$conn = sqlsrv_connect($serverName, $connInfo);
if($conn){
 echo "Database connection established.<br />";
}else{
 echo "Connection could not be established.<br />";
 die( print_r(sqlsrv_errors(), true));
}
?>