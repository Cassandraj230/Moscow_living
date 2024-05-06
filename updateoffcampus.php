<?php
require 'config.php';
$id = 1;
$Budget = $_POST["Budget"];
$Location = $_POST["Location"];
$Bedroom = $_POST["Bedroom"];
$Bathroom = $_POST["Bathroom"];
$Wifi = $_POST["Wifi"];
$Electric = $_POST["Electric"];
$Laundry = $_POST["Laundry"];
$MoveinDate= $_POST["MoveinDate"];

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Retrieve list of registered users from the database
$sql = "update offcampuspreferences set Budget = '$Budget',Location ='$Location',Bedroom ='$Bedroom',Bathroom ='$Bathroom',"
        . "Wifi ='$Wifi',Electric ='$Electric',Laundry ='$Laundry',MoveinDate ='$MoveinDate' where id='$id'";

if ($conn->query($sql) === TRUE) {
	echo "Records updated: ".$Budget."-".$Location."-".$Bedroom. "-" .$Bathroom."-".$Wifi."-".$Electric."-".$Laundry."-".$MoveinDate;
} else {
	echo "Error: ".$sql."<br>".$conn->error;
}

$conn->close();

?>