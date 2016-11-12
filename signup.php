<?php
 	include("config.php");
  	include('class/userClass.php');
  	$userClass = new userClass();

	/* Signup Form */
	
	$username=$_POST['name'];
	$email=$_POST['emailsignup'];
	$password=$_POST['passsignup'];

	$uid=$userClass->userRegistration($username,$password,$email);

	if($uid){
		//$url=BASE_URL.'home.php';
		header("Location: main.php"); // Page redirecting to home.php 
	}else{
		$errorMsgReg="Username or Email already exists.";
		echo $errorMsgReg;
	}
	
?>