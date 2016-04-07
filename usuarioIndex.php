<?php
require_once 'doctype.php';
?>

<body>

    <?php
    require_once 'header.php';
    ?>

    <div id="wrapper" class="main-otro">
        <aside id="sidebar-wrapper">
            <nav>
                <ul class="sidebar-nav">
                    <figure>
                        <picture>
                            <img class="center-block avatar" src="img/avatar.png" alt="Nombre de usuario">
                        </picture>
                    </figure>
                    <h2 class="text-center blanco">Nombre de usuario</h2>
                    <div class="col-xs-12">
                        <button class="btn btn-warning btn-lg btn-block" name="seguir" id="seguir"><span class="glyphicon glyphicon-plus-sign"></span> Seguir</button>
                        <button class="btn btn-danger btn-lg btn-block" name="seguir" id="seguir"><span class="glyphicon glyphicon-remove-sign"></span> Bloquear usuario</button>
                        <p class="extra-space text-justify blanco">
                            Descripción del usuario: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis beatae excepturi minus incidunt, sequi odio ut veniam officia ea architecto qui sint nostrum inventore labore iure natus, vel dolor ullam.
                        </p>
                    </div>
                </ul>
            </nav>
        </aside>

        <section id="page-content-wrapper">
            <div class="container-fluid">
                <div class="extra-space">
                    <a href="#menu-toggle" class="btn btn-warning" id="menu-toggle"><i class="glyphicon glyphicon-chevron-left"></i></a>
                </div>
                <div class="extra-space">
                    <div class="panel panel-default">

                        <div class="panel-heading galHeader">
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
                            <button class="btn btn-warning" name="seguidores" id="seguidores"><span class="glyphicon glyphicon-plus-sign"></span> Ver mas</button>
                        </div>

                    </div>
                </div>

                <div class="panel panel-default">

                    <div class="panel-heading galHeader">
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
                        <button class="btn btn-warning" name="seguidores" id="seguidores"><span class="glyphicon glyphicon-plus-sign"></span> Ver mas</button>
                    </div>

                </div>
                <div class="panel panel-default">
                    <div class="panel-heading galHeader">
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
                        <button class="btn btn-warning" name="seguidores" id="seguidores"><span class="glyphicon glyphicon-plus-sign"></span> Ver mas</button>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading galHeader">
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
                        <button class="btn btn-warning" name="seguidores" id="seguidores"><span class="glyphicon glyphicon-plus-sign"></span> Ver mas</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

<?php
require_once 'footer.php';
?>

<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>

</html>