app.controller('camere', function($scope, $http, $location, $q) {

    $scope.setDeleteData = function(record) {

    	console.log(record);

    	$("#delete-room").html(record.numar);
    	$("#delete-link").attr("href","../camere/stergecamera/" + record.id);

    }

    $scope.setChangeData = function(record) {

    	$("#change-room").trigger('reset');

    	$("#change-room select[name=fk_proprietate]").val(record.id_proprietate).trigger('select');
    	$("#change-room input[name=numar]").val(record.numar).trigger('input');
    	$("#change-room input[name=pret]").val(record.pret).trigger('input');
    	$("#change-room input[name=etaj]").val(record.etaj).trigger('input');
    	if (record.balcon == 1)
    		$("#change-room input[name=balcon]").prop('checked', true).trigger('input');
    	else
    		$("#change-room input[name=balcon]").prop('checked', false).trigger('input');
    	if (record.baie == 1)
    		$("#change-room input[name=baie]").prop('checked', true).trigger('input');
    	else
    		$("#change-room input[name=baie]").prop('checked', false).trigger('input');
    	$("#change-room input[name=numar_persoane]").val(record.numar_persoane).trigger('input');

    	$("#change-room").attr("action","../camere/modificacamera/" + record.id).trigger('form');

    }

});