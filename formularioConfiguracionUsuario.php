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
                    <h1 class="col-md-12">Editar perfil</h1>
                </div>
            </div>
            
            <div class="panel-body postDesc">
                <form id="configUsuario" class="form-horizontal col-xs-12 col-md-8 col-md-offset-2" enctype="multipart/form-data" action="javascript:alert( 'success!' );" method="post" novalidate>

                    <div id="div-nombre" class="form-group">
                        <label class="control-label" for="nombre">Nombre: </label>
                        <div>
                            <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" />
                        </div>
                        <span id="err-nombre" class="help-inline text-danger hidden"></span>
                    </div>

                    <div id="div-alias" class="form-group">
                        <label class="control-label" for="alias">Alias: </label>
                        <div>
                            <input type="text" class="form-control" id="alias" placeholder="Alias" name="alias" />
                        </div>
                        <span id="err-alias" class="help-inline text-danger hidden"></span>
                    </div>

                    <div id="div-correo" class="form-group">
                        <label class="control-label" for="correo">Correo: </label>
                        <div>
                            <!--<input type="email" class="form-control" id="correo" placeholder="alguien@ejemplo.com" disabled name="correo" />-->
                            <input type="email" class="form-control" id="correo" placeholder="alguien@ejemplo.com" name="correo" />
                        </div>
                        <span id="err-correo" class="help-inline text-danger hidden"></span>
                    </div>

                    <div id="div-password" class="form-group">
                        <label class="control-label" for="password">Contraseña: </label>
                        <div>
                            <input type="password" class="form-control" id="password" placeholder="Contreseña" name="password" />
                        </div>
                        <span id="err-password" class="help-inline text-danger hidden"></span>
                    </div>

                    <div id="div-passwordConfirmacion" class="form-group">
                        <label class="control-label" for="passwordConfirmacion">Repetir contraseña: </label>
                        <div>
                            <input type="password" class="form-control" id="passwordConfirmacion" placeholder="Repetir contreseña" name="passwordConfirmacion" />
                        </div>
                        <span id="err-passwordConfirmacion" class="help-inline text-danger hidden"></span>
                    </div>

                    <div id="div-biografia" class="form-group">
                        <label class="control-label" for="biografia">Biografía: </label>
                        <div>
                            <textarea class="form-control col-xs-12 col-md-8" id="biografia" name="biografia"></textarea>
                        </div>
                        <span id="err-biografia" class="help-inline text-danger hidden"></span>
                    </div>

                    <div id="div-avatar" class="form-group">
                        <label class="control-label" for="avatar">Avatar: </label>
                        <div>
                           <input type="file" name="filename" id="avatar" accept="image/gif, image/jpeg, image/png, image/jpg" onchange="readURL(this);">
                        </div>
                        <span id="err-avatar" class="help-inline text-danger hidden"></span>
                    </div>
                    
                     <div class="form-group">
                        <div>
                            <img class="center-block" id="blah" src="#" alt="Avatar" width="100" height="100" />
                        </div>
                     </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-md-4 col-md-offset-2">
                            <button class="btn btn-warning btn-block" type="submit"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <button type="button" onclick="confirmarEliminacion();" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-remove-sign"></span> Eliminar cuenta</button>
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
    $('#configUsuario').on('submit',function(event){
        var inputs = $('#configUsuario input');
        var txtArea = $('#configUsuario textarea');
        var banderaInput = true;
        var banderaTxt = true;
        event.preventDefault();
        banderaInput = validarInputs(inputs);
        banderaTxt = validarTextArea(txtArea);
        if(banderaInput && banderaTxt){
            this.submit();
        }   
    });

    function confirmarEliminacion(){
        var eliminar = confirm('Está seguro de que quiere eliminar su cuenta? Todos sus datos serán eliminados.');
        if(eliminar){
            location.href = 'index.php';
        }
    }
</script>

</html>