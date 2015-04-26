angular.module('quantifier')
    .controller('TrackNewController', function() {
        this.create = function (track) {
            $http({method: 'POST', url: 'api/web/api/track', data: controller.track})
                .success(function () {

                })
                .error(function () {

                });
            }
        });