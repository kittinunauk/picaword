<?php
class userClass{
      /* User Login */
      public function userLogin($UEmail,$UPass){
         try{
         $db = getDB();
         $stmt = $db->prepare("SELECT UID FROM Users WHERE UEmail=:usernameEmail AND UPass=:password"); 
         $stmt->bindParam("usernameEmail", $UEmail,PDO::PARAM_STR) ;
         $stmt->bindParam("password", $UPass,PDO::PARAM_STR) ;
         $stmt->execute();
         $count=$stmt->rowCount();
         $data=$stmt->fetch(PDO::FETCH_OBJ);
         $db = null;

         if($count) {
            $_SESSION['UID']=$data->uid; // Storing user session value
            return true;
         }else {
           return false;
         } 

         }catch(PDOException $e) {
         echo '{"error":{"text":'. $e->getMessage() .'}}';
         }
      }

      /*Register*/
      public function userRegistration($username,$password,$email){
         try{
            $db = getDB();
            $st = $db->prepare("SELECT UID FROM Users WHERE UUser=:username OR UEmail=:email"); 
            $st->bindParam("username", $username,PDO::PARAM_STR);
            $st->bindParam("email", $email,PDO::PARAM_STR);
            $st->execute();
            $count=$st->rowCount();
         if($count<1){
            $stmt = $db->prepare("INSERT INTO Users(UUser,UPass,UEmail) VALUES (:username,:password,:email)");
            $stmt->bindParam("username", $username,PDO::PARAM_STR) ;
            $stmt->bindParam("password", $password,PDO::PARAM_STR) ;
            $stmt->bindParam("email", $email,PDO::PARAM_STR) ;
            $stmt->execute();
            $uid=$db->lastInsertId(); // Last inserted row id
            $db = null;
            $_SESSION['uid']=$uid;
            return true;
         }else{
            $db = null;
            return false;
         }
      } 
       catch(PDOException $e) {
         echo '{"error":{"text":'. $e->getMessage() .'}}'; 
         }
      }


}
?>