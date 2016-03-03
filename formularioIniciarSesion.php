<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        include ('header.php');
        ?>
        <meta charset="UTF-8">
        <title>Iniciar Sesión</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    </head>
    <body>
        <div class="container main-pubIndex">
            <div class="panel col-md-6 col-md-offset-3">
                <div class="panel-heading postHeader">
                    <div class="row">
                        <h1 class="col-md-12">Iniciar Sesión</h1>
                    </div>
                </div>
                <div class="panel-body postDesc">
                    <form class="form-horizontal">

                        <div class="form-group">
                            <label for="correo" class="col-xs-12 col-md-8 col-md-offset-2">Correo: </label>
                            <div class="col-xs-12 col-md-8 col-md-offset-2">
                                <input type="email" class="form-control" id="correo" placeholder="micuenta@ejemplo.com" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-xs-12 col-md-8 col-md-offset-2">Contraseña: </label>
                            <div class="col-xs-12 col-md-8 col-md-offset-2">
                                <input type="password" class="form-control" id="password" placeholder="Contreseña" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12 col-md-8 col-md-offset-2">
                                <button class="btn btn-warning btn-block">Iniciar sesión</button>
                            </div>
                        </div>
                    </form>
                    <span><small><br>¿Aún no estás registrado en Dragonart? <a>Registrate ahora</a></small></span><br>
                    <span><small>¿Olvidaste tu contraseña? Recupérala <a>aquí</a></small></span>
                </div>
            </div>
        </div>  
    </body>
    <?php
    include ('footer.php');
    ?>
</html>