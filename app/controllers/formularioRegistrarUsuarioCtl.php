<?php

class formularioRegistrarUsuarioCtl {
    public $modelo;

    function __construct() {
        echo 'Soy formularioRegistrarUsuarioCtl';
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
        include('app/views/formularioRegistrarUsuario.php');
    }
}
?>