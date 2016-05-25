<?php

if(isset($_GET['controlador'])){
    switch($_GET['controlador']) {
        
        case 'backend':
            require('app/controladores/backendCtl.php');
            $controlador = new backendCtl();
            break;
            
        case 'sesion':
            require('app/controladores/sesionCtl.php');
            $controlador = new sesionCtl();
            break;
            
        case 'usuario':
            require('app/controladores/usuarioCtl.php');
            $controlador = new usuarioCtl();
            break;

        case 'imagen':
            require('app/controladores/imagenCtl.php');
            $controlador = new imagenCtl();
            break;

        case 'paginasestaticas':
            require('app/controladores/paginasestaticasCtl.php');
            $controlador = new paginasestaticasCtl();
            break;

        case 'contacto':
            require('app/controladores/contactoCtl.php');
            $controlador = new contactoCtl();
            break;
        
        case 'notificaciones':
            require('app/controladores/notificacionesCtl.php');
            $controlador = new notificacionesCtl();
            break;

        case 'favorito':
            require('app/controladores/favoritoCtl.php');
            $controlador = new favoritoCtl();
            break;

        default:
            require('app/controladores/imagenCtl.php');
            $controlador = new imagenCtl();
            break;
    }
} else {
    require('app/controladores/imagenCtl.php');
    $controlador = new imagenCtl();
}

$controlador->run();
?>