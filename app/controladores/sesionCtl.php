<?php

class sesionCtl {
    public $modelo;

    function __construct() {
        session_start();
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
        if(isset($_POST)){
            if(sesionCtl::validarSesion($_POST)){
                require_once('app/modelos/usuarioMdl.php');
                $usrMdl = new usuarioMdl();
                if($usrMdl->iniciarSesion($_POST['correo'],$_POST['logPass'])){
                    $_SESSION['correo'] = $_POST['correo'];
                    $_SESSION['logPass'] = $_POST['logPass'];
                    require_once('app/vistas/usuarioIndex.php');
                }
                else{
                    unset($_SESSION['correo']);
                    unset($_SESSION['logPass']);
                    var_dump($_POST);
                    require_once('app/vistas/formularioIniciarSesion.php');
                }
            }
            else{
                require_once('app/vistas/formularioIniciarSesion.php');
            }
        }
        else{
            require_once('app/vistas/formularioIniciarSesion.php');
        }
    }
    
    function recuperarcontrasenacorreo() {
        require_once('app/vistas/formularioRecuperarContrasenaCorreo.php');
    }
    
    function recuperarcontrasena() {
        require_once('app/vistas/formularioRecuperarContrasena.php');
    }
    
    /**
    *<h1>estaVacio</h1>
    *<p>Esta función evalúa una cadena recibida desde el parámetro $cadena y verifica que no tenga
    *longitud cero o que esté lleno de caracteres en blanco.</p>
    *
    *
    *@author    Mauricio Gerardo Lazcano Origel
    *@version   1.0.0
    *@since     19/Mayo/2016
    *@param     $cadena Cadena a evaluar.
    *@return    Retorna TRUE si las validaciones de los campos fueron correctas, sino, retorna FALSE.
    */

    function estaVacio($cadena){
        if(strlen($cadena) === 0 || preg_match("/^\s+$/", $cadena)){
            return true;
        }
        return false;
    }

    /**
    *<h1>validarSesion</h1>
    *<p>Esta función evalúa cada campo enviado en el parámetro $array para tomar cada
    *campo del formulario de inicio de sesión. Evalúa cada uno de estos campos con distintas
    *reglas como la longitud de la contraseña, no permitir campos llenos con espacios en blanco,
    *entre otras validaciones.</p>
    *
    *
    *@author    Mauricio Gerardo Lazcano Origel
    *@version   1.0.0
    *@since     15/Mayo/2016
    *@param     $array Arreglo que contiene los datos recibidos desde $_POST
    *@return    Retorna TRUE si las validaciones de los campos fueron correctas, sino, retorna FALSE.
    */

    function validarSesion($array){
        if(isset($array['correo'])){
            $correo = $array['correo'];
            if(sesionCtl::estaVacio($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL)){
                return false;
            }
        }
        else{
            return false;
        }

        if(isset($array['logPass'])){
            $contrasena = $array['logPass'];
            if(sesionCtl::estaVacio($contrasena) || strlen($contrasena) < 8){
                return false;
            }
        }
        else{
            return false;
        }

        return true;
    }
}
?>