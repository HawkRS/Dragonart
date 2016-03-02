<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<?php
		include 'header.php';
	?>
	<title>Página de usuario</title>
</head>
<body>
	<div class="container warp">
		<div class="main main-usrIndex">
			<div class="col-md-4">
				
				<div class="panel">
					<div class="panel-header usrHeader">
						<picture>
							<img class="center-block avatar" src="img/avatar.png" alt="Nombre de usuario">
						</picture>

						<section class="text-center">
							<h1>Nombre de usuario</h1>
							<button class="btn btn-warning btn-lg btn-block" name="seguir" id="seguir">+Seguir</button>
						</section>
					</div>

					<div class="panel-body postDesc">
						<p>
							Descripción del usuario: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis beatae excepturi minus incidunt, sequi odio ut veniam officia ea architecto qui sint nostrum inventore labore iure natus, vel dolor ullam.
						</p>
					</div>

					<div class="panel-footer postTags">
						<span>Registrado desde: 28/feb/2016</span>
						<br>
						<span>Imágenes publicadas: 123</span>
					</div>
				</div>
				
				<div class="panel">
					<div class="panel-header galHeader">
						<h2 class="galHeaderText">Seguidores</h2>
					</div>

					<div class="panel-body postDesc">

						<div class="row">

							<div class="col-sm-6 col-md-3">
								<div class="thumbnail">
									<a href="publicacionIndex.php">
										<img src="img/avatar.png" alt="Demostración">
									</a>
								</div>
							</div>

							<div class="col-sm-6 col-md-3">
								<div class="thumbnail">
									<a href="publicacionIndex.php">
										<img src="img/avatar.png" alt="Demostración">
									</a>
								</div>
							</div>

							<div class="col-sm-6 col-md-3">
								<div class="thumbnail">
									<a href="publicacionIndex.php">
										<img src="img/avatar.png" alt="Demostración">
									</a>
								</div>
							</div>

							<div class="col-sm-6 col-md-3">
								<div class="thumbnail">
									<a href="publicacionIndex.php">
										<img src="img/avatar.png" alt="Demostración">
									</a>
								</div>
							</div>

						</div>

					</div>

					<div class="panel-footer postTags">
						<button class="btn btn-warning" name="seguidores" id="seguidores">Ver mas</button>
					</div>
				</div>

				<div class="panel">
					<div class="panel-header galHeader">
						<h2 class="galHeaderText">Siguiendo</h2>
					</div>

					<div class="panel-body postDesc">

						<div class="row">

							<div class="col-sm-6 col-md-3">
								<div class="thumbnail">
									<a href="publicacionIndex.php">
										<img src="img/avatar.png" alt="Demostración">
									</a>
								</div>
							</div>

							<div class="col-sm-6 col-md-3">
								<div class="thumbnail">
									<a href="publicacionIndex.php">
										<img src="img/avatar.png" alt="Demostración">
									</a>
								</div>
							</div>

							<div class="col-sm-6 col-md-3">
								<div class="thumbnail">
									<a href="publicacionIndex.php">
										<img src="img/avatar.png" alt="Demostración">
									</a>
								</div>
							</div>

							<div class="col-sm-6 col-md-3">
								<div class="thumbnail">
									<a href="publicacionIndex.php">
										<img src="img/avatar.png" alt="Demostración">
									</a>
								</div>
							</div>

						</div>

					</div>

					<div class="panel-footer postTags">
						<button class="btn btn-warning" name="seguidores" id="seguidores">Ver mas</button>
					</div>
				</div>

			</div>

			<div class="col-md-8">

				<div class="panel">

					<div class="panel-header galHeader">
						<h2 class="galHeaderText">Galería</h2>
					</div>

					<div class="panel-body postDesc">

						<div class="row">

							<div class="col-sm-6 col-md-3">
								<div class="thumbnail">
									<a href="publicacionIndex.php">
										<img src="img/Imagen.png" alt="Demostración">
									</a>
								<div class="caption">
									<h3>Título de la imagen</h3>
									<button class="btn btn-warning btn-block" name="favorito" id="favorito">+Favorito</button>
								</div>
								</div>
							</div>
							
							<div class="col-sm-6 col-md-3">
								<div class="thumbnail">
									<img src="img/Imagen4.jpg" alt="Demostración">
								<div class="caption">
									<h3>Título de la imagen</h3>
									<button class="btn btn-warning btn-block" name="favorito" id="favorito">+Favorito</button>
								</div>
								</div>
							</div>

							<div class="col-sm-6 col-md-3">
								<div class="thumbnail">
									<img src="img/Imagen8.png" alt="Demostración">
								<div class="caption">
									<h3>Título de la imagen</h3>
									<button class="btn btn-warning btn-block" name="favorito" id="favorito">+Favorito</button>
								</div>
								</div>
							</div>

							<div class="col-sm-6 col-md-3">
								<div class="thumbnail">
									<img src="img/Imagen7.png" alt="Demostración">
								<div class="caption">
									<h3>Título de la imagen</h3>
									<button class="btn btn-warning btn-block" name="favorito" id="favorito">+Favorito</button>
								</div>
								</div>
							</div>

						</div>

					</div>

					<div class="panel-footer postTags">
						<a href="galeria.php" class="btn btn-warning">Ver mas</a>
					</div>

				</div>
				
				<div class="panel">

					<div class="panel-header galHeader">
						<h2 class="galHeaderText">Favoritos</h2>
					</div>

					<div class="panel-body postDesc">
						
						<div class="row">

							<div class="col-sm-6 col-md-3">
								<div class="thumbnail">
									<img src="img/Imagen2.png" alt="Demostración">
								<div class="caption">
									<h3>Título de la imagen</h3>
									<button class="btn btn-warning btn-block" name="favorito" id="favorito">+Favorito</button>
								</div>
								</div>
							</div>
							
							<div class="col-sm-6 col-md-3">
								<div class="thumbnail">
									<img src="img/Imagen3.png" alt="Demostración">
								<div class="caption">
									<h3>Título de la imagen</h3>
									<button class="btn btn-warning btn-block" name="favorito" id="favorito">+Favorito</button>
								</div>
								</div>
							</div>

							<div class="col-sm-6 col-md-3">
								<div class="thumbnail">
									<img src="img/Imagen10.png" alt="Demostración">
								<div class="caption">
									<h3>Título de la imagen</h3>
									<button class="btn btn-warning btn-block" name="favorito" id="favorito">+Favorito</button>
								</div>
								</div>
							</div>

							<div class="col-sm-6 col-md-3">
								<div class="thumbnail">
									<img src="img/Imagen5.png" alt="Demostración">
								<div class="caption">
									<h3>Título de la imagen</h3>
									<button class="btn btn-warning btn-block" name="favorito" id="favorito">+Favorito</button>
								</div>
								</div>
							</div>

						</div>

					</div>

					<div class="panel-footer postTags">
						<a href="galeria.php" class="btn btn-warning">Ver mas</a>
					</div>

				</div>

			</div>
		</div>
	</div>
</body>
	<?php 
		include 'footer.php';
	 ?>
</html>