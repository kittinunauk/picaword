<?php
	session_start();
	//Check whether user's already login or not?
      	if(!isset($_SESSION['UID'])){
       		header("Location: index.php"); 
     	 }

	$did =  $_POST['did'];  // Receive from deck id (main.php)
	$selMode = $_POST['selMode'];
	$deckid = $did;
	$mode =  $selMode; // 1 for Learning and 2 for KeepProgress
	$userID = $_SESSION['UID'];

?>
<!DOCTYPE html>
<html ng-app="picaword">
<head>
	<meta charset="UTF-8">
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
	<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
	
	<!--For using angular materials-->
	<script src="node_modules/angular-animate/angular-animate.min.js"></script>
	<link rel="stylesheet" href="node_modules/angular-material/angular-material.min.css">
	<script src="node_modules/angular-aria/angular-aria.js"></script>
      	<script src="node_modules/angular-material/angular-material.js"></script>
	<script src="node_modules/angular-messages/angular-messages.js"></script>

 	<link rel="stylesheet" href="css/button.css">
 	<link rel="stylesheet" href="css/style.css">
 	<link rel="stylesheet" href="css/game.css">

 	<style>
.tooltiptext {
    visibility: visible;
    width: 120px;
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
    top: 100%;
    left: 50%;
    margin-left: -60px;
}

.tooltiptext::after {
    content: "";
    position: absolute;
    bottom: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: transparent transparent black transparent;
}

.tooltiptext:hover {
    visibility: visible;
}
</style>
</head>
<body>

        <div id="wrapper">
        <div class="overlay"></div>
        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                <li class="sidebar-brand">
                   <img id="nohover" src="img/web/LOGOMINI.png" alt="" align="center">
                </li>
                <li style="color: white;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-user"></i><?php echo " User: <b>".$_SESSION['UUser']."</b>!";?>
                </li>
                <li>
                    <a href="main.php">
                    <i class="fa fa-fw fa-home"></i>  Home
                    </a>
                </li>
                <li>
                    <a href="php/logout.php">
                    <i class="fa fa-key"></i> Logout
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper" ng-controller="wordCtrl">
          <button type="button" class="hamburger is-closed animated fadeInLeft" data-toggle="offcanvas">
            <span class="hamb-top"></span>
            <span class="hamb-middle"></span>
            <span class="hamb-bottom"></span>
          </button>
            <div class="col-lg-4 col-md-4 col-sm-3 col-xs-2"></div>
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-9"> 
		<div class="container">
		<b>Deck Name:</b> {{deckname}} 
		<form action="php/progress.php" method="POST" style="float: right;">
		
			<input type="text" ng-hide="true" value="{{userprogress}}" name = "fprogress" >
			<input type="text" ng-hide="true" value="{{deckid}}" name = "fdeckid">
			<button class="button" id="normal" type="submit" style="width: 40px; height: 40px; background-color:#CE0003;" title="Click here to close"><i class="fa fa-close"></i>
			<md-tooltip md-visible="false" md-direction="top">
            				Save and Quit
          			</md-tooltip>
			</button>
		</form>
		
		<!-- CSS Boostrap Progress bar -->
		<div ng-hide="cardprogressbar">
		Card:
		<div class="progress">
	  		<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="{{pid}}"
	  			aria-valuemin="0" aria-valuemax="100" style="width:{{(pid/maxcard)*100}}%;">
	    		<!-- {{(pid/3)*100 | number:0 }} % Complete  -->
	    		{{pid}} of {{maxcard}}
	  		</div>
		</div>
		</div>
		
		<div ng-hide="scoreprogressbar">
		Progress:
		<div class="progress">
	  		<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="{{userscore}}"
	  			aria-valuemin="0" aria-valuemax="100" style="width:{{(userscore/maxcard)*100}}%;">
	    		<!-- {{(userscore/maxcard)*100 | number:0}}  % -->
	  		</div>
		</div>
		</div>
		</div>
	    <div style="text-align: center"> <p style="font-size:5%;"><br></p>
	    	<div style="display: inline-block;">
				<flippy horizontal class="fancy" flip="['click']" flip-back="['click']" duration="500" timing-function="ease-in-out" style="z-index: 5;">
	                    	<flippy-front>

	                    		<img src="{{cards[pid-1].CIPath}}" width="100px" height="200px">
	                  
	                    	</flippy-front>
	                    	<flippy-back>
	                    		<p>	
	                    			<p ng-show="wordDisplay"><b>Word: </b> {{currentword}} <br></p>
					<b>Description: </b> {{description}}
	                    		</p>
	                   	 </flippy-back>
            	</flippy>
        	</div>
        </div>

		<div class="container-input">
		<input class="input-answer" ng-type="text" ng-model="userans" ng-disabled="inputtext" ng-show="inputtextvisible" ng-enter="getVerdict()"> 
		<button class="button" id="normal" type="button" ng-click="getVerdict()" ng-show="submitbtnvisible" style="width: 40px;padding-top: 4px;transition:none;" title="Click here to submit">
			<span class="glyphicon glyphicon-circle-arrow-right"></span></button>
		<button style="transition: none;"class="button" id="left" type="button" ng-click="getPrevCard()" ng-show="prevbtnvisible" ng-disabled="prevbtn"><span>Prev</span></button>
		<button style="transition: none;"class="button" id="right" type="button" ng-click="getNextCard()" ng-show="nextbtnvisible" ng-disabled="nextbtn"><span>Next</span></button>
		
		</div>
	
