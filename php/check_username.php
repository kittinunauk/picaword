<?php

/*PDO*/
	require("config.php");
	$username = $_GET["user"];
	$pdo = $dbConnection;
	//$pdo=new PDO("mysql:dbname=picaword;host=localhost","root","");
	$statement=$pdo->prepare("SELECT * FROM Users WHERE UUser=:username");
	 $statement->bindParam("username", $username,PDO::PARAM_STR) ;
	$statement->execute();
	$results=$statement->fetchAll(PDO::FETCH_ASSOC);
	$json=json_encode($results);
	$outp ='{"records":'.$json.'}';
	echo ($outp);
?>