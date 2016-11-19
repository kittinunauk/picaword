<?php
	require("config.php");
	$uid = $_GET["uid"];
	//$uid = S_SESSION['UID'];
	$pdo = $dbConnection;
	//$statement=$pdo->prepare("SELECT DID,DName,DDescription,DMax,DCreator,DRating,CIPath FROM Deck,Card WHERE Card.CDID = Deck.DID GROUP BY Card.CDID");
	$statement=$pdo->prepare("SELECT d.DID,d.DName,d.DDescription,d.DCreator,c.CIPath,p.UProgress FROM Deck as d,Card as c,progress as p WHERE c.CDID = d.DID AND p.UID =:uid AND p.DID = d.DID GROUP BY c.CDID");
	$statement->bindParam("uid", $uid,PDO::PARAM_STR) ;
	$statement->execute();
	$results=$statement->fetchAll(PDO::FETCH_ASSOC);
	$json=json_encode($results);
	$outp ='{"records":'.$json.'}';
	echo ($outp);

?>