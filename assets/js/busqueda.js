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

function buscarTitulo(){
    var contadorFilas = 0;
    var contadorImagen = 0;
    var limite = 4;

    $('#postDesc').empty();

    $.ajax({
            type : 'POST',
            url : 'index.php?controlador=imagen&accion=buscarTitulo',
            dataType: 'json',
            data : {
                buscar: $('#inputBuscar').val(),
                offset: 0,
                limit: 8
            },
            success : function(json){
                if($.isEmptyObject(json)){
                    $('#postDesc').append('<i>No hay resultados...</i>');
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
                                    .append('<span id="titulo'+ tmp +'">'+ json[tmp].titulo +'</span>')
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

function buscarDescripcion(){
    var contadorFilas = 0;
    var contadorImagen = 0;
    var limite = 4;

    $('#postDesc').empty();

    $.ajax({
            type : 'POST',
            url : 'index.php?controlador=imagen&accion=buscarDescripcion',
            dataType: 'json',
            data : {
                buscar: $('#inputBuscar').val(),
                offset: 0,
                limit: 8
            },
            success : function(json){
                if($.isEmptyObject(json)){
                    $('#postDesc').append('<i>No hay resultados...</i>');
                }else{
                    if(json.length <= 4){
                        var limiteFilas = 1;
                    }else if(json.length > 4 && json.length <=8){
                        var limiteFilas = 2;
                    }

                    console.log(limiteFilas+' '+contadorFilas);
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
                                    .append('<span id="titulo'+ tmp +'">'+ json[tmp].titulo +'</span>')
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

function buscarTags(){
    var contadorFilas = 0;
    var contadorImagen = 0;
    var limite = 4;

    $('#postDesc').empty();

    $.ajax({
            type : 'POST',
            url : 'index.php?controlador=imagen&accion=buscarTags',
            dataType: 'json',
            data : {
                buscar: $('#inputBuscar').val(),
                offset: 0,
                limit: 8
            },
            success : function(json){
                if($.isEmptyObject(json)){
                    $('#postDesc').append('<i>No hay resultados...</i>');
                }else{
                    if(json.length <= 4){
                        var limiteFilas = 1;
                    }else if(json.length > 4 && json.length <=8){
                        var limiteFilas = 2;
                    }

                    console.log(limiteFilas+' '+contadorFilas);
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
                                    .append('<span id="titulo'+ tmp +'">'+ json[tmp].titulo +'</span>')
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
                alert(respuesta.responseText);
            }
        });
}

function buscarNombre(){
    var contadorFilas = 0;
    var contadorImagen = 0;
    var limite = 4;

    $('#postDesc').empty();

    $.ajax({
            type : 'POST',
            url : 'index.php?controlador=usuario&accion=buscarNombre',
            dataType: 'json',
            data : {
                buscar: $('#inputBuscar').val(),
                offset: 0,
                limit: 8
            },
            success : function(json){
                if($.isEmptyObject(json)){
                    $('#postDesc').append('<i>No hay resultados...</i>');
                }else{
                    if(json.length <= 4){
                        var limiteFilas = 1;
                    }else if(json.length > 4 && json.length <=8){
                        var limiteFilas = 2;
                    }

                    while(contadorFilas < limiteFilas){
                        $('#postDesc').append('<div id="fila' + contadorFilas + '" class="row"></div>');
                        while(contadorImagen < limite && contadorImagen < json.length){
                console.log(json);
                            (function(tmp, tmpFila){
                                $('#fila' + tmpFila).append('<div id="avatar' + tmp + '" name="avatar' + tmp + '" class="col-sm-6 col-md-3"></div>');
                                $('#avatar' + tmp).append('<div class="thumbnail"></div>');
                                $('#avatar' + tmp + ' .thumbnail')
                                    .append('<a href="index.php?controlador=usuario&accion=mostrar&usuario='+ json[tmp].nombre +'"></a>')
                                    .append('<div class="caption text-center"></div>');
                                $('#avatar' + tmp + ' .thumbnail > div')
                                    .append('<span id="titulo'+ tmp +'">'+ json[tmp].nombre +'</span>');
                                $('#avatar' + tmp + ' .thumbnail > a')
                                    .append('<img class="avatar img-circle" src="'+ json[tmp].avatar +'" alt="'+ json[tmp].nombre +'" />');
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

function buscarAlias(){
    var contadorFilas = 0;
    var contadorImagen = 0;
    var limite = 4;

    $('#postDesc').empty();

    $.ajax({
            type : 'POST',
            url : 'index.php?controlador=usuario&accion=buscarAlias',
            dataType: 'json',
            data : {
                buscar: $('#inputBuscar').val(),
                offset: 0,
                limit: 8
            },
            success : function(json){
                if($.isEmptyObject(json)){
                    $('#postDesc').append('<i>No hay resultados...</i>');
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
                                $('#fila' + tmpFila).append('<div id="avatar' + tmp + '" name="avatar' + tmp + '" class="col-sm-6 col-md-3"></div>');
                                $('#avatar' + tmp).append('<div class="thumbnail"></div>');
                                $('#avatar' + tmp + ' .thumbnail')
                                    .append('<a href="index.php?controlador=usuario&accion=mostrar&usuario='+ json[tmp].nombre +'"></a>')
                                    .append('<div class="caption text-center"></div>');
                                $('#avatar' + tmp + ' .thumbnail > div')
                                    .append('<span id="titulo'+ tmp +'">'+ json[tmp].nombre +'</span>');
                                $('#avatar' + tmp + ' .thumbnail > a')
                                    .append('<img class="avatar img-circle" src="'+ json[tmp].avatar +'" alt="'+ json[tmp].nombre +'" />');
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

function buscarComentario(){
    var contadorFilas = 0;
    var contadorImagen = 0;
    var limite = 8;

    $('#postDesc').empty();

    $.ajax({
            type : 'POST',
            url : 'index.php?controlador=imagen&accion=buscarComentario',
            dataType: 'json',
            data : {
                buscar: $('#inputBuscar').val(),
                offset: 0,
                limit: 8
            },
            success : function(json){
                if($.isEmptyObject(json)){
                    $('#postDesc').append('<i>No hay resultados...</i>');
                }else{
                    $('#postDesc').append('<div class="table-responsive"></div>');
                    $('#postDesc .table-responsive')
                        .append('<table class="table table-hover"></table>');
                    $('#postDesc .table')
                        .append('<thead></thead>');
                    $('#postDesc thead')
                        .append('<tr id="tablaEncabezado"></tr>');
                    var encabezado = $('#tablaEncabezado');
                    encabezado.append('<th>Avatar</th>');
                    encabezado.append('<th>Nombre</th>');
                    encabezado.append('<th>Comentario</th>');
                    encabezado.append('<th>Fecha</th>');
                    encabezado.append('<th>Enlace</th>');
                    $('#postDesc .table')
                        .append('<tbody id="tablaCuerpo"></tbody>');
                    while(contadorImagen < limite && contadorImagen < json.length){
                        (function(tmp){
                            $('#tablaCuerpo').append('<tr id="fila' + tmp + '"></tr>');
                            $('#fila' + tmp).append('<td><img class="avatar img-circle" src="'+ json[tmp].avatar +'" alt="'+ json[tmp].nombreUsuario +'"></td>');
                            $('#fila' + tmp).append('<td>'+ json[tmp].nombreUsuario +'</td>');
                            $('#fila' + tmp).append('<td>'+ json[tmp].comentario +'</td>');
                            $('#fila' + tmp).append('<td>'+ json[tmp].fecha +'</td>');
                            $('#fila' + tmp).append('<td><a href="index.php?controlador=imagen&accion=mostrar&img='+ json[tmp].imagen +'">Ir a publicación</a></td>');
                        })(contadorImagen);
                        contadorImagen++;
                    }
                }
            },
            error : function(respuesta){
                alert(respuesta.responseText);
            }
        });
}

function verMasResultados(){
    var contadorFilas = $('#postDesc .row').length;
    var contadorInputs = $('#postDesc .row .thumbnail').length + 1;
    var clon = $('#fila0').clone();
    var bandera = false;

    clon.attr('id', 'fila' + contadorFilas);

    if(clon.find('#image0').length > 0){
        if($('.galHeader > h2').text() === 'Resultado de imágenes por título'){
            $.ajax({
                    type : 'POST',
                    url : 'index.php?controlador=imagen&accion=buscarTitulo',
                    dataType: 'json',
                    data : {
                        buscar: $('#inputBuscar').val(),
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
        }if($('.galHeader > h2').text() === 'Resultado de imágenes por descripción'){
            $.ajax({
                    type : 'POST',
                    url : 'index.php?controlador=imagen&accion=buscarDescripcion',
                    dataType: 'json',
                    data : {
                        buscar: $('#inputBuscar').val(),
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
        }if($('.galHeader > h2').text() === 'Resultado de imágenes por tag'){
            $.ajax({
                    type : 'POST',
                    url : 'index.php?controlador=imagen&accion=buscarTags',
                    dataType: 'json',
                    data : {
                        buscar: $('#inputBuscar').val(),
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
        }

    }else{
        if($('.galHeader > h2').text() === 'Resultado de usuarios por nombre'){
            $.ajax({
                    type : 'POST',
                    url : 'index.php?controlador=usuario&accion=buscarNombre',
                    dataType: 'json',
                    data : {
                        buscar: $('#inputBuscar').val(),
                        offset: contadorInputs,
                        limit: 4
                    },
                    success : function(json){
                        if($.isEmptyObject(json)){
                            alert('No hay mas usuarios.');
                        }else{
                            for(var i = 0; i < json.length; i++){
                                (function(tmp, cont){
                                    clon.find('#avatar' + tmp).attr('id','image' + cont);
                                    clon.find('#avatar' + cont).attr('name','avatar' + cont);
                                    clon.find('#avatar' + cont).find('img').attr('src',json[tmp].avatar);
                                    clon.find('#avatar' + cont).find('img').attr('alt',json[tmp].nombre);
                                    clon.find('#avatar' + cont).find('a').attr('href','index.php?controlador=usuario&accion=mostrar&usuario='+json[tmp].nombre);
                                    clon.find('#avatar' + cont).find('#titulo' + tmp).text(json[tmp].nombre);
                                })(i, contadorInputs);
                                contadorInputs++;
                            }

                            if(json.length < 4){
                                var Eliminar = 0;
                                while(Eliminar !== 4){
                                    clon.find('#avatar' + Eliminar).remove();
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
        }if($('.galHeader > h2').text() === 'Resultado de usuarios por alias'){
            $.ajax({
                    type : 'POST',
                    url : 'index.php?controlador=usuario&accion=buscarAlias',
                    dataType: 'json',
                    data : {
                        buscar: $('#inputBuscar').val(),
                        offset: contadorInputs,
                        limit: 4
                    },
                    success : function(json){
                        if($.isEmptyObject(json)){
                            alert('No hay mas usuarios.');
                        }else{
                            for(var i = 0; i < json.length; i++){
                                (function(tmp, cont){
                                    clon.find('#avatar' + tmp).attr('id','image' + cont);
                                    clon.find('#avatar' + cont).attr('name','avatar' + cont);
                                    clon.find('#avatar' + cont).find('img').attr('src',json[tmp].avatar);
                                    clon.find('#avatar' + cont).find('img').attr('alt',json[tmp].nombre);
                                    clon.find('#avatar' + cont).find('a').attr('href','index.php?controlador=usuario&accion=mostrar&usuario='+json[tmp].nombre);
                                    clon.find('#avatar' + cont).find('#titulo' + tmp).text(json[tmp].nombre);
                                })(i, contadorInputs);
                                contadorInputs++;
                            }

                            if(json.length < 4){
                                var Eliminar = 0;
                                while(Eliminar !== 4){
                                    clon.find('#avatar' + Eliminar).remove();
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
        }if($('.galHeader > h2').text() === 'Resultado de comentarios'){
            var contadorInputs = $('#tablaCuerpo tr').length + 1;
            $.ajax({
                type : 'POST',
                url : 'index.php?controlador=imagen&accion=buscarComentario',
                dataType: 'json',
                data : {
                    buscar: $('#inputBuscar').val(),
                    offset: contadorInputs,
                    limit: 8
                },
                success : function(json){
                    if($.isEmptyObject(json)){
                        alert('No hay mas comentarios.');
                    }else{
                        for(var i = 0; i < json.length; i++){
                            (function(tmp){
                                $('#tablaCuerpo').append('<tr id="fila' + tmp + '"></tr>');
                                $('#fila' + tmp).append('<td><img class="avatar img-circle" src="'+ json[tmp].avatar +'" alt="'+ json[tmp].nombreUsuario +'"></td>');
                                $('#fila' + tmp).append('<td>'+ json[tmp].nombreUsuario +'</td>');
                                $('#fila' + tmp).append('<td>'+ json[tmp].comentario +'</td>');
                                $('#fila' + tmp).append('<td>'+ json[tmp].fecha +'</td>');
                                $('#fila' + tmp).append('<td><a href="index.php?controlador=imagen&accion=mostrar&img='+ json[tmp].imagen +'">Ir a publicación</a></td>');
                            })(contadorInputs);
                            contadorInputs++;
                        }
                    }
                },
                error : function(respuesta){
                    alert('Hubo un error al procesar su solicitud. Por favor, Inténtelo más tarde.');
                }
            });
        }
    }
}