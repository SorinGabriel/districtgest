
	<span ng-init="
	data=<?php echo htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8');?>;
	total=<?php echo htmlspecialchars(json_encode($total), ENT_QUOTES, 'UTF-8');?>;
	user=<?php echo htmlspecialchars(json_encode($user), ENT_QUOTES, 'UTF-8');?>;
	proprietati=<?php echo htmlspecialchars(json_encode($proprietati), ENT_QUOTES, 'UTF-8');?>"></span>

	<div class="container-fluid container-table" ng-controller="camere">

		<div class="buttons">
			<h3><i class="fas fa-bed"></i> Camere / <i class="fas fa-bed"></i> Lista Camere</h3>
			<a data-toggle="modal" data-target="#adauga-camera" class="btn btn-primary btn-lg btn-custom"><i class="fas fa-plus"></i> Adauga camera</a>
		</div>

		<table class="data-table">

			<tr>

				<th class="width-15 align-center">
					<label ng-click="setOrderBy('proprietati.nume')">Proprietate <i ng-class="sortClass('proprietati.nume')"></i></label>
					<select ng-model="filters['proprietati.nume']" ng-change="fetchData(1,filters)">
						<option value="">Toate</option>
						<option ng-repeat="x in proprietati" value="{{x.nume}}">{{x.nume}}</option>
					</select>
				</th>
				<th class="width-15 align-center">
					<label ng-click="setOrderBy('camere.numar')">Numar <i ng-class="sortClass('camere.numar')"></i></label>
					<input type="text" ng-model="filters['camere.numar']" ng-change="fetchData(1,filters)" placeholder="Cauta camera">
				</th>
				<th class="width-15 align-center">
					<label ng-click="setOrderBy('camere.pret')">Pret standard/noapte <i ng-class="sortClass('camere.pret')"></i></label>
					<input type="text" ng-model="filters['camere.pret']" ng-change="fetchData(1,filters)" placeholder="Cauta pret">
				</th>
				<th class="width-15 align-center">
					<label ng-click="setOrderBy('camere.numar_persoane')">Capacitate <i ng-class="sortClass('camere.numar_persoane')"></i></label>
					<input type="text" ng-model="filters['camere.numar_persoane']" ng-change="fetchData(1,filters)" placeholder="Cauta capacitate">
				</th>
				<th class="width-15 align-center">
					<label ng-click="setOrderBy('camere.etaj')">Etaj <i ng-class="sortClass('camere.etaj')"></i></label>
					<input type="text" ng-model="filters['camere.etaj']" ng-change="fetchData(1,filters)" placeholder="Cauta etaj">
				</th>
				<th class="width-15 align-center">
					<label ng-click="setOrderBy('camere.balcon')">Balcon <i ng-class="sortClass('camere.balcon')"></i></label>
					<select ng-model="filters['camere.balcon']" ng-change="fetchData(1,filters)">
						<option value="" checked>Toate</option>
						<option value="1">Da</option>
						<option value="0">Nu</option>
					</select>
				</th>
				<th class="width-15 align-center">
					<label ng-click="setOrderBy('camere.baie')">Baie <i ng-class="sortClass('camere.baie')"></i></label>
					<select ng-model="filters['camere.baie']" ng-change="fetchData(1,filters)">
						<option value="" checked>Toate</option>
						<option value="1">Da</option>
						<option value="0">Nu</option>
					</select>
				</th>
				<th class="align-right">

					<label>Actiuni</label>

					<span>Pagina {{page}} din {{total.pages}}</span>

					<button ng-class="paging('previous')" ng-click="changePage('previous')">
						<i class="fas fa-caret-left"></i>
					</button>

					<button ng-class="paging('next')" ng-click="changePage('next')">
						<i class="fas fa-caret-right"></i>
					</button>

				</th>

			</tr>

			<div ng-show="data.length == 0">
				<h1><i class="fas fa-exclamation-triangle"></i> Nu s-au gasit rezultate</h1>
			</div>

			<tr ng-repeat="record in data">

				<td class="width-15 align-center">{{record.nume}}</td>
				<td class="width-15 align-center">{{record.numar}}</td>
				<td class="width-15 align-center">{{record.pret}}</td>
				<td class="width-15 align-center">{{record.numar_persoane}}</td>
				<td class="width-15 align-center">{{record.etaj}}</td>
				<td class="width-15 align-center">{{record.balcon == 1 ? "Da" : "Nu"}}</td>
				<td class="width-15 align-center">{{record.baie == 1 ? "Da" : "Nu"}}</td>
				<td class="align-center">
					
					<div class="actions">

						<a data-toggle="modal" data-target="#modifica-camera" ng-click="setChangeData(record)" href="#" title="Modifica camera">
						
							<button class="btn btn-success action-button">
								<i class="fas fa-pencil-alt"></i>
							</button>
						
						</a>

						<a data-toggle="modal" data-target="#sterge-camera" ng-click="setDeleteData(record)" href="#" title="Sterge camera">
						
							<button class="btn btn-danger action-button">
								<i class="fas fa-trash"></i>
							</button>
						
						</a>

					</div>

				</td>

			</tr>

		</table>

	</div>