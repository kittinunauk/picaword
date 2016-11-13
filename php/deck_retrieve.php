<?php
/* mysqli() */
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");

// $conn = new mysqli("localhost", "root", "", "picaword");
// //$result = $conn->query("SELECT * FROM Deck ");
// $result = $conn->query("SELECT DID,DName,DDescription,DMax,DCreator,DRating,CIPath FROM Deck,Card WHERE Card.CDID = Deck.DID GROUP BY Card.CDID");

// $outp = "";

// while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
//     if ($outp != "") {$outp .= ",";}
//     $outp .= '{"DID":"'  . $rs["DID"] . '",';
//     $outp .= '"DName":"'   . $rs["DName"] . '",';
//     $outp .= '"DDescription":"'   . $rs["DDescription"] . '",';
//     $outp .= '"DMax":"'   . $rs["DMax"]        . '",';
//     $outp .= '"DCreator":"'   . $rs["DCreator"]        . '",';
//     $outp .= '"DRating":"'   . $rs["DRating"]        . '",';
//     $outp .= '"CIPath":"'   . $rs["CIPath"]   . '"}';
// }


// $outp ='{"records":['.$outp.']}';

// $conn->close();
// //Return as JSON object.
// echo($outp);

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