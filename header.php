<header>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">

                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menuHeader">
                    <span class="sr-only">Menú</span>
                    <span class="icon-bar blanco"></span>
                    <span class="icon-bar blanco"></span>
                    <span class="icon-bar blanco"></span>
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
                            <button class="btn btn-warning" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                </form>

                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="formularioRegistrarUsuario.php"><span class="glyphicon glyphicon-pencil"></span> Regístrate</a>
                    </li>
                    <li>
                        <a href="formularioIniciarSesion.php"><span class="glyphicon glyphicon-log-in"></span> Iniciar sesión</a>
                    </li>
                    <li class="active">
                        <a href="formularioImagen.php"><span class="glyphicon glyphicon-upload"></span> Subir imagen</a>
                    </li>
                    <li class="dropdown">

                        <a href="#" data-toggle="dropdown" role="button">
                            Nombre de usuario<span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu submenu">
                            <li>
                                <a href="usuarioIndex.php"><span class="glyphicon glyphicon-user"></span> Página de usuario</a>
                            </li>
                            <li>
                                <a href="notificaciones.php"><span class="glyphicon glyphicon-comment"></span> Notificaciones</a>
                            </li>
                            <li>
                                <a href="formularioConfiguracionUsuario.php"><span class="glyphicon glyphicon-edit"></span> Editar perfil</a>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="index.php"><span class="glyphicon glyphicon-log-out"></span> Cerrar sesión</a>
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