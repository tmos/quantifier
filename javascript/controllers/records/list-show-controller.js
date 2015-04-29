angular.module('quantifier')
    .controller('ListShowController', function ($http, $routeParams) {
        var controller = this;
        $http({method:'GET', url:'api/web/api/track/' + $routeParams.id})
            .success(function(data){
                controller.track = data;
            })
            .error(function(){
            });

        this.delete = function () {
            $http({
                url: 'api/web/api/listing/' + $routeParams.id,
                method: "DELETE"
            })
                .success(function (data) {
                    console.log(data);
                })
                .error(function () {

                });

        }
    });