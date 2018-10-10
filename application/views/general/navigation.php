	
	<div class="container">

		<div class="row">

			<div class="logo col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
				<h1><i class="fas fa-home"></i> DistrictGest</h1>
			</div>

		</div>

	</div>

	<div class="container-fluid">

		<nav class="navbar navbar-default navbar-custom">

		  	<div class="container-fluid">

			    <div class="navbar-header">

			      	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span> 
			      	</button>

			    </div>

			    <div class="collapse navbar-collapse" id="navbar">

			      	<ul class="nav navbar-nav">

				        <li><a href="../homepage"><i class="fas fa-home"></i> Prima pagina</a></li>
				      	<li class="dropdown">

					        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fas fa-bed"></i> Camere<span class="caret"></span></a>

					        <ul class="dropdown-menu">
					          <li><a href="../camere/index"><i class="fas fa-bed"></i> Lista Camere</a></li>
					          <li><a href="../camere/oferte"><i class="fas fa-tag"></i> Oferte</a></li>
					        </ul>

					    </li>
				      	<li class="dropdown">

					        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="far fa-calendar-alt"></i> Rezervari<span class="caret"></span></a>

					        <ul class="dropdown-menu">
					          <li><a href="../rezervari/index"><i class="far fa-calendar-alt"></i> Lista Rezervari</a></li>
					          <li><a href="../rezervari/clienti"><i class="fas fa-user"></i> Clienti</a></li>
					        </ul>

					    </li>
				      	<li class="dropdown">

					        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="far fa-id-badge"></i> Personal<span class="caret"></span></a>

					        <ul class="dropdown-menu">
					          <li><a href="#">Page 1-1</a></li>
					          <li><a href="#">Page 1-2</a></li>
					          <li><a href="#">Page 1-3</a></li>
					        </ul>

					    </li>				      	<li class="dropdown">

					        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fas fa-archive"></i> Inventar<span class="caret"></span></a>

					        <ul class="dropdown-menu">
					          <li><a href="#">Page 1-1</a></li>
					          <li><a href="#">Page 1-2</a></li>
					          <li><a href="#">Page 1-3</a></li>
					        </ul>

					    </li>
				      	<li class="dropdown">

					        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fas fa-dollar-sign"></i> Financiar<span class="caret"></span></a>

					        <ul class="dropdown-menu">
					          <li><a href="#">Page 1-1</a></li>
					          <li><a href="#">Page 1-2</a></li>
					          <li><a href="#">Page 1-3</a></li>
					        </ul>

					    </li>
				      	<li class="dropdown">

					        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fas fa-chart-line"></i> Rapoarte<span class="caret"></span></a>

					        <ul class="dropdown-menu">
					          <li><a href="#">Page 1-1</a></li>
					          <li><a href="#">Page 1-2</a></li>
					          <li><a href="#">Page 1-3</a></li>
					        </ul>

					    </li>
					    <?php if ($user->{"drept_administrare"} == 1) : ?>
				      	<li class="dropdown">

					        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fas fa-cogs"></i> Administrare<span class="caret"></span></a>

					        <ul class="dropdown-menu">
					          <li><a href="../administrare/proprietati"><i class="fas fa-building"></i> Proprietati</a></li>
					          <li><a href="../administrare/utilizatori"><i class="fas fa-users"></i> Utilizatori</a></li>
					        </ul>

					    </li>
					    <?php endif; ?>
				        <li><a href="../homepage/logout"><i class="fas fa-sign-out-alt"></i> Deconectare</a></li>

			      	</ul>

			    </div>

		  </div>

		</nav>

	</div>
