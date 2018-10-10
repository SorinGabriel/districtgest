
	<div id="adauga-utilizator" class="modal fade" role="dialog" ng-controller="utilizatori">
	  	
	  	<div class="modal-dialog">

	    	<div class="modal-content">

	      		<div class="modal-header">

	        		<button type="button" class="close" data-dismiss="modal">&times;</button>
	        		
	        		<h4 class="modal-title">Adauga utilizator</h4>

	      		</div>
	      
		      	<div class="modal-body">
		        	
		        	<form id="add-username" name="add" method="post" action="../administrare/adaugautilizator">

		        		<div class="input-group">

		        			<label for="username">Nume utilizator:</label>
		        			<input type="text" name="username" placeholder="Nume de utilizator" ng-model="username" required>
		        			<span ng-show="add.username.$touched && add.username.$invalid" class="validator">Campul este obligatoriu</span>

		        		</div>

		        		<div class="input-group">

		        			<label for="password">Parola:</label>
		        			<input type="password" name="password" placeholder="Parola utilizator" ng-model="password" required>
		        			<span ng-show="add.password.$touched && add.password.$invalid" class="validator">Campul este obligatoriu</span>

		        		</div>

		        		<div class="input-group">

		        			<label for="adresa-mail">Adresa de mail:</label>
		        			<input type="mail" name="adresa-mail" placeholder="Ex:sorin@farmasoft.net">

		        		</div>

		        		<div class="input-group">

		        			<label for="numar-telefon">Numar de telefon:</label>
		        			<input type="phone" name="numar-telefon" placeholder="Ex:0720 000 000">

		        		</div>

		        		<button type="submit" class="btn btn-custom btn-success"><i class="fas fa-plus"></i> Adauga</button>

		        	</form>
		      	
		      	</div>

	    	</div>

	  	</div>

	</div>
