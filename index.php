<?php

if(isset($_GET['buscar']) && strlen($_GET['buscar']) > 0){
    
    resultadoBusqueda();    
    
}else{

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

}

function resultadoBusqueda(){
    session_start();
    require_once('app/controladores/procesadorPlantillas.php');
    $procesador = new procesadorPlantillas();
    require_once('app/modelos/imagenMdl.php');
    $imgMdl = new imagenMdl();

    $resImagenes = $imgMdl->busquedaImagenTitulo($_GET['buscar'], 0, 8);

    $doctype = file_get_contents('app/vistas/doctype.html');
    $header = file_get_contents('app/vistas/header.html');
    $vista = file_get_contents('app/vistas/formularioBusqueda.html');
    $footer = file_get_contents('app/vistas/footer.html');
    $vista = $procesador->vistaBusqueda($doctype, $header, $vista, $footer, $resImagenes);
    echo $vista;

}

?>