<?php

	require("config.php");
	
	$userID = $_SESSION['UID'];
	$deckID = $_POST["fdeckid"];
	$deckProgress = $_POST["fprogress"];

	$statement = $dbConnection->prepare("SELECT UProgress FROM progress WHERE DID=:deckID AND UID=:userID"); 
   	$statement->bindParam("deckID", $deckID,PDO::PARAM_STR) ;
   	$statement->bindParam("userID", $userID,PDO::PARAM_STR) ;
      	$statement->execute();
      	$count = $statement->rowCount();

      	echo $userID." ".$deckID;
      	if(!$count){ // Not Yet record
      	 $statement = $dbConnection->prepare("INSERT INTO progress(UID,DID,UProgress) VALUES (:userID,:deckID,:deckProgress)");
	 $statement->bindParam("deckID", $deckID,PDO::PARAM_STR) ;
   	 $statement->bindParam("userID", $userID,PDO::PARAM_STR) ;
	 $statement->bindParam("deckProgress", $deckProgress,PDO::PARAM_STR) ;
	 $statement->execute();
      	}else{ //Have record
      	 $statement = $dbConnection->prepare("UPDATE progress SET UProgress =:deckProgress WHERE UID =:userID AND DID =:deckID");
	 $statement->bindParam("deckID", $deckID,PDO::PARAM_STR) ;
   	 $statement->bindParam("userID", $userID,PDO::PARAM_STR) ;
	 $statement->bindParam("deckProgress", $deckProgress,PDO::PARAM_STR) ;
	 $statement->execute();
      	}
      	header("Location: ../main.php"); 

?>