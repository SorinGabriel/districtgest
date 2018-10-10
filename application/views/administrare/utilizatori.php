
	<span ng-init="
	data=<?php echo htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8');?>;
	total=<?php echo htmlspecialchars(json_encode($total), ENT_QUOTES, 'UTF-8');?>;
	user=<?php echo htmlspecialchars(json_encode($user), ENT_QUOTES, 'UTF-8');?>"></span>

	<div class="container-fluid container-table" ng-controller="utilizatori">

		<div class="buttons">
			<h3><i class="fas fa-cogs"></i> Administrare / <i class="fas fa-users"></i> Utilizatori</h3>
			<a data-toggle="modal" data-target="#adauga-utilizator" class="btn btn-primary btn-lg btn-custom"><i class="fas fa-plus"></i> Adauga utilizator</a>
		</div>

		<table class="data-table">

			<tr>

				<th class="width-25 align-center">
					<label ng-click="setOrderBy('utilizatori.utilizator')">Utilizator <i ng-class="sortClass('utilizatori.utilizator')"></i></label>
					<input type="text" ng-model="filters['utilizatori.utilizator']" ng-change="fetchData(1,filters)" placeholder="Cauta utilizator">
				</th>
				<th class="width-25 align-center">
					<label ng-click="setOrderBy('utilizatori.adresa_mail')">Adresa Mail <i ng-class="sortClass('utilizatori.adresa_mail')"></i></label>
					<input type="text" ng-model="filters['utilizatori.adresa_mail']" ng-change="fetchData(1,filters)" placeholder="Cauta mail">
				</th>
				<th class="width-25 align-center">
					<label ng-click="setOrderBy('utilizatori.numar_telefon')">Numar Telefon <i ng-class="sortClass('utilizatori.numar_telefon')"></i></label>
					<input type="text" ng-model="filters['utilizatori.numar_telefon']" ng-change="fetchData(1,filters)" placeholder="Cauta telefon">
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

				<td class="width-25 align-center"><i class="fab fa-jenkins" ng-show="record.owner == 1" title="Proprietar"></i> {{record.utilizator}}</td>
				<td class="width-25 align-center">{{record.adresa_mail}}</td>
				<td class="width-25 align-center">{{record.numar_telefon}}</td>
				<td class="align-center">
					
					<div class="actions">

						<a data-toggle="modal" data-target="#drepturi-utilizator" ng-hide="record.utilizator == user.utilizator || record.owner == 1" ng-click="setAccessData(record)" href="#" title="Drepturi Utilizator">
						
							<button class="btn btn-info action-button">
								<i class="fab fa-expeditedssl"></i>
							</button>
						
						</a>

						<a data-toggle="modal" data-target="#modifica-utilizator" ng-hide="record.utilizator != user.utilizator && record.owner == 1" ng-click="setChangeData(record)" href="#" title="Modifica Utilizator">
						
							<button class="btn btn-success action-button">
								<i class="fas fa-pencil-alt"></i>
							</button>
						
						</a>

						<a data-toggle="modal" data-target="#sterge-utilizator" ng-hide="(record.utilizator == user.utilizator && record.owner == 1) || record.owner == 1" ng-click="setDeleteData(record)" href="#" title="Sterge Utilizator">
						
							<button class="btn btn-danger action-button">
								<i class="fas fa-trash"></i>
							</button>
						
						</a>

					</div>

				</td>

			</tr>

		</table>

	</div>