<?php
	$deckid = $_GET["deckid"];
	$uid = $_GET["uid"];
	require("config.php");
	$pdo = $dbConnection;
	$statement=$pdo->prepare("INSERT INTO picaword.progress VALUES($uid,$deckid,0)");
	$statement->execute();
?>