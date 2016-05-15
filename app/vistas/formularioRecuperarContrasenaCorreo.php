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
                    <h1 class="col-md-12">Recuperar contraseña</h1>
                </div>
            </div>
            <div class="panel-body postDesc">
                <p>Para restablecer tu contraseña, escribe el correo con el que te registraste.</p>
                <form id="recContrasena" class="form-horizontal col-xs-12 col-md-8 col-md-offset-2" action="javascript:alert( 'success!' );" method="post" novalidate>

                    <div id="div-correo" class="form-group">
                        <label class="control-label" for="correo">Correo: </label>
                        <div>
                            <input type="email" class="form-control" id="correo" placeholder="alguien@ejemplo.com" name="correo" />
                        </div>
                        <span id="err-correo" class="help-inline text-danger hidden"></span>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-md-8 col-md-offset-2">
                            <button type="submit" class="btn btn-warning btn-block" onclick="index.php?controlador=usuario&accion=recuperarcontrasena"><span class="glyphicon glyphicon-send"></span> Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>  
</body>

<?php
require_once ('footer.php');
?>

<script>
    $('#recContrasena').on('submit',function(event){
        var inputs = $('#recContrasena input');
        event.preventDefault();
        if(validarInputs(inputs)){
            this.submit();
        }   
    }); 
</script>

</html>