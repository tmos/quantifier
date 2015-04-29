angular.module('quantifier')
    .controller('TrackShowController', function($http, $routeParams){
        var controller = this;
        $http({method:'GET', url:'api/web/api/track/' + $routeParams.id})
            .success(function(data){
                controller.track = data;
            })
            .error(function(){
            });
    });