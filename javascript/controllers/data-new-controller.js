angular.module('quantifier')
    .controller('DataNewController', function () {
        this.changeDate = function () {
            swal({
                title: "Date",
                text: "Set the date of your record",
                type: "input",
                inputType:"date",
                showCancelButton: true,
                closeOnConfirm: false,
                animation: "slide-from-top",
                inputPlaceholder: new Date().toISOString()
            }, function (inputValue) {
                if (inputValue === false) return false;
                if (inputValue === "") {
                    swal.showInputError("You need to write something!");
                    return false
                }
                swal("Nice!", "You wrote: " + inputValue, "success");
            });
        };
        this.create = function (track) {
            $http({method: 'POST', url: 'api/web/api/data', data: controller.data})
                .success(function () {

                })
                .error(function () {

                });
        }

    });