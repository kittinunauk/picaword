<?php
	//require('config.php');
	$did =  $_POST['did'];  // Receive from deck id (main.php)
	$selMode = $_POST['selMode'];
	//echo $tmp;
	$deckid = $did;
	$mode =  $selMode; // 1 for Learning and 2 for KeepProgress
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
</head>
<body>
<div class="col-md-4"></div>
<div ng-controller="wordCtrl" class="col-md-4" > 
		<b>Deck ID:</b> {{deckid}}   <br>
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
	    		{{(userscore/maxcard)*100 | number:0}}  %
	  		</div>
		</div>
		</div>

		<flippy horizontal class="fancy" flip="['click']" flip-back="['click']" duration="500" timing-function="ease-in-out">
	                    	<flippy-front>
	                    		<img ng-src="/picaword/{{cards[pid-1].CIPath}}" width="250" height="250">

	                    	</flippy-front>
	                    	<flippy-back>
	                    		<p>	
	                    			<p ng-hide="true"><b>Word: </b> {{currentword}} <br></p>
					<b>Description: </b> {{description}}
	                    		</p>
	                   	 </flippy-back>
                	</flippy>

		<input type="text" ng-model="userans" ng-disabled="inputtext" ng-show="inputtextvisible">
		<input type="button" value="Submit" ng-click="getVerdict()" ng-show="submitbtnvisible">
		<input type="button" value="Prev" ng-click="getPrevCard()" ng-show="prevbtnvisible" ng-disabled="prevbtn">
		<input type="button" value="Next" ng-click="getNextCard()" ng-show="nextbtnvisible" ng-disabled="nextbtn">
		{{result}}

		
</div>

<div class="col-md-4"></div>
</body>

<script>

	//Get deckid from user (php)
	var _deckid = <?php echo $deckid ?>;
	var _mode = <?php echo "".$mode ?>;
	//Declare queue for storing cards that user answer incorrectly
	var queue = [];
	//Declare Angular application name myApp
	var app = angular.module('picaword', ['angular-flippy']);
	//Declare Angular controller named "wordCtrl"
	app.controller('wordCtrl',  function ($scope, $http, $filter, $sce){

		/*General Initialization*/
		 //Pass _deckid to use in wordCtrl 
		 $scope.deckid = _deckid;
		 //Verdict
		 $scope.verdict = "-";	    
		 //User Score
		 $scope.userscore = 0;
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
		 }else if(_mode===2){
		 	//Card & Progress Bar in mode 2
		 	$scope.cardprogressbar  = true;
		 	$scope.scoreprogressbar  = false;
		 	//Visibility for submit &next
		 	$scope.nextbtnvisible = false;
		 	$scope.inputtextvisible = true;
		 	$scope.submitbtnvisible = true;
			$scope.inputtext = false;
		 }
	 
		$http.get('cards_retrieve.php', { params: { deckid: _deckid } }).then(function (response) {
		    	$scope.cards = response.data.records;
		    	$scope.description = $scope.cards[0].CDescription;
			$scope.maxcard = Object.keys($scope.cards).length;
		    	$scope.currentword = $scope.cards[0].CWord;
		    	console.log($scope.cards);
			//Enqueue all cards into queue
		    	for($i  = 1; $i<=$scope.maxcard ;$i++){
		    		queue.push($i);
		    		//queue.push(parseInt($scope.cards[$i].CID));
		    	}
		    	console.log(queue);
		    	 //Picture ID
		    	 $scope.pid = parseInt(queue[0]);
		 	//$scope.pid = parseInt($scope.cards[0].CID);	
		 	//In case in Learning mode
		 	if(_mode===1) $scope.userscore = maxcard;    	
		 } );
	   	   	
		 $scope.result = "";

		 // getVerdict() function
		 $scope.getVerdict = function(){
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

		 	}else{
		 		console.log("Verdict: Wrong Answer");
		 		$scope.verdict = "Wrong Answer";
		 		//Enqueue if answer was wrong

		 		queue.push(queue.shift());
		 		console.log("Current Queue: " + queue);
		 	}

		 	// In case it's  a last card in deck
		 	if(queue.length===0){
		 		console.log("Game Ended");
		 		$scope.result += "You've got " +  $scope.userscore + " out of " + $scope.maxcard + "!";
				$scope.submitbtnvisible = false;
				$scope.inputtextvisible = false;
				$scope.pid = queue[0];
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
			 	$scope.verdict = "-";
			 	$scope.pid = queue[0];
			 	$scope.submitbtnvisible = true;
			 	$scope.nextbtnvisible = false;
			 	$scope.inputtext = false;
			 	$scope.userans = "";			 	
		 	 }

		 	//Learning Mode
		 	if(_mode===1){
				//Last Card
		 		if($scope.pid===$scope.maxcard){
		 			$scope.nextbtn = true;
		 		}
		 		 //Update Card information
	 			$scope.description = $scope.cards[$scope.pid-1].CDescription;
	 			$scope.currentword = $scope.cards[$scope.pid-1].CWord;
		 	}else{
		 		$scope.description  = $scope.cards[$scope.pid-1].CDescription;
		 		$scope.currentword =  $scope.cards[$scope.pid-1].CWord;
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

</html>