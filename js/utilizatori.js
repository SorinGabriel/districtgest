app.controller('utilizatori', function($scope, $http, $location, $q) {

    $scope.setDeleteData = function(record) {

    	$("#delete-user").html(record.utilizator);
    	$("#delete-link").attr("href","../administrare/stergeutilizator/" + record.id);

    }

    $scope.setChangeData = function(record) {

    	$("#change-username").trigger('reset');

    	$("#change-username input[name=username]").val(record.utilizator).trigger('input');
    	$("#change-username input[name=adresa-mail]").val(record.adresa_mail).trigger('input');
    	$("#change-username input[name=numar-telefon]").val(record.numar_telefon).trigger('input');

    	$("#change-username").attr("action","../administrare/modificautilizator/" + record.id).trigger('form');

    }

    $scope.setAccessData = function(record) {

    	if (record.drept_administrare == 1)
    		$("#access-username input[name=drept_administrare]").prop('checked', true);
    	else
    		$("#access-username input[name=drept_administrare]").prop('checked', false);

    	$("#access-username").attr("action","../administrare/modificadrepturiutilizator/" + record.id);

    }

});