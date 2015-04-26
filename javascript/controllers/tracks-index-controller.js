angular.module('quantifier')
    .controller('TracksIndexController', function($http){
        var controller = this;
        $http({method:'GET', url:'api/web/api/tracks'}).success(function(data){
            controller.tracks = data;
        });
    });