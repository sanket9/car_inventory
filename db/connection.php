<?php 
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "car_inventory";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $db);

	// Check connection
	if ($conn) {
		//echo "Connected..!!";	    
	}else{
		die("Connection failed: " . $conn->connect_error);
	}

?>