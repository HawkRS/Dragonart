<header>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">

                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menuHeader">
                    <span class="sr-only">Menú</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand text-hide logo" href="index.php">
                    Dragon art
                    <figure>
                        <img class="img-responsive logoImagen" src="img/logo.gif" alt="logotipo Dragon art">
                    </figure>
                </a>

            </div>

            <div class="collapse navbar-collapse" id="menuHeader">
                
                <form class="navbar-form navbar-left" action="" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                </form>

                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="formularioRegistrarUsuario.php">Regístrate</a>
                    </li>
                    <li>
                        <a href="formularioIniciarSesion.php">Iniciar sesión</a>
                    </li>
                    <li class="active">
                        <a href="formularioImagen.php">Subir imagen</a>
                    </li>
                    <li class="dropdown">

                        <a href="#" data-toggle="dropdown" role="button">
                            Nombre de usuario<span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu submenu">
                            <li>
                                <a href="usuarioIndex.php">Página de usuario</a>
                            </li>
                            <li>
                                <a href="notificaciones.php">Notificaciones</a>
                            </li>
                            <li>
                                <a href="formularioConfiguracionUsuario.php">Editar perfil</a>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="index.php">Cerrar sesión</a>
                            </li>
                        </ul>

                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/star-rating.js"></script>
</header>