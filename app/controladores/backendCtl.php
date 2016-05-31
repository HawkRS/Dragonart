<?php

class backendCtl {
    public $modelo;
    
    private $doctype;
    private $header;
    private $footer;

    function __construct() {
    	session_start();
        
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
                default:
                    $this->mostrar();
                    break;
            }
        }
    }

    function mostrar() {
        require_once('app/controladores/procesadorPlantillas.php');
        $procesador = new procesadorPlantillas();
        require_once('app/modelos/imagenMdl.php');
        $imgMdl = new imagenMdl();

        if(isset($_SESSION['admin']) && $_SESSION['admin'] === 0){
            $infoImagen = $imgMdl->backend(0, 10);

            $vista = file_get_contents('app/vistas/backend.html');
            $vista = $procesador->vistaBackend($this->doctype, $this->header, $vista, $this->footer, $infoImagen);
            echo $vista;
        }else{
            $vista = file_get_contents('app/vistas/404.html');
            $mensaje = 'La página que solicitaste no existe.';
            $vista = $procesador->vistaError404($this->doctype, $this->header, $vista, $this->footer, $mensaje);
            echo $vista;
        }
    }
}
?>