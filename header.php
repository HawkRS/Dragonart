<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<header>
		<nav class="navbar colorNavbar navbar-fixed-top" role="navigation">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-ex1-collapse">
                    <span class="sr-only">Menú</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Dragon art</a>
            </div>

            <div class="collapse navbar-collapse" id="navbar-ex1-collapse">
                
                <form class="navbar-form navbar-left" action="" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" name="buscador" id="buscador" placeholder="Buscar">
                    </div>
                    <button type="submit" class="btn btn-warning">Buscar</button>
                </form>

    			<ul class="nav navbar-nav navbar-right">
                    <li class="activo">
                        <a href="#">Subir imágen</a>
                    </li>
    				<li class="dropdown">

    					<a href="#" data-toggle="dropdown" role="button">
                            Nombre de usuario<span class="caret"></span>
                        </a>

    					<ul class="dropdown-menu">
    						<li>
    							<a href="#">Página de usuario</a>
    						</li>
    						<li>
    							<a href="#">Notificaciones</a>
    						</li>
    						<li>
    							<a href="#">Opciones de usuario</a>
    						</li>
                            <li role="separator" class="divider"></li>
    						<li>
    							<a href="#">Cerrar sesión</a>
    						</li>
    					</ul>

    				</li>
    			</ul>

            </div>

		</nav>
	</header>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>