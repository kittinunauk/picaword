<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "root", "", "picaword");
$result = $conn->query("SELECT * FROM Deck ");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"DID":"'  . $rs["DID"] . '",';
    $outp .= '"DName":"'   . $rs["DName"] . '",';
    $outp .= '"DDescription":"'   . $rs["DDescription"] . '",';
    $outp .= '"DMax":"'   . $rs["DMax"]        . '",';
    $outp .= '"DCreator":"'   . $rs["DCreator"]        . '",';
    $outp .= '"DRating":"'   . $rs["DRating"]   . '"}';
}
$outp ='{"records":['.$outp.']}';

$conn->close();
//Return as JSON object.
echo($outp);
?>