angular.module('quantifier')
    .controller('NotesIndexController', function($http){
        var controller = this;
        $http({method:'GET', url:'api/web/app.php/api/tracks'}).success(function(data){
            controller.tracks = data;
        });
    });