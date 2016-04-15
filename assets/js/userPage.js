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
		}
		if($(this).attr('id') === 'siguiendo'){
			$('.galHeader > h2').text('Siguiendo');
		}
	}
});

function llenarGaleria(){
	var contadorFilas = 0;
	var clon1 = $('#fila1').clone();
	var clon2 = $('#fila0').clone();
	$('#postDesc').empty();
	$('#postDesc')
		.append(clon1);
	$('#postDesc')
		.append(clon2);
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