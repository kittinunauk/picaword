<?php
/*
This is database configuration file.
*/
	session_start();
	try {
		$dbUsername = "root";
		$dbPassword = "";
		$dbConnection = new PDO("mysql:host=localhost;dbname=picaword", $dbUsername, $dbPassword); 
		$dbConnection->exec("set names utf8");
		$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
	}

?>