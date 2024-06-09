<?php
if($_SERVER['HTTP_HOST']=="localhost"){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database= "prj_locoshop_db";
	$local_mode = true;
}
else{
	$servername = "localhost";
	$username = "prj_locoshop_db";
	$password = "prj_locoshop_db";
	$database= "prj_locoshop_db";
	$local_mode = false;
}
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>