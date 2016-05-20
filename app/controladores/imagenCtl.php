<?php

class imagenCtl {
    public $modelo;

    function __construct() {
    	session_start();
        echo 'Soy imagenCtl';
    }

    function run() {
        if(isset($_GET['accion'])) {
            switch($_GET['accion']) {
                case 'alta':
                    $this->alta();
                    break;
                    
                case 'mostrar':
                    $this->mostrar();
                    break;
                    
                case 'inicio':
                    $this->inicio();
                    break;
            }
        }
        else {
            $this->inicio();
        }
    }
    
    function alta() {
        require_once('app/vistas/formularioImagen.php');
    }

    function inicio() {
        require_once('app/vistas/principal.php');
    }
    
    function mostrar() {
        require_once('app/vistas/publicacionIndex.php');
    }
}
?>