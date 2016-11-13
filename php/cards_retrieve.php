<?php

/*PDO*/
	require("config.php");
	$deckid = $_GET["deckid"];
	$pdo = $dbConnection;
	//$pdo=new PDO("mysql:dbname=picaword;host=localhost","root","");
	$statement=$pdo->prepare("SELECT * FROM Card WHERE CDID=".$deckid."");
	$statement->execute();
	$results=$statement->fetchAll(PDO::FETCH_ASSOC);
	$json=json_encode($results);
	$outp ='{"records":'.$json.'}';
	echo ($outp);
?>