<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        include ('header.php');
        ?>
        <meta charset="UTF-8">
        <title>Nueva contraseña</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    </head>
    <body>
        <div class="container main">
            <div class="panel col-md-6 col-md-offset-3">
                <div class="panel-heading postHeader">
                    <div class="row">
                        <h1 class="col-md-12">Nueva contraseña</h1>
                    </div>
                </div>
                <div class="panel-body postDesc">
                   <p>Ingresa tu nueva contraseña</p>
                    <form class="form-horizontal">

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
                            <div class="col-xs-12 col-md-8 col-md-offset-2">
                                <button class="btn btn-warning btn-block">Aceptar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>  
    </body>
    <?php
    include ('footer.php');
    ?>
</html>