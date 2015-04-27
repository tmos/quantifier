angular.module('quantifier')
    .controller('TrackNewController', function($http) {
        this.create = function (track) {
            $http({method: 'POST', url: 'api/web/api/track/', data: JSON.stringify(this.track)})
                .success(function (data) {
                    console.log(data);
                })
                .error(function () {

                });
            }
        });