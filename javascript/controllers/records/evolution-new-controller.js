angular.module('quantifier')
    .controller('EvolutionNewController', function ($http, $routeParams) {
        var controller = this;

        this.create = function (data) {
            data.type = "0";

            if (data.dateChosen === undefined) {
                data.dateChosen = Math.floor(Date.now() / 1000);
                console.log(data.dateChosen);

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
                data.dateChosen = Math.floor(new Date(inputValue) / 1000);
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