angular.module('quantifier')
    .controller('TrackShowController', function($http, $routeParams){
        var controller = this;
        $http({method:'GET', url:'api/web/api/track/' + $routeParams.id})
            .success(function(data){
                controller.track = data;
            })
            .error(function(){
                controller.track = JSON.parse('{"id":16,"name":"Whisky drunk","creator":"Spieldy","date":"2015-04-25T17:20:48-0400","type":0,"evolutions":[1,2,3,4,5],"listings":[],"binaries":[]}');
            });
    });