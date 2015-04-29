angular.module('quantifier')
    .controller('TrackNewController', function($http) {
        this.create = function (track) {
            $http({
                url: 'api/web/api/track/',
                method: "POST",
                data: serializeData(track),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
                .success(function (data) {
                    console.log(data);
                })
                .error(function () {

                });
            }
        });