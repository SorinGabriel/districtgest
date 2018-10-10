
	<div id="drepturi-utilizator" class="modal fade" role="dialog" ng-controller="utilizatori">
	  	
	  	<div class="modal-dialog">

	    	<div class="modal-content">

	      		<div class="modal-header">

	        		<button type="button" class="close" data-dismiss="modal">&times;</button>
	        		
	        		<h4 class="modal-title">Drepturi utilizator</h4>

	      		</div>
	      
		      	<div class="modal-body">
		        	
		        	<form id="access-username" method="post" action="../administrare/modificadrepturiutilizator">

		        		<div class="input-group">

		        			<label for="drept_administrare">Drept administrare:</label>
							<label class="switch">
								<input type="checkbox" name="drept_administrare" value="1">
								<span class="slider"></span>
							</label>

		        		</div>

		        		<button type="submit" class="btn btn-custom btn-success"><i class="fas fa-save"></i> Modifica</button>

		        	</form>
		      	
		      	</div>

	    	</div>

	  	</div>

	</div>


