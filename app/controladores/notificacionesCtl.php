<?php

class notificacionesCtl {
    public $modelo;

    function __construct() {
        echo 'Soy notificacionesCtl';
    }

    function run() {
        if(isset($_GET['accion'])) {
            switch($_GET['accion']) {                    
                case 'mostrar':
                    $this->mostrar();
            }
        }
        else {
            $this->mostrar();
        }
    }

    function mostrar() {
        require_once('app/vistas/notificaciones.php');
    }
}
?>