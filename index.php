<!DOCTYPE html>
<html lang="es">
<head>
	<?php
		include 'header.php';
	?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>¡Bienvenido a Dragon art!</title>
	<link type="text/css" href="css/left.css" rel="stylesheet" />
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery.jcarousel.min.js"></script>
	<script type="text/javascript" src="js/jquery.pikachoose.min.js"></script>
	<script type="text/javascript" src="js/jquery.touchwipe.min.js"></script>
	<script language="javascript">
		$(document).ready(function (){
			$("#pikame").PikaChoose({carousel:true, carouselVertical:true});
		});
	</script>
</head>
<body>

	<div class="jumbotron text-center banner">
		<div class="container">
			<h1>Bienvenido a Dragon art</h1>
			<p>Dragon art es una comunidad para artistas donde pueden compartir sus trabajos.<br>
			¡Únete y comienza a explorar y compartir!</p>
		</div>
	</div>
	
	<div class="container">
		<section>
				<h2>Los más populares</h2>
				<div class="pikachoose">

					<ul id="pikame" class="jcarousel-skin-pika">
						<li>
							<a href="publicacionIndex.php"><img src="img/Imagen.png"/></a>
							<span>Silver Dragon por @Silverdragon94.</span>
						</li>
						<li>
							<a href="publicacionIndex.php"><img src="img/Imagen2.png"/></a>
							<span>Inflatable parade por @Silverdragon94</span>
						</li>
						<li>
							<a href="publicacionIndex.php"><img src="img/Imagen3.png"/></a>
							<span>Blue eyes toon dragon por @Dragonloco</span>
						</li>
						<li>
							<a href="publicacionIndex.php"><img src="img/Imagen4.jpg"/></a>
							<span>Plesiosaurus por @Bolt</span>
						</li>
						<li>
							<a href="publicacionIndex.php"><img src="img/Imagen5.png"/></a>
							<span>Gator nerd por @Eligecos</span>
						</li>
						<li>
							<a href="publicacionIndex.php"><img src="img/Imagen6.png"/></a>
							<span>Dino plush por @Silverdragon94</span>
						</li>
						<li>
							<a href="publicacionIndex.php"><img src="img/Imagen7.png"/></a>
							<span>Buff hyena por @Marchenko</span>
						</li>
						<li>
							<a href="publicacionIndex.php"><img src="img/Imagen8.png"/></a>
							<span>King koopa por @Teaselbone</span>
						</li>
						<li>
							<a href="publicacionIndex.php"><img src="img/Imagen9.png"/></a>
							<span>Licos aragon por @WizLicos</span>
						</li>
						<li>
							<a href="publicacionIndex.php"><img src="img/Imagen10.png"/></a>
							<span>Otter por @Maootter</span>
						</li>
					</ul>

				</div>
		</section>

		<section class="row">
			<div class="col-md-12">
				<h2>Los más recientes</h2>
				<p>
					Aquí pondremos la galería "Pikachoose" o alguna otra
				</p>
			</div>
		</section>
	</div>
</body>
	<?php
		include 'footer.php';
	?>
</html>
