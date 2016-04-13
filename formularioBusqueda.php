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
                <form id="busqueda" class="form-horizontal col-xs-12 col-md-8 col-md-offset-2" action="javascript:alert( 'success!' );" method="post">

                    <div class="form-group">
                        <label for="buscarPor">Buscar por: </label>
                        <div>
                            <select class="form-control" id="buscarPor" name="buscarPor">
                                <option value="1">Alias de usuario</option> 
                                <option value="2">Título de la imagen</option> 
                                <option value="3">Tag de imágenes</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="palabraClave">Palabra clave: </label>
                        <div>
                            <input type="text" class="form-control" id="palabraClave" placeholder="Ejemplo: dragon" name="palabraClave"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-md-4 col-md-offset-4">
                            <button class="btn btn-warning btn-block" type="submit"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading postHeader">
                <h2 class="galHeaderText">Usuarios</h2>
            </div>

            <div class="panel-body postDesc">

                <div class="row">

                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                            <a href="publicacionIndex.php">
                                <img src="assets/img/avatar.png" alt="Demostración">
                            </a>
                        </div>
                        <div class="caption text-center">
                            <span>Usuario</span>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                            <a href="publicacionIndex.php">
                                <img src="assets/img/avatar.png" alt="Demostración">
                            </a>
                        </div>
                        <div class="caption text-center">
                            <span>Usuario</span>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                            <a href="publicacionIndex.php">
                                <img src="assets/img/avatar.png" alt="Demostración">
                            </a>
                        </div>
                        <div class="caption text-center">
                            <span>Usuario</span>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                            <a href="publicacionIndex.php">
                                <img src="assets/img/avatar.png" alt="Demostración">
                            </a>
                        </div>
                        <div class="caption text-center">
                            <span>Usuario</span>
                        </div>
                    </div>


                </div>

            </div>

            <div class="panel-footer postTags">
                <ul class="pagination">
                    <li class="disabled">
                        <a href="#">&laquo;</a>
                    </li>
                    <li class="active">
                        <a href="#">1 <span class="sr-only">(página actual)</span></a>
                    </li>
                    <li>
                        <a href="#">2</a>
                    </li>
                    <li>
                        <a href="#">3</a>
                    </li>
                    <li>
                        <a href="#">4</a>
                    </li>
                    <li>
                        <a href="#">5</a>
                    </li>
                    <li>
                        <a href="#">6</a>
                    </li>
                    <li>
                        <a href="#">7</a>
                    </li>
                    <li>
                        <a href="#">8</a>
                    </li>
                    <li>
                        <a href="#">9</a>
                    </li>
                    <li>
                        <a href="#">10</a>
                    </li>
                    <li>
                        <a href="#">&raquo;</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading postHeader">
                <h2 class="galHeaderText">Imágenes</h2>
            </div>

            <div class="panel-body postDesc">

                <div class="row">

                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                            <a href="publicacionIndex.php">
                                <img src="assets/img/Imagen.png" alt="Demostración">
                            </a>
                        </div>
                        <div class="caption text-center">
                            <span>Título imagen</span><br>
                            <button class="btn btn-warning" name="favorito" id="favorito" type="button">+Favorito</button>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                            <a href="publicacionIndex.php">
                                <img src="assets/img/Imagen2.png" alt="Demostración">
                            </a>
                        </div>
                        <div class="caption text-center">
                            <span>Título imagen</span><br>
                            <button class="btn btn-warning" name="favorito" id="favorito" type="button">+Favorito</button>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                            <a href="publicacionIndex.php">
                                <img src="assets/img/Imagen3.png" alt="Demostración">
                            </a>
                        </div>
                        <div class="caption text-center">
                            <span>Título imagen</span><br>
                            <button class="btn btn-warning" name="favorito" id="favorito" type="button">+Favorito</button>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                            <a href="publicacionIndex.php">
                                <img src="assets/img/Imagen4.jpg" alt="Demostración">
                            </a>
                        </div>
                        <div class="caption text-center">
                            <span>Título imagen</span><br>
                            <button class="btn btn-warning" name="favorito" id="favorito" type="button">+Favorito</button>
                        </div>
                    </div>

                </div>
                <div class="row">

                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                            <a href="publicacionIndex.php">
                                <img src="assets/img/Imagen5.png" alt="Demostración">
                            </a>
                        </div>
                        <div class="caption text-center">
                            <span>Título imagen</span><br>
                            <button class="btn btn-warning" name="favorito" id="favorito" type="button">+Favorito</button>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                            <a href="publicacionIndex.php">
                                <img src="assets/img/Imagen6.png" alt="Demostración">
                            </a>
                        </div>
                        <div class="caption text-center">
                            <span>Título imagen</span><br>
                            <button class="btn btn-warning" name="favorito" id="favorito" type="button">+Favorito</button>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                            <a href="publicacionIndex.php">
                                <img src="assets/img/Imagen7.png" alt="Demostración">
                            </a>
                        </div>
                        <div class="caption text-center">
                            <span>Título imagen</span><br>
                            <button class="btn btn-warning" name="favorito" id="favorito" type="button">+Favorito</button>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                            <a href="publicacionIndex.php">
                                <img src="assets/img/Imagen8.png" alt="Demostración">
                            </a>
                        </div>
                        <div class="caption text-center">
                            <span>Título imagen</span><br>
                            <button class="btn btn-warning" name="favorito" id="favorito" type="button">+Favorito</button>
                        </div>
                    </div>
                </div>

            </div>

            <div class="panel-footer postTags">
                <ul class="pagination">
                    <li class="disabled">
                        <a href="#">&laquo;</a>
                    </li>
                    <li class="active">
                        <a href="#">1 <span class="sr-only">(página actual)</span></a>
                    </li>
                    <li>
                        <a href="#">2</a>
                    </li>
                    <li>
                        <a href="#">3</a>
                    </li>
                    <li>
                        <a href="#">4</a>
                    </li>
                    <li>
                        <a href="#">5</a>
                    </li>
                    <li>
                        <a href="#">6</a>
                    </li>
                    <li>
                        <a href="#">7</a>
                    </li>
                    <li>
                        <a href="#">8</a>
                    </li>
                    <li>
                        <a href="#">9</a>
                    </li>
                    <li>
                        <a href="#">10</a>
                    </li>
                    <li>
                        <a href="#">&raquo;</a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</body>

<?php
require_once ('footer.php');
?>

<script>
    $('#busqueda').submit(function(event){
        var inputs = $('#busqueda input');
        if(!(validarInputs(inputs))){
            event.preventDefault();
        }   
    });
</script>

</html>