
	<span ng-init="
	data=<?php echo htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8');?>;
	total=<?php echo htmlspecialchars(json_encode($total), ENT_QUOTES, 'UTF-8');?>;
	user=<?php echo htmlspecialchars(json_encode($user), ENT_QUOTES, 'UTF-8');?>;
	proprietati=<?php echo htmlspecialchars(json_encode($proprietati), ENT_QUOTES, 'UTF-8');?>;
	camere=<?php echo htmlspecialchars(json_encode($camere), ENT_QUOTES, 'UTF-8');?>;
	camereAvailableFilters=<?php echo htmlspecialchars(json_encode($camere), ENT_QUOTES, 'UTF-8');?>;
	camereAvailableAdd=<?php echo htmlspecialchars(json_encode($camere), ENT_QUOTES, 'UTF-8');?>;
	camereAvailableChange=<?php echo htmlspecialchars(json_encode($camere), ENT_QUOTES, 'UTF-8');?>"></span>

	<div class="container-fluid container-table" ng-controller="oferte">

		<div class="buttons">
			<h3><i class="fas fa-bed"></i> Camere / <i class="fas fa-tag"></i> Oferte</h3>
			<a data-toggle="modal" data-target="#adauga-oferta" class="btn btn-primary btn-lg btn-custom"><i class="fas fa-plus"></i> Adauga oferta</a>
		</div>

		<table class="data-table">

			<tr>

				<th class="width-15 align-center">
					<label ng-click="setOrderBy('proprietati.nume')">Proprietate <i ng-class="sortClass('proprietati.nume')"></i></label>
					<select ng-model="filters['proprietati.id']" ng-change="chambersAvailability('Filters');fetchData(1,filters)">
						<option value="">Toate</option>
						<option ng-repeat="x in proprietati" value="{{x.id}}">{{x.nume}}</option>
					</select>
				</th>
				<th class="width-15 align-center">
					<label ng-click="setOrderBy('camere.numar')">Camera <i ng-class="sortClass('camere.numar')"></i></label>
					<select ng-model="filters['camere.numar']" ng-change="fetchData(1,filters)">
						<option value="">Toate</option>
						<option ng-repeat="x in camereAvailableFilters" value="{{x.numar}}">{{x.numar}}</option>
					</select>
				</th>
				<th class="width-15 align-center">
					<label ng-click="setOrderBy('oferte.nume')">Oferta <i ng-class="sortClass('oferte.nume')"></i></label>
					<input type="text" ng-model="filters['oferte.nume']" ng-change="fetchData(1,filters)" placeholder="Cauta oferta">
				</th>
				<th class="width-15 align-center">
					<label ng-click="setOrderBy('camere.pret')">Pret standard/noapte <i ng-class="sortClass('camere.pret')"></i></label>
					<input type="text" ng-model="filters['camere.pret']" ng-change="fetchData(1,filters)" placeholder="Cauta pret">
				</th>
				<th class="width-15 align-center">
					<label ng-click="setOrderBy('oferte.pret')">Pret oferta/noapte <i ng-class="sortClass('oferte.pret')"></i></label>
					<input type="text" ng-model="filters['oferte.pret']" ng-change="fetchData(1,filters)" placeholder="Cauta capacitate">
				</th>
				<th class="width-15 align-center">
					<label ng-click="setOrderBy('oferte.data_inceput')">Data Inceput <i ng-class="sortClass('oferte.data_inceput')"></i></label>
					<input type="text" class="datepicker" ng-model="filters['oferte.data_inceput']" ng-change="fetchData(1,filters)" placeholder="Cauta data inceput">
				</th>
				<th class="width-15 align-center">
					<label ng-click="setOrderBy('oferte.data_sfarsit')">Data Sfarsit <i ng-class="sortClass('oferte.data_sfarsit')"></i></label>
					<input type="text" class="datepicker" ng-model="filters['oferte.data_sfarsit']" ng-change="fetchData(1,filters)" placeholder="Cauta data sfarsit">
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

				<td class="width-15 align-center">{{record.nume_proprietate}}</td>
				<td class="width-15 align-center">{{record.numar_camera}}</td>
				<td class="width-15 align-center">{{record.nume}}</td>
				<td class="width-15 align-center">{{record.pret_camera}}</td>
				<td class="width-15 align-center">{{record.pret}}</td>
				<td class="width-15 align-center">{{record.data_inceput}}</td>
				<td class="width-15 align-center">{{record.data_sfarsit}}</td>
				<td class="align-center">
					
					<div class="actions">

						<a data-toggle="modal" data-target="#modifica-oferta" ng-click="setChangeData(record)" href="#" title="Modifica oferta">
						
							<button class="btn btn-success action-button">
								<i class="fas fa-pencil-alt"></i>
							</button>
						
						</a>

						<a data-toggle="modal" data-target="#sterge-oferta" ng-click="setDeleteData(record)" href="#" title="Sterge oferta">
						
							<button class="btn btn-danger action-button">
								<i class="fas fa-trash"></i>
							</button>
						
						</a>

					</div>

				</td>

			</tr>

		</table>

	</div>
