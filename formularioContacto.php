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
                    <h1 class="col-md-12">Comunícate con nosotros</h1>
                </div>
            </div>
            <div class="panel-body postDesc">
                <p class="text-center">Envíanos un correo con tus dudas, quejas, aclaraciones o sugerencias.<br>Nos pondremos en contacto contigo para ayudarte.</p><br>

                <form class="form-horizontal col-xs-12 col-md-8 col-md-offset-2" action="" method="post">

                    <div class="form-group">
                        <label for="nombre">Nombre: </label>
                        <div>
                            <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="correo" >Correo: </label>
                        <div>
                            <input type="email" class="form-control" id="correo" placeholder="alguien@ejemplo.com" name="correo" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción: </label>
                        <div>
                            <textarea class="form-control" id="descripcion" rows="5" name="descripcion" placeholder="Escríbenos tus comentarios..."></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-md-4 col-md-offset-4">
                            <button class="btn btn-warning btn-block" type="submit"><span class="glyphicon glyphicon-send"></span> Enviar</button>
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