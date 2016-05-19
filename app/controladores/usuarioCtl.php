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
                    
                case 'perfilusuario':
                    $this->perfilusuario();
                    break;            }
        }
        else {
            $this->alta();
        }
    }
    
    function alta() {
    	if(isset($_POST)){
			if(usuarioCtl::validarRegistro($_POST)){
				require_once('app/vistas/usuarioIndex.php');
			}
			else{
				require_once('app/vistas/formularioRegistrarUsuario.php');
			}
		}
		else{
			require_once('app/vistas/formularioRegistrarUsuario.php');
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
    *@version 	1.1.0
    *@since 	15/Mayo/2016
    *@param 	$array Arreglo que contiene los datos recibidos desde $_POST
    *@return 	Retorna TRUE si las validaciones de los campos fueron correctas, sino, retorna FALSE.
    */

    function validarRegistro($array){
    	if(isset($array['nombre'])){
	    	$nombre = $array['nombre'];
	    	if(usuarioCtl::estaVacio($nombre) || !preg_match("/^([a-zA-Z]+\s)*[a-zA-Z]+$/", $nombre)){
	    		return false;
	    	}
    	}
    	else{
    		return false;
    	}

    	if(isset($array['alias'])){
	    	$alias = $array['alias'];
	    	if(usuarioCtl::estaVacio($alias) || !preg_match("/^[a-z0-9_-]{3,16}$/", $alias)){
	    		return false;
	    	}
    	}
    	else{
    		return false;
    	}

    	if(isset($array['correo'])){
	    	$correo = $array['correo'];
	    	if(usuarioCtl::estaVacio($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL)){
	    		return false;
	    	}
	    }
    	else{
    		return false;
    	}

    	if(isset($array['contrasena'])){
	    	$contrasena = $array['contrasena'];
	    	if(usuarioCtl::estaVacio($contrasena) || strlen($contrasena) < 8){
	    		return false;
	    	}
	    }
    	else{
    		return false;
    	}

    	if(isset($array['contrasenaConfirmacion'])){
	    	$contrasenaConfirmacion = $array['contrasenaConfirmacion'];
	    	if(usuarioCtl::estaVacio($contrasenaConfirmacion) || strcmp($contrasena, $contrasenaConfirmacion) !== 0){
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