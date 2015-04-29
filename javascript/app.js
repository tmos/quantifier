angular.module('quantifier', ['ngRoute'])
    .config(['$routeProvider', function ($routeProvider) {
        $routeProvider
            /* User relative */
            .when('/login', {
                templateUrl: 'templates/pages/meta-views/login.html'
            })
            .when('/register', {
                templateUrl: 'templates/pages/meta-views/register.html'
            })
            .when('/settings', {
                templateUrl: 'templates/pages/meta-views/settings.html'
            })

            /* Tracks */
            .when('/tracks', {
                templateUrl: 'templates/pages/tracks/tracks-list.html',
                controller: 'TracksIndexController',
                controllerAs: 'indexCtrl'
            })
            .when('/tracks/new', {
                templateUrl: 'templates/pages/tracks/track-new.html',
                controller: 'TrackNewController',
                controllerAs: 'newCtrl'
            })
            .when('/track/0/:id', {
                templateUrl: 'templates/pages/records/evolution-show.html',
                controller: 'EvolutionShowController',
                controllerAs: 'trackCtrl'
            })
            .when('/track/1/:id', {
                templateUrl: 'templates/pages/records/list-show.html',
                controller: 'TrackShowController',
                controllerAs: 'trackCtrl'
            })
            .when('/track/2/:id', {
                templateUrl: 'templates/pages/records/binary-show.html',
                controller: 'TrackShowController',
                controllerAs: 'trackCtrl'
            })

            /* Proportions */
            .when('/proportions', {
                templateUrl: 'templates/pages/proportions/proportions-list.html',
                controller: 'ProportionsIndexController',
                controllerAs: 'indexCtrl'
            })
            .when('/proportion/:id', {
                templateUrl: 'templates/pages/proportions/proportions-show.html',
                controller: 'ProportionShowController',
                controllerAs: 'proportionCtrl'
            })
            .when('/proportions/new', {
                templateUrl: 'templates/pages/proportions/proportions-new.html',
                controller: 'TrackNewController',
                controllerAs: 'newCtrl'
            })

            /* Data */
            .when('/track/0/:id/new', {
                templateUrl: 'templates/pages/records/evolution-new.html',
                controller: 'EvolutionNewController',
                controllerAs: 'dataCtrl'
            })
            .when('/track/1/:id/new', {
                templateUrl: 'templates/pages/records/list-new.html',
                controller: 'ListNewController',
                controllerAs: 'dataCtrl'
            })
            .when('/track/2/:id/new', {
                templateUrl: 'templates/pages/records/binary-new.html',
                controller: 'BinaryNewController',
                controllerAs: 'dataCtrl'
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