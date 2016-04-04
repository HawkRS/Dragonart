<?php
require_once 'doctype.php';
?>

<body>

    <?php
    require_once 'header.php';
    ?>

    <div class="container main-pubIndex">

        <section class="col-md-12">
            <div class="row margen">
                <figure>
                    <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                        <img class="center-block img-responsive" src="img/Imagen.png" alt="Imagen del post">
                    </div>
                </figure>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading postHeader">
                    <div class="row row-centered">
                        <figure>
                            <a href="usuarioIndex.php">
                                <img class="col-xs-12 col-sm-4 col-md-3 avatar col-centered" src="img/avatar.png" alt="avatar">
                            </a>
                        </figure>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <h2>Titulo de la imagen</h2>
                            <span>Fecha: 28/febrero/2016</span>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-3 pull-right offsetUp">
                            <input id="input-1" class="rating rating-loading" data-show-clear="false" data-show-caption="false" size="sm">
                            <button type="button" onclick="location.href='formularioImagen.php';" class="btn btn-warning btn-block">Editar información</button>
                            <button type="button" onclick="location.href='usuarioIndex.php';" class="btn btn-danger btn-block">Eliminar post</button>
                        </div>
                    </div>
                </div>

                <div class="panel-body postDesc">
                    <p>Descripción de la imagen: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat ex nesciunt cum ea excepturi praesentium officia iusto neque atque perspiciatis architecto doloremque expedita odit ducimus aliquam, vero dignissimos illum, aperiam!</p>
                </div>
                <div class="panel-footer postTags">
                    <a href="formularioBusqueda.php" class="label label-warning">silver</a>
                    <a href="formularioBusqueda.php" class="label label-warning">dragon</a>
                    <a href="formularioBusqueda.php" class="label label-warning">toon</a>
                    <a href="formularioBusqueda.php" class="label label-warning">nerd</a>
                </div>
            </div>
        </section>

        <section class="col-md-12">
            <form name="comentar" class="form-horizontal">
                <div class="form-group">
                    <label for="comentario" class="col-xs-12 col-md-8 col-md-offset-2">Escribe un comentario </label>
                </div>

                <div class="form-group">
                    <div class="col-xs-12 col-md-8 col-md-offset-2">
                        <textarea class="form-control" id="comentario" rows="5"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12 col-md-8 col-md-offset-2">
                        <button class="btn btn-warning">Subir comentario</button>
                    </div>
                </div>
            </form>
            
            <div class="col-md-8 col-md-offset-2">
                <article class="panel panel-default">
                    <div class="panel-heading postHeader">
                        <div class="row">
                            <figure>
                                <a href="usuarioIndex.php">
                                    <img class="col-md-3 avatar" src="img/avatar.png" alt="avatar">
                                </a>
                            </figure>
                            <div class="col-md-9">
                                <h2>Nombre de usuario</h2>
                                <span>Fecha: 28/febrero/2016</span>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body postComentario">
                        <p>Comentario: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit, aperiam soluta excepturi necessitatibus aspernatur, sequi error tempore dolores dicta eum quaerat, itaque beatae temporibus? Veritatis blanditiis adipisci, vitae maiores fuga?</p>
                    </div>
                </article>

                <article class="panel panel-default">
                    <div class="panel-heading postHeader">
                        <div class="row">
                            <figure>
                                <a href="usuarioIndex.php">
                                    <img class="col-md-3 avatar" src="img/avatar.png" alt="avatar">
                                </a>
                            </figure>
                            <div class="col-md-9">
                                <h2>Nombre de usuario</h2>
                                <span>Fecha: 28/febrero/2016</span>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body postComentario">
                        <p>Comentario: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit, aperiam soluta excepturi necessitatibus aspernatur, sequi error tempore dolores dicta eum quaerat, itaque beatae temporibus? Veritatis blanditiis adipisci, vitae maiores fuga?</p>
                    </div>
                </article>

                <article class="panel panel-default">
                    <div class="panel-heading postHeader">
                        <div class="row">
                            <figure>
                                <a href="usuarioIndex.php">
                                    <img class="col-md-3 avatar" src="img/avatar.png" alt="avatar">
                                </a>
                            </figure>
                            <div class="col-md-9">
                                <h2>Nombre de usuario</h2>
                                <span>Fecha: 28/febrero/2016</span>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body postComentario">
                        <p>Comentario: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit, aperiam soluta excepturi necessitatibus aspernatur, sequi error tempore dolores dicta eum quaerat, itaque beatae temporibus? Veritatis blanditiis adipisci, vitae maiores fuga?</p>
                    </div>
                </article>
            </div>

        </section>
    </div>
</body>

<?php
require_once 'footer.php';
?>

</html>