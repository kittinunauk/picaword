 <?php
        // Getting posted data and decodeing json
        $_POST = json_decode(file_get_contents('php://input'), true);
        require("config.php");
        $deckid = $_POST["deckid"];
        try {
              $pdo = $dbConnection;
              $statement=$pdo->prepare("SET SQL_SAFE_UPDATES = 0");
              $statement->execute();
	       $statement = $pdo->prepare("DELETE FROM Deck WHERE DID =:deckid;");
	       $statement->bindParam("deckid", $deckid,PDO::PARAM_STR) ;     
              $statement->execute();
              $statement = $pdo->prepare("DELETE FROM Progress WHERE DID =:deckid;");
              $statement->bindParam("deckid", $deckid,PDO::PARAM_STR) ;     
              $statement->execute();
       }catch (PDOException $e) {
	     echo 'Connection failed: ' . $e->getMessage();
      }

?>