app.controller('oferte', function($scope, $http, $location, $q) {

    $scope.allowChambersSelect = true;

    $scope.setDeleteData = function(record) {

    	$("#delete-offer").html(record.nume);
    	$("#delete-link").attr("href","../camere/stergeoferta/" + record.id);

    }

    $scope.setChangeData = function(record) {

    	$("#change-offer").trigger('reset');

    	$("#change-offer input[name=nume]").val(record.nume).trigger('input');
        $("#change-offer select[name=fk_proprietate]").val(record.id_proprietate).trigger('select');
        $("#change-offer .fk_camera").val(record.id_camera.split("; ")).trigger('change');
    	$("#change-offer input[name=pret]").val(record.pret).trigger('input');
    	$("#change-offer input[name=data_inceput]").val(record.data_inceput).trigger('input');
        $("#change-offer input[name=data_sfarsit]").val(record.data_sfarsit).trigger('input');

    	$("#change-offer").attr("action","../camere/modificaoferta/" + record.id).trigger('form');

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

                $scope.camereAvailableAdd = $scope.camere.filter(function(el){
                    return parseInt(el.fk_proprietate) == parseInt($scope.addProperty);
                });

            }

            else {

                $scope.camereAvailableAdd = $scope.camere;

            }

        }

        if (type == 'Change') {

            if ($scope.changeProperty.length > 0) {

                $scope.camereAvailableChange = $scope.camere.filter(function(el){
                    return parseInt(el.fk_proprietate) == parseInt($scope.changeProperty);
                });

            }

            else {

                $scope.camereAvailableChange = $scope.camere;

            }

        }

    }

});