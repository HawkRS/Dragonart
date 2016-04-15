<?php
require_once 'doctype.php';
?>

<body>
	
	<?php
    require_once 'header.php';
    ?>

    <div class="container main-usrIndex">

			<aside class="col-xs-12 col-sm-3 col-md-3">
				
				<div class="panel panel-default">
					<div class="panel-heading">
						<figure>
							<picture>
								<img class="center-block avatar" src="assets/img/avatar.png" alt="Nombre de usuario">
							</picture>
						</figure>

						<h2 class="text-center">Silver Dragon</h2>
						<div class="profile-userbuttons">
							<button class="btn btn-warning btn-sm btn-block" name="btnSeguir" id="btnSeguir"><span class="glyphicon glyphicon-plus-sign"></span> Seguir</button>
	                        <button class="btn btn-danger btn-sm btn-block" name="btnBloquear" id="btnBloquear"><span class="glyphicon glyphicon-remove-sign"></span> Bloquear</button>
                        </div>
					</div><!--Fin Panel header-->
					<div class="panel-body">
                    	<p>
                    		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur maxime enim, nisi iste, vitae commodi ducimus molestias veritatis! Officiis neque facilis quaerat voluptate ab vel impedit incidunt. Eum ratione, doloremque!
                    	</p>
					</div>
					<div id="menuUser" class="list-group">
						<button id="galeria" class="list-group-item active">Galería</button>
						<button id="favoritos" class="list-group-item">Favoritos</button>
						<button id="seguidores" class="list-group-item">Seguidores</button>
						<button id="siguiendo" class="list-group-item">Siguiendo</button>
					</div>
				</div><!--Fin Panel Usuario-->

			</aside><!--Fin Aside-->
			
			<div class="col-xs-12 col-sm-9 col-md-9">
				<div class="panel panel-default">

                        <div class="panel-heading galHeader">
                            <h2 class="galHeaderText">Galería</h2>
                        </div>

                        <div id="postDesc" class="panel-body">

                            <div id="fila0" class="row">

                                <div id="image1" name="image1" class="col-sm-6 col-md-3">
                                    <div class="thumbnail">
                                        <a href="publicacionIndex.php">
                                            <img src="assets/img/Imagen8.png" alt="Demostración">
                                        </a>
                                        <div class="caption">
                                            <span>Título de la imagen</span>
                                            <input id="input-1" class="rating rating-loading" data-show-clear="false" data-show-caption="false" data-size="xs" data-step="1">
                                        </div>
                                    </div>
                                </div>

                                <div id="image2" name="image2" class="col-sm-6 col-md-3">
                                    <div class="thumbnail">
                                        <img src="assets/img/Imagen.png" alt="Demostración">
                                        <div class="caption">
                                            <span>Título de la imagen</span>
                                            <input id="input-2" class="rating rating-loading" data-show-clear="false" data-show-caption="false" data-size="xs" data-step="1">
                                        </div>
                                    </div>
                                </div>

                                <div id="image3" name="image3" class="col-sm-6 col-md-3">
                                    <div class="thumbnail">
                                        <img src="http://placekitten.com/g/300/200" alt="Demostración">
                                        <div class="caption">
                                            <span>Título de la imagen</span>
                                            <input id="input-3" class="rating rating-loading" data-show-clear="false" data-show-caption="false" data-size="xs" data-step="1">
                                        </div>
                                    </div>
                                </div>

                                <div id="image4" name="image4" class="col-sm-6 col-md-3">
                                    <div class="thumbnail">
                                        <img src="http://placekitten.com/g/300/200" alt="Demostración">
                                        <div class="caption">
                                            <span>Título de la imagen</span>
                                            <input id="input-4" class="rating rating-loading" data-show-clear="false" data-show-caption="false" data-size="xs" data-step="1">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div id="fila1" class="row">

                                <div id="image5" name="image5" class="col-sm-6 col-md-3">
                                    <div class="thumbnail">
                                        <a href="publicacionIndex.php">
                                            <img src="http://placekitten.com/g/300/200" alt="Demostración">
                                        </a>
                                        <div class="caption">
                                            <span>Título de la imagen</span>
                                            <input id="input-5" class="rating rating-loading" data-show-clear="false" data-show-caption="false" data-size="xs" data-step="1">
                                        </div>
                                    </div>
                                </div>

                                <div id="image6" name="image6" class="col-sm-6 col-md-3">
                                    <div class="thumbnail">
                                        <img src="http://placekitten.com/g/300/200" alt="Demostración">
                                        <div class="caption">
                                            <span>Título de la imagen</span>
                                            <input id="input-6" class="rating rating-loading" data-show-clear="false" data-show-caption="false" data-size="xs" data-step="1">
                                        </div>
                                    </div>
                                </div>

                                <div id="image7" name="image7" class="col-sm-6 col-md-3">
                                    <div class="thumbnail">
                                        <img src="http://placekitten.com/g/300/200" alt="Demostración">
                                        <div class="caption">
                                            <span>Título de la imagen</span>
                                            <input id="input-7" class="rating rating-loading" data-show-clear="false" data-show-caption="false" data-size="xs" data-step="1">
                                        </div>
                                    </div>
                                </div>

                                <div id="image8" name="image8" class="col-sm-6 col-md-3">
                                    <div class="thumbnail">
                                        <img src="http://placekitten.com/g/300/200" alt="Demostración">
                                        <div class="caption">
                                            <span>Título de la imagen</span>
                                            <input id="input-8" class="rating rating-loading" data-show-clear="false" data-show-caption="false" data-size="xs" data-step="1">
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="panel-footer postTags">
                            <button class="btn btn-warning" name="btnVerMas" id="btnVerMas"><span class="glyphicon glyphicon-plus-sign"></span> Ver mas</button>
                        </div>

                    </div><!--Fin Panel Galeria-->
			</div>

    </div><!--Fin Div Principal-->

</body>

<?php
require_once 'footer.php';
?>

<script type="text/javascript" src="assets/js/userPage.js"></script>

</html>