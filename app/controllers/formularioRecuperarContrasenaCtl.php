<?php

class formularioRecuperarContrasenaCtl {
    public $modelo;

    function __construct() {
        echo 'Soy formularioRecuperarContrasenaCtl';
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
        include('app/views/formularioRecuperarContrasena.php');
    }
}
?>