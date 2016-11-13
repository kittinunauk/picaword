<?php

	require("config.php");
	$pdo = $dbConnection; //$dbConnection from config.php
	//$pdo=new PDO("mysql:dbname=picaword;host=localhost","root","");
	$deckid = 1;
	$statement=$pdo->prepare("SELECT * FROM Card WHERE CDID=".$deckid."");
	$statement->execute();
	$results=$statement->fetchAll(PDO::FETCH_ASSOC);
	$json = json_encode($results);
	$outp ='{"records":['.$json.']}';
	//Return as JSON object.
	echo ($outp);
?>