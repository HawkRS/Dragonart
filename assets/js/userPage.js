var menu = $('.list-group-item'); 
menu.click(function(){
	menu.removeClass('active');
	if(!$(this).hasClass('active')){
		$(this).addClass('active');
		if($(this).attr('id') === 'galeria'){
			$('.galHeader > h2').text('Galería');
			llenarGaleria();
		}
		if($(this).attr('id') === 'favoritos'){
			$('.galHeader > h2').text('Favoritos');
			llenarGaleria();
		}
		if($(this).attr('id') === 'seguidores'){
			$('.galHeader > h2').text('Seguidores');
			llenarSeguidores();
		}
		if($(this).attr('id') === 'siguiendo'){
			$('.galHeader > h2').text('Siguiendo');
			llenarSeguidores();
		}
	}
});

function llenarGaleria(){
	var contadorFilas = 0;
	var contadorImagen = 1;
	var limite = 4;

	$('#postDesc').empty();

	while(contadorFilas < 2){
		$('#postDesc')
			.append('<div id="fila' + contadorFilas + '" class="row"></div>');

		while(contadorImagen <= limite){
			$('#fila' + contadorFilas)
				.append('<div id="image' + contadorImagen + '" name="image' + contadorImagen + '" class="col-sm-6 col-md-3"></div>');
			$('#image' + contadorImagen)
				.append('<div class="thumbnail"></div>');
			$('#image' + contadorImagen + ' .thumbnail')
				.append('<a href="publicacionIndex.php"></a>')
				.append('<div class="caption"></div>');
			$('#image' + contadorImagen + ' .thumbnail > a')
				.append('<img src="http://placekitten.com/g/300/200" alt="Demostración" />');
			$('#image' + contadorImagen + ' .thumbnail > div')
				.append('<span>Título de la imagen</span>')
				.append('<input id="input-' + contadorImagen + '" class="rating rating-loading" data-show-clear="false" data-show-caption="false" data-size="xs" data-step="1">');
			$('#input-' + contadorImagen).rating();
			contadorImagen++;
		}

		limite += limite;
		contadorFilas++;
	}
}

function llenarSeguidores(){
	var contadorFilas = 0;
	var contadorImagen = 1;
	var limite = 4;

	$('#postDesc').empty();

	while(contadorFilas < 2){
		$('#postDesc')
			.append('<div id="fila' + contadorFilas + '" class="row"></div>');

		while(contadorImagen <= limite){
			$('#fila' + contadorFilas)
				.append('<div id="avatar' + contadorImagen + '" name="avatar' + contadorImagen + '" class="col-sm-6 col-md-3"></div>');
			$('#avatar' + contadorImagen)
				.append('<div class="thumbnail"></div>');
			$('#avatar' + contadorImagen + ' .thumbnail')
				.append('<a href="usuarioIndex.php"></a>')
				.append('<div class="caption text-center"></div>');
			$('#avatar' + contadorImagen + ' .thumbnail > div')
				.append('<span>Usuario</span>');
			$('#avatar' + contadorImagen + ' .thumbnail > a')
				.append('<img src="assets/img/avatar.png" alt="Demostración" />');
			contadorImagen++;
		}

		limite += limite;
		contadorFilas++;
	}
}

var btnVerMas = $('#btnVerMas');
var contadorFilas = 2;
var contadorInputs = 9;
btnVerMas.click(function(){
	$('#postDesc')
		.append(
				$('#fila0')
					.clone()
						.attr('id', 'fila'+ contadorFilas)
			);
	$('#fila' + contadorFilas)
		.css('display', 'none')
	$('#fila' + contadorFilas)
		.fadeIn('slow');
	contadorFilas++;

});