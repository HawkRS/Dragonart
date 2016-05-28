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
			llenarFavoritos();
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

function asignarAJAX(urlImagen, val){
	$.ajax({
            type : 'POST',
            url : 'index.php?controlador=imagen&accion=altaFavorito',
            data : {
                url : urlImagen,
                calificacion : val
            },
            success : function(respuesta){
                if(respuesta !== '1'){
                    alert('No se pudo agregar el favorito.');
                }
            },
            error : function(respuesta){
                alert('Hubo un error al ejecutar tu petición. Inténtelo más tarde.');
            }
        });
}

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
	            			(function(tmp, tmpFila){
	            				$('#fila' + tmpFila)
									.append('<div id="image' + tmp + '" name="image' + tmp + '" class="col-sm-6 col-md-3"></div>');
								$('#image' + tmp)
									.append('<div class="thumbnail"></div>');
								$('#image' + tmp + ' .thumbnail')
									.append('<a href="index.php?controlador=imagen&accion=mostrar&img='+ json[tmp].id +'"></a>')
									.append('<div class="caption"></div>');
								$('#image' + tmp + ' .thumbnail > a')
									.append('<img src="'+ json[tmp].url +'" alt="'+ json[tmp].titulo +'" />');
								$('#image' + tmp + ' .thumbnail > div')
									.append('<span>'+ json[tmp].titulo +'</span>')
									.append('<input id="input-' + tmp + '" class="rating-loading" data-show-clear="false" data-show-caption="false" data-size="xs" data-step="1" value="'+ json[tmp].promedio +'">');
								$('#input-' + tmp).rating({displayOnly : json[tmp].bool});
								$('#input-' + tmp).on('rating.change', function(event, value, caption){
						            url = $('#image' + tmp).find('img').attr('src');
				            		asignarAJAX(url, value);
						        });
							})(contadorImagen, contadorFilas);
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

function llenarFavoritos(){
	var contadorFilas = 0;
	var contadorImagen = 0;
	var limite = 4;

	$('#postDesc').empty();

	$.ajax({
	        type : 'POST',
	        url : 'index.php?controlador=imagen&accion=masFavoritos',
	        dataType: 'json',
	        data : {
	            usuario: $('#nombreUsuario').text(),
	            offset: 0,
	            limit: 8
	        },
	        success : function(json){
	        	console.log(json);
	            if($.isEmptyObject(json)){
	                $('#postDesc').append('<i>No hay favoritos...</i>');
	            }else{
	            	if(json.length <= 4){
	            		var limiteFilas = 1;
	            	}else if(json.length > 4 && json.length <=8){
	            		var limiteFilas = 2;
	            	}

	            	while(contadorFilas < limiteFilas){
	            		$('#postDesc').append('<div id="fila' + contadorFilas + '" class="row"></div>');
	            		while(contadorImagen < limite && contadorImagen < json.length){
	            			(function(tmp, tmpFila){
	            				$('#fila' + tmpFila)
									.append('<div id="image' + tmp + '" name="image' + tmp + '" class="col-sm-6 col-md-3"></div>');
								$('#image' + tmp)
									.append('<div class="thumbnail"></div>');
								$('#image' + tmp + ' .thumbnail')
									.append('<a href="index.php?controlador=imagen&accion=mostrar&img='+ json[tmp].id +'"></a>')
									.append('<div class="caption"></div>');
								$('#image' + tmp + ' .thumbnail > a')
									.append('<img src="'+ json[tmp].url +'" alt="'+ json[tmp].titulo +'" />');
								$('#image' + tmp + ' .thumbnail > div')
									.append('<span>'+ json[tmp].titulo +'</span>')
									.append('<input id="input-' + tmp + '" class="rating-loading" data-show-clear="false" data-show-caption="false" data-size="xs" data-step="1" value="'+ json[tmp].promedio +'">');
								$('#input-' + tmp).rating({displayOnly : json[tmp].bool});
								$('#input-' + tmp).on('rating.change', function(event, value, caption){
						            url = $('#image' + tmp).find('img').attr('src');
				            		asignarAJAX(url, value);
						        });
							})(contadorImagen, contadorFilas);
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
		if($('.galHeader > h2').text() === 'Galería'){
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
	                        alert('No hay mas imágenes.');
	                    }else{
	                    	for(var i = 0; i < json.length; i++){
	                    		(function(tmp, cont){
									clon.find('#image' + tmp).attr('id','image' + cont);
									clon.find('#image' + cont).attr('name','image' + cont);
									clon.find('#image' + cont).find('img').attr('src',json[tmp].url);
									clon.find('#image' + cont).find('img').attr('alt',json[tmp].titulo);
									clon.find('#image' + cont).find('a').attr('href','index.php?controlador=imagen&accion=mostrar&img='+json[tmp].id);
									clon.find('#image' + cont).find('#titulo' + tmp).text(json[tmp].titulo);
									clon.find('#image' + cont).find('#input-' + tmp).parent().remove();
									clon.find('#image' + cont).find('.caption').append('<input id="input-'+ cont +'" class="rating-loading" data-show-clear="false" data-show-caption="false" data-size="xs" data-step="1" value="0">');
									clon.find('#image' + cont).find('#input-' + cont).attr('value', json[tmp].promedio);
									clon.find('#image' + cont).find('#input-' + cont).rating({displayOnly : json[tmp].bool});
									clon.find('#image' + cont).find('#input-' + cont).on('rating.change', function(event, value, caption){
							            url = $('#image' + cont).find('img').attr('src');
				            			asignarAJAX(url, value);
							        });
								})(i, contadorInputs);
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
		}if($('.galHeader > h2').text() === 'Favoritos'){
			$.ajax({
	                type : 'POST',
	                url : 'index.php?controlador=imagen&accion=masFavoritos',
	                dataType: 'json',
	                data : {
	                    usuario: $('#nombreUsuario').text(),
	                    offset: contadorInputs,
	                    limit: 4
	                },
	                success : function(json){
	                    if($.isEmptyObject(json)){
	                        alert('No hay más favoritos.');
	                    }else{
	                    	for(var i = 0; i < json.length; i++){
	                    		(function(tmp, cont){
									clon.find('#image' + tmp).attr('id','image' + cont);
									clon.find('#image' + cont).attr('name','image' + cont);
									clon.find('#image' + cont).find('img').attr('src',json[tmp].url);
									clon.find('#image' + cont).find('img').attr('alt',json[tmp].titulo);
									clon.find('#image' + cont).find('a').attr('href','index.php?controlador=imagen&accion=mostrar&img='+json[tmp].id);
									clon.find('#image' + cont).find('#titulo' + tmp).text(json[tmp].titulo);
									clon.find('#image' + cont).find('#input-' + tmp).parent().remove();
									clon.find('#image' + cont).find('.caption').append('<input id="input-'+ cont +'" class="rating-loading" data-show-clear="false" data-show-caption="false" data-size="xs" data-step="1" value="0">');
									clon.find('#image' + cont).find('#input-' + cont).attr('value', json[tmp].promedio);
									clon.find('#image' + cont).find('#input-' + cont).rating({displayOnly : json[tmp].bool});
									clon.find('#image' + cont).find('#input-' + cont).on('rating.change', function(event, value, caption){
							            url = $('#image' + cont).find('img').attr('src');
				            			asignarAJAX(url, value);
							        });
								})(i, contadorInputs);
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
		}if($('.galHeader > h2').text() === 'Seguidores'){

		}if($('.galHeader > h2').text() === 'Siguiendo'){

		}
			
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