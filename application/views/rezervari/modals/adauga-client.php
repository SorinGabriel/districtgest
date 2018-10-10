
	<div id="adauga-client" class="modal fade" role="dialog" ng-controller="<?php echo $controller; ?>">
	  	
	  	<div class="modal-dialog">

	    	<div class="modal-content">

	      		<div class="modal-header">

	        		<button type="button" class="close" data-dismiss="modal">&times;</button>
	        		
	        		<h4 class="modal-title">Adauga client</h4>

	      		</div>
	      
		      	<div class="modal-body">
		        	
		        	<form id="add-client" name="add"
		        	<?php if ($controller == "clienti") : ?> method="post" action="../rezervari/adaugaclient" 
		        	<?php elseif ($controller == "rezervari") : ?> ng-submit="addClient()" <?php endif; ?> >

		        		<div class="input-group">

		        			<label for="nume">Nume:</label>
		        			<input type="text" name="nume" placeholder="Nume" ng-model="nume" required>
		        			<span ng-show="add.nume.$touched && add.nume.$invalid" class="validator">Campul este obligatoriu</span>

		        		</div>

		        		<div class="input-group">

		        			<label for="email">Email:</label>
		        			<input type="text" name="email" placeholder="Email" ng-model="email" required>
		        			<span ng-show="add.email.$touched && add.email.$invalid" class="validator">Campul este obligatoriu</span>

		        		</div>


		        		<div class="input-group">

		        			<label for="telefon">Telefon:</label>
		        			<input type="text" name="telefon" placeholder="Telefon" ng-model="telefon" required>
		        			<span ng-show="add.telefon.$touched && add.telefon.$invalid" class="validator">Campul este obligatoriu</span>

		        		</div>


		        		<div class="input-group">

		        			<label for="detalii">Detalii:</label>
		        			<textarea name="detalii" ng-model="detalii"></textarea>

		        		</div>

		        		<button type="submit" class="btn btn-custom btn-success"><i class="fas fa-plus"></i> Adauga</button>

		        	</form>
		      	
		      	</div>

	    	</div>

	  	</div>

	</div>
