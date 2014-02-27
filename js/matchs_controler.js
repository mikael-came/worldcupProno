var matchCtrl = angular.module('matchCtrl', []);
 
matchCtrl.controller('matchCtrl', function ($scope, $http, $routeParams, $location) {
	
	    if ($routeParams.id_competition) {
	    	$scope.id_Competition = $routeParams.id_competition;

	    } else {
			$scope.id_Competition = "";
	    }
   
	  //recuperation des equipes
	  $http.post('./server/getListeEquipe.php',{'id_Competition' :$scope.id_Competition}
	  	).
		  success(function(data, status, headers, config) {
		   
			  $scope.equipes = data.equipes;
		  });


	   // Récuperation des matchs
	   $http.post('./server/getallmatchs.php',{'id_Competition' : $scope.id_Competition}
	  	).
		success(function(data, status, headers, config) {
			  $scope.matchs = data.matchs;
			  
	    });

		var indexedTeams = [];

		// fonction de tri sur les groupes
	    $scope.matchsToFilter = function() {
	        indexedTeams = [];
	        return $scope.matchs;
	    }

	    $scope.filterGroupe = function(match) {
	        var teamIsNew = indexedTeams.indexOf(match.nom_groupe) == -1;
	        if (teamIsNew) {
	            indexedTeams.push(match.nom_groupe);
	        }
	        return teamIsNew;
	    }

	    // fonction permettant l'ajout d'un match
	  	$scope.submitForm = function() {
			
			$.ajax({
			  type: "POST",
			  url: "./server/addMatch.php",
			  data: { id_equipe1: $scope.equipe_1.id, id_equipe2: $scope.equipe_2.id ,id_groupe_Matchs:"1",date:"2014-02-04 15:00:00"}
			})
			  .done(function( msg ) {
			    alert( "Data Saved: " + msg );
			  });
		};
  
});
