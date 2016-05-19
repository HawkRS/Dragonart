<?php

class sesionCtl {
    public $modelo;

    function __construct() {
        echo 'Soy sesionCtl';
    }

    function run() {
        if(isset($_GET['accion'])) {
            switch($_GET['accion']) {
                    
                case 'iniciarsesion':
                    $this->iniciarsesion();
                    break;
                    
                case 'recuperarcontrasenacorreo':
                    $this->recuperarcontrasenacorreo();
                    break;
                    
                case 'recuperarcontrasena':
                    $this->recuperarcontrasena();
                    break;
            }
        }
        else {
            $this->iniciarsesion();
        }
    }
    
    function iniciarsesion() {
        require_once('app/vistas/formularioIniciarSesion.php');
    }
    
    function recuperarcontrasenacorreo() {
        require_once('app/vistas/formularioRecuperarContrasenaCorreo.php');
    }
    
    function recuperarcontrasena() {
        require_once('app/vistas/formularioRecuperarContrasena.php');
    }
    
}
?>