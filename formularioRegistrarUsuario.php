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
            <div class="panel-body postDesc">
                <form class="form-horizontal">

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
                            <input type="email" class="form-control" id="correo" placeholder="Correo" />
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
                        <div class="col-xs-12 col-md-4 col-md-offset-4">
                            <button class="btn btn-warning btn-block">Enviar</button>
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