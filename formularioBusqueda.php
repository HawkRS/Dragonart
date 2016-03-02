<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        include ('header.php');
        ?>
        <meta charset="UTF-8">
        <title>Búsqueda avanzada</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    </head>
    <body>
        <div class="container main">
            <div class="panel">
                <div class="panel-heading postHeader">
                    <div class="row">
                        <h1 class="col-md-12">Búsqueda avanzada</h1>
                    </div>
                </div>
                <div class="panel-body postDesc">
                    <form class="form-horizontal">

                        <div class="form-group">
                            <label for="buscarPor" class="col-xs-12 col-md-8 col-md-offset-2">Buscar por: </label>
                            <div class="col-xs-12 col-md-8 col-md-offset-2">
                                <select class="form-control" id="buscarPor" name="buscarPor">
                                    <option value="1">Alias de usuario</option> 
                                    <option value="2">Título de la imagen</option> 
                                    <option value="3">Tag de imágenes</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="palabraClave" class="col-xs-12 col-md-8 col-md-offset-2">Palabra clave: </label>
                            <div class="col-xs-12 col-md-8 col-md-offset-2">
                                <input type="text" class="form-control" id="palabraClave" placeholder="Ejemplo: dragon" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12 col-md-4 col-md-offset-4">
                                <button class="btn btn-warning btn-block">Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>   
    </body>
    <?php
    include ('footer.php');
    ?>
</html>