</div>

<div class="col-md-2 col-sm-3" style="height: 100%;"> 
<img src="{{verdictimg}}" width="200px" height="200px">
<span class="tooltiptext">{{verdict}}{{result}}</span>
 </div>
</div>
</div>
</body>

<script>

	//Get deckid from user (php)
	var _deckid = <?php echo $deckid ?>;
	var _mode = <?php echo "".$mode ?>;
	//Declare queue for storing cards that user answer incorrectly
	var queue = [];
	//Declare Angular application name myApp
	var app = angular.module('picaword', ['angular-flippy','ngMaterial']);

	app.directive('ngEnter', function () {
    		return function (scope, element, attrs) {
        		element.bind("keydown keypress", function (event) {
	            		if(event.which === 13) {
		                scope.$apply(function (){
		                scope.$eval(attrs.ngEnter);
	                	});
	                	event.preventDefault();
            		}
        		});
    		};
	});
	//Declare Angular controller named "wordCtrl"
	app.controller('wordCtrl',  function ($scope, $http, $filter, $sce){

		/*General Initialization*/
		 //Pass _deckid to use in wordCtrl 
		 $scope.deckid = _deckid;
		 //Verdict
		 $scope.verdict = "Let's guess";	    
		 $scope.verdictimg ="img/mascot/cardy-so.png";
		 //User Score
		 $scope.userscore = 0;
		 $scope.userprogress = 0;
		 console.log("Current Deck ID: "+_deckid);

		 /*Mode-based Initialization*/
		 if(_mode===1){

		 	//Card & Progress Bar in mode 1
		 	$scope.cardprogressbar  = false;
		 	$scope.scoreprogressbar  = true;

		 	//Visibility for submit &next
		 	$scope.nextbtnvisible = true; // Learning Mode
		 	$scope.prevbtnvisible = true;
		 	$scope.prevbtn = true; // Disable first
		 	$scope.nextbtn = false;
		 	$scope.wordDisplay = true;
		 	$scope.savebtn = false;


		 }else if(_mode===2){
		 	//Card & Progress Bar in mode 2
		 	$scope.cardprogressbar  = true;
		 	$scope.scoreprogressbar  = false;
		 	//Visibility for submit &next
		 	$scope.nextbtnvisible = false;
		 	$scope.inputtextvisible = true;
		 	$scope.submitbtnvisible = true;
			$scope.inputtext = false;
			$scope.wordDisplay = false;
			$scope.savebtn = true;
		 }
	 
		$http.get('php/deckinfo_retreive.php', { params: { deckid: _deckid } }).then(function (response) {
		    	$scope.deckinfos = response.data.deckinfo;
		    	// console.log($scope.deckinfos[0])
		    	console.log($scope.deckinfos[1]);
		    	$scope.deckname = $scope.deckinfos[0].DName;
		 } );

		$http.get('php/cards_retrieve.php', { params: { deckid: _deckid } }).then(function (response) {
		    	$scope.cards = response.data.records;
		    	$scope.description = $scope.cards[0].CDescription;
			$scope.maxcard = Object.keys($scope.cards).length;
		    	$scope.currentword = $scope.cards[0].CWord;
		    	console.log($scope.cards);
		    	console.log("Length = " + $scope.cards.length);
		    	if($scope.cards.length===1){
		 		$scope.nextbtn = true;
		 	}
			//Enqueue all cards into queue
		    	for($i  = 1; $i<=$scope.maxcard ;$i++){
		    		queue.push($i);
		    		//queue.push(parseInt($scope.cards[$i].CID));
		    	}
		    	console.log(queue);
		    	 //Picture ID
		    	 $scope.pid = parseInt(queue[0]);
		 	if(_mode===1) $scope.userscore = maxcard;    	
		 } );

		
	   	   	
		 $scope.result = "";

		 // getVerdict() function
		 $scope.getVerdict = function(){
		 	$scope.submitbtnvisible = false;
		 	$scope.inputtext = true;
		 	$scope.correctans = $scope.cards[$scope.pid-1].CWord;
		 	console.log("Correct Answer:" + $scope.correctans);
		 	console.log("User Answer:" + $scope.userans);
		 	console.log($scope.correctans.toLowerCase()===$scope.userans.toLowerCase());
		 	
		 	//Check user input and the right answer for this card
		 	//In case it's correct answer
		 	if(($scope.correctans.toLowerCase()===$scope.userans.toLowerCase())==true){
		 		console.log("Verdict: Accepted");
		 		$scope.verdict = "Accepted";
		 		$scope.userscore += 1;
		 		if(queue.length>0) queue.shift();
		 		$scope.userprogress  = ($scope.userscore/$scope.maxcard)*100;
		 		console.log("User Progression(%): " + $scope.userprogress);
		 		$scope.verdictimg ="img/mascot/cardy-yes.png";

		 	}else{
		 		console.log("Verdict: Wrong Answer");
		 		$scope.verdict = "Wrong Answer";
		 		//Enqueue if answer was wrong
		 		queue.push(queue.shift());
		 		console.log("Current Queue: " + queue);
		 		$scope.userans = $scope.correctans;
		 		$scope.verdictimg ="img/mascot/cardy-no.png";

		 		if(queue.length===1){
		 			console.log("lll");
		 			$scope.nextbtn = false;
		 		}

		 	}

		 	// In case it's  a last card in deck
		 	if(queue.length===0){
		 		console.log("Game Ended");
		 		$scope.result += "Good Job!";
				$scope.submitbtnvisible = false;
				$scope.inputtextvisible = false;
				$scope.verdict ="";
				//$scope.pid = queue[0];
		 	// Otherwise
		 	}else{
		 		$scope.submitbtnvisible = false;
		 		$scope.nextbtnvisible = true;
		 	}

		 };

		  // getNextCard() function
		 $scope.getNextCard = function(){
		 	
		 	if(_mode===1){
		 		$scope.prevbtn = false;
		 		$scope.pid++;		 		
		 	 }else{
			 	$scope.verdict = "Guess what!";
			 	$scope.pid = queue[0];
			 	$scope.nextbtnvisible = false;
			 	$scope.inputtext = false;
			 	$scope.submitbtnvisible = true;
			 	$scope.userans = "";			 	
		 	 }

		 	//Learning Mode
		 	if(_mode===1){
				// //Last Card
		 	// 	if($scope.pid===$scope.maxcard||queue.length===0){
		 	// 		$scope.nextbtn = true;
		 	// 	} 
		 		//Update Card information
	 			$scope.description = $scope.cards[$scope.pid-1].CDescription;
	 			$scope.currentword = $scope.cards[$scope.pid-1].CWord;
		 	}else{
		 		$scope.description  = $scope.cards[$scope.pid-1].CDescription;
		 		$scope.currentword =  $scope.cards[$scope.pid-1].CWord;
		 		 $scope.verdictimg ="img/mascot/cardy-so.png";
		 	}

		 	
		 };

		   // getPrevCard() function
		 $scope.getPrevCard = function(){
		 	
	 		$scope.pid--;
	 		//First Card
	 		if($scope.pid===1){
	 			$scope.prevbtn = true;
	 		}
	 		if($scope.pid!=0){
	 			$scope.nextbtn = false;
	 		}
	 		//Update Card information
	 		$scope.description = $scope.cards[$scope.pid-1].CDescription;
		 	$scope.currentword = $scope.cards[$scope.pid-1].CWord;

		 };
	});
	

</script>

        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>

    <script src="js/index.js"></script>


</html>