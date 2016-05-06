var menu = $('.list-group-item'); 
menu.click(function(){
	menu.removeClass('active');
	if(!$(this).hasClass('active')){
		$(this).addClass('active');
		if($(this).attr('id') === 'imagenes'){
			$('.galHeader > h2').text('Imágenes');
			$('#btnVerMas').attr('onclick', 'verMasImagenes()');
			cargarImagenes();
		}
		if($(this).attr('id') === 'usuarios'){
			$('.galHeader > h2').text('Usuarios');
			$('#btnVerMas').attr('onclick', 'verMasUsuarios()');
			cargarUsuarios();
		}
		if($(this).attr('id') === 'comentarios'){
			$('.galHeader > h2').text('Comentarios');
			$('#btnVerMas').attr('onclick', 'verMasComentarios()');
			cargarComentarios();
		}
	}
});

function eliminar(){
	var contador = $('.check').length;
	console.log(contador);
	var lista = $('.check');
	for(var i = contador; i > 0; i--){
        if(lista.eq(i-1).prop('checked')){
            $('#fila' + i).remove();
        }
    }

    lista = $('#tablaCuerpo > tr');
    contador = $('#tablaCuerpo > tr').length;
    for(var i = 0; i < contador; i++){
        lista.eq(i).attr('id','fila' + (i+1));
    }
}

var mainCheck = $('#mainCheck');
mainCheck.click(function(){
	console.log(this.checked);
	if(this.checked === false){
		$('.check:checked').prop('checked',false);
	}
	else{
		$('.check:not(:checked)').prop('checked',true);
	}
});

function activaCheckbox(){
	var mainCheck = $('#mainCheck');
	mainCheck.click(function(){
		console.log(this.checked);
		if(this.checked === false){
			$('.check:checked').prop('checked',false);
		}
		else{
			$('.check:not(:checked)').prop('checked',true);
		}
	});
}

function cargarImagenes(){
	var encabezado = $('#tablaEncabezado');
	encabezado.empty();
	encabezado.append('<th><input type="checkbox" id="mainCheck"></th>');
	activaCheckbox();
	encabezado.append('<th>ID</th>');
	encabezado.append('<th>Imagen</th>');
	encabezado.append('<th>Nombre</th>');
	encabezado.append('<th>Alias</th>');
	encabezado.append('<th>Rating</th>');
	encabezado.append('<th>Editar</th>');
	encabezado.append('<th>Eliminar</th>');

	var cuerpo = $('#tablaCuerpo');
	cuerpo.empty();
	for(var i = 1; i <= 5; i++){
		cuerpo.append('<tr id="fila' + i + '"></tr>');
		$('#fila' + i).append('<td><input type="checkbox" class="check"></td>');
		$('#fila' + i).append('<td>' + i + '</td>');
		$('#fila' + i).append('<td><img class="img-sm" src="http://placekitten.com/300/200" alt="Demostración"></td>');
		$('#fila' + i).append('<td>Gatito</td>');
		$('#fila' + i).append('<td>Silver</td>');
		$('#fila' + i).append('<td><input id="input-'+i+'" class="rating rating-loading" value="4" data-show-clear="false" data-show-caption="false" data-size="xs" data-readonly="true"></td>');
		$('#fila' + i).append('<td><a href="#">Editar</a></td>');
		$('#fila' + i).append('<td><a href="#">Eliminar</a></td>');

		$('#input-' + i).rating();
	}
}

function verMasImagenes(){
	var cuerpo = $('#tablaCuerpo');
	var contador = $('#tablaCuerpo > tr').length + 1;
	console.log(contador);
	for(var i = contador; i <= (contador+4); i++){
		cuerpo.append('<tr id="fila' + i + '"></tr>');
		$('#fila' + i).append('<td><input type="checkbox" class="check"></td>');
		$('#fila' + i).append('<td>' + i + '</td>');
		$('#fila' + i).append('<td><img class="img-sm" src="http://placekitten.com/300/200" alt="Demostración"></td>');
		$('#fila' + i).append('<td>Gatito</td>');
		$('#fila' + i).append('<td>Silver</td>');
		$('#fila' + i).append('<td><input id="input-'+i+'" class="rating rating-loading" value="4" data-show-clear="false" data-show-caption="false" data-size="xs" data-readonly="true"></td>');
		$('#fila' + i).append('<td><a href="#">Editar</a></td>');
		$('#fila' + i).append('<td><a href="#">Eliminar</a></td>');

		$('#input-' + i).rating();
	}
}

function cargarUsuarios(){
	var encabezado = $('#tablaEncabezado');
	encabezado.empty();
	encabezado.append('<th><input type="checkbox" id="mainCheck"></th>');
	activaCheckbox();
	encabezado.append('<th>ID</th>');
	encabezado.append('<th>Avatar</th>');
	encabezado.append('<th>Nombre</th>');
	encabezado.append('<th>Alias</th>');
	encabezado.append('<th>Editar</th>');
	encabezado.append('<th>Eliminar</th>');

	var cuerpo = $('#tablaCuerpo');
	cuerpo.empty();
	for(var i = 1; i <= 5; i++){
		cuerpo.append('<tr id="fila' + i + '"></tr>');
		$('#fila' + i).append('<td><input type="checkbox" class="check"></td>');
		$('#fila' + i).append('<td>' + i + '</td>');
		$('#fila' + i).append('<td><img src="http://placekitten.com/50/50" alt="Demostración"></td>');
		$('#fila' + i).append('<td>Mauricio</td>');
		$('#fila' + i).append('<td>Silver</td>');
		$('#fila' + i).append('<td><a href="#">Editar</a></td>');
		$('#fila' + i).append('<td><a href="#">Eliminar</a></td>');
	}
}

function verMasUsuarios(){
	var cuerpo = $('#tablaCuerpo');
	var contador = $('#tablaCuerpo > tr').length + 1;
	console.log(contador);
	for(var i = contador; i <= (contador+4); i++){
		cuerpo.append('<tr id="fila' + i + '"></tr>');
		$('#fila' + i).append('<td><input type="checkbox" class="check"></td>');
		$('#fila' + i).append('<td>' + i + '</td>');
		$('#fila' + i).append('<td><img src="http://placekitten.com/50/50" alt="Demostración"></td>');
		$('#fila' + i).append('<td>Mauricio</td>');
		$('#fila' + i).append('<td>Silver</td>');
		$('#fila' + i).append('<td><a href="#">Editar</a></td>');
		$('#fila' + i).append('<td><a href="#">Eliminar</a></td>');
	}
}

function cargarComentarios(){
	var encabezado = $('#tablaEncabezado');
	encabezado.empty();
	encabezado.append('<th><input type="checkbox" id="mainCheck"></th>');
	activaCheckbox();
	encabezado.append('<th>ID</th>');
	encabezado.append('<th>Avatar</th>');
	encabezado.append('<th>Alias</th>');
	encabezado.append('<th>Comentario</th>');
	encabezado.append('<th>Eliminar</th>');

	var cuerpo = $('#tablaCuerpo');
	cuerpo.empty();
	for(var i = 1; i <= 5; i++){
		cuerpo.append('<tr id="fila' + i + '"></tr>');
		$('#fila' + i).append('<td><input type="checkbox" class="check"></td>');
		$('#fila' + i).append('<td>' + i + '</td>');
		$('#fila' + i).append('<td><img src="http://placekitten.com/50/50" alt="Demostración"></td>');
		$('#fila' + i).append('<td>Silver</td>');
		$('#fila' + i).append('<td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat ex nesciunt cum ea excepturi praesentium officia iusto neque atque perspiciatis architecto doloremque expedita odit ducimus aliquam, vero dignissimos illum, aperiam!</td>');
		$('#fila' + i).append('<td><a href="#">Eliminar</a></td>');
	}
}

function verMasComentarios(){
	var cuerpo = $('#tablaCuerpo');
	var contador = $('#tablaCuerpo > tr').length + 1;
	console.log(contador);
	for(var i = contador; i <= (contador+4); i++){
		cuerpo.append('<tr id="fila' + i + '"></tr>');
		$('#fila' + i).append('<td><input type="checkbox" class="check"></td>');
		$('#fila' + i).append('<td>' + i + '</td>');
		$('#fila' + i).append('<td><img src="http://placekitten.com/50/50" alt="Demostración"></td>');
		$('#fila' + i).append('<td>Silver</td>');
		$('#fila' + i).append('<td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat ex nesciunt cum ea excepturi praesentium officia iusto neque atque perspiciatis architecto doloremque expedita odit ducimus aliquam, vero dignissimos illum, aperiam!</td>');
		$('#fila' + i).append('<td><a href="#">Eliminar</a></td>');
	}
}