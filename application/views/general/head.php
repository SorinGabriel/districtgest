<!DOCTYPE html>

<html>

<head>
	
	<title><?php echo $title; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" />

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
	<script src="<?php echo base_url(); ?>js/app.js"></script>
	<script src="<?php echo base_url(); ?>js/<?php echo $controller; ?>.js"></script>
	<script src="<?php echo base_url(); ?>js/services.js"></script>
	<script>

		$( function() {

			$( ".datepicker" ).datetimepicker({ 
				format: 'Y-MM-D' 
			});
			$( ".datetimepicker" ).datetimepicker({
				allowInputToggle : true,
				format: 'Y-MM-D HH:mm'
			});
			$( ".select2" ).select2();

			$(".select2").on('select2:selecting', function(e) {
			  var sibling_elements = e.params.args.data.element.parentElement.children
			  for(var i = 0; i < sibling_elements.length; i++) {
			    sibling_elements[i].selected = false
			  }
			});

		} );

	</script>

</head>

<body>

<div id="<?php echo $page;?>" ng-app="districtGest" >
	