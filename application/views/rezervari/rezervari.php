
	<span ng-init="
	data=<?php echo htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8');?>;
	total=<?php echo htmlspecialchars(json_encode($total), ENT_QUOTES, 'UTF-8');?>;
	user=<?php echo htmlspecialchars(json_encode($user), ENT_QUOTES, 'UTF-8');?>;
	proprietati=<?php echo htmlspecialchars(json_encode($proprietati), ENT_QUOTES, 'UTF-8');?>;
	camere=<?php echo htmlspecialchars(json_encode($camere), ENT_QUOTES, 'UTF-8');?>;
	camereAvailableFilters=<?php echo htmlspecialchars(json_encode($camere), ENT_QUOTES, 'UTF-8');?>;
	camereSiOferte=<?php echo htmlspecialchars(json_encode($camereSiOferte), ENT_QUOTES, 'UTF-8');?>;
	camereAvailableAdd=<?php echo htmlspecialchars(json_encode($camereSiOferte), ENT_QUOTES, 'UTF-8');?>;
	camereAvailableChange=<?php echo htmlspecialchars(json_encode($camereSiOferte), ENT_QUOTES, 'UTF-8');?>;
	oferte=<?php echo htmlspecialchars(json_encode($oferte), ENT_QUOTES, 'UTF-8');?>;
	clienti=<?php echo htmlspecialchars(json_encode($clienti), ENT_QUOTES, 'UTF-8');?>
	"></span>

	<div class="container-fluid container-table" id="special-one" ng-controller="rezervari">

		<div class="buttons">
			<h3><i class="far fa-calendar-alt"></i>  Rezervari / <i class="far fa-calendar-alt"></i>  Lista Rezervari</h3>
			<a data-toggle="modal" data-target="#adauga-rezervare" class="btn btn-primary btn-lg btn-custom"><i class="fas fa-plus"></i> Adauga rezervare</a>
		</div>

		<table class="data-table">

			<tr>

				<th class="width-15 align-center">
					<label ng-click="setOrderBy('clienti.nume')">Nume <i ng-class="sortClass('clienti.nume')"></i></label>
					<input type="text" ng-model="filters['clienti.nume']" ng-change="fetchData(1,filters)" placeholder="Cauta nume">
				</th>
				<th class="width-15 align-center">
					<label ng-click="setOrderBy('proprietati.nume')">Proprietate <i ng-class="sortClass('proprietati.nume')"></i></label>
					<select ng-model="filters['proprietati.id']" ng-change="chambersAvailability('Filters');fetchData(1,filters)">
						<option value="">Toate</option>
						<option ng-repeat="x in proprietati" value="{{x.id}}">{{x.nume}}</option>
					</select>
				</th>
				<th class="width-15 align-center">
					<label ng-click="setOrderBy('camere.numar')">Numar camera <i ng-class="sortClass('camere.numar')"></i></label>
					<select ng-model="filters['camere.numar']" ng-change="fetchData(1,filters)">
						<option value="">Toate</option>
						<option ng-repeat="x in camereAvailableFilters" value="{{x.numar}}">{{x.numar}}</option>
					</select>
				</th>
				<th class="width-15 align-center">
					<label>Oferte</label>
				</th>
				<th class="width-15 align-center">
					<label>Pret standard/noapte</label>
				</th>
				<th class="width-15 align-center">
					<label>Pret cu oferte/noapte</label>
				</th>
				<th class="width-15 align-center">
					<label>Pret standard total</label>
				</th>
				<th class="width-15 align-center">
					<label>Pret cu oferte total </label>
				</th>
				<th class="width-15 align-center">
					<label ng-click="setOrderBy('rezervari.data_inceput')">Data inceput <i ng-class="sortClass('rezervari.data_inceput')"></i></label>
					<input type="text" ng-model="filters['rezervari.data_inceput']" ng-change="fetchData(1,filters)" placeholder="Cauta data">
				</th>
				<th class="width-15 align-center">
					<label ng-click="setOrderBy('rezervari.data_sfarsit')">Data sfarsit <i ng-class="sortClass('rezervari.data_sfarsit')"></i></label>
					<input type="text" ng-model="filters['rezervari.data_sfarsit']" ng-change="fetchData(1,filters)" placeholder="Cauta data">
				</th>
				<th class="width-15 align-center">
					<label ng-click="setOrderBy('clienti.telefon')">Telefon <i ng-class="sortClass('clienti.telefon')"></i></label>
					<input type="text" ng-model="filters['clienti.telefon']" ng-change="fetchData(1,filters)" placeholder="Cauta telefon">
				</th>
				<th class="width-15 align-center">
					<label ng-click="setOrderBy('clienti.email')">Email <i ng-class="sortClass('clienti.email')"></i></label>
					<input type="text" ng-model="filters['clienti.email']" ng-change="fetchData(1,filters)" placeholder="Cauta email">
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
				<td class="width-15 align-center">{{record.nume_proprietate}}</td>
				<td class="width-15 align-center">{{record.numar_camera}}</td>
				<td class="width-15 align-center">{{record.oferte_camera}}</td>
				<td class="width-15 align-center">{{record.pret_standard}}</td>
				<td class="width-15 align-center">{{record.pret_oferta}}</td>
				<td class="width-15 align-center">{{record.pret_standard * record.numar_zile}}</td>
				<td class="width-15 align-center">{{record.pret_oferta * record.numar_zile}}</td>				
				<td class="width-15 align-center">{{record.data_inceput}}</td>
				<td class="width-15 align-center">{{record.data_sfarsit}}</td>
				<td class="width-15 align-center">{{record.telefon}}</td>
				<td class="width-15 align-center">{{record.email}}</td>
				<td class="align-center">
					
					<div class="actions">

						<a data-toggle="modal" data-target="#modifica-rezervare" ng-click="setChangeData(record)" href="#" title="Modifica rezervare">
						
							<button class="btn btn-success action-button">
								<i class="fas fa-pencil-alt"></i>
							</button>
						
						</a>

						<a data-toggle="modal" data-target="#sterge-rezervare" ng-click="setDeleteData(record)" href="#" title="Sterge rezervare">
						
							<button class="btn btn-danger action-button">
								<i class="fas fa-trash"></i>
							</button>
						
						</a>

					</div>

				</td>

			</tr>

		</table>

	</div>