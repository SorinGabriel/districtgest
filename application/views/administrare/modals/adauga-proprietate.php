
	<div id="adauga-proprietate" class="modal fade" role="dialog" ng-controller="proprietati">
	  	
	  	<div class="modal-dialog">

	    	<div class="modal-content">

	      		<div class="modal-header">

	        		<button type="button" class="close" data-dismiss="modal">&times;</button>
	        		
	        		<h4 class="modal-title">Adauga proprietate</h4>

	      		</div>
	      
		      	<div class="modal-body">
		        	
		        	<form id="add-property" name="add" method="post" action="../administrare/adaugaproprietate">

		        		<div class="input-group">

		        			<label for="nume">Nume proprietate:</label>
		        			<input type="text" name="nume" placeholder="Nume de proprietate" ng-model="nume" required>
		        			<span ng-show="add.nume.$touched && add.nume.$invalid" class="validator">Campul este obligatoriu</span>

		        		</div>

		        		<div class="input-group">

		        			<label for="adresa">Adresa:</label>
		        			<input type="text" name="adresa" placeholder="Adresa proprietate" ng-model="adresa" required>
		        			<span ng-show="add.adresa.$touched && add.adresa.$invalid" class="validator">Campul este obligatoriu</span>

		        		</div>

		        		<div class="input-group">

		        			<label for="tip">Tip:</label>
		        			<select name="tip">
		        				<option ng-repeat="x in tipProprietati" value="{{x.id}}">{{x.nume}}</option>
		        			</select>

		        		</div>

		        		<button type="submit" class="btn btn-custom btn-success"><i class="fas fa-plus"></i> Adauga</button>

		        	</form>
		      	
		      	</div>

	    	</div>

	  	</div>

	</div>