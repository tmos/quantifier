angular.module('quantifier')
    .controller('DataNewController', function () {
        controller = this;
        controller .dateChosen = new Date();
        this.changeDate = function () {
            swal({
                title: "Date",
                text: "Set the date of your record",
                type: "input",
                inputType:"date",
                showCancelButton: true,
                animation: "slide-from-top",
                inputPlaceholder: controller.dateChosen.toISOString()
            }, function (inputValue) {
                if (inputValue === false) return false;
                if (inputValue === "") {
                    swal.showInputError("You need to write something!");
                    return false
                }
                controller.dateChosen = inputValue;
            });
        };

        this.comment = function () {
            swal({
                title: "Comment",
                text: "Add something about this record",
                type: "input",
                showCancelButton: true,
                animation: "slide-from-top",
                inputPlaceholder: "…"
            }, function (inputValue) {
                if (inputValue === false) return false;
                if (inputValue === "") {
                    swal.showInputError("You need to write something!");
                    return false
                }
                controller.comment = inputValue;
            });
        };

        this.create = function (track) {
            $http({method: 'POST', url: 'api/web/api/data', data: controller.data})
                .success(function (data) {
                    console.log(data);
                })
                .error(function () {

                });
        }

    });