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
            .when('/tracks', {
                templateUrl: 'templates/pages/tracks/index.html',
                controller:'TracksIndexController',
                controllerAs:'indexCtrl'
            })
            .when('/track/:id', {
                templateUrl: 'templates/pages/track/index.html',
                controller:'TrackShowController',
                controllerAs:'trackCtrl'
            })
            .when('/tracks/new', {
                templateUrl: 'templates/pages/tracks-new/index.html',
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
            .when('/proportions/new', {
                templateUrl: 'templates/pages/proportions-new/index.html',
                controller:'TrackNewController',
                controllerAs:'newCtrl'
            })
            /* Data */
            .when('/data/new/evolution', {
                templateUrl: 'templates/pages/data-new/evolution',
                controller: 'DataNewController',
                controllerAs:'dataCtrl'
            })
            .when('/data/new/binary', {
                templateUrl: 'templates/pages/data-new/binary',
                controller: 'NewDataController',
                controllerAs:'dataCtrl'
            })
            .when('/data/new/list', {
                templateUrl: 'templates/pages/data-new/evolution',
                controller: 'NewDataController',
                controllerAs:'dataCtrl'
            })
            /* Settings */
            .when('/settings', {
                templateUrl: 'templates/pages/settings/index.html',
                controller:'SettingsNewController',
                controllerAs:'settingsCtrl'
            })
            /* Meta */
            .when('/', {
                redirectTo:'/tracks'
            })
            .otherwise({
                redirectTo:'/tracks'
            });
    }]);
