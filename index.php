<!--This is index Page-->
<?php
     session_start();
     //Check whether user's already login or not?
     if(isset($_SESSION['UID'])){
       header("Location: main.php"); 
     }
?>
<!DOCTYPE html>
<html ng-app="picaword">
<head>
  <title>Play</title>
  <!-- Include AngularJS Framework -->
  <script type="text/javascript" src="node_modules/angular/angular.min.js"></script>
  <!-- Include Bootstrap Framework -->
  <link rel="stylesheet" type="text/css" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
  <!-- Include AngularJS directive to flip card with a CSS3 flip animation
  Ref. https://github.com/zwacky/angular-flippy -->
          <link rel="stylesheet" href="css/angular-flippy.css">
          <link rel="stylesheet" href="css/angular-flippy-fancy.css">
          <script type="text/javascript" src="js/angular-flippy.js"></script>
          <script type="text/javascript" src="js/loginsignup.js"></script>
          <script src="node_modules/angular-animate/angular-animate.js"></script>
          <link rel="stylesheet" href="css/index.css">


          <link rel="stylesheet" href="node_modules/angular-material/angular-material.min.css">
          <script src="node_modules/angular-aria/angular-aria.js"></script>
          <script src="node_modules/angular-material/angular-material.js"></script>
          <script src="node_modules/angular-messages/angular-messages.js"></script>

</head>
<body style="background-color: #F9F6D4;" >
<div ng-controller="indexCtrl">
  <header>
      <div id ="logo">
        <img src="img/web/LOGO2.png" alt="">
      </div>
   </header>
   <section>
     <div id = "login" class="col-xs-12">
         
        <button ng-show="loginbtn" ng-click="getLoginForm()" >LOGIN
        </button>
     </div>
     <div class="col-xs-12 loginform" ng-show="loginform">
          <form action="php/login.php" method="POST">
        
            <input type="email" name="emaillogin" id="emaillogin" class="input-txt" placeholder="E-Mail" ng-model="email" required> <br>
            <input type="password" name="passlogin" id="passlogin" class="input-txt" placeholder="Password" ng-model  = "password" required> <br>
            <br><button type="submit" id="loginbtn" name="loginSubmit" ng-click="checkLogin()"> Login </button>
            
           <br><a href="#" ng-click="getSignupForm()">SIGN UP</a>
          </form>
     </div>
     <div id ="signup" class="col-xs-12">
      <button id="green" ng-show="signupbtn" ng-click="getSignupForm()">SIGN UP</button>
     </div>

      <div class="col-xs-12 signupform" ng-show="signupform">
          <form action="php/signup.php" method="POST">
              
            <input type="text" name="name" id="name" class="signup-input-txt" placeholder="Name" ng-model="username" ng-change="checkUser()" required> <br>
            <input type="email" name="emailsignup" id="emaillsignup" class="signup-input-txt" placeholder="E-Mail" required> <br>
            <input type="password" name="passsignup" id="passsignup" class="signup-input-txt" placeholder="Password" ng-model="passsignup" ng-change="checkPass()" required> 
             <br>         
            <input type="password" name="cpasssignup" id="cpasssignup" class="signup-input-txt" placeholder="Confirmed Password" ng-model="cpasssignup" ng-change="checkPass()" required> <br>
            <br>
            {{errMsgPass}}
            <button type="submit" id="signupbtn" ng-show="submitbtn"> Submit 
           </button>
           <br><a href="#" ng-click="getLoginForm()">Login</a>
           
          </form>
     </div>

   </section>
</div>

</body>

<script>
  
    //Declare Angular application name 
    var app = angular.module('picaword',['ngAnimate','ngMaterial']);
    //Declare Angular controller named "wordCtrl"
    app.controller('indexCtrl',  function ($scope, $http, $filter, $sce,$timeout){
        $scope.loginbtn = true;
        $scope.loginform = false;
        $scope.signupform = false;
        $scope.signupbtn = true;
        $scope.submitbtn = false;

        $scope.errMsgUser = "";
        $scope.errMsgPass = "";
        $scope.username = "";


        $scope.getLoginForm = function(){
          $scope.loginbtn = false;
          $scope.signupbtn = false;
          $scope.signupform = false;
         $timeout( function(){ $scope.loginform = true }, 300);
        };

        $scope.getSignupForm = function(){
          $scope.loginbtn = false;
          $scope.signupbtn = false;
          $scope.loginform = false;
          $timeout( function(){ $scope.signupform = true }, 300);
        };

        $scope.checkPass = function(){
          if($scope.passsignup!=$scope.cpasssignup){
            console.log("Password doesn't match");
            $scope.errMsgPass = "Password doesn't match";
             $scope.submitbtn = false;
          }else{
             $scope.errMsgPass = "";
              $scope.submitbtn = true;
          }
        };

  });
</script>
</html>