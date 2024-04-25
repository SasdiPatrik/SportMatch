<?php 

	$conn = new mysqli("localhost", "root","", "team04");
	
	if($conn->connect_error){
		die("Connection failed! ".$conn->connect_error);
	}

	mysqli_set_charset($conn, "utf8mb4");

?>