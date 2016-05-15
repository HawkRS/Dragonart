<?php

class usuarioCtl {
    public $modelo;

    function __construct() {
        echo 'Soy usuarioCtl';
    }

    function run() {
        if(isset($_GET['accion'])) {
            switch($_GET['accion']) {
                case 'alta':
                    $this->alta();
                    break;
                    
                case 'modificar':
                    $this->modificar();
                    break;
                    
                case 'mostrar':
                    $this->mostrar();
                    break;
                    
                case 'iniciarsesion':
                    $this->iniciarsesion();
                    break;
                    
                case 'perfilusuario':
                    $this->perfilusuario();
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
            $this->alta();
        }
    }
    
    function alta() {
        if(empty($_POST)){
            require_once('app/vistas/formularioRegistrarUsuario.php');
        } 
        else {
            $nombre = $_POST["nombre"];
            $alias = $_POST["alias"];
            $correo = $_POST["correo"];
            $contrasena = $_POST["contrasena"];
            $contrasenaConfirmacion = $_POST["contrasenaConfirmacion"];
            
            require_once('app/vistas/usuarioIndex.php');
        }
    }
    
    function modificar() {
        if(empty($_POST)){
            require_once('app/vistas/formularioConfiguracionUsuario.php');
        } 
        else {            
            require_once('app/vistas/usuarioIndex.php');
        }
    }
    
    function mostrar() {
        require_once('app/vistas/usuarioIndex.php');
    }
    
    function iniciarsesion() {
        require_once('app/vistas/formularioIniciarSesion.php');
    }
    
    function perfilusuario() {
        require_once('app/vistas/usuarioIndex.php');
    }
    
    function recuperarcontrasenacorreo() {
        require_once('app/vistas/formularioRecuperarContrasenaCorreo.php');
    }
    
    function recuperarcontrasena() {
        require_once('app/vistas/formularioRecuperarContrasena.php');
    }
}
?>