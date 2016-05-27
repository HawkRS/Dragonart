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
	var contadorImagen = 0;
	var limite = 4;

	$('#postDesc').empty();

	$.ajax({
	        type : 'POST',
	        url : 'index.php?controlador=imagen&accion=masImagenes',
	        dataType: 'json',
	        data : {
	            usuario: $('#nombreUsuario').text(),
	            offset: 0,
	            limit: 8
	        },
	        success : function(json){
	            if($.isEmptyObject(json)){
	                $('#postDesc').append('<i>No hay imágenes en la galería...</i>');
	            }else{
	            	if(json.length <= 4){
	            		var limiteFilas = 1;
	            	}else if(json.length > 4 && json.length <=8){
	            		var limiteFilas = 2;
	            	}

	            	while(contadorFilas < limiteFilas){
	            		$('#postDesc').append('<div id="fila' + contadorFilas + '" class="row"></div>');
	            		while(contadorImagen < limite && contadorImagen < json.length){
	            			$('#fila' + contadorFilas)
								.append('<div id="image' + contadorImagen + '" name="image' + contadorImagen + '" class="col-sm-6 col-md-3"></div>');
							$('#image' + contadorImagen)
								.append('<div class="thumbnail"></div>');
							$('#image' + contadorImagen + ' .thumbnail')
								.append('<a href="index.php?controlador=imagen&accion=mostrar&img='+ json[contadorImagen].id +'"></a>')
								.append('<div class="caption"></div>');
							$('#image' + contadorImagen + ' .thumbnail > a')
								.append('<img src="'+ json[contadorImagen].url +'" alt="'+ json[contadorImagen].titulo +'" />');
							$('#image' + contadorImagen + ' .thumbnail > div')
								.append('<span>'+ json[contadorImagen].titulo +'</span>')
								.append('<input id="input-' + contadorImagen + '" class="rating-loading" data-show-clear="false" data-show-caption="false" data-size="xs" data-step="1" value="'+ json[contadorImagen].promedio +'">');
							$('#input-' + contadorImagen).rating({displayOnly : json[contadorImagen].bool});
							$('#input-' + contadorImagen).on('rating.change', function(event, value, caption){
					            $.ajax({
					                type : 'POST',
					                url : 'index.php?controlador=favorito&accion=alta',
					                data : {
					                    url : $('#image' + x).find('a').attr('href'),
					                    calificacion : $('#input-' + contadorImagen).val()
					                },
					                success : function(respuesta){
					                    if(respuesta !== '1'){
					                        alert('Hubo un error al ejecutar tu petición. Inténtelo más tarde.');
					                    }
					                },
					                error : function(respuesta){
					                    alert('Hubo un error al ejecutar tu petición. Inténtelo más tarde.');
					                }
					            });
					        });
							contadorImagen++;
	            		}
	            		$('#fila' + contadorFilas).css('display', 'none');
						$('#fila' + contadorFilas).fadeIn('slow');

						limite += limite;
						contadorFilas++;
	            	}
	            	
	            }
	        },
	        error : function(respuesta){
	            alert('Hubo un error al ejecutar tu petición. Inténtelo más tarde.');
	        }
	    });
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
				.append('<a href="index.php?controlador=usuario&accion=mostrar"></a>')
				.append('<div class="caption text-center"></div>');
			$('#avatar' + contadorImagen + ' .thumbnail > div')
				.append('<span>Usuario</span>');
			$('#avatar' + contadorImagen + ' .thumbnail > a')
				.append('<img src="assets/img/avatar.png" alt="Demostración" />');
			contadorImagen++;
		}

		$('#fila' + contadorFilas).css('display', 'none');
		$('#fila' + contadorFilas).fadeIn('slow');

		limite += limite;
		contadorFilas++;
	}
}

function verMas(){
	var contadorFilas = $('#postDesc .row').length;
	var contadorInputs = $('#postDesc .row .thumbnail').length + 1;
	var clon = $('#fila0').clone();
	var bandera = false;

	clon.attr('id', 'fila' + contadorFilas);

	if(clon.find('#image0').length > 0){
		$.ajax({
                type : 'POST',
                url : 'index.php?controlador=imagen&accion=masImagenes',
                dataType: 'json',
                data : {
                    usuario: $('#nombreUsuario').text(),
                    offset: contadorInputs,
                    limit: 4
                },
                success : function(json){
                    if($.isEmptyObject(json)){
                        alert($('#nombreUsuario').text());
                    }else{
                    	for(var i = 0; i < json.length; i++){
							clon.find('#image' + i).attr('id','image' + contadorInputs);
							clon.find('#image' + contadorInputs).attr('name','image' + contadorInputs);
							clon.find('#image' + contadorInputs).find('img').attr('src',json[i].url);
							clon.find('#image' + contadorInputs).find('img').attr('alt',json[i].titulo);
							clon.find('#image' + contadorInputs).find('a').attr('href','index.php?controlador=imagen&accion=mostrar&img='+json[i].id);
							clon.find('#image' + contadorInputs).find('#titulo' + i).text(json[i].titulo);
							clon.find('#image' + contadorInputs).find('#input-' + i).parent().remove();
							clon.find('#image' + contadorInputs).find('.caption').append('<input id="input-'+ contadorInputs +'" class="rating-loading" data-show-clear="false" data-show-caption="false" data-size="xs" data-step="1" value="0">');
							clon.find('#image' + contadorInputs).find('#input-' + contadorInputs).attr('value', json[i].promedio);
							clon.find('#image' + contadorInputs).find('#input-' + contadorInputs).rating({displayOnly : json[i].bool});
							clon.find('#image' + contadorInputs).find('#input-' + contadorInputs).on('rating.change', function(event, value, caption){
					            $.ajax({
					                type : 'POST',
					                url : 'index.php?controlador=favorito&accion=alta',
					                data : {
					                    url : clon.find('#image' + contadorInputs).find('a').attr('href'),
					                    calificacion : clon.find('#image' + contadorInputs).find('#input-' + contadorInputs).val()
					                },
					                success : function(respuesta){
					                    if(respuesta !== '1'){
					                        alert('Hubo un error al ejecutar tu petición. Inténtelo más tarde.');
					                    }
					                },
					                error : function(respuesta){
					                    alert('Hubo un error al ejecutar tu petición. Inténtelo más tarde.');
					                }
					            });
					        });
							contadorInputs++;
						}

						if(json.length < 4){
							var Eliminar = 0;
							while(Eliminar !== 4){
								clon.find('#image' + Eliminar).remove();
								Eliminar++;
							}
						}

						clon.css('display', 'none');
						clon.fadeIn('slow');

						$('#postDesc').append(clon);
                    }
                },
                error : function(respuesta){
                    alert('Hubo un error al ejecutar tu petición. Inténtelo más tarde.');
                }
            });
	}else{

	}

	/*for(var i = 0; i < 4; i++){
		if(clon.find('#image' + i).length){
			clon.find('#image' + i).attr('id','image' + contadorInputs);
			clon.find('#image' + contadorInputs).attr('name','image' + contadorInputs);
		}
		else{
			clon.find('#avatar' + i).attr('id','avatar' + contadorInputs);
			clon.find('#avatar' + contadorInputs).attr('name','avatar' + contadorInputs);
		}
		contadorInputs++;
	}*/

}