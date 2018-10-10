
	<div id="modifica-oferta" class="modal fade" role="dialog" ng-controller="oferte">
	  	
	  	<div class="modal-dialog">

	    	<div class="modal-content">

	      		<div class="modal-header">

	        		<button type="button" class="close" data-dismiss="modal">&times;</button>
	        		
	        		<h4 class="modal-title">Modifica oferta</h4>

	      		</div>
	      
		      	<div class="modal-body">
		        	
		        	<form id="change-offer" name="change" method="post" action="../camere/modificaoferta">
 
		        		<div class="input-group">

		        			<label for="nume">Nume oferta:</label>
		        			<input type="text" name="nume" placeholder="Nume oferta" ng-model="nume" required>
		        			<span ng-show="change.nume.$touched && change.nume.$invalid" class="validator">Campul este obligatoriu</span>

		        		</div>

		        		<div class="input-group">

		        			<label for="fk_proprietate">Proprietate:</label>
		        			<select name="fk_proprietate" ng-model="changeProperty" ng-change="chambersAvailability('Change')">
								<option ng-repeat="x in proprietati" value="{{x.id}}">{{x.nume}}</option>
		        			</select>

		        		</div>

		        		<div class="input-group">

		        			<label for="fk_camera">Camera:</label>
		        			<select class="select2 fk_camera" name="fk_camera[]" multiple="multiple">
								<option ng-repeat="x in camereAvailableChange" value="{{x.id}}">{{x.numar}} - Pret standard: {{x.pret}}</option>
		        			</select>

		        		</div>

		        		<div class="input-group">

		        			<label for="pret">Pret oferta/noapte:</label>
		        			<input type="number" name="pret" placeholder="Pret oferta" ng-model="pret" min="0" required>
		        			<span ng-show="change.pret.$touched && change.pret.$invalid" class="validator">Valoare invalida</span>

		        		</div>

		        		<div class="input-group">

		        			<label for="data_inceput">Data Inceput:</label>
		        			<input type="date" name="data_inceput" placeholder="Data inceput" ng-model="data_inceput" class="datepicker" required>
		        			<span ng-show="change.data_inceput.$touched && change.data_inceput.$invalid" class="validator">Campul este obligatoriu</span>

		        		</div>

		        		<div class="input-group">

		        			<label for="data_sfarsit">Data Sfarsit:</label>
		        			<input type="date" name="data_sfarsit" placeholder="Data sfarsit" ng-model="data_sfarsit" class="datepicker" required>
		        			<span ng-show="change.data_sfarsit.$touched && change.data_sfarsit.$invalid" class="validator">Campul este obligatoriu</span>

		        		</div>

		        		<button type="submit" class="btn btn-custom btn-success"><i class="fas fa-save"></i> Modifica</button>

		        	</form>
		      	
		      	</div>

	    	</div>

	  	</div>

	</div>