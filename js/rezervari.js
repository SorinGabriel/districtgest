app.controller('rezervari', function($scope, $http, $location, $q, $timeout) {

    $scope.allowChambersSelect = true;

    $scope.setDeleteData = function(record) {

    	$("#delete-reservation").html(record.nume);
    	$("#delete-link").attr("href","../rezervari/stergerezervare/" + record.id);

    }

    $scope.setChangeData = function(record) {

    	$("#change-reservation").trigger('reset');

        $timeout(function(){
            $("#change-reservation select[name=fk_proprietate]").val(record.id_proprietate);
            $("#change-reservation .fk_camera").val(record.id_camera_oferta.split("; "));
            angular.element($("#change-reservation .fk_camera")).trigger('change');
            angular.element($("#change-reservation select[name=fk_proprietate]")).trigger('change');
        })
    	$("#change-reservation input[name=data_inceput]").val(record.data_inceput.split(" ")[0]).trigger('input');
    	$("#change-reservation input[name=data_sfarsit]").val(record.data_sfarsit.split(" ")[0]).trigger('input');
        $("#change-reservation select[name=fk_client]").val(record.fk_client).trigger('change');

    	$("#change-reservation").attr("action","../rezervari/modificarezervare/" + record.id).trigger('form');

    }


    $scope.chambersAvailability = function(type) {

        $scope.allowChambersSelect = false;

        if (type == 'Filters') {

            if ($scope.filters['proprietati.id'].length > 0) {

                $scope.camereAvailableFilters = $scope.camere.filter(function(el){
                    return parseInt(el.fk_proprietate) == parseInt($scope.filters['proprietati.id']);
                });

            }

            else {

                $scope.camereAvailableFilters = $scope.camere;

            }

        }

        if (type == 'Add') {

            if ($scope.addProperty.length > 0) {

                $scope.camereAvailableAdd = $scope.camereSiOferte.filter(function(el){
                    return parseInt(el.fk_proprietate) == parseInt($scope.addProperty);
                });

            }

            else {

                $scope.camereAvailableAdd = $scope.camereSiOferte;

            }

        }

        if (type == 'Change') {

            if ($scope.changeProperty.length > 0) {

                $scope.camereAvailableChange = $scope.camereSiOferte.filter(function(el){
                    return parseInt(el.fk_proprietate) == parseInt($scope.changeProperty);
                });

            }

            else {

                $scope.camereAvailableChange = $scope.camereSiOferte;

            }

        }

    }

    $scope.addClient = function() {

        $http(
            {
               method: 'POST',
               url: "../rezervari/adaugaclient/api/",
               data: $("#add-client").serialize(),
               timeout: $scope.httpRequest,
               headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function successCallback(response) {
                $scope.clienti.push(response.data);
                $('#adauga-client').modal('toggle');
            }, function errorCallback(response) {
                console.error("Http service failed");
        });

    }

});