<?php
	require("config.php");
	$dcreator = $_SESSION['UUser'];
	$pdo = $dbConnection;
	$statement=$pdo->prepare("SELECT * FROM Deck WHERE Deck.Dcreator=:dcreator");
	$statement->bindParam("dcreator", $dcreator,PDO::PARAM_STR) ;
	$statement->execute();
	$results=$statement->fetchAll(PDO::FETCH_ASSOC);
	$json=json_encode($results);
	$outp ='{"decklist":'.$json.'}';
	echo ($outp);
?>