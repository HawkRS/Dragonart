<!DOCTYPE html>
<html lang="es">
    <head>
        <?php
            include 'header.php';
        ?>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

        <title>Imagen de usuario</title>
    </head>

    <body>
        <div class="container">

            <section class="col-md-12">
                <div class="row">
                    <figure>
                        <img class="center-block imagenPost" src="img/Imagen.png" alt="Imagen del post">
                    </figure>
                </div>
                <div class="text-center btnFavorito">
                    <button class="btn btn-warning">+Favorito</button>
                </div>

                <div class="panel">
                    <div class="panel-heading postHeader">
                        <div class="row row-centered">
                            <figure>
                                <img class="col-xs-12 col-sm-4 col-md-3 col-centered avatar" src="img/avatar.png" alt="avatar">
                            </figure>
                            <div class="col-xs-12 col-sm-4 col-md-6">
                                <h2>Titulo de la imágen</h2>
                                <span>Fecha: 28/febrero/2016</span>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-3 pull-right offsetUp">
                                <button class="btn btn-warning btn-block">Editar información</button>
                                <button class="btn btn-warning btn-block">Eliminar post</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel-body postDesc">
                        <p>Descripción de la imágen: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat ex nesciunt cum ea excepturi praesentium officia iusto neque atque perspiciatis architecto doloremque expedita odit ducimus aliquam, vero dignissimos illum, aperiam!</p>
                    </div>
                    <div class="panel-footer postTags">
                        <a href="#" class="label label-warning">silver</a>
                        <a href="#" class="label label-warning">dragon</a>
                        <a href="#" class="label label-warning">toon</a>
                        <a href="#" class="label label-warning">nerd</a>
                    </div>
                </div>

            </section>

            <section class="col-md-12">
               <form name="comentar" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="comentario" class="col-md-12">Escribe un comentario </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <textarea class="form-control" id="comentario"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-2">
                            <button>Subir comentario</button>
                        </div>
                    </div>
                </form>
                
                <article class="panel">
                    <div class="panel-heading postHeader">
                        <div class="row">
                            <figure>
                                <img class="col-md-3 avatar" src="img/avatar.png" alt="avatar">
                            </figure>
                            <div class="col-md-9">
                                <h2>Nombre de usuario</h2>
                                <span>Fecha: 28/febrero/2016</span>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body postDesc">
                        <p>Comentario: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit, aperiam soluta excepturi necessitatibus aspernatur, sequi error tempore dolores dicta eum quaerat, itaque beatae temporibus? Veritatis blanditiis adipisci, vitae maiores fuga?</p>
                    </div>
                    <div class="panel-footer postTags">
                        <button>Responder</button>
                    </div>
                </article>

                <article class="panel">
                    <div class="panel-heading postHeader">
                        <div class="row">
                            <figure>
                                <img class="col-md-3 avatar" src="img/avatar.png" alt="avatar">
                            </figure>
                            <div class="col-md-9">
                                <h2>Nombre de usuario</h2>
                                <span>Fecha: 28/febrero/2016</span>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body postDesc">
                        <p>Comentario: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit, aperiam soluta excepturi necessitatibus aspernatur, sequi error tempore dolores dicta eum quaerat, itaque beatae temporibus? Veritatis blanditiis adipisci, vitae maiores fuga?</p>
                    </div>
                    <div class="panel-footer postTags">
                        <button>Responder</button>
                    </div>
                </article>

                <article class="panel">
                    <div class="panel-heading postHeader">
                        <div class="row">
                            <figure>
                                <img class="col-md-3 avatar" src="img/avatar.png" alt="avatar">
                            </figure>
                            <div class="col-md-9">
                                <h2>Nombre de usuario</h2>
                                <span>Fecha: 28/febrero/2016</span>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body postDesc">
                        <p>Comentario: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit, aperiam soluta excepturi necessitatibus aspernatur, sequi error tempore dolores dicta eum quaerat, itaque beatae temporibus? Veritatis blanditiis adipisci, vitae maiores fuga?</p>
                    </div>
                    <div class="panel-footer postTags">
                        <button>Responder</button>
                    </div>
                </article>
            </section>
        </div>
    </body>

    <?php
        include 'footer.php';
    ?>

</html>