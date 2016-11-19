<!DOCTYPE html>
<html>
<head>
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
</head>
<body ng-app="app" ng-controller="addDeckCtrl">

    <h2>My Created Deck</h2>
    <div ng-repeat="n in mydeck">

    	{{n.DName}}  {{n.DDescription}}  <button type="button"  data-toggle="modal" data-target="#addcard">Add New card</button>

    </div>
    <button type="button"  data-toggle="modal" data-target="#dummy">Add New Deck</button>
    
    

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
	    <button type="submit" class="btn btn-primary">Submit</button>
	    {{errorImg}}
	    {{message}}
	    </form>
	  <a href="#" ng-click="submitForm()">Click</a>
	  {{codeStatus}}
	  <div>Select an image file: <input type="file" id="fileInput" /></div>
	  <div class="cropArea">
	          <img-crop image="myImage" area-type="rectangle" aspect-ratio="0.7" result-image="myCroppedImage" result-image-size='{w: 340,h: 200}' init-max-area="true"></img-crop>
	  </div>
	  <div>Cropped Image:</div>
	  <div><img ng-src="{{myCroppedImage}}" /></div>
          
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-warning"> Add</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>
        </div>

      </div>
    </div>

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
	          url     : 'php/card_insert.php',
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