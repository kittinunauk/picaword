<?php
	require("config.php");

	//Getting data from user in registration form.
	$dcreator = $_SESSION['UUser'];
	$dname = $_POST['dname'];
	$ddes = $_POST['ddes'];
	$dcover = "img/mascot/cardy-so.png";
	try {
	            $statement = $dbConnection->prepare("INSERT INTO Deck(DName,DDescription,DCreator,DCover) VALUES (:dname,:ddes,:dcreator,:dcover)");
	            $statement->bindParam("dcreator", $dcreator,PDO::PARAM_STR) ;
	            $statement->bindParam("dname", $dname,PDO::PARAM_STR) ;
	            $statement->bindParam("ddes", $ddes,PDO::PARAM_STR) ;
	            $statement->bindParam("dcover", $dcover,PDO::PARAM_STR) ;
	            $statement->execute();
	            header("Location: ../adddeck.php"); // Page redirecting to home.php after registers

	}catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
	}

	
?>