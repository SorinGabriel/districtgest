
	<div id="modifica-client" class="modal fade" role="dialog" ng-controller="clienti">
	  	
	  	<div class="modal-dialog">

	    	<div class="modal-content">

	      		<div class="modal-header">

	        		<button type="button" class="close" data-dismiss="modal">&times;</button>
	        		
	        		<h4 class="modal-title">Modifica client</h4>

	      		</div>
	      
		      	<div class="modal-body">
		        	
		        	<form id="change-client" name="change" method="post" action="../rezervari/modificaclient">

		        		<div class="input-group">

		        			<label for="nume">Nume:</label>
		        			<input type="text" name="nume" placeholder="Nume" ng-model="nume" required>
		        			<span ng-show="change.nume.$touched && change.nume.$invalid" class="validator">Campul este obligatoriu</span>

		        		</div>

		        		<div class="input-group">

		        			<label for="email">Email:</label>
		        			<input type="text" name="email" placeholder="Email" ng-model="email" required>
		        			<span ng-show="change.email.$touched && change.email.$invalid" class="validator">Campul este obligatoriu</span>

		        		</div>


		        		<div class="input-group">

		        			<label for="telefon">Telefon:</label>
		        			<input type="text" name="telefon" placeholder="Telefon" ng-model="telefon" required>
		        			<span ng-show="change.telefon.$touched && change.telefon.$invalid" class="validator">Campul este obligatoriu</span>

		        		</div>


		        		<div class="input-group">

		        			<label for="detalii">Detalii:</label>
		        			<textarea name="detalii" ng-model="detalii"></textarea>

		        		</div>

		        		<button type="submit" class="btn btn-custom btn-success"><i class="fas fa-save"></i> Modifica</button>

		        	</form>
		      	
		      	</div>

	    	</div>

	  	</div>

	</div>