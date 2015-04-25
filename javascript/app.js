angular.module('quantifier', ['ngRoute'])
    .config(['$routeProvider', function($routeProvider) {
        $routeProvider
            .when('/login', {
                templateUrl:'templates/pages/login/index.html'
            })
            .when('/register', {
                templateUrl:'templates/pages/register/index.html'
            })
            .when('/tracks', {
                templateUrl: 'templates/pages/tracks/index.html',
                controller:'NotesIndexController',
                controllerAs:'indexCtrl'
            })
            .when('/tracks/new', {
                templateUrl: 'templates/pages/tracks/new.html'
            })
            .when('/proportions', {
                templateUrl: 'templates/pages/proportions/index.html'
            })
            .when('/settings', {
                templateUrl: 'templates/pages/proportions/index.html'
            })
            .otherwise({
                redirectTo:'/tracks'
            });
    }]);