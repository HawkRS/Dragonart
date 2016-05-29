<?php

class notificacionesCtl {
    public $modelo;
    
    private $doctype;
    private $header;
    private $footer;

    function __construct() {
    	session_start();
        echo 'Soy notificacionesCtl';
        $this->doctype = file_get_contents('app/vistas/doctype.html');
        $this->header = file_get_contents('app/vistas/header.html');
        $this->footer = file_get_contents('app/vistas/footer.html');
    }

    function run() {
        if(isset($_GET['accion'])) {
            switch($_GET['accion']) {                    
                case 'mostrar':
                    $this->mostrar();
                    break;
            }
        }
        else {
            $this->mostrar();
        }
    }

    function mostrar() {
        require_once('app/controladores/procesadorPlantillas.php');
        $procesador = new procesadorPlantillas();

        if(isset($_SESSION['correo']) && isset($_SESSION['logPass'])){
            require_once('app/modelos/usuarioMdl.php');
            $usrMdl = new usuarioMdl();
            require_once('app/modelos/notificacionMdl.php');
            $ntfMdl = new notificacionMdl();

            $infoUsuario = $usrMdl->obtenerInfo($_SESSION['correo'], $_SESSION['logPass']);
            $notifSeguidores = $ntfMdl->obtenerSeguidores($infoUsuario['id']);
            $notifImagenes = $ntfMdl->obtenerImagenes($infoUsuario['id']);
            $notifComentarios = $ntfMdl->obtenerComentarios($infoUsuario['id']);
            $notifFavoritos = $ntfMdl->obtenerFavoritos($infoUsuario['id']);

            $vista = file_get_contents('app/vistas/notificaciones.html');
            $vista = $procesador->vistaNotificaciones($this->doctype, $this->header, $vista, $this->footer, $notifSeguidores, $notifImagenes, $notifComentarios, $notifFavoritos);
        }else{
            $vista = file_get_contents('app/vistas/404.html');
            $mensaje = 'Debes iniciar sesión para ver tus notificaciones.';
            $vista = $procesador->vistaError404($this->doctype, $this->header, $vista, $this->footer, $mensaje);
        }

        echo $vista;
    }
}
?>