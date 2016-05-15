/********************/
/*Seccion seguidores*/
/********************/

function segSelTodos(){
    var contador = $('#panelSeg .panel-body .row .thumbnail').length;
    for(var i = 0; i < contador; i++){
        $('#sCheck-' + i).prop('checked', true);
    }
}

function segInvertir(){
    var contador = $('#panelSeg .panel-body .row .thumbnail').length;
    for(var i = 0; i < contador; i++){
        if($('#sCheck-' + i).prop('checked')){
            $('#sCheck-' + i).prop('checked', false);
        }
        else{
            $('#sCheck-' + i).prop('checked', true);
        }
    }
}

function segQuitar(){
    var contador = $('#panelSeg .panel-body .row')
        .find('.thumbnail')
        .length;
    for(var i = 0; i < contador; i++){
        if($('#sCheck-' + i).prop('checked')){
            $('#avatar' + i).remove();
        }
    }

    var tempDiv = $('#panelSeg .panel-body .row > div');
    var tempCheck = $('#panelSeg .panel-body .row').find('input:checkbox');

    for(var i = 0; i < contador; i++){
        tempCheck.eq(i).attr('id','sCheck-' + i);
        tempCheck.eq(i).attr('name','sCheck-' + i);
        tempDiv.eq(i).attr('id','avatar' + i);
        tempDiv.eq(i).attr('name','avatar' + i);
    }

    if(tempDiv.length === 0){
        $('#panelSeg').remove();
        if($('.main-usrIndex div').length === 0){
            $('.main-usrIndex').append('<h3>No hay notificaciones nuevas.</h3>');
        }
    }
    
}

/*************************/
/*Seccion Imagenes nuevas*/
/*************************/

function galSelTodos(){
    var contador = $('#panelGal .panel-body .row')
        .find('.thumbnail')
        .length;
    for(var i = 0; i < contador; i++){
        $('#gCheck-' + i).prop('checked', true);
    }
}

function galInvertir(){
    var contador = $('#panelGal .panel-body .row')
        .find('.thumbnail')
        .length;
    for(var i = 0; i < contador; i++){
        if($('#gCheck-' + i).prop('checked')){
            $('#gCheck-' + i).prop('checked', false);
        }
        else{
            $('#gCheck-' + i).prop('checked', true);
        }
    }
}

function galQuitar(){
    var contador = $('#panelGal .panel-body .row')
        .find('.thumbnail')
        .length;
    for(var i = 0; i < contador; i++){
        if($('#gCheck-' + i).prop('checked')){
            $('#image' + i).remove();
        }
    }

    var tempDiv = $('#panelGal .panel-body .row > div');
    var tempCheck = $('#panelGal .panel-body .row').find('input:checkbox');
    var tempStar = $('#panelGal .panel-body .row').find('.rating-container input');

    for(var i = 0; i < contador; i++){
        tempCheck.eq(i).attr('id','gCheck-' + i);
        tempCheck.eq(i).attr('name','gCheck-' + i);
        tempStar.eq(i).attr('id','input-' + i);
        tempDiv.eq(i).attr('id','image' + i);
        tempDiv.eq(i).attr('name','image' + i);
    }

    if(tempDiv.length === 0){
        $('#panelGal').remove();
        if($('.main-usrIndex div').length === 0){
            $('.main-usrIndex').append('<h3>No hay notificaciones nuevas.</h3>');
        }
    }
    
}

/*********************/
/*Seccion comentarios*/
/*********************/

function comSelTodos(){
    var contador = $('.panel-body > .panel').length;
    for(var i = 0; i < contador; i++){
        $('#cCheck-' + i).prop('checked', true);
    }
}

function comInvertir(){
    var contador = $('.panel-body > .panel').length;
    for(var i = 0; i < contador; i++){
        if($('#cCheck-' + i).prop('checked')){
            $('#cCheck-' + i).prop('checked', false);
        }
        else{
            $('#cCheck-' + i).prop('checked', true);
        }
    }
}

function comQuitar(){
    var contador = $('.panel-body > .panel').length;
    var temp = $('.panel-body > .panel');
    for(var i = 0; i < contador; i++){
        if($('#cCheck-' + i).prop('checked')){
            temp.eq(i).remove();
        }
    }
    for(var i = 0; i < contador; i++){
        $('.panel-body > .panel').find('input').eq(i).attr('id','cCheck-' + i);
        $('.panel-body > .panel').find('input').eq(i).attr('name','cCheck-' + i);
    }

    if($('.panel-body > .panel').length === 0){
        $('#panelCom').remove();
        if($('.main-usrIndex div').length === 0){
            $('.main-usrIndex').append('<h3>No hay notificaciones nuevas.</h3>');
        }
    }
}

/*******************/
/*Seccion favoritos*/
/*******************/

function favSelTodos(){
    var contador = $('#favGrupo > a').length;
    for(var i = 0; i < contador; i++){
        $('#fCheck-' + i).prop('checked', true);
    }
}

function favInvertir(){
    var contador = $('#favGrupo > a').length;
    for(var i = 0; i < contador; i++){
        if($('#fCheck-' + i).prop('checked')){
            $('#fCheck-' + i).prop('checked', false);
        }
        else{
            $('#fCheck-' + i).prop('checked', true);
        }
    }
}

function favQuitar(){
    var contador = $('#favGrupo > a').length;
    var temp = $('#favGrupo > a');
    for(var i = 0; i < contador; i++){
        if($('#fCheck-' + i).prop('checked')){
            temp.eq(i).remove();
        }
    }
    for(var i = 0; i < contador; i++){
        $('#favGrupo > a').find('input').eq(i).attr('id','fCheck-' + i);
        $('#favGrupo > a').find('input').eq(i).attr('name','fCheck-' + i);
    }

    if($('#favGrupo > a').length === 0){
        $('#panelFav').remove();
        if($('.main-usrIndex div').length === 0){
            $('.main-usrIndex').append('<h3>No hay notificaciones nuevas.</h3>');
        }
    }
}