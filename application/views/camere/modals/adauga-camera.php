
	<div id="adauga-camera" class="modal fade" role="dialog" ng-controller="camere">
	  	
	  	<div class="modal-dialog">

	    	<div class="modal-content">

	      		<div class="modal-header">

	        		<button type="button" class="close" data-dismiss="modal">&times;</button>
	        		
	        		<h4 class="modal-title">Adauga camera</h4>

	      		</div>
	      
		      	<div class="modal-body">
		        	
		        	<form id="add-room" name="add" method="post" action="../camere/adaugacamera">

		        		<div class="input-group">

		        			<label for="fk_proprietate">Proprietate:</label>
		        			<select name="fk_proprietate">
		        				<option ng-repeat="x in proprietati" value="{{x.id}}">{{x.nume}}</option>
		        			</select>

		        		</div>

		        		<div class="input-group">

		        			<label for="numar">Numar camera:</label>
		        			<input type="text" name="numar" placeholder="Numar camera" ng-model="numar" required>
		        			<span ng-show="add.numar.$touched && add.numar.$invalid" class="validator">Campul este obligatoriu</span>

		        		</div>

		        		<div class="input-group">

		        			<label for="pret">Pret standard/noapte:</label>
		        			<input type="number" name="pret" placeholder="Pret camera" ng-model="pret" min="0" required>
		        			<span ng-show="add.pret.$touched && add.pret.$invalid" class="validator">Valoare invalida</span>

		        		</div>

		        		<div class="input-group">

		        			<label for="pret">Etaj:</label>
		        			<input type="number" name="etaj" placeholder="Etaj" ng-model="etaj" required>
		        			<span ng-show="add.etaj.$touched && add.etaj.$invalid" class="validator">Campul este obligatoriu</span>

		        		</div>

		        		<div class="input-group">

		        			<label for="balcon">Balcon:</label>
							<label class="switch">
								<input type="checkbox" name="balcon" value="1">
								<span class="slider"></span>
							</label>

		        		</div>

		        		<div class="input-group">

		        			<label for="baie">Baie:</label>
							<label class="switch">
								<input type="checkbox" name="baie" value="1">
								<span class="slider"></span>
							</label>

		        		</div>

		        		<div class="input-group">

		        			<label for="numar_persoane">Numar Persoane:</label>
		        			<input type="number" name="numar_persoane" placeholder="Numar Persoane" ng-model="numar_persoane" min="1" required>
		        			<span ng-show="add.numar_persoane.$touched && add.numar_persoane.$invalid" class="validator">Valoare invalida</span>

		        		</div>

		        		<button type="submit" class="btn btn-custom btn-success"><i class="fas fa-plus"></i> Adauga</button>

		        	</form>
		      	
		      	</div>

	    	</div>

	  	</div>

	</div>