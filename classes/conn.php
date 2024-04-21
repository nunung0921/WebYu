<?php
	
 error_reporting(E_ALL);
ini_set('display_errors', 1);

	$conn = new PDO("mysql:host=localhost;dbname=u813203284_bmis","u813203284_webyu","Webyu@2023");
	if(!$conn){
		die("Error: Failed to connect to database!");
	}

?>