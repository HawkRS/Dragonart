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
	}
});

function eliminar(){
	var contador = $('.check').length;
	console.log(contador);
	var lista = $('.check');
	if($('#panelResultados').find('h2').text() === 'Imágenes'){
		for(var i = 0; i < contador; i++){
			if(lista.eq(i).prop('checked')){
	            (function(tmp){
	            	//CAMBIAR STATUS DEL CONTENIDO
	                var id = $('#fila' + i).find('td').eq(1).text();
	                $.ajax({
			            type : 'POST',
			            url : 'index.php?controlador=imagen&accion=cambiarEstado',
			            dataType: 'text',
			            data : {
			                id: id
			            },
			            success : function(respuesta){
			            	if(respuesta !== 'false'){
			            		$('#fila' + tmp).find('td').eq(6).text(respuesta);
			            	}else{
			            		alert('Hubo un error al cambiar los estados.')
			            	}
			            },
			            error : function(respuesta){
			                alert(respuesta.responseText);
			            }
			        });
	            })(i);
	        }
	    }
	}if($('#panelResultados').find('h2').text() === 'Usuarios'){
		for(var i = 0; i < contador; i++){
			if(lista.eq(i).prop('checked')){
	            (function(tmp){
	            	//CAMBIAR STATUS DEL CONTENIDO
	                var id = $('#fila' + i).find('td').eq(1).text();
	                $.ajax({
			            type : 'POST',
			            url : 'index.php?controlador=usuario&accion=cambiarEstado',
			            dataType: 'text',
			            data : {
			                id: id
			            },
			            success : function(respuesta){
			            	if(respuesta !== 'false'){
			            		$('#fila' + tmp).find('td').eq(7).text(respuesta);
			            	}else{
			            		alert('Hubo un error al cambiar los estados.')
			            	}
			            },
			            error : function(respuesta){
			                alert(respuesta.responseText);
			            }
			        });
	            })(i);
	        }
	    }
	}if($('#panelResultados').find('h2').text() === 'Comentarios'){
		for(var i = 0; i < contador; i++){
			if(lista.eq(i).prop('checked')){
	            (function(tmp){
	            	//CAMBIAR STATUS DEL CONTENIDO
	                var id = $('#fila' + i).find('td').eq(1).text();
	                $.ajax({
			            type : 'POST',
			            url : 'index.php?controlador=imagen&accion=cambiarEstadoComentarios',
			            dataType: 'text',
			            data : {
			                id: id
			            },
			            success : function(respuesta){
			            	if(respuesta !== 'false'){
			            		$('#fila' + tmp).find('td').eq(6).text(respuesta);
			            	}else{
			            		alert('Hubo un error al cambiar los estados.')
			            	}
			            },
			            error : function(respuesta){
			                alert(respuesta.responseText);
			            }
			        });
	            })(i);
	        }
	    }
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
	encabezado.append('<th>Título</th>');
	encabezado.append('<th>Alias</th>');
	encabezado.append('<th>Rating</th>');
	encabezado.append('<th>Estatus</th>');
	encabezado.append('<th>Comentarios</th>');

	var cuerpo = $('#tablaCuerpo');
	cuerpo.empty();
	
	$.ajax({
            type : 'POST',
            url : 'index.php?controlador=imagen&accion=backend',
            dataType: 'json',
            data : {
                offset: 0,
                limit: 10
            },
            success : function(json){
                if($.isEmptyObject(json)){
                    cuerpo.append('<i>No hay resultados...</i>');
                }else{
                    for(var x = 0; x < json.length; x++){
                        (function(i){
                            $('#tablaCuerpo').append('<tr id="fila' + i + '"></tr>');
                            $('#fila' + i).append('<td><input type="checkbox" class="check"></td>');
                            $('#fila' + i).append('<td>'+ json[i].id +'</td>');
                            $('#fila' + i).append('<td><img class="img-sm" src="'+ json[i].url +'" alt="'+ json[i].titulo +'"></td>');
                            $('#fila' + i).append('<td><a href="index.php?controlador=imagen&accion=mostrar&img='+ json[i].id +'">'+ json[i].titulo +'</a></td>');
                            $('#fila' + i).append('<td>'+ json[i].alias +'</td>');
                            $('#fila' + i).append('<td><input id="input-'+ i +'" class="rating-loading" data-show-clear="false" data-show-caption="false" data-size="xs" data-step="1" value="'+ json[i].promedio +'"></td>');
                            $('#fila' + i).append('<td>'+ json[i].status +'</td>');
                            $('#fila' + i).append('<td><button class="btn btn-sm btn-warning" name="btnCom'+ i +'" id="btnCom'+ i +'" onclick="cargarComentarios('+ json[i].id +')"><span class="glyphicon glyphicon-comment"></span> Ver comentarios</button></td>');
                            $('#input-' + i).rating({displayOnly : true});
                        })(x);
                    }
                }
            },
            error : function(respuesta){
                alert(respuesta.responseText);
            }
        });
}

function verMasImagenes(){
	var cuerpo = $('#tablaCuerpo');
	var contador = $('#tablaCuerpo > tr').length;

	$.ajax({
            type : 'POST',
            url : 'index.php?controlador=imagen&accion=backend',
            dataType: 'json',
            data : {
                offset: contador,
                limit: 10
            },
            success : function(json){
                if($.isEmptyObject(json)){
                    alert('No hay resultados...');
                }else{
                    for(var x = 0; x < json.length; x++){
                        (function(tmp, i){
                            $('#tablaCuerpo').append('<tr id="fila' + tmp + '"></tr>');
                            $('#fila' + tmp).append('<td><input type="checkbox" class="check"></td>');
                            $('#fila' + tmp).append('<td>'+ json[i].id +'</td>');
                            $('#fila' + tmp).append('<td><img class="img-sm" src="'+ json[i].url +'" alt="'+ json[i].titulo +'"></td>');
                            $('#fila' + tmp).append('<td><a href="index.php?controlador=imagen&accion=mostrar&img='+ json[i].id +'">'+ json[i].titulo +'</a></td>');
                            $('#fila' + tmp).append('<td>'+ json[i].alias +'</td>');
                            $('#fila' + tmp).append('<td><input id="input-'+ tmp +'" class="rating-loading" data-show-clear="false" data-show-caption="false" data-size="xs" data-step="1" value="'+ json[i].promedio +'"></td>');
                            $('#fila' + tmp).append('<td>'+ json[i].status +'</td>');
                            $('#fila' + tmp).append('<td><button class="btn btn-sm btn-warning" name="btnCom'+ tmp +'" id="btnCom'+ tmp +'" onclick="cargarComentarios('+ json[i].id +')"><span class="glyphicon glyphicon-comment"></span> Ver comentarios</button></td>');
                            $('#input-' + tmp).rating({displayOnly : true});
                        })(contador, x);
                        contador++;
                    }
                }
            },
            error : function(respuesta){
                alert(respuesta.responseText);
            }
        });

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
	encabezado.append('<th>Correo</th>');
	encabezado.append('<th>Tipo</th>');
	encabezado.append('<th>Estatus</th>');
	encabezado.append('<th>Editar</th>');

	var cuerpo = $('#tablaCuerpo');
	cuerpo.empty();

	$.ajax({
            type : 'POST',
            url : 'index.php?controlador=usuario&accion=backend',
            dataType: 'json',
            data : {
                offset: 0,
                limit: 10
            },
            success : function(json){
                if($.isEmptyObject(json)){
                    cuerpo.append('<i>No hay resultados...</i>');
                }else{
                    for(var x = 0; x < json.length; x++){
                        (function(i){
                            $('#tablaCuerpo').append('<tr id="fila' + i + '"></tr>');
                            $('#fila' + i).append('<td><input type="checkbox" class="check"></td>');
                            $('#fila' + i).append('<td>'+ json[i].id +'</td>');
                            $('#fila' + i).append('<td><img class="avatar img-circle" src="'+ json[i].avatar +'" alt="'+ json[i].nombre +'"></td>');
                            $('#fila' + i).append('<td><a href="index.php?controlador=usuario&accion=mostrar&usuario='+ json[i].nombre +'">'+ json[i].nombre +'</a></td>');
                            $('#fila' + i).append('<td>'+ json[i].alias +'</td>');
                            $('#fila' + i).append('<td>'+ json[i].correo +'</td>');
                            $('#fila' + i).append('<td>'+ json[i].tipo +'</td>');
                            $('#fila' + i).append('<td>'+ json[i].status +'</td>');
                            $('#fila' + i).append('<td><button class="btn btn-sm btn-warning" name="btnEd'+ i +'" id="btnEd'+ i +'" onclick="editarUsuario('+ json[i].id +')"><span class="glyphicon glyphicon-pencil"></span> Editar</button></td>');
                        })(x);
                    }
                }
            },
            error : function(respuesta){
                alert(respuesta.responseText);
            }
        });

}

function verMasUsuarios(){
	var cuerpo = $('#tablaCuerpo');
	var contador = $('#tablaCuerpo > tr').length + 1;
	
	$.ajax({
            type : 'POST',
            url : 'index.php?controlador=usuario&accion=backend',
            dataType: 'json',
            data : {
                offset: contador,
                limit: 10
            },
            success : function(json){
                if($.isEmptyObject(json)){
                    alert('No hay resultados...');
                }else{
                    for(var x = 0; x < json.length; x++){
                        (function(tmp, i){
                             $('#tablaCuerpo').append('<tr id="fila' + tmp + '"></tr>');
                            $('#fila' + tmp).append('<td><input type="checkbox" class="check"></td>');
                            $('#fila' + tmp).append('<td>'+ json[i].id +'</td>');
                            $('#fila' + tmp).append('<td><img class="img-sm img-circle" src="'+ json[i].avatar +'" alt="'+ json[i].nombre +'"></td>');
                            $('#fila' + tmp).append('<td><a href="index.php?controlador=usuario&accion=mostrar&usuario='+ json[i].nombre +'">'+ json[i].nombre +'</a></td>');
                            $('#fila' + tmp).append('<td>'+ json[i].alias +'</td>');
                            $('#fila' + tmp).append('<td>'+ json[i].correo +'</td>');
                            $('#fila' + tmp).append('<td>'+ json[i].tipo +'</td>');
                            $('#fila' + tmp).append('<td>'+ json[i].status +'</td>');
							$('#fila' + tmp).append('<td><button class="btn btn-sm btn-warning" name="btnEd'+ i +'" id="btnEd'+ i +'" onclick="editarUsuario('+ json[i].id +')"><span class="glyphicon glyphicon-pencil"></span> Editar</button></td>');
                        })(contador, x);
                        contador++;
                    }
                }
            },
            error : function(respuesta){
                alert(respuesta.responseText);
            }
        });
}

function cargarComentarios(id){
	$('#btnVerMas').attr('onclick', 'verMasComentarios('+ id +')');
	$('.galHeader > h2').text('Comentarios');
	var encabezado = $('#tablaEncabezado');
	encabezado.empty();
	encabezado.append('<th><input type="checkbox" id="mainCheck"></th>');
	activaCheckbox();
	encabezado.append('<th>ID</th>');
	encabezado.append('<th>Avatar</th>');
    encabezado.append('<th>Nombre</th>');
    encabezado.append('<th>Comentario</th>');
    encabezado.append('<th>Fecha</th>');
    encabezado.append('<th>Estatus</th>');
    encabezado.append('<th>Enlace</th>');

	var cuerpo = $('#tablaCuerpo');
	cuerpo.empty();
	
	$.ajax({
            type : 'POST',
            url : 'index.php?controlador=imagen&accion=backendComentarios',
            dataType: 'json',
            data : {
            	id: id,
                offset: 0,
                limit: 10
            },
            success : function(json){
                if($.isEmptyObject(json)){
                    cuerpo.append('<i>No hay resultados...</i>');
                }else{
                    for(var x = 0; x < json.length; x++){
                        (function(i){
                            $('#tablaCuerpo').append('<tr id="fila' + i + '"></tr>');
                            $('#fila' + i).append('<td><input type="checkbox" class="check"></td>');
                            $('#fila' + i).append('<td>'+ json[i].id +'</td>');
                            $('#fila' + i).append('<td><img class="avatar img-circle" src="'+ json[i].avatar +'" alt="'+ json[i].nombre +'"></td>');
                            $('#fila' + i).append('<td>'+ json[i].nombre +'</td>');
                            $('#fila' + i).append('<td>'+ json[i].comentario +'</td>');
                            $('#fila' + i).append('<td>'+ json[i].fecha +'</td>');
                            $('#fila' + i).append('<td>'+ json[i].status +'</td>');
                            $('#fila' + i).append('<td><a href="index.php?controlador=imagen&accion=mostrar&img='+ json[i].imagen +'">Ir a publicación</a></td>');
                        })(x);
                    }
                }
            },
            error : function(respuesta){
                alert(respuesta.responseText);
            }
        });

}

function verMasComentarios(id){
	var cuerpo = $('#tablaCuerpo');
	var contador = $('#tablaCuerpo > tr').length + 1;
	
	$.ajax({
            type : 'POST',
            url : 'index.php?controlador=imagen&accion=backendComentarios',
            dataType: 'json',
            data : {
            	id: id,
                offset: contador,
                limit: 10
            },
            success : function(json){
                if($.isEmptyObject(json)){
                    alert('No hay resultados...');
                }else{
                    for(var x = 0; x < json.length; x++){
                        (function(tmp, i){
                            $('#tablaCuerpo').append('<tr id="fila' + tmp + '"></tr>');
                            $('#fila' + tmp).append('<td><input type="checkbox" class="check"></td>');
                            $('#fila' + tmp).append('<td>'+ json[i].id +'</td>');
                            $('#fila' + tmp).append('<td><img class="avatar img-circle" src="'+ json[i].avatar +'" alt="'+ json[i].nombre +'"></td>');
                            $('#fila' + tmp).append('<td>'+ json[i].nombre +'</td>');
                            $('#fila' + tmp).append('<td>'+ json[i].comentario +'</td>');
                            $('#fila' + tmp).append('<td>'+ json[i].fecha +'</td>');
                            $('#fila' + tmp).append('<td>'+ json[i].status +'</td>');
                            $('#fila' + tmp).append('<td><a href="index.php?controlador=imagen&accion=mostrar&img='+ json[i].imagen +'">Ir a publicación</a></td>');
                        })(contador, x);
                        contador++;
                    }
                }
            },
            error : function(respuesta){
                alert(respuesta.responseText);
            }
        });
}

function editarUsuario(id){
	location.href = 'http://localhost/Dragonart/index.php?controlador=usuario&accion=editarAdmin&usr=' + id;
}