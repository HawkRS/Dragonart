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
            if(usuarioCtl::validarRegistro($_POST)){
            	require_once('app/vistas/usuarioIndex.php');
        	}
        	else{
        		require_once('app/vistas/formularioRegistrarUsuario.php');
        	}
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

    /**
    *<h1>estaVacio</h1>
    *<p>Esta función evalúa una cadena recibida desde el parámetro $cadena y verifica que no tenga
    *longitud cero o que esté lleno de caracteres en blanco.</p>
    *
    *
    *@author 	Mauricio Gerardo Lazcano Origel
    *@version 	1.0
    *@since 	15/Mayo/2016
    *@param 	$cadena Cadena a evaluar.
    *@return 	Retorna TRUE si las validaciones de los campos fueron correctas, sino, retorna FALSE.
    */

    function estaVacio($cadena){
    	if(strlen($cadena) === 0 || preg_match("/^\s+$/", $cadena)){
    		return true;
    	}
    	return false;
    }

    /**
    *<h1>validarRegistro</h1>
    *<p>Esta función evalúa cada campo enviado en el parámetro $array para tomar cada
    *campo del formulario de registro de usuario. Evalúa cada uno de estos campos con distintas
    *reglas como la longitud de la contraseña, no permitir campos llenos con espacios en blanco,
    *entre otras validaciones.</p>
    *
    *
    *@author 	Mauricio Gerardo Lazcano Origel
    *@version 	1.0
    *@since 	15/Mayo/2016
    *@param 	$array Arreglo que contiene los datos recibidos desde $_POST
    *@return 	Retorna TRUE si las validaciones de los campos fueron correctas, sino, retorna FALSE.
    */

    function validarRegistro($array){
    	$nombre = $array['nombre'];
    	if(!usuarioCtl::estaVacio($nombre)){
    		return false;
    	}

    	$alias = $array['alias'];
    	if(!usuarioCtl::estaVacio($alias)){
    		return false;
    	}

    	$correo = $array['correo'];
    	if(!usuarioCtl::estaVacio($correo) && !preg_match("/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD", $cadena)){
    		return false;
    	}

    	$contrasena = $array['contrasena'];
    	if(!usuarioCtl::estaVacio($contrasena) && strlen($contrasena) >= 8){
    		return false;
    	}

    	$contrasenaConfirmacion = $array['contrasenaConfirmacion'];
    	if(!usuarioCtl::estaVacio($contrasenaConfirmacion) && strcmp($contrasena, $contrasenaConfirmacion) === 0){
    		return false;
    	}

    }
}
?>