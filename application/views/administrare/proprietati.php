
	<span ng-init="
	data=<?php echo htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8');?>;
	total=<?php echo htmlspecialchars(json_encode($total), ENT_QUOTES, 'UTF-8');?>;
	user=<?php echo htmlspecialchars(json_encode($user), ENT_QUOTES, 'UTF-8');?>;
	tipProprietati=<?php echo htmlspecialchars(json_encode($tipProprietati), ENT_QUOTES, 'UTF-8');?>"></span>

	<div class="container-fluid container-table" ng-controller="proprietati">

		<div class="buttons">
			<h3><i class="fas fa-cogs"></i> Administrare / <i class="fas fa-building"></i> Proprietati</h3>
			<a data-toggle="modal" data-target="#adauga-proprietate" class="btn btn-primary btn-lg btn-custom"><i class="fas fa-plus"></i> Adauga proprietate</a>
		</div>

		<table class="data-table">

			<tr>

				<th class="width-25 align-center">
					<label ng-click="setOrderBy('proprietati.nume')">Nume <i ng-class="sortClass('proprietati.nume')"></i></label>
					<input type="text" ng-model="filters['proprietati.nume']" ng-change="fetchData(1,filters)" placeholder="Cauta proprietate">
				</th>
				<th class="width-25 align-center">
					<label ng-click="setOrderBy('proprietati.adresa')">Adresa <i ng-class="sortClass('proprietati.adresa')"></i></label>
					<input type="text" ng-model="filters['proprietati.adresa']" ng-change="fetchData(1,filters)" placeholder="Cauta adresa">
				</th>
				<th class="width-25 align-center">
					<label ng-click="setOrderBy('proprietati.tip')">Tip <i ng-class="sortClass('proprietati.tip')"></i></label>
					<input type="text" ng-model="filters['tip-proprietati.nume']" ng-change="fetchData(1,filters)" placeholder="Cauta tip">
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

				<td class="width-25 align-center">{{record.nume}}</td>
				<td class="width-25 align-center">{{record.adresa}}</td>
				<td class="width-25 align-center">{{record.tip_nume}}</td>
				<td class="align-center">
					
					<div class="actions">

						<a data-toggle="modal" data-target="#modifica-proprietate" ng-click="setChangeData(record)" href="#" title="Modifica proprietate">
						
							<button class="btn btn-success action-button">
								<i class="fas fa-pencil-alt"></i>
							</button>
						
						</a>

						<a data-toggle="modal" data-target="#sterge-proprietate" ng-click="setDeleteData(record)" href="#" title="Sterge proprietate">
						
							<button class="btn btn-danger action-button">
								<i class="fas fa-trash"></i>
							</button>
						
						</a>

					</div>

				</td>

			</tr>

		</table>

	</div>