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
                    <h1 class="col-md-12">Búsqueda avanzada</h1>
                </div>
            </div>
            <div class="panel-body postDesc">
                <form id="busqueda" class="form-horizontal col-xs-12 col-md-8 col-md-offset-2" action="javascript:buscar();" method="post" novalidate>

                    <div id="div-buscarPor" class="form-group">
                        <label class="control-label" for="buscarPor">Buscar por: </label>
                        <div>
                            <select class="form-control" id="buscarPor" name="buscarPor">
                                <option value="1">Alias de usuario</option> 
                                <option value="2">Título de la imagen</option> 
                                <option value="3">Tag de imágenes</option>
                            </select>
                        </div>
                    </div>

                    <div id="div-palabraClave" class="form-group">
                        <label class="control-label" for="palabraClave">Palabra clave: </label>
                        <div>
                            <input type="text" class="form-control" id="palabraClave" placeholder="Ejemplo: dragon" name="palabraClave"/>
                        </div>
                        <span id="err-palabraClave" class="help-inline text-danger hidden"></span>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-md-4 col-md-offset-4">
                            <button class="btn btn-warning btn-block" type="submit"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div id="panelResultado" class="panel panel-default hidden">

            <div class="panel-heading galHeader">
                <h2 class="galHeaderText">Usuarios</h2>
            </div>

            <div id="postDesc" class="panel-body">

                <div id="fila0" class="row">

                    <div id="avatar1" name="avatar1" class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                            <a href="usuarioIndex.php">
                                <img src="assets/img/avatar.png" alt="Demostración">
                            </a>
                            <div class="caption text-center">
                                <span>Usuario</span>
                            </div>
                        </div>
                    </div>

                    <div id="avatar2" name="avatar2" class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                            <a href="usuarioIndex.php">
                                <img src="assets/img/avatar.png" alt="Demostración">
                            </a>
                            <div class="caption text-center">
                                <span>Usuario</span>
                            </div>
                        </div>
                    </div>

                    <div id="iavatar" name="iavatar" class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                            <a href="usuarioIndex.php">
                                <img src="assets/img/avatar.png" alt="Demostración">
                            </a>
                            <div class="caption text-center">
                                <span>Usuario</span>
                            </div>
                        </div>
                    </div>

                    <div id="avatar4" name="avatar4" class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                            <a href="usuarioIndex.php">
                                <img src="assets/img/avatar.png" alt="Demostración">
                            </a>
                            <div class="caption text-center">
                                <span>Usuario</span>
                            </div>
                        </div>
                    </div>

                </div>

                <div id="fila1" class="row">

                    <div id="avatar5" name="avatar5" class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                            <a href="usuarioIndex.php">
                                <img src="assets/img/avatar.png" alt="Demostración">
                            </a>
                            <div class="caption text-center">
                                <span>Usuario</span>
                            </div>
                        </div>
                    </div>

                    <div id="avatar6" name="avatar6" class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                            <a href="usuarioIndex.php">
                                <img src="assets/img/avatar.png" alt="Demostración">
                            </a>
                            <div class="caption text-center">
                                <span>Usuario</span>
                            </div>
                        </div>
                    </div>

                    <div id="avatar7" name="avatar7" class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                            <a href="usuarioIndex.php">
                                <img src="assets/img/avatar.png" alt="Demostración">
                            </a>
                            <div class="caption text-center">
                                <span>Usuario</span>
                            </div>
                        </div>
                    </div>

                    <div id="avatar8" name="avatar8" class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                            <a href="usuarioIndex.php">
                                <img src="assets/img/avatar.png" alt="Demostración">
                            </a>
                            <div class="caption text-center">
                                <span>Usuario</span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="panel-footer postTags">
                <button class="btn btn-warning" name="btnVerMas" id="btnVerMas" onclick="verMas()"><span class="glyphicon glyphicon-plus-sign"></span> Ver mas</button>
            </div>

        </div><!--Fin Panel Galeria-->

    </div>
</body>

<?php
require_once ('footer.php');
?>

<script type="text/javascript" src="assets/js/userPage.js"></script>
<script>
    $('#busqueda').on('submit',function(event){
        var inputs = $('#busqueda input');
        event.preventDefault();
        if(validarInputs(inputs)){
            this.submit();
        }   
    });

    function buscar(){

        if($('#panelResultado').hasClass('hidden')){
            $('#panelResultado').removeClass('hidden');
        }

        switch($('option:selected').val()){
            case '1':
                $('.galHeader > h2').text('Resultado de usuarios');
                llenarSeguidores();
                break;

            case '2':
                $('.galHeader > h2').text('Resultado de imágenes por título');
                llenarGaleria();
                break;

            case '3':
                $('.galHeader > h2').text('Resultado de imágenes por tag');
                llenarGaleria();
                break;

            default:
                break;
        }
    }
</script>

</html>