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
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/sidebar.css">
	<script src="js/sidebar.js"></script>
</head>
<body>
	<div id="container">

	<!--Sidebar-->
	<div class="row">
	        	<div class="col-sm-4 col-md-3 sidebar">
			<div class="mini-submenu">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>	
			</div>
	    	<div class="list-group">
        		<span href="#" class="list-group-item active">
          		  Menu
            		<span class="pull-right" id="slide-submenu">
                	<i class="fa fa-times"></i>
            		</span>
        		</span>
	        	<a href="#" class="list-group-item">
	            	<i class="fa fa-user"></i><?php echo " User: <b>".$_SESSION['UUser']."</b>!";?>
	        	</a>
	        	<a href="#" class="list-group-item">
	            	<i class="fa fa-folder-open-o"></i>  Decks <span class="badge">2</span>
	        	</a>
	        	<a href="php/logout.php" class="list-group-item">
	            	<i class="fa fa-key"></i> Logout
	        	</a>
	    	</div>        
		</div>
    	</div>
	
	<!--Deck zone-->
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
		      	<button type="button" class="btn btn-success" ng-click="removeDeck(n.DID)"> Remove</button>
		      	<button type="submit" class="btn btn-success" ng-click="clickLearning()"> Learning</button>
		      	<button type="submit" class="btn btn-warning" ng-click="clickProgress()">Play</button>
		      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </form>
		        <!-- <button type="button" class="btn btn-default" ng-click="startPlay(n.DID)">Play </button> -->
		       
		      </div>
		    </div>

		  </div>
		</div>
		</div>


		<h2>All Decks</h2>
		<div ng-repeat="m in decklists" id="deckprev">
		 <!-- Trigger the modal with an image -->
		
		 <img src={{m.CIPath}} class="crop" width="169" height="169px" data-toggle="modal" data-target="#{{m.DID}}">
		<!-- Modal for display information-->
		<div id="{{m.DID}}" class="modal fade" role="dialog" ng-controller="deckCtrl">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Deck Information</h4>
		      </div>
		      <div class="modal-body">
		        <p><b>Deck Name: </b> {{m.DName}} <br>
		        	<b> Description: </b> {{m.DDescription}} <br>
			<b> No. of cards: </b>{{m.DMax}} <br>
			 <b> Deck Creator: </b>{{m.DCreator}} <br>
			 Deck Rating: {{m.DRating}} 
		        </p>
		      </div>
		      <div class="modal-footer">
		       <form action="game.php" method="POST">
		      	<input type="text" name="did" value="{{n.DID}}" placeholder="{{m.DID}}" ng-hide="true">
		      	<input type="text" name="selMode" value="{{selMode}}" placeholder="{{selMode}}" ng-hide="true">
		      	<button type="button" class="btn btn-success" ng-click="addDeck(m.DID)"> Add</button>
		      	
		      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </form>
		        <!-- <button type="button" class="btn btn-default" ng-click="startPlay(n.DID)">Play </button> -->
		       
		      </div>
		    </div>

		  </div>
		</div>

		</div>
	</div>

	</div>
</body>

<script>
	//Declare Angular application name decklist
	var uid = <?php echo $_SESSION['UID']; ?>;
	var app = angular.module('decklist', []);
	app.controller('deckCtrl',  function ($scope, $http, $filter, $sce,$location,$window){
		console.log("User ID: " + uid);

		$http.get('php/decklist_retrieve.php',{ params: { uid: uid } }).then(function (response) {
		    	$scope.decklists = response.data.decklist;
		    	console.log($scope.decklists[0]);
		 } );

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

		//Remove from my deck
		$scope.removeDeck = function(deckid){
			console.log(deckid);
			$http.get('php/removedeck.php',{ params: { deckid: deckid ,uid: uid} }).then(function (response) {
		    		//$scope.decks = response.data.records;
		    		console.log("remove completed");
		    		$window.location.reload();

		 	});
		}
		//Add to my deck
		$scope.addDeck = function(deckid){
			console.log(deckid);
			$http.get('php/adddeck.php',{ params: { deckid: deckid ,uid: uid} }).then(function (response) {
		    		//$scope.decks = response.data.records;
		    		console.log("add completed");
		    		$window.location.reload();

		 	});
		}

	});
</script>
</html>
