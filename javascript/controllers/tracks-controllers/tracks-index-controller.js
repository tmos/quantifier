angular.module('quantifier')
    .controller('TracksIndexController', function($http){
        var controller = this;
        $http({method:'GET', url:'api/web/api/track/'})
            .success(function(data){
                controller.tracks = data;
            })
            .error(function(){
                controller.tracks = JSON.parse('[{"id":16,"name":"Whisky drunk","creator":"Spieldy","date":"2015-04-25T17:20:48-0400","type":0,"evolutions":[],"listings":[],"binaries":[]},{"id":17,"name":"Hour worked on Quantifier","creator":"Tom","date":"2015-04-25T17:20:48-0400","type":0,"evolutions":[1,2,3,4,5],"listings":[],"binaries":[]},{"id":18,"name":"KM run","creator":"Spieldy","date":"2015-04-24T14:50:30-0400","type":0,"evolutions":[1,2,3,4,6,9,3,8,8,7,6],"listings":[],"binaries":[]}]');
            });
    });