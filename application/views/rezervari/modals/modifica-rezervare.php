
	<div id="modifica-rezervare" class="modal fade" role="dialog" ng-controller="rezervari">
	  	
	  	<div class="modal-dialog">

	    	<div class="modal-content">

	      		<div class="modal-header">

	        		<button type="button" class="close" data-dismiss="modal">&times;</button>
	        		
	        		<h4 class="modal-title">Modifica rezervare</h4>

	      		</div>
	      
		      	<div class="modal-body">
		        	
		        	<form id="change-reservation" name="change" method="post" action="../rezervari/modificarezervare">

		        		<div class="input-group">

		        			<label for="fk_proprietate">Proprietati:</label>
		        			<select ng-model="changeProperty" name="fk_proprietate" ng-change="chambersAvailability('Change')">
		        				<option ng-repeat="x in proprietati" value="{{x.id}}">{{x.nume}}</option>
		        			</select>

		        		</div>

		        		<div class="input-group">

		        			<label for="fk_camera">Camera:</label>
		        			<select class="select2 fk_camera" name="fk_camera[]" multiple="multiple" ng-model="selectedChambers" ng-options="x as (x.numar + ' - Pret: ' + x.pret) group by x.group_numar for x in camereAvailableChange track by x.id"></select>

		        		</div>

		        		<div class="input-group">

		        			<label for="data_inceput">Data inceput:</label>
		        			<input type="datetime" class="datetimepicker" name="data_inceput" placeholder="Data inceput" ng-model="data_inceput" required>
		        			<span ng-show="change.data_inceput.$touched && change.data_inceput.$invalid" class="validator">Campul este obligatoriu</span>

		        		</div>

		        		<div class="input-group">

		        			<label for="data_inceput">Data sfarsit:</label>
		        			<input type="datetime" class="datetimepicker" name="data_sfarsit" placeholder="Data sfarsit" ng-model="data_sfarsit" required>
		        			<span ng-show="change.data_sfarsit.$touched && change.data_sfarsit.$invalid" class="validator">Campul este obligatoriu</span>

		        		</div>

		        		<div class="input-group">

		        			<label for="fk_client">Client:</label>
		        			<select name="fk_client" class="select2">
		        				<option ng-repeat="x in clienti" value="{{x.id}}">{{x.nume}} {{x.prenume}}</option>
		        			</select>		
		        			<a data-toggle="modal" data-target="#adauga-client" class="btn btn-primary btn-lg btn-custom"><i class="fas fa-plus"></i> Adauga client</a>        			
		        			<span ng-show="add.fk_client.$touched && add.fk_client.$invalid" class="validator">Campul este obligatoriu</span>

		        		</div>

		        		<button type="submit" class="btn btn-custom btn-success"><i class="fas fa-save"></i> Modifica</button>

		        	</form>
		      	
		      	</div>

	    	</div>

	  	</div>

	</div>