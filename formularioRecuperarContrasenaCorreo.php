<?php
require_once ('doctype.php');
?>

<body>

    <?php
    require_once ('header.php');
    ?>

    <div class="container main-pubIndex">
        <div class="panel-default col-md-6 col-md-offset-3">
            <div class="panel-heading postHeader">
                <div class="row">
                    <h1 class="col-md-12">Recuperar contraseña</h1>
                </div>
            </div>
            <div class="panel-body postDesc">
                <p>Para restablecer tu contraseña, escribe el correo con el que te registraste.</p>
                <form class="form-horizontal">

                    <div class="form-group">
                        <label for="correo" class="col-xs-12 col-md-8 col-md-offset-2">Correo: </label>
                        <div class="col-xs-12 col-md-8 col-md-offset-2">
                            <input type="email" class="form-control" id="correo" placeholder="alguien@ejemplo.com" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-md-8 col-md-offset-2">
                            <button type="button" onclick="location.href='formularioRecuperarContrasena.php';" class="btn btn-warning btn-block">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>  
</body>

<?php
require_once ('footer.php');
?>

</html>