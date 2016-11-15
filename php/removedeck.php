<?php
	$deckid = $_GET["deckid"];
	$uid = $_GET["uid"];
	require("config.php");
	$pdo = $dbConnection;
	$statement=$pdo->prepare("SET SQL_SAFE_UPDATES = 0");
	$statement->execute();
	$statement=$pdo->prepare("DELETE FROM picaword.progress WHERE UID = $uid AND DID = $deckid");
	$statement->execute();
?>