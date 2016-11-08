<!DOCTYPE html>
<html ng-app="decklist">
<head>
	<title>Deck List</title>
	<!-- Include AngularJS Framework -->
	<script type="text/javascript" src="node_modules/angular/angular.min.js"></script>
	<!-- Include Bootstrap Framework -->
	<link rel="stylesheet" type="text/css" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
	<div ng-controller="deckCtrl">
		<table class="table">
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
			</tr>
		</table>
	</div>
</body>

<script>
	//Declare Angular application name decklist
	var app = angular.module('decklist', []);
	app.controller('deckCtrl',  function ($scope, $http, $filter, $sce){

		$http.get('deck_retrieve.php').then(function (response) {
		    	$scope.decks = response.data.records;
		    	//console.log($scope.decks[0].DID);
		 } );

	});
</script>
</html>
