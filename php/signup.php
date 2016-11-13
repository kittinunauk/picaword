<?php

	require("config.php");

	//Getting data from user in registration form.
	$username = $_POST['name'];
	$email = $_POST['emailsignup'];
	$password = $_POST['passsignup'];

	try {
	        // First, prepare SQL statement to check user exist in database or not
	        $statement = $dbConnection->prepare("SELECT UID FROM Users WHERE UUser=:username OR UEmail=:email"); 
	        $statement->bindParam("username", $username,PDO::PARAM_STR);
	        $statement->bindParam("email", $email,PDO::PARAM_STR);
	        $statement->execute();
	        $count=$statement->rowCount(); // count result from Insert statement (Check if user already exists)

	         if($count < 1){ // username or ever never exists.
	            $statement = $dbConnection->prepare("INSERT INTO Users(UUser,UPass,UEmail) VALUES (:username,:password,:email)");
	            $statement->bindParam("username", $username,PDO::PARAM_STR) ;
	            $statement->bindParam("password", $password,PDO::PARAM_STR) ;
	            $statement->bindParam("email", $email,PDO::PARAM_STR) ;
	            $statement->execute();
	            header("Location: ../main.php"); // Page redirecting to home.php after registers
	         }else{ //username already exists.
	         	echo("Exists!");
	         }

	}catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
	}

	
?>