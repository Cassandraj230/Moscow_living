<?php
require 'config.php';
$id = 1;
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Retrieve list of registered users from the database
$sql = "update student_login set fname='$fname', lname='$lname', email='$email' where id='$id'";

if ($conn->query($sql) === TRUE) {
	echo "Records updated: ".$fname."-".$lname."-".$email;
} else {
	echo "Error: ".$sql."<br>".$conn->error;
}

$conn->close();

?>