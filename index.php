<?php

if(isset($_GET['controlador'])){
    switch($_GET['controlador']) {
        case 'formularioBusqueda':
            require('app/controllers/formularioBusquedaCtl.php');
            $controlador = new formularioBusquedaCtl();
            break;

        case 'formularioConfiguracionUsuario':
            require('app/controllers/formularioConfiguracionUsuarioCtl.php');
            $controlador = new formularioConfiguracionUsuarioCtl();
            break;

        case 'formularioContacto':
            require('app/controllers/formularioContactoCtl.php');
            $controlador = new formularioContactoCtl();
            break;

        case 'formularioImagen':
            require('app/controllers/formularioImagenCtl.php');
            $controlador = new formularioImagenCtl();
            break;

        case 'formularioIniciarSesion':
            require('app/controllers/formularioIniciarSesionCtl.php');
            $controlador = new formularioIniciarSesionCtl();
            break;

        case 'formularioRecuperarContrasena':
            require('app/controllers/formularioRecuperarContrasenaCtl.php');
            $controlador = new formularioRecuperarContrasenaCtl();
            break;

        case 'formularioRecuperarContrasenaCorreo':
            require('app/controllers/formularioRecuperarContrasenaCorreoCtl.php');
            $controlador = new formularioRecuperarContrasenaCorreoCtl();
            break;

        case 'formularioRegistrarUsuario':
            require('app/controllers/formularioRegistrarUsuarioCtl.php');
            $controlador = new formularioRegistrarUsuarioCtl();
            break;

        case 'galeria':
            require('app/controllers/galeriaCtl.php');
            $controlador = new galeriaCtl();
            break;

        case 'notificaciones':
            require('app/controllers/notificacionesCtl.php');
            $controlador = new notificacionesCtl();
            break;

        case 'politicaCargaImagenes':
            require('app/controllers/politicaCargaImagenesCtl.php');
            $controlador = new politicaCargaImagenesCtl();
            break;

        case 'principal':
            require('app/controllers/principalCtl.php');
            $controlador = new principalCtl();
            break;

        case 'publicacionIndex':
            require('app/controllers/publicacionIndexCtl.php');
            $controlador = new publicacionIndexCtl();
            break;

        case 'terminosCondiciones':
            require('app/controllers/terminosCondicionesCtl.php');
            $controlador = new terminosCondicionesCtl();
            break;

        case 'usuarioIndex':
            require('app/controllers/usuarioIndexCtl.php');
            $controlador = new usuarioIndexCtl();
            break;

        default:
            require('app/controllers/principalCtl.php');
            $controlador = new principalCtl();
            break;
    }
} else {
    require('app/controllers/principalCtl.php');
    $controlador = new principalCtl();
}

$controlador->run();
?>