<?php

	require("config.php");
	// $uid = $_GET["uid"];
	$uid = $_SESSION['UID'];
	//$uid = 1;
	$pdo = $dbConnection;
	$playedDeck=$pdo->prepare("SELECT d.DID,d.DName,d.DDescription,d.DCreator,c.CIPath,p.UProgress FROM Deck as d,Card as c,progress as p WHERE c.CDID = d.DID AND p.UID =$uid AND p.DID = d.DID GROUP BY c.CDID");
	$allDeck=$pdo->prepare("SELECT DID,DName,DDescription,DCreator,CIPath FROM Deck,Card WHERE Card.CDID = Deck.DID GROUP BY Card.CDID");
	//$statement=$pdo->prepare("SELECT d.DID,d.DName,d.DDescription,d.DMax,d.DCreator,d.DRating,c.CIPath,p.UProgress FROM Deck as d,Card as c,progress as p WHERE c.CDID = d.DID AND p.UID =".$uid." AND p.DID = d.DID GROUP BY c.CDID");
	$allDeck->execute();
	$playedDeck->execute();

	$r_allDeck = $allDeck->fetchAll(PDO::FETCH_ASSOC);
	$r_playedDeck = $playedDeck->fetchAll(PDO::FETCH_ASSOC);

	foreach ($r_playedDeck as $key) {
		# code...
		foreach ($r_allDeck as $row => $subarray) {
			# code...
			if($subarray['DID']==$key['DID']) {
				unset($r_allDeck[$row]);
			}
		}
	}
	//print_r($r_allDeck);
	$results = $r_allDeck;
	$json=json_encode($results);
	$outp ='{"decklist":'.$json.'}';
	echo ($outp);

	//B6DCFE

?>