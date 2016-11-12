<?php
   include("config.php");
   include('class/userClass.php');

   $userClass = new userClass();

   /* Login Form */
   $usernameEmail = $_POST['emaillogin'];
   $password = $_POST['passlogin'];
   if(strlen(trim($usernameEmail))>1 && strlen(trim($password))>1 ){
      $uid=$userClass->userLogin($usernameEmail,$password);
         if($uid){
            //In case login success
            //$url=BASE_URL.'main.php';
            //header("Location: $url"); // Page redirecting to home.php 
            header("Location: main.php");
            $_SESSION['UID'] = 1;
         }else{
            //In case login failed;
         }
   }
   
?>