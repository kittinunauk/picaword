<?php session_start() ?>
<!DOCTYPE html>
<html ng-app="decklist">
<head>
<!-- http://jsfiddle.net/AhakQ/13/ -->
	<title>Deck List</title>
	<!-- Include AngularJS Framework -->
	<script type="text/javascript" src="node_modules/angular/angular.min.js"></script>
	<!-- Include Bootstrap Framework -->
	<link rel="stylesheet" type="text/css" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/main.css">
</head>
<body>
	<div id="container">
	<?php echo "Welcome, ".$_SESSION['UUser']."!";?>
	<a href="php/logout.php">Logout</a>
	<div ng-controller="deckCtrl">
		<h2>My Decks</h2>
		<div ng-repeat="n in decks" id="deckprev">
		 <!-- Trigger the modal with an image -->
		 <img src={{n.CIPath}} class="crop" width="169" height="169px" data-toggle="modal" data-target="#{{n.DID}}">
		{{n.UProgress}} %
		<!-- Modal for display information-->
		<div id="{{n.DID}}" class="modal fade" role="dialog" ng-controller="deckCtrl">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Deck Information</h4>
		      </div>
		      <div class="modal-body">
		        <p><b>Deck Name: </b> {{n.DName}} <br>
		        	<b> Description: </b> {{n.DDescription}} <br>
			<b> No. of cards: </b>{{n.DMax}} <br>
			 <b> Deck Creator: </b>{{n.DCreator}} <br>
			 Deck Rating: {{n.DRating}} 
		        </p>
		      </div>
		      <div class="modal-footer">
		       <form action="game.php" method="POST">
		      	<input type="text" name="did" value="{{n.DID}}" placeholder="{{n.DID}}" ng-hide="true">
		      	<input type="text" name="selMode" value="{{selMode}}" placeholder="{{selMode}}" ng-hide="true">
		      	<button type="submit" class="btn btn-success" ng-click="clickLearning()"> Learning</button>
		      	<button type="submit" class="btn btn-warning" ng-click="clickProgress()"> Keep Progress</button>
		      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </form>
		        <!-- <button type="button" class="btn btn-default" ng-click="startPlay(n.DID)">Play </button> -->
		       
		      </div>
		    </div>

		  </div>
		</div>
		<!-- <table class="table">
			<td><b>Deck #</b></td>
			<td><b>Name</b></td>
			<td><b>Description</b></td>
			<td><b>No. of Cards</b></td>
			<td><b>Creator</b></td>
			<td><b>Rating</b></td>
			<td ><b>Action</b></td>
			<tr ng-repeat="n in decks"> 
				<td>{{ n.DID }}</td>
				<td>{{ n.DName }}</td>
				<td>{{ n.DDescription}}</td>
				<td>{{ n.DMax}} </td>
				<td>{{ n.DCreator}} </td>
				<td>{{ n.DRating}} </td>
				<td><a href="#"> Play  </a></td>   
				<!-- <a href="#"> Edit</a></td> -->
		<!--	</tr>
		</table>-->
		</div>
	</div>
	</div>
</body>

<script>
	//Declare Angular application name decklist
	var uid = <?php echo $_SESSION['UID']; ?>;
	var app = angular.module('decklist', []);
	app.controller('deckCtrl',  function ($scope, $http, $filter, $sce,$location){
		console.log("User ID: " + uid);

		$http.get('php/deck_retrieve.php',{ params: { uid: uid } }).then(function (response) {
		    	$scope.decks = response.data.records;
		 } );
		
		$scope.selMode = 0;

		//Learning Mode
		$scope.clickLearning = function(){
			$scope.selMode = 1;
		}

		//Keep Progress Mode
		$scope.clickProgress = function(){
			$scope.selMode = 2;
		}

	});
</script>
</html>
