angular.module('quantifier')
    .controller('DataNewController', function ($http, $routeParams) {
        var controller = this;
        this.create = function (data) {
            data.type = "0";
            console.log(data);
            $http({
                url: 'api/web/api/evolution/' + $routeParams.id,
                method: "POST",
                data: serializeData(controller.theData),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
                .success(function (data) {
                    console.log(data);
                })
                .error(function () {

                });

        }
/*
        controller.data.dateChosen = new Date();
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
        };*/
    });