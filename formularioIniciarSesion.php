<?php
require_once ('doctype.php');
?>

<body>

    <?php
    require_once ('header.php');
    ?>

    <div class="container main-pubIndex">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading postHeader">
                    <div class="row">
                        <h1 class="col-md-12">Iniciar Sesión</h1>
                    </div>
                </div>

                <div class="panel-body postDesc">
                    <form id="inicioSesion" class="form-horizontal col-xs-12 col-md-12" action="javascript:alert( 'success!' );" method="post" novalidate>
                        <div id="div-correo" class="form-group">
                            <label class="control-label" for="correo">Correo: </label>
                            <div>
                                <input type="email" class="form-control" id="correo" placeholder="alguien@ejemplo.com" name="correo" />
                            </div>
                            <span id="err-correo" class="help-inline text-danger hidden"></span>
                        </div>

                        <div id="div-logPass" class="form-group">
                            <label class="control-label" for="password">Contraseña: </label>
                            <div>
                                <input type="password" class="form-control" id="logPass" placeholder="Contreseña" name="logPass" />
                            </div>
                            <span id="err-logPass" class="help-inline text-danger hidden"></span>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12 col-md-8 col-md-offset-2">
                                <button type="submit" class="btn btn-warning btn-block"><span class="glyphicon glyphicon-log-in"></span>  Iniciar sesión</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <span><small>¿Aún no estás registrado en Dragonart? <a href="formularioRegistrarUsuario.php">Regístrate ahora</a></small></span><br>
                            <span><small>¿Olvidaste tu contraseña? Recupérala <a href="formularioRecuperarContrasenaCorreo.php">aquí</a></small></span>
                        </div>
                    </form>                
                </div>

                <div class="sociales col-xs-12 col-md-8 col-md-offset-2">
                    <a class="btn btn-block btn-social btn-facebook">
                        <span class="fa fa-facebook"></span> Iniciar sesión con Facebook
                    </a>

                    <a class="btn btn-block btn-social btn-twitter">
                        <span class="fa fa-twitter"></span> Iniciar sesión con Twitter
                    </a>
                </div>
            </div>
        </div>
    </div>  
</body>

<?php
require_once ('footer.php');
?>

<script>
    $('#inicioSesion').on('submit',function(event){
        var inputs = $('#inicioSesion input');
        event.preventDefault();
        if(validarInputs(inputs)){
            this.submit();
        }   
    });
    $('#inicioSesion').submit(function(event){
        var inputs = $('#inicioSesion input');
        if(!(validarInputs(inputs))){
            event.preventDefault();
        }   
    });
</script>

</html>