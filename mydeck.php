<?php 
      session_start();
      //Check whether user's already login or not?
      if(!isset($_SESSION['UID'])){
       header("Location: index.php"); 
      }
?>
<!DOCTYPE html>
<html ng-app="mydeck">
<head>
  <meta charset="UTF-8">
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
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>

  <link rel="stylesheet" href="css/style.css">
  
</head>

<body>
      <div id="wrapper">
        <div class="overlay"></div>
    
        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                       MENU 
                    </a>
                </li>
                <li>
                    <a href="#">
                    <i class="fa fa-user"></i><?php echo " User: <b>".$_SESSION['UUser']."</b>!";?>
                    </a>
                </li>
                <li>
                    <a href="#">
                    <i class="fa fa-folder-open-o"></i>  Decks <span class="badge">2</span>
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
            <div class="container" style="padding-left: 100px; padding-top: 0px;" ng-controller="myDeckCtrl">
                <h2>My Created Deck</h2>
               
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>

    <script src="js/index.js"></script>

</body>
<script>
  //Declare Angular application name decklist
  var uid = <?php echo $_SESSION['UID']; ?>;
  var app = angular.module('mydeck', []);
  app.controller('myDeckCtrl',  function ($scope, $http, $filter, $sce,$location,$window){
    console.log("User ID: " + uid);

    // $http.get('php/decklist_retrieve.php',{ params: { uid: uid } }).then(function (response) {
    //       $scope.decklists = response.data.decklist;
    //       console.log($scope.decklists.length);
    //  } );

   });
</script>

</html>
