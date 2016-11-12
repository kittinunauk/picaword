<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$deckid = $_GET["deckid"];
$conn = new mysqli("localhost", "root", "", "picaword");
$result = $conn->query("SELECT * FROM Card WHERE CDID=".$deckid."");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"CID":"'  . $rs["CID"] . '",';
    $outp .= '"CIPath":"'   . $rs["CIPath"] . '",';
    $outp .= '"CDescription":"'   . $rs["CDescription"]        . '",';
    $outp .= '"CWord":"'   . $rs["CWord"]   . '"}';
}
$outp ='{"records":['.$outp.']}';

$conn->close();
//Return as JSON object.
echo($outp);
?>