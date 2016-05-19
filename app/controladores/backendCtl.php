<?php

class backendCtl {
    public $modelo;

    function __construct() {
        echo 'Soy backendCtl';
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
        require_once('app/vistas/backend.php');
    }
}
?>