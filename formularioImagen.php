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
                    <h1 class="col-md-12">Subir imagen</h1>
                </div>
            </div>
            <div class="panel-body postDesc">
                <form class="form-horizontal col-xs-12 col-md-8 col-md-offset-2" enctype="multipart/form-data" action="" method="post">
                    <div class="form-group">
                        <label for="imagen">Seleccionar imagen: </label>
                        <div>
                            <input type="file" name="filename" id="imagen" accept="image/gif, image/jpeg, image/png image/jpg" onchange="readURL(this);">                        
                        </div>
                    </div>

                    <div class="form-group">
                        <div>
                            <img class="center-block" id="blah" src="#" alt="Imagen" width="250" height="250" />
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción: </label>
                        <div>
                            <textarea class="form-control" id="descripcion" name="descripcion">
                            </textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tags">Tags: </label>
                        <div>
                            <input type="text" class="form-control" id="tags" placeholder="Tags" name="tags" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-md-4 col-md-offset-4">
                            <button type="submit" onclick="location.href='publicacionIndex.php';" class="btn btn-warning btn-block">Subir</button>
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