var app = angular.module('districtGest', []);

app.run(function($rootScope, $http, $location, $q) {

	$rootScope.user = "";

	$rootScope.data = "";

	$rootScope.page = 1;
	$rootScope.orderByArray = "";
	$rootScope.filters = {};

	$rootScope.total = "";

	$rootScope.setOrderBy = function(column) {

		var index = $rootScope.orderByArray.indexOf(column + " asc");
		var index2 = $rootScope.orderByArray.indexOf(column + " desc");

		if (index == -1 && index2 == -1) {
			$rootScope.orderByArray = $rootScope.orderByArray + column + " asc, ";
		}
		else {

			if (index2 == -1)
				$rootScope.orderByArray = $rootScope.orderByArray.substring(0,index) + column + " desc, " + $rootScope.orderByArray.substring(index + column.length + 6);			
			else
				$rootScope.orderByArray = $rootScope.orderByArray.substring(0,index2) + $rootScope.orderByArray.substring(index2 + column.length + 7);

		}

		$rootScope.filters.orderby = $rootScope.orderByArray.slice(0,-2);

		$rootScope.fetchData(1,$rootScope.filters);

	}

	$rootScope.sortClass =function(column) {

		if ($rootScope.orderByArray.indexOf(column + " asc") >= 0)
			return "fas fa-sort-down";
		else if ($rootScope.orderByArray.indexOf(column + " desc") >= 0)
			return "fas fa-sort-up";
		else
			return "";

	}

    $rootScope.fetchData = function(page,filters) {

    	for (var property in filters) 
    		if (filters[property].length == 0) delete filters[property];

    	filters = $.param(filters);

		if ($rootScope.httpRequest)
			$rootScope.httpRequest.resolve();

		$rootScope.httpRequest = $q.defer();

		$http(
		    {
		       method: 'POST',
		       url: $location.absUrl() + "/api/" + page,
		       data: filters,
		       timeout: $rootScope.httpRequest,
		       headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		    }).then(function successCallback(response) {

		    	$rootScope.data = response.data.data;
		    	$rootScope.total = response.data.total;
		    	$rootScope.page = page;
		    
		    }, function errorCallback(response) {
	    		console.error("Http service failed");
		});

    }

    $rootScope.changePage = function(direction) {

    	if (direction == 'next') {
    		
    		$rootScope.page++;
    		$rootScope.fetchData($rootScope.page,$rootScope.filters);

    	}
    	else if (direction == 'previous') {

    		$rootScope.page--;
    		$rootScope.fetchData($rootScope.page,$rootScope.filters);

    	}

    }

    $rootScope.paging = function(direction) {

    	if (direction == 'next') {

    		if ($rootScope.page >= $rootScope.total.pages)

    			return "btn btn-primary action-button hidden";

    	}

    	if (direction == 'previous') {

    		if ($rootScope.page <= 1) {

    			return "btn btn-primary action-button hidden";

    		}

    	}

    	return "btn btn-primary action-button";

    }

});