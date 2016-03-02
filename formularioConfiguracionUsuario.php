<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        include ('header.php');
        ?>
        <meta charset="UTF-8">
        <title>Modificar datos</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    </head>
    <body>
        <div class="container main">
            <div class="panel">
                <div class="panel-heading postHeader">
                    <div class="row">
                        <h1 class="col-md-12">Editar perfil</h1>
                    </div>
                </div>
                <div class="panel-body postDesc">
                    <form class="form-horizontal" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="nombre" class="col-xs-12 col-md-8 col-md-offset-2">Nombre: </label>
                            <div class="col-xs-12 col-md-8 col-md-offset-2">
                                <input type="text" class="form-control" id="nombre" placeholder="Nombre" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alias" class="col-xs-12 col-md-8 col-md-offset-2">Alias: </label>
                            <div class="col-xs-12 col-md-8 col-md-offset-2">
                                <input type="text" class="form-control" id="alias" placeholder="Alias" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="correo" class="col-xs-12 col-md-8 col-md-offset-2">Correo: </label>
                            <div class="col-xs-12 col-md-8 col-md-offset-2">
                                <input type="email" class="form-control" id="correo" placeholder="micorreo@miservidor.com" disabled />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-xs-12 col-md-8 col-md-offset-2">Contraseña: </label>
                            <div class="col-xs-12 col-md-8 col-md-offset-2">
                                <input type="password" class="form-control" id="password" placeholder="Contreseña" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="passwordConfirmacion" class="col-xs-12 col-md-8 col-md-offset-2">Repetir contraseña: </label>
                            <div class="col-xs-12 col-md-8 col-md-offset-2">
                                <input type="password" class="form-control" id="passwordConfirmacion" placeholder="Repetir contreseña" />
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="biografia" class="col-xs-12 col-md-8 col-md-offset-2">Biografía: </label>
                            <div class="col-xs-12 col-md-8 col-md-offset-2">
                                <textarea class="form-control" id="biografia" rows="5"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="avatar" class="col-xs-12 col-md-8 col-md-offset-2">Avatar: </label>
                            <div class="col-xs-12 col-md-4 col-md-offset-3">
                                <input type="file" name="filename" class="form-control" id="avatar" accept="image/gif, image/jpeg, image/png, image/jpg" onchange="readURL(this);">
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <img id="blah" src="#" alt="Avatar" width="100" height="100" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12 col-md-4 col-md-offset-4">
                                <button class="btn btn-warning btn-block">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>    
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/avatar.js"></script>
    </body>
    <?php
    include ('footer.php');
    ?>
</html>