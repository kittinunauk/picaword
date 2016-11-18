<?php
	require("config.php");
	$deckid = $_GET["deckid"];
	$pdo = $dbConnection;
	$statement=$pdo->prepare("SELECT * FROM Deck WHERE DID=".$deckid."");
	$statement->execute();
	$results=$statement->fetchAll(PDO::FETCH_ASSOC);
	$json=json_encode($results);
	$outp ='{"deckinfo":'.$json.'}';
	echo ($outp);
?>