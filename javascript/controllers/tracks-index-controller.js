angular.module('quantifier')
    .controller('NotesIndexController', function($http){
        var controller = this;
        $http({method:'GET', url:'api/web/app.php/api/tracks'}).success(function(data){
            controller.tracks = data;
        });

        /*
        this.tracks = [
            {
                id:1,
                title:"Time spent with Ember"
            },
            {
                id:2,
                title:"Working time at UQAC"
            },
            {
                id:3,
                title:"Cafés"
            },
            {
                id:4,
                title:"Céceu"
            },
            {
                id:5,
                title:"Tabernacle"
            }
        ];
        */
    });