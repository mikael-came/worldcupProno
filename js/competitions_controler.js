var competitionsCtrl = angular.module('competitionsCtrl', []);
 

competitionsCtrl.controller('competitionsCtrl', function ($scope, $http) {
	  
	  // Recupération des compétitions
	  $http({method: 'GET', 
	  	url: './server/getlisteCompetitions.php'}
	  	).
		  success(function(data, status, headers, config) {
		   
			  $scope.competitions = data.competitions;
		  });


	    
});
