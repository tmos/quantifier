angular.module('quantifier')
    .controller('DataNewController', function ($http, $routeParams) {
        var controller = this;
        var data = this.data;
        var customDate = this.customDate;

        this.create = function (data) {
            data.type = "0";

            if (dateChosen.dateChosen === undefined) {
                data.dateChosen = customDate;
            }
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

        this.changeDate = function (data) {
            swal({
                title: "Date",
                text: "Set the date of your record",
                type: "input",
                inputType:"date",
                showCancelButton: true,
                animation: "slide-from-top"
            }, function (inputValue) {
                if (inputValue === false) return false;
                if (inputValue === "") {
                    swal.showInputError("You need to write something!");
                    return false
                }
                data.dateChosen = inputValue;
            });
        };

        this.comment = function (data) {
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
                data.comment = inputValue;
            });
        };
    });