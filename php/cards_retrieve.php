<?php
//mysqli() method
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");

// $deckid = $_GET["deckid"];
// $conn = new mysqli("localhost", "root", "", "picaword");
// $result = $conn->query("SELECT * FROM Card WHERE CDID=".$deckid."");

// $outp = "";
// while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
//     if ($outp != "") {$outp .= ",";}
//     $outp .= '{"CID":"'  . $rs["CID"] . '",';
//     $outp .= '"CIPath":"'   . $rs["CIPath"] . '",';
//     $outp .= '"CDescription":"'   . $rs["CDescription"]        . '",';
//     $outp .= '"CWord":"'   . $rs["CWord"]   . '"}';
// }
// $outp ='{"records":['.$outp.']}';

// $conn->close();
// //Return as JSON object.
// echo($outp);

//PDO method
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