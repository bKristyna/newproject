<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "loginsystem";

	$conn = mysqli_connect($servername,$username, $password, $database);

	if(!$conn) {
		die("Can't connect to the database". mysqli_connect_error());
	}
?>