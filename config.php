<?php
	try {
	    $user = "root";
	    $pass = "";
	    $dbh = new PDO('mysql:host=localhost;dbname=picaword', $user, $pass);
	} catch (PDOException $e) {
	    print "Error!: " . $e->getMessage() . "<br/>";
	    die();
	}
?>