<?php 
      session_start();
      //Check whether user's already login or not?
      if(!isset($_SESSION['UID'])){
       header("Location: index.php"); 
      }
?>
<!DOCTYPE html>
<html ng-app="decklist">
<head>
  <meta charset="UTF-8">
  <!-- http://jsfiddle.net/AhakQ/13/ -->
  <title>Main Page</title>
  <!-- Include Framework & Library -->
  <script type="text/javascript" src="node_modules/angular/angular.min.js"></script>
  <link rel="stylesheet" type="text/css" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/sidebar.css">
  <script src="js/sidebar.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/loading.css">

</head>

<body onload="myFunction()">

  <div id="loader"></div>

  <div style="display:none;" id="myDiv" class="animate-bottom">
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
                    <a href="#">
                    <i class="fa fa-folder-open-o"></i>  Decks
                    </a>
                </li>
                <li>
                    <a href="adddeck.php">
                    <i class="fa fa-plus-square"></i>  Add Deck
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
        <div id="page-content-wrapper">
          <button type="button" class="hamburger is-closed animated fadeInLeft" data-toggle="offcanvas">
            <span class="hamb-top"></span>
            <span class="hamb-middle"></span>
            <span class="hamb-bottom"></span>
          </button>
            <div class="container" style="padding-left: 100px; padding-top: 0px;">
                <div class="row">
                    <div class="col-sm-12 col-md-12 sidebar">
                       <!--Deck zone-->
  <div ng-controller="deckCtrl" >
  
    <h2>My Progress Decks</h2>
    
    <div ng-repeat="n in decks" id="deckprev">
		<!-- Trigger the modal with an image -->
		<img src={{n.DCover}} class="crop" id="cardshow" data-toggle="modal" data-target="#{{n.DID}}">
		
		<div class="progress">
			<div class="progress-bar" role="progressbar" aria-value="{{n.UProgress}}" aria-valuemin="0" aria-valuemax="100" style="width: {{n.UProgress}}%">				
			</div>
		</div>
  		
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
            <p color="#23454C"><b>Deck Name: </b> {{n.DName}} <br>
              <b> Description: </b> {{n.DDescription}} <br>
       <b> Deck Creator: </b>{{n.DCreator}} <br>
            </p>
          </div>
          <div class="modal-footer">
           <form action="game.php" method="POST">
            <input type="text" name="did" value="{{n.DID}}"ng-hide="true">
            <input type="text" name="selMode" value="{{selMode}}"  ng-hide="true">
            <input type="text" name="dname" value="{{n.DName}}"  ng-hide="true">
            <button type="submit" class="btn btn-info" ng-click="clickLearning()"> Learning</button>
            <button type="submit" class="btn btn-success" ng-click="clickProgress()">Play</button>
            <button type="button" class="btn btn-danger" ng-click="removeDeck(n.DID)"> Remove</button>
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
    
     <img src={{m.DCover}} class="crop" id="cardshow" data-toggle="modal" data-target="#{{m.DID}}">
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
       <b> Deck Creator: </b>{{m.DCreator}} <br>
            </p>
          </div>
          <div class="modal-footer">
           <form action="game.php" method="POST">
            <input type="text" name="did" value="{{n.DID}}" placeholder="{{m.DID}}" ng-hide="true">
            <input type="text" name="selMode" value="{{selMode}}" placeholder="{{selMode}}" ng-hide="true">
            <button type="button" class="btn btn-warning" ng-click="addDeck(m.DID)"> Add</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </form>
           
          </div>
        </div>

      </div>
    </div>

    </div>
  </div><!--close deck zone-->

                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
</div>

  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>

    <script src="js/index.js"></script>

</body>
<script>
var myVar;

function myFunction() {
    myVar = setTimeout(showPage, 30);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}
  //Declare Angular application name decklist
  var uid = <?php echo $_SESSION['UID']; ?>;
  var app = angular.module('decklist', []);
  app.controller('deckCtrl',  function ($scope, $http, $filter, $sce,$location,$window){
    console.log("User ID: " + uid);

    $http.get('php/decklist_retrieve.php',{ params: { uid: uid } }).then(function (response) {
          $scope.decklists = response.data.decklist;
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
      $http.get('php/remove_deck_progress.php',{ params: { deckid: deckid ,uid: uid} }).then(function (response) {
            //$scope.decks = response.data.records;
            console.log("remove completed");
            $window.location.reload();
      });
    }
    //Add to my deck
    $scope.addDeck = function(deckid){
      console.log(deckid);
      $http.get('php/add_deck_progress.php',{ params: { deckid: deckid ,uid: uid} }).then(function (response) {
            //$scope.decks = response.data.records;
            console.log("add completed");
            $window.location.reload();

      });
    }

  });
</script>

</html>
