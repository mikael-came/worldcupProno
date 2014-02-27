var utilisateurCtrl = angular.module('UtilisateurCtrl', []);
 
utilisateurCtrl.controller('UtilisateurCtrl', function ($scope, $http, $routeParams, $location) {
 

  // Fonction permettant l'ajout d'un utilisateur
	$scope.ajoutUtilisateur = function() {


    if($scope.utilisateur.pwd != $scope.utilisateur.pwd2 ){
      alert("le mot de passe saisi ne correspond pas à la confirmation.");
    }else{
      $http.post(
  			'./server/ajoutUtilisateur.php',
  			{'utilisateur' : $scope.utilisateur}
    	).
  		  success(function(data, status, headers, config) {
  		 
  	     
      }).error(function(data, status, headers, config) {
      // called asynchronously if an error occurs
      // or server returns response with an error status.
      alert("une erreur de conction à la base de donnée, a eu lieu.");
    });
    }
	};

  //Fonction permettant la gestion du clic sur le bouton de login
  $scope.login =function(){

      $http.post(
        './server/checkLogin.php',
        {'utilisateur' : $scope.utilisateur}
      )
      .success(function(data, status, headers, config) {
        if(data =="OK"){
          alert("athentifié");
        }else{
          alert(data);      
        }
      
         
      })
      .error(function(data, status, headers, config) {
      // called asynchronously if an error occurs
      // or server returns response with an error status.
      alert("une erreur de conction à la base de donnée, a eu lieu.");
    });
  };



});