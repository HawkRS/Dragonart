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
					<h2>Menú</h2>
				</div>

				<div id="menuAdmin" class="list-group">
					<button id="imagenes" class="list-group-item active">
						<span class="glyphicon glyphicon-picture"></span> Imágenes
					</button>
					<button id="usuarios" class="list-group-item">
						<span class="glyphicon glyphicon-user"></span> Usuarios
					</button>
					<button id="comentarios" class="list-group-item">
						<span class="glyphicon glyphicon-comment"></span> Comentarios
					</button>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h2>Filtros</h2>
				</div>
				<div class="panel-body">
					
				</div>
			</div>
		</aside>

		<div class="col-xs-12 col-sm-9 col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading galHeader">
					<h2>Imágenes</h2>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr id="tablaEncabezado">
									<th><input type="checkbox" id="mainCheck"></th>
									<th>ID</th>
									<th>Imagen</th>
									<th>Nombre</th>
									<th>Alias</th>
									<th>Rating</th>
									<th>Editar</th>
									<th>Eliminar</th>
								</tr>
							</thead>
							<tbody id="tablaCuerpo">
								<tr id="fila1">
									<td><input type="checkbox" class="check"></td>
									<td>1</td>
									<td><img class="img-sm" src="http://placekitten.com/g/300/200" alt="Demostración"></td>
									<td>King koopa</td>
									<td>Silver</td>
									<td><input id="input-1" class="rating rating-loading" value="3" data-show-clear="false" data-show-caption="false" data-size="xs" data-readonly="true"></td>
									<td><a href="#">Editar</a></td>
									<td><a href="#">Eliminar</a></td>
								</tr>
								<tr id="fila2">
									<td><input type="checkbox" class="check"></td>
									<td>2</td>
									<td><img class="img-sm" src="http://placekitten.com/g/300/200" alt="Demostración"></td>
									<td>Silver nerd</td>
									<td>Licos</td>
									<td><input id="input-2" class="rating rating-loading" value="4" data-show-clear="false" data-show-caption="false" data-size="xs" data-readonly="true"></td>
									<td><a href="#">Editar</a></td>
									<td><a href="#">Eliminar</a></td>
								</tr>
								<tr id="fila3">
									<td><input type="checkbox" class="check"></td>
									<td>3</td>
									<td><img class="img-sm" src="http://placekitten.com/g/300/200" alt="Demostración"></td>
									<td>Random</td>
									<td>Parinton</td>
									<td><input id="input-3" class="rating rating-loading" value="5" data-show-clear="false" data-show-caption="false" data-size="xs" data-readonly="true"></td>
									<td><a href="#">Editar</a></td>
									<td><a href="#">Eliminar</a></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="panel-footer">
					<button class="btn btn-warning" name="btnVerMas" id="btnVerMas" onclick="verMasImagenes()"><span class="glyphicon glyphicon-plus-sign"></span> Ver mas</button>
					<button class="btn btn-danger" name="btnEliminar" id="btnEliminar" onclick="eliminar()"><span class="glyphicon glyphicon-remove"></span> Eliminar selección</button>
				</div>
			</div>
		</div>

    </div>

</body>

<?php
require_once 'footer.php';
?>

<script type="text/javascript" src="assets/js/backend.js"></script>

</html>