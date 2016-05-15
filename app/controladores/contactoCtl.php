<?php

class contactoCtl {
    public $modelo;

    function __construct() {
        echo 'Soy contactoCtl';
    }

    function run() {
        if(isset($_GET['accion'])) {
            switch($_GET['accion']) {
                case 'mostrar':
                    $this->mostrar();
                    break;
            }
        }else {
            $this->mostrar();
        }
    }

    function mostrar() {
        require_once('app/vistas/formularioContacto.php');
    }
}
?>