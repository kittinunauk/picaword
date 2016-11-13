<?php

/*PDO */
	require("config.php");
	$pdo = $dbConnection;
	//$pdo=new PDO("mysql:dbname=picaword;host=localhost","root","");
	$statement=$pdo->prepare("SELECT DID,DName,DDescription,DMax,DCreator,DRating,CIPath FROM Deck,Card WHERE Card.CDID = Deck.DID GROUP BY Card.CDID");
	$statement->execute();
	$results=$statement->fetchAll(PDO::FETCH_ASSOC);
	$json=json_encode($results);
	$outp ='{"records":'.$json.'}';
	echo ($outp);

?>