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
                <form class="form-horizontal col-xs-12 col-md-8 col-md-offset-2" enctype="multipart/form-data" action="" method="post">

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
                            <input type="email" class="form-control" id="correo" placeholder="alguien@ejemplo.com" disabled name="correo" />
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
                        <label for="biografia">Biografía: </label>
                        <div>
                            <textarea class="form-control col-xs-12 col-md-8" id="biografia" name="biografia"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="avatar">Avatar: </label>
                        <div>
                           <input type="file" name="filename" id="avatar" accept="image/gif, image/jpeg, image/png, image/jpg" onchange="readURL(this);">
                        </div>
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
                            <button type="submit" onclick="location.href='index.php';" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-remove-sign"></span> Eliminar cuenta</button>
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