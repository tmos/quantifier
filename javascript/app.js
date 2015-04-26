angular.module('quantifier', ['ngRoute'])
    .config(['$routeProvider', function($routeProvider) {
        $routeProvider
            /* User relative */
            .when('/login', {
                templateUrl:'templates/pages/login/index.html'
            })
            .when('/register', {
                templateUrl:'templates/pages/register/index.html'
            })
            /* Tracks */
            .when('/track/:id', {
                templateUrl: 'templates/pages/track/index.html',
                controller:'TrackShowController',
                controllerAs:'trackCtrl'
            })
            .when('/tracks', {
                templateUrl: 'templates/pages/tracks/index.html',
                controller:'TracksIndexController',
                controllerAs:'indexCtrl'
            })
            .when('/track/new', {
                templateUrl: 'templates/pages/track-new/index.html',
                controller:'TrackNewController',
                controllerAs:'newCtrl'
            })
            /* Proportions */
            .when('/proportions', {
                templateUrl: 'templates/pages/proportions/index.html',
                controller:'ProportionsIndexController',
                controllerAs:'indexCtrl'
            })
            .when('/proportion/:id', {
                templateUrl: 'templates/pages/proportion/index.html',
                controller:'ProportionShowController',
                controllerAs:'proportionCtrl'
            })
            .when('/proportion/new', {
                templateUrl: 'templates/pages/proportion/new.html',
                controller:'TrackNewController',
                controllerAs:'newCtrl'
            })
            /* Settings */
            .when('/settings', {
                templateUrl: 'templates/pages/settings/index.html',
                controller:'SettingsNewController',
                controllerAs:'settingsCtrl'
            })
            /* Meta */
            .otherwise({
                redirectTo:'/'
            });
    }]);