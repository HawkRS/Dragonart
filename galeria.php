<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<?php
		include 'header.php';
		include 'footer.php';
	?>
	<title>Galería de usuario</title>
</head>
<body>
	<div>
		<div>
			<p>Aquí va el baner de usuario</p>
		</div>

		<div>
			<picture>
				<img src="img/avatar.png" alt="Nombre de usuario">
			</picture>

			<section>
				<h1>Nombre de usuario</h1>
				<span>Galería principal o favoritos</span>
				<button name="seguir" id="seguir">+Seguir</button>
			</section>

			<section>
				<picture>
					<img src="img/prueba.png" alt="Imágen de prueba">
				</picture>
				<span>Título de la imágen</span>

				<picture>
					<img src="img/prueba.png" alt="Imágen de prueba">
				</picture>
				<span>Título de la imágen</span>

				<picture>
					<img src="img/prueba.png" alt="Imágen de prueba">
				</picture>
				<span>Título de la imágen</span>

				<picture>
					<img src="img/prueba.png" alt="Imágen de prueba">
				</picture>
				<span>Título de la imágen</span>

				<picture>
					<img src="img/prueba.png" alt="Imágen de prueba">
				</picture>
				<span>Título de la imágen</span>
			</section>

			<section>
				<button>Anterior</button>
				<button>Siguiente</button>
			</section>
		</div>
	</div>
</body>
</html>