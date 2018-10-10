app.controller('clienti', function($scope, $http, $location, $q) {

    $scope.setDeleteData = function(record) {

    	$("#delete-client").html(record.nume);
    	$("#delete-link").attr("href","../rezervari/stergeclient/" + record.id);

    }

    $scope.setChangeData = function(record) {

    	$("#change-client").trigger('reset');

    	$("#change-client input[name=nume]").val(record.nume).trigger('input');
    	$("#change-client input[name=email]").val(record.email).trigger('input');
    	$("#change-client input[name=telefon]").val(record.telefon).trigger('input');
        $("#change-client textarea[name=detalii]").html(record.detalii).trigger('textarea');

    	$("#change-client").attr("action","../rezervari/modificaclient/" + record.id).trigger('form');

    }

});