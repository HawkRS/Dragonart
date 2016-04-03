<?php
require_once ('doctype.php');
?>

<body>

    <?php
    require_once ('header.php');
    ?>

    <div class="container main-pubIndex">
        <div class="col-md-6 col-md-offset-3 panel-default">
            <div class="panel-heading postHeader">
                <div class="row">
                    <h1 class="col-md-12">Iniciar Sesión</h1>
                </div>
            </div>
            <div class="panel-body postDesc">
                <form class="form-horizontal col-xs-12 col-md-12">

                    <div class="form-group">
                        <label for="correo">Correo: </label>
                        <div>
                            <input type="email" class="form-control" id="correo" placeholder="alguien@ejemplo.com" name="correo" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña: </label>
                        <div>
                            <input type="password" class="form-control" id="password" placeholder="Contreseña" name="password" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-md-8 col-md-offset-2">
                            <button type="submit" onclick="location.href='usuarioIndex.php';" class="btn btn-warning btn-block">Iniciar sesión</button>
                        </div>
                    </div>
                </form>
                <span><small><br>¿Aún no estás registrado en Dragonart? <a href="formularioRegistrarUsuario.php">Regístrate ahora</a></small></span><br>
                <span><small>¿Olvidaste tu contraseña? Recupérala <a href="formularioRecuperarContrasenaCorreo.php">aquí</a></small></span>
            </div>
            
        </div>
    </div>  
</body>

<?php
require_once ('footer.php');
?>

</html>