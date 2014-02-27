var worldCupApp = angular.module('worldCupApp', [
  'ngRoute',
  'UtilisateurCtrl','matchCtrl','competitionsCtrl'
]);

 
worldCupApp.config(['$routeProvider',
  function($routeProvider) {

    $routeProvider.
      when('/signin', {
        templateUrl: './partial/newUserForm.html',
        controller: 'UtilisateurCtrl',
        authenticate: false,
      }). 
      when('/login', {
        templateUrl: './partial/loginForm.html',
        authenticate: false,
        controller: 'UtilisateurCtrl'
      }).
       when('/matchs/:id_Competition', {
        templateUrl: './partial/listeMatchs.html',
        authenticate: true,
        controller: 'matchCtrl'
      }).
        when('/competitions', {
        templateUrl: './partial/Selection_competitions.html',
        authenticate: true,
        controller: 'competitionsCtrl'
      }).
      when('/competition/:id_competition', {
        templateUrl: './partial/listeMatchs.html',
        authenticate: true,
        controller: 'matchCtrl'
      }).
        when('/ajout_match', {
        templateUrl: './partial/ajoutMatch.html',
        authenticate: true,
        controller: 'matchCtrl'
      })
      .
      otherwise({
        redirectTo: '/login'
      });
  }]);


worldCupApp.directive('uiDate', function() {
    return {
      require: '?ngModel',
      link: function($scope, element, attrs, controller) {
        var originalRender, updateModel, usersOnSelectHandler;
        if ($scope.uiDate == null) $scope.uiDate = {};
        if (controller != null) {
          updateModel = function(value, picker) {
            return $scope.$apply(function() {
              return controller.$setViewValue(element.datepicker("getDate"));
            });
          };

          if ($scope.uiDate.onSelect != null) {
            usersOnSelectHandler = $scope.uiDate.onSelect;
            $scope.uiDate.onSelect = function(value, picker) {
              updateModel(value);
              return usersOnSelectHandler(value, picker);
            };
          } else {
            $scope.uiDate.onSelect = updateModel;
          }
          originalRender = controller.$render;
          
          controller.$render = function() {
            originalRender();
            return element.datepicker("setDate", controller.$viewValue);
          };
        }
        return element.datepicker($scope.uiDate);
      }
    };
  });

