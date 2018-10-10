app.controller('proprietati', function($scope, $http, $location, $q) {

    $scope.setDeleteData = function(record) {

    	$("#delete-property").html(record.nume);
    	$("#delete-link").attr("href","../administrare/stergeproprietate/" + record.id);

    }

    $scope.setChangeData = function(record) {

    	$("#change-property").trigger('reset');

    	$("#change-property input[name=nume]").val(record.nume).trigger('input');
    	$("#change-property input[name=adresa]").val(record.adresa).trigger('input');
    	$("#change-property select[name=tip]").val(record.tip).trigger('select');

    	$("#change-property").attr("action","../administrare/modificaproprietate/" + record.id).trigger('form');

    }

});