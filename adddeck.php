<?php
      session_start();
      //Check whether user's already login or not?
      if(!isset($_SESSION['UID'])){
       header("Location: index.php"); 
      }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Add deck</title>
  <!-- Include AngularJS Framework &modules -->
  <script type="text/javascript" src="node_modules/angular/angular.min.js"></script>
  <script src="bower_components/ng-img-crop-full-extended/compile/minified/ng-img-crop.js"></script>
  <link rel="stylesheet" type="text/css" href="bower_components/ng-img-crop-full-extended/compile/minified/ng-img-crop.css">
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
<body ng-app="app" ng-controller="addDeckCtrl">
    <div id="wrapper">
        <div class="overlay"></div>
        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                <li class="sidebar-brand">
                   <img id="nohover" src="img/web/LOGOMINI.png" alt="" align="center">
                </li>
                <li>
                    <a href="#">
                    <i class="fa fa-user"></i><?php echo " User: <b>".$_SESSION['UUser']."</b>!";?>
                    </a>
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
        <div id="page-content-wrapper">
          <button type="button" class="hamburger is-closed animated fadeInLeft" data-toggle="offcanvas">
            <span class="hamb-top"></span>
            <span class="hamb-middle"></span>
            <span class="hamb-bottom"></span>
          </button>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                       <h2>My Created Deck</h2>
    <div ng-repeat="n in mydeck" style="display: inline-block;" id="deckprev">

  <img src={{n.DCover}} width="150px" height="200px" data-toggle="modal" data-target ="#{{n.DID}}" style="border-radius: 10px;">
      <!-- <button type="button"  data-toggle="modal" data-target="#addcard">Add New card</button> -->

  <!-- Modal for display information-->
  <div id="{{n.DID}}" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Deck Information</h4>
            </div>
            <div class="modal-body">
              <p><b>Deck Name: </b> {{n.DName}}<br>
                     <b> Description: </b>{{n.DDescription}} <br>
              </p>
            </div>
            <div class="modal-footer">
            <form action="addcard.php" method="POST">

              <input type="text" value="{{n.DName}}" name="DName" ng-hide="true"/>
              <input type="text" value="{{n.DID}}" name="DID" ng-hide="true"/>
              <button type="submit" class="btn btn-warning"> Add Card</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
             </form>
             
            </div>
           
          </div>

        </div>
    </div>



    </div>
    <button type="button"  data-toggle="modal" data-target="#dummy" style="border:none; background-color: Transparent;" title="Click here to add a new deck">
      <img src="img/web/adddeck.png" alt="add new deck" height="200" width="150"></button>
    
   
    <!-- Modal for display information-->
    <div id="dummy" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Deck Information</h4>
          </div>
          <div class="modal-body">

          <form action="php/deck_insert.php" method="POST">
            <p><b>Deck Name: </b> <input type="text" name="dname"><br>
                   <b> Description: </b><input type="text" name="ddes"><br>
            </p>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-warning"> Add</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </form>
           
          </div>
        </div>

      </div>
    </div>
                    </div>
                </div>
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

    angular.module('app', ['ngImgCrop']).controller('addDeckCtrl', function($scope,$http,$templateCache) {
      

         $http.get('php/mydeck_retreive.php').then(function (response) {
          $scope.mydeck = response.data.decklist;
          console.log($scope.mydeck);
         });

         $scope.submitForm = function() {
           // create a blank object to handle form data.
                   $scope.user = {};
                   $scope.user.cname = $scope.cardName;
                   $scope.user.cdes = $scope.cardDes;
                   $scope.user.ccate = $scope.cardCate;
           $scope.user.cimg = $scope.myCroppedImage;
          // Posting data to php file
          $http({
            method  : 'POST',
            url     : 'php/cards_insert.php',
            data    : $scope.user, //forms user object
            headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
           })
            .success(function(data) {
              if (data.errors) {
                // Showing errors.
                $scope.errorName = data.errors.name;
                $scope.errorUserName = data.errors.username;
                $scope.errorEmail = data.errors.email;
                $scope.errorImg = data.errors.cimg;
              } else {
                $scope.message = data.message;
                console.log($scope.message);
              }
            });
        };

        $scope.myImage='';
        $scope.myCroppedImage='';

        var handleFileSelect=function(evt) {
          var file=evt.currentTarget.files[0];
          var reader = new FileReader();
          reader.onload = function (evt) {
            $scope.$apply(function($scope){
              $scope.myImage=evt.target.result;
            });
          };
          reader.readAsDataURL(file);
        };
        angular.element(document.querySelector('#fileInput')).on('change',handleFileSelect);

        
      });
  </script>
</html>