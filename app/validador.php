<?php

	if(isset($_POST)){
		if(validarRegistro($_POST)){
			require_once('vistas/usuarioIndex.php');
		}
		else{
			require_once('vistas/formularioRegistrarUsuario.php');
		}
	}
	else{
		require_once('vistas/formularioRegistrarUsuario.php');
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
    *@version 	1.0.1
    *@since 	15/Mayo/2016
    *@param 	$array Arreglo que contiene los datos recibidos desde $_POST
    *@return 	Retorna TRUE si las validaciones de los campos fueron correctas, sino, retorna FALSE.
    */

    function validarRegistro($array){
    	$nombre = $array['nombre'];
    	if(estaVacio($nombre)){
    		return false;
    	}

    	$alias = $array['alias'];
    	if(estaVacio($alias)){
    		return false;
    	}

    	$correo = $array['correo'];
    	if(estaVacio($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL)){
    		return false;
    	}

    	$contrasena = $array['contrasena'];
    	if(estaVacio($contrasena) || strlen($contrasena) < 8){
    		return false;
    	}

    	$contrasenaConfirmacion = $array['contrasenaConfirmacion'];
    	if(estaVacio($contrasenaConfirmacion) || strcmp($contrasena, $contrasenaConfirmacion) !== 0){
    		return false;
    	}

    	return true;
    }
?>