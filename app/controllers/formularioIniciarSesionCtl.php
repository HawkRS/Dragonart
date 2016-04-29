<?php

class formularioIniciarSesionCtl {
    public $modelo;

    function __construct() {
        echo 'Soy formularioIniciarSesionCtl';
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
        include('app/views/formularioIniciarSesion.php');
    }
}
?>