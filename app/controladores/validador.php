<?php
	
	class validador{

		function __construct(){}

		/**
	    *<h1>estaVacio</h1>
	    *<p>Esta función evalúa una cadena recibida desde el parámetro $cadena y verifica que no tenga
	    *longitud cero o que esté lleno de caracteres en blanco.</p>
	    *
	    *
	    *@author 	Mauricio Gerardo Lazcano Origel
	    *@version 	1.0.0
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
	    *<h1>validarRegistroUsuario</h1>
	    *<p>Esta función evalúa cada campo enviado en el parámetro $array para tomar cada
	    *campo del formulario de registro de usuario. Evalúa cada uno de estos campos con distintas
	    *reglas como la longitud de la contraseña, no permitir campos llenos con espacios en blanco,
	    *entre otras validaciones.</p>
	    *
	    *
	    *@author 	Mauricio Gerardo Lazcano Origel
	    *@version 	1.2.0
	    *@since 	24/Mayo/2016
	    *@param 	$array Arreglo que contiene los datos recibidos desde $_POST
	    *@return 	Retorna TRUE si las validaciones de los campos fueron correctas, sino, retorna una cadena conteniendo un mensaje de error.
	    */

	    function validarRegistroUsuario($array){
	    	if(isset($array['nombre'])){
		    	$nombre = $array['nombre'];
		    	if(validador::estaVacio($nombre) || !preg_match("/^([a-zA-Z]+\s)*[a-zA-Z]+$/", $nombre)){
		    		return 'El nombre ingresado es erroneo.';
		    	}
	    	}
	    	else{
	    		return 'Debe escribir un nombre.';
	    	}

	    	if(isset($array['alias'])){
		    	$alias = $array['alias'];
		    	if(validador::estaVacio($alias) || !preg_match("/^[a-zA-Z0-9_-]{3,16}$/", $alias)){
		    		return 'El alias ingresado es erroneo.';
		    	}
	    	}
	    	else{
	    		return 'Debe escribir un alias.';
	    	}

	    	if(isset($array['correo'])){
		    	$correo = $array['correo'];
		    	if(validador::estaVacio($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL)){
		    		return 'El correo ingresado es erroneo.';
		    	}
		    }
	    	else{
	    		return 'Debe escribir un correo.';
	    	}

	    	if(isset($array['contrasena'])){
		    	$contrasena = $array['contrasena'];
		    	if(validador::estaVacio($contrasena) || strlen($contrasena) < 8){
		    		return 'La contraseña es erronea.';
		    	}
		    }
	    	else{
	    		return 'Debe escribir una contraseña.';
	    	}

	    	if(isset($array['contrasenaConfirmacion'])){
		    	$contrasenaConfirmacion = $array['contrasenaConfirmacion'];
		    	if(validador::estaVacio($contrasenaConfirmacion) || strcmp($contrasena, $contrasenaConfirmacion) !== 0){
		    		return 'Las contraseñas escritas no son iguales.';
		    	}
		    }
	    	else{
	    		return 'Debe repetir su contraseña.';
	    	}

	        require_once('app/modelos/usuarioMdl.php');
	        $usrMdl = new usuarioMdl();

	        if($usrMdl->existeNombre($array['nombre'])){
	            return 'El nombre ingresado ya existe.';
	        }

	        if($usrMdl->existeCorreo($array['correo'])){
	            return 'El correo ingresado ya existe.';
	        }

	    	return true;
	    }

	}

?>