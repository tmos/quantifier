angular.module("quantifier", ["chart.js"])
    .controller("previewChart", function ($scope) {

        $scope.data = indexCtrl.track.values;
});