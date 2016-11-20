<?php
   require("config.php");
   //Getting data from user in login form.
   $userEmail = $_POST['emaillogin'];
   $userPassword = $_POST['passlogin'];

   try {

      $statement = $dbConnection->prepare("SELECT * FROM Users WHERE UEmail=:usernameEmail AND UPass=:password"); 
      $statement->bindParam("usernameEmail", $userEmail,PDO::PARAM_STR) ;
      $statement->bindParam("password", $userPassword,PDO::PARAM_STR) ;
      $statement->execute();
      $count = $statement->rowCount();
      $data = $statement->fetch(PDO::FETCH_OBJ);
      //var_dump($data);

      // Storing user session value
      if($count) {
		 session_start();
         $_SESSION['UID'] = $data->UID; 
         $_SESSION['UUser'] = $data->UUser;
         header("Location: ../main.php"); 
      }else {
         echo "<script>";
         echo "alert('Invalid username or password, try again!');";
         echo "</script>";
         echo "<a href='../index.php'>Click here to go login page</a>";
      } 
         
   }catch (PDOException $e) {
      echo 'Connection failed: ' . $e->getMessage();
   }
   
?>