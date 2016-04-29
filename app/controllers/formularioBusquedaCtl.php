<?php

class formularioBusquedaCtl {
    public $modelo;

    function __construct() {
        echo 'Soy formularioBusquedaCtl';
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
        include('app/views/formularioBusqueda.php');
    }
}
?>