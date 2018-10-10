
	<span ng-init="
	data=<?php echo htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8');?>;
	total=<?php echo htmlspecialchars(json_encode($total), ENT_QUOTES, 'UTF-8');?>;
	user=<?php echo htmlspecialchars(json_encode($user), ENT_QUOTES, 'UTF-8');?>"></span>

	<div class="container-fluid container-table" ng-controller="clienti">

		<div class="buttons">
			<h3><i class="far fa-calendar-alt"></i>  Rezervari / <i class="fas fa-user"></i> Clienti</h3>
			<a data-toggle="modal" data-target="#adauga-client" class="btn btn-primary btn-lg btn-custom"><i class="fas fa-plus"></i> Adauga client</a>
		</div>

		<table class="data-table">

			<tr>

				<th class="width-15 align-center">
					<label ng-click="setOrderBy('clienti.nume')">Nume <i ng-class="sortClass('clienti.nume')"></i></label>
					<input type="text" ng-model="filters['clineit.nume']" ng-change="fetchData(1,filters)" placeholder="Cauta nume">
				</th>
				<th class="width-15 align-center">
					<label ng-click="setOrderBy('clienti.email')">Email <i ng-class="sortClass('clienti.email')"></i></label>
					<input type="text" ng-model="filters['clienti.email']" ng-change="fetchData(1,filters)" placeholder="Cauta email">
				</th>
				<th class="width-15 align-center">
					<label ng-click="setOrderBy('clienti.telefon')">Telefon <i ng-class="sortClass('clienti.telefon')"></i></label>
					<input type="text" ng-model="filters['clienti.telefon']" ng-change="fetchData(1,filters)" placeholder="Cauta telefon">
				</th>
				<th class="width-15 align-center">
					<label ng-click="setOrderBy('clienti.detalii')">Detalii <i ng-class="sortClass('clienti.detalii')"></i></label>
					<input type="text" ng-model="filters['clienti.detalii']" ng-change="fetchData(1,filters)" placeholder="Cauta detalii">
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
				<td class="width-15 align-center">{{record.email}}</td>
				<td class="width-15 align-center">{{record.telefon}}</td>
				<td class="width-15 align-center">{{record.detalii}}</td>
				<td class="align-center">
					
					<div class="actions">

						<a data-toggle="modal" data-target="#modifica-client" ng-click="setChangeData(record)" href="#" title="Modifica client">
						
							<button class="btn btn-success action-button">
								<i class="fas fa-pencil-alt"></i>
							</button>
						
						</a>

						<a data-toggle="modal" data-target="#sterge-client" ng-click="setDeleteData(record)" href="#" title="Sterge client">
						
							<button class="btn btn-danger action-button">
								<i class="fas fa-trash"></i>
							</button>
						
						</a>

					</div>

				</td>

			</tr>

		</table>

	</div>