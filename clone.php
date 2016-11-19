<?php

$errors = array();
$data = array();
// Getting posted data and decodeing json
$_POST = json_decode(file_get_contents('php://input'), true);

// checking for blank values.
if (empty($_POST['cname']))
  $errors['name'] = 'Card name is required.';

if (empty($_POST['cdes']))
  $errors['username'] = 'Card description is required.';

if (empty($_POST['ccate']))
  $errors['email'] = 'Card category is required.';

if (empty($_POST['cimg']))
  $errors['cimg'] = 'Card Img is required.';

if (!empty($errors)) {
  $data['errors']  = $errors;
} else {
       // $data['message'] = 'Form data is going well';
       $cname = $_POST['cname'];
       $cdes = $_POST['cdes'];
       $ccate = $_POST['ccate'];
       $cimg = $_POST['cimg'];
       require("php/config.php");
       try {
	       $statement = $dbConnection->prepare("INSERT INTO Card(CDID,CWord,CDescription,CIPath,CCategory) VALUES (3,:cname,:cdes,:cimg,:ccate)");
	       $statement->bindParam("cname", $cname,PDO::PARAM_STR) ;
	       $statement->bindParam("cdes", $cdes,PDO::PARAM_STR) ;
	       $statement->bindParam("ccate", $ccate,PDO::PARAM_STR) ;
	       $statement->bindParam("cimg", $cimg,PDO::PARAM_STR);
	       $statement->execute();
       }catch (PDOException $e) {
	$data['message'] = 'Connection failed: ' . $e->getMessage();
      }
}

// response back.
echo json_encode($data);
?>