<?php
require_once ('doctype.php');
?>

<body>

    <?php
    require_once ('header.php');
    ?>

    <div class="container main-pubIndex">
        <div class="panel panel-default">
            <div class="panel-heading postHeader">
                <div class="row">
                    <h1 class="col-md-12">Registrar usuario</h1>
                </div>
            </div>
            
            <div class="sociales col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-4">
                <a class="btn btn-block btn-social btn-facebook">
                    <span class="fa fa-facebook"></span> Regístrate con Facebook
                </a>

                <a class="btn btn-block btn-social btn-twitter">
                    <span class="fa fa-twitter"></span> Regístrate con Twitter
                </a>

                <a class="btn btn-block btn-social btn-google">
                    <span class="fa fa-google"></span> Regístrate sesión con Google+
                </a>
            </div>
            
            <div class="panel-body postDesc">
                <form id="registroUsr" name="registroUsr" class="form-horizontal col-xs-12 col-md-8 col-md-offset-2" action="javascript:alert( 'success!' );" method="post">

                    <div class="form-group">
                        <label for="nombre">Nombre: </label>
                        <div>
                            <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="alias">Alias: </label>
                        <div>
                            <input type="text" class="form-control" id="alias" placeholder="Alias" name="alias" />
                        </div>
                    </div>

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
                        <label for="passwordConfirmacion">Repetir contraseña: </label>
                        <div>
                            <input type="password" class="form-control" id="passwordConfirmacion" placeholder="Repetir contreseña" name="passwordConfirmacion" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-md-4 col-md-offset-4">
                            <button id="btnEnviar" name="btnEnviar" type="submit" class="btn btn-warning btn-block">
                                <span class="glyphicon glyphicon-send"></span> Enviar
                            </button>
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

<script>
    $('#registroUsr').submit(function(event){
        var inputs = $('#registroUsr input');
        if(!(validarInputs(inputs))){
            event.preventDefault();
        }   
    });
</script>

</html>