angular.module('quantifier', ['ngRoute'])
    .config(['$routeProvider', function ($routeProvider) {
        $routeProvider
            /* User relative */
            .when('/login', {
                templateUrl: 'templates/pages/login/index.html'
            })
            .when('/register', {
                templateUrl: 'templates/pages/register/index.html'
            })
            /* Tracks */
            .when('/tracks', {
                templateUrl: 'templates/pages/tracks/index.html',
                controller: 'TracksIndexController',
                controllerAs: 'indexCtrl'
            })
            .when('/track/:id', {
                templateUrl: 'templates/pages/track/index.html',
                controller: 'TrackShowController',
                controllerAs: 'trackCtrl'
            })
            .when('/tracks/new', {
                templateUrl: 'templates/pages/tracks-new/index.html',
                controller: 'TrackNewController',
                controllerAs: 'newCtrl'
            })
            /* Proportions */
            .when('/proportions', {
                templateUrl: 'templates/pages/proportions/index.html',
                controller: 'ProportionsIndexController',
                controllerAs: 'indexCtrl'
            })
            .when('/proportion/:id', {
                templateUrl: 'templates/pages/proportion/index.html',
                controller: 'ProportionShowController',
                controllerAs: 'proportionCtrl'
            })
            .when('/proportions/new', {
                templateUrl: 'templates/pages/proportions-new/index.html',
                controller: 'TrackNewController',
                controllerAs: 'newCtrl'
            })
            /* Data */
            .when('/track/:id/new/0', {
                templateUrl: 'templates/pages/data-new/evolution.html',
                controller: 'DataNewController',
                controllerAs: 'dataCtrl'
            })
            .when('/track/:id/new/1', {
                templateUrl: 'templates/pages/data-new/binary.html',
                controller: 'NewDataController',
                controllerAs: 'dataCtrl'
            })
            .when('/track/:id/new/2', {
                templateUrl: 'templates/pages/data-new/evolution.html',
                controller: 'DataNewController',
                controllerAs: 'dataCtrl'
            })
            /* Settings */
            .when('/settings', {
                templateUrl: 'templates/pages/settings/index.html',
                controller: 'SettingsNewController',
                controllerAs: 'settingsCtrl'
            })
            /* Meta */
            .when('/', {
                redirectTo: '/tracks'
            })
            .otherwise({
                redirectTo: '/tracks'
            });
    }]);

/* https://github.com/jquery/jquery/blob/master/src/serialize.js */
function serializeData(data) {
    // If this is not an object, defer to native stringification.
    if (!angular.isObject(data)) {
        return ( ( data == null ) ? "" : data.toString() );
    }
    var buffer = [];

    // Serialize each key in the object.
    for (var name in data) {
        if (!data.hasOwnProperty(name)) {
            continue;
        }

        var value = data[name];
        buffer.push(
            encodeURIComponent(name) +
            "=" +
            encodeURIComponent(( value == null ) ? "" : value)
        );
    }

    // Serialize the buffer and clean it up for transportation.
    var source = buffer
            .join("&")
            .replace(/%20/g, "+")
        ;
    return ( source );
};