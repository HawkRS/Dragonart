<?php

if(isset($_GET['controlador'])){
    switch($_GET['controlador']) {
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