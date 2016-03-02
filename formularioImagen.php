<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        include ('header.php');
        ?>
        <meta charset="UTF-8">
        <title>Subir imagen</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    </head>
    <body>
        <div class="container main">
            <div class="panel">
                <div class="panel-heading postHeader">
                    <div class="row">
                        <h1 class="col-md-12">Subir imagen</h1>
                    </div>
                </div>
                <div class="panel-body postDesc">
                    <form class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="imagen" class="col-xs-12 col-md-8 col-md-offset-2">Seleccionar imagen: </label>
                            <div class="col-xs-12 col-md-8 col-md-offset-2">
                                <input type="file" name="filename" class="form-control" id="imagen" accept="image/gif, image/jpeg, image/png image/jpg" onchange="readURL(this);">                        
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12 col-md-8 col-md-offset-2">
                                <img class="center-block" id="blah" src="#" alt="Imagen" width="250" height="250" />
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="descripcion" class="col-xs-12 col-md-8 col-md-offset-2">Descripción: </label>
                            <div class="ccol-xs-12 col-md-8 col-md-offset-2">
                                <textarea class="form-control" id="descripcion" rows="5">
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tags" class="col-xs-12 col-md-8 col-md-offset-2">Tags: </label>
                            <div class="col-xs-12 col-md-8 col-md-offset-2">
                                <input type="text" class="form-control" id="tags" placeholder="Tags" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12 col-md-4 col-md-offset-4">
                                <button class="btn btn-warning btn-block">Subir</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>    
        <script src="js/imagen.js"></script>
    </body>
    <?php
    include ('footer.php');
    ?>
</html>