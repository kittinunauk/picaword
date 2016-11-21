<?php
  session_start();
      //Check whether user's already login or not?
      if(!isset($_SESSION['UID'])){
       header("Location: index.php"); 
      }
  $did = $_POST['DID'];
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Add Card</title>
  <script type="text/javascript" src="node_modules/angular/angular.min.js"></script>
  <script src="bower_components/ng-img-crop-full-extended/compile/minified/ng-img-crop.js"></script>
  <link rel="stylesheet" type="text/css" href="bower_components/ng-img-crop-full-extended/compile/minified/ng-img-crop.css">
  <style>
    .cropArea {
      background: #E4E4E4;
      overflow: hidden;
      width:300px;
      height:300px;
    }
  </style>
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
  <link rel="stylesheet" href="css/button.css">
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
	
					    <form action="adddeck.php" method="POST" style="">	
              <h1> </h1>
							<button class="button" id="normal" type="submit" style="width: 40px; height: 40px; background-color:#CE0003; float:right;" title="Click here to close"><i class="fa fa-close"></i></button>
						<h2><?php echo $_POST['DName'] ?></h2></form>
					
					

    <div ng-repeat="m in cardlist" style="display: inline-block;" id="deckprev">
     <!-- Trigger the modal with an image -->
    
     <img src={{m.CIPath}} class="crop"  data-toggle="modal" data-target="#{{m.CID}}" style="border-radius:10px;height: 150px;width: 200px;">


    <!-- Modal for display information-->
      <div id="{{m.CID}}" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Card Information</h4>
            </div>
            <div class="modal-body">

              <p><b>Card Name: </b> {{m.CWord}}<br>
                     <b> Card Description: </b> {{m.CDescription}}<br>
              </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>

     </div>
    <button type="button"  data-toggle="modal" data-target="#addcard" style="border:none; background-color: Transparent;" title="Click here to add a new card">
      <img src="img/web/addcard.png" alt="add new deck" height="200" width="150"></button>

    <div ng-repeat="n in cardlist">
    </div>
    <!-- Modal for display add card information-->
    <div id="addcard" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Card</h4>
          </div>
          <div class="modal-body">
  <!-- FORM -->
      <form name="userForm" ng-submit="submitForm()">
      <div class="form-group">
          <label>Card Name</label>
          <input type="text" name="cname" class="form-control" ng-model="cardName">
          <span ng-show="errorName">{{errorName}}</span>
      </div>
      <div class="form-group">
          <label>Card Description</label>
          <input type="text" name="cdes" class="form-control" ng-model="cardDes">
          <span ng-show="errorUserName">{{errorUserName}}</span>
      </div>
      <div class="form-group">
          <label>Category</label>
          <input type="text" name="ccate" class="form-control" ng-model="cardCate">
          <span ng-show="errorEmail">{{errorEmail}}</span>
      </div>
     
    {{codeStatus}}
    <div>Select an image file: <input type="file" id="fileInput" /></div>
         {{errorImg}}
    <div class="cropArea">
            <img-crop image="myImage" area-type="rectangle" aspect-ratio="0.7" result-image="myCroppedImage" result-image-size='{w: 200,h: 300}' init-max-area="true"></img-crop>
    </div>
    <div>Cropped Image:</div>
    <div><img ng-src="{{myCroppedImage}}" /></div>
          
          </div>
          <div class="modal-footer">
           <button type="submit" class="btn btn-primary">Add</button>
     
      {{message}}
      </form>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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

    var DID = <?php echo $did ?>;

    angular.module('app', ['ngImgCrop']).controller('addDeckCtrl', function($scope,$http,$templateCache,$window) {
    
         $http.get('php/mydeckcard_retreive.php',{ params: { deckid: DID } }).then(function (response) {
         	$scope.cardlist = response.data.cardlistindeck;
         	console.log($scope.cardlist);
         });

         $scope.submitForm = function() {
         	 // create a blank object to handle form data.
        	         $scope.user = {};
        	         $scope.user.cname = $scope.cardName;
        	         $scope.user.cdes = $scope.cardDes;
        	         $scope.user.ccate = $scope.cardCate;
                       $scope.user.did = DID;
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
	              //console.log($scope.message);
                    $window.location.reload();
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