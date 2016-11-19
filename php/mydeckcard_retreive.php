<?php
	//session_start();
	require("config.php");
	$did = $_GET['deckid'];
	$pdo = $dbConnection;
	$statement=$pdo->prepare("SELECT * FROM Card WHERE Card.CDID = :did");
	$statement->bindParam("did", $did,PDO::PARAM_STR) ;
	$statement->execute();
	$results=$statement->fetchAll(PDO::FETCH_ASSOC);
	$json=json_encode($results);
	$outp ='{"cardlistindeck":'.$json.'}';
	echo ($outp);
?>