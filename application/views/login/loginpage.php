
		<div class="container">

			<div class="login-box">

				<div class="row">

					<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4 custom-box">

						<form method="post" action="../login/try">

							<div class="logo">
								<h1><i class="fas fa-home"></i> DistrictGest</h1>
							</div>

							<div class="input-group">
								<label for="username">Utilizator:</label>
								<input type="text" name="username" placeholder="Nume de utilizator" class="text-input">
							</div>

							<div class="input-group">
								<label for="password">Parola:</label>
								<input type="password" name="password" placeholder="Parola" class="text-input">
							</div>

							<?php if (!empty($error)) : ?>
								<p class="error"><i class="fas fa-exclamation-triangle"></i> <?php echo $error;?></p>
							<?php endif; ?>

							<input type="submit" value="Conecteaza-te" class="btn btn-primary btn-custom">

						</form>

					</div>

				</div>

			</div>

		</div>

	</div>

</body>

</html>