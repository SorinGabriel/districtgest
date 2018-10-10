
	<div id="adauga-rezervare" class="modal fade" role="dialog" ng-controller="rezervari">
	  	
	  	<div class="modal-dialog">

	    	<div class="modal-content">

	      		<div class="modal-header">

	        		<button type="button" class="close" data-dismiss="modal">&times;</button>
	        		
	        		<h4 class="modal-title">Adauga rezervare</h4>

	      		</div>
	      
		      	<div class="modal-body">
		        	
		        	<form id="add-reservation" name="add" method="post" action="../rezervari/adaugarezervare">

		        		<div class="input-group">

		        			<label for="fk_proprietate">Proprietati:</label>
		        			<select ng-model="addProperty" name="fk_proprietate" ng-change="chambersAvailability('Add')">
		        				<option ng-repeat="x in proprietati" value="{{x.id}}">{{x.nume}}</option>
		        			</select>

		        		</div>

		        		<div class="input-group">

		        			<label for="fk_camera">Camera:</label>
		        			<select class="select2" name="fk_camera[]" multiple="multiple" ng-disabled="allowChambersSelect" ng-model="selectedChambers" ng-options="x as (x.numar + ' - Pret: ' + x.pret) group by x.group_numar for x in camereAvailableAdd track by x.id"></select>

		        		</div>

		        		<div class="input-group">

		        			<label for="data_inceput">Data inceput:</label>
		        			<input type="datetime" class="datetimepicker" name="data_inceput" placeholder="Data inceput" ng-model="data_inceput" required>

		        		</div>

		        		<div class="input-group">

		        			<label for="data_inceput">Data sfarsit:</label>
		        			<input type="datetime" class="datetimepicker" name="data_sfarsit" placeholder="Data sfarsit" ng-model="data_sfarsit" required>

		        		</div>

		        		<div class="input-group">

		        			<label for="fk_client">Client:</label>
		        			<select name="fk_client" class="select2">
		        				<option ng-repeat="x in clienti" value="{{x.id}}">{{x.nume}} {{x.prenume}}</option>
		        			</select>		
		        			<a data-toggle="modal" data-target="#adauga-client" class="btn btn-primary btn-lg btn-custom"><i class="fas fa-plus"></i> Adauga client</a>        			
		        			<span ng-show="add.fk_client.$touched && add.fk_client.$invalid" class="validator">Campul este obligatoriu</span>

		        		</div>

		        		<button type="submit" class="btn btn-custom btn-success"><i class="fas fa-plus"></i> Adauga</button>

		        	</form>
		      	
		      	</div>

	    	</div>

	  	</div>

	</div>
