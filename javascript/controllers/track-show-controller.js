angular.module('quantifier')
    .controller('TrackShowController', function($http, $routeParams){
        var controller = this;
        $http({method:'GET', url:'api/web/api/track/' + $routeParams.id})
            .success(function(data){
                controller.track = data;
            })
            .error(function(){
                controller.track = JSON.parse('{"id":18,"name":"KMs run","creator":"Spieldy","date":"2015-04-24T14:50:30-0400","type":0,"evolutions":[{"id":13,"value":5.5,"date_creation":"2015-04-26T15:05:53-0400","date_chosen":"2015-04-26T13:26:34-0400","comment":"Sunny"},{"id":14,"value":2.12,"date_creation":"2015-04-26T15:06:08-0400","date_chosen":"2015-04-24T10:50:30-0400","comment":"Under rain"}],"listings":[],"binaries":[]}');
            });
    });