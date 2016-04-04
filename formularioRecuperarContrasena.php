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
                    <h1 class="col-md-12">Nueva contraseña</h1>
                </div>
            </div>
            <div class="panel-body postDesc">
                <p>Ingresa tu nueva contraseña</p>
                <form class="form-horizontal col-xs-12 col-md-8 col-md-offset-2" action="" method="post">

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
                        <div class="col-xs-12 col-md-8 col-md-offset-2">
                            <button type="submit" onclick="location.href='usuarioIndex.php';" class="btn btn-warning btn-block">Aceptar</button>
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