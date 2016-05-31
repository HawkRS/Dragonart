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
		    	if(validador::estaVacio($alias) || !preg_match("/^[a-zA-Z][a-zA-Z0-9_-]*$/", $alias)){
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

	    function validarRegistroUsuarioAdmon($array){
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
		    	if(validador::estaVacio($alias) || !preg_match("/^[a-zA-Z][a-zA-Z0-9_-]*$/", $alias)){
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

	    	if(isset($array['tipo'])){
		    	if($array['tipo'] < 0 || $array['tipo'] > 1){
		    		return 'Debe elegir un tipo válido de usuario.';
		    	}
		    }
	    	else{
	    		return 'Debe elegir un tipo de usuario.';
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

	    function validarSesion($array){
	        if(isset($array['correo'])){
	            $correo = $array['correo'];
	            if(validador::estaVacio($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL)){
	                return 'El correo ingresado no es válido.';
	            }
	        }
	        else{
	            return 'Debes ingresar un correo.';
	        }

	        if(isset($array['logPass'])){
	            $contrasena = $array['logPass'];
	            if(validador::estaVacio($contrasena) || strlen($contrasena) < 8){
	                return 'La contraseña escrita no es válida.';
	            }
	        }
	        else{
	            return 'Debes escribir una contraseña.';
	        }

	        return true;
	    }

	    function validarCorreoParaNuevaContrasena($array){
	    	if(isset($array['correo'])){
	            $correo = $array['correo'];
	            if(validador::estaVacio($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL)){
	                return 'El correo ingresado no es válido.';
	            }
	        }
	        else{
	            return 'Debes ingresar un correo.';
	        }

	        return true;
	    }

	    function validarRegistroImagen($array){
	        if(isset($array['titulo'])){
	            if(validador::estaVacio($array['titulo'])){
	                return 'El título no debe llevar solamente espacios en blanco.';
	            }
	        }
	        else{
	            return 'Debe escribir un título.';
	        }

	        if(isset($array['descripcion'])){
	        	if(validador::estaVacio($array['descripcion'])){
	                return 'La descripción no debe llevar solamente espacios en blanco.';
	            }
	        }
	        else{
	        	return 'Debe escribir una descripción.';
	        }

	        if(isset($array['tags'])){
	            $tags = $array['tags'];
	            if(validador::estaVacio($tags) || !preg_match("/^[a-zA-Z]*([a-zA-Z0-9]|\s)+$/", $tags)){
	                return 'Los tags no deben ser solamente espacios en blanco.';
	            }
	        }
	        else{
	            return 'Debe escribir al menos un tag.';
	        }

	        $mensaje = validador::validarArchivoCargado('imagen', 10485760);
	        if($mensaje !== true){
	        	return $mensaje;
	        }

	        return true;
	    }

	    function validarModificacionImagen($array){
	        if(isset($array['titulo'])){
	            if(validador::estaVacio($array['titulo'])){
	                return 'El título no debe llevar solamente espacios en blanco.';
	            }
	        }
	        else{
	            return 'Debe escribir un título.';
	        }

	        if(isset($array['descripcion'])){
	        	if(validador::estaVacio($array['descripcion'])){
	                return 'La descripción no debe llevar solamente espacios en blanco.';
	            }
	        }
	        else{
	        	return 'Debe escribir una descripción.';
	        }

	        if(isset($array['tags'])){
	            $tags = $array['tags'];
	            if(validador::estaVacio($tags) || !preg_match("/^[a-zA-Z]*([a-zA-Z0-9]|\s)+$/", $tags)){
	                return 'Los tags no deben ser solamente espacios en blanco.';
	            }
	        }
	        else{
	            return 'Debe escribir al menos un tag.';
	        }

	        return true;
	    }

	    function validarModificacionUsuario($array){
	    	$hayPass = false;

	    	if(isset($array['alias'])){
		    	$alias = $array['alias'];
		    	if(validador::estaVacio($alias) || !preg_match("/^[a-zA-Z][a-zA-Z0-9_-]*$/", $alias)){
		    		return 'El alias ingresado es erroneo.';
		    	}
	    	}
	    	else{
	    		return 'Debe escribir un alias.';
	    	}

	    	if(isset($array['contrasena'])){
		    	$contrasena = $array['contrasena'];
		    	if(strlen($contrasena) > 0){
			    	if(validador::estaVacio($contrasena) || strlen($contrasena) < 8){
			    		return 'La contraseña es erronea.';
			    	}
			    	$hayPass = true;
			    }
		    }

		    if($hayPass){
		    	if(isset($array['contrasenaConfirmacion'])){
			    	$contrasenaConfirmacion = $array['contrasenaConfirmacion'];
			    	if(validador::estaVacio($contrasenaConfirmacion) || strcmp($contrasena, $contrasenaConfirmacion) !== 0){
			    		return 'Las contraseñas escritas no son iguales.';
			    	}
			    }
		    }

		    if(isset($array['biografia'])){
		    	if(strlen($array['biografia']) > 0){
		        	if(validador::estaVacio($array['biografia'])){
		                return 'La biografía no debe llevar solamente espacios en blanco.';
		            }
		    	}
	        }

	        if(isset($_FILES['avatar'])){
	        	if($_FILES['avatar']['error'] === UPLOAD_ERR_OK){
	        		$mensaje = validador::validarArchivoCargado('avatar', 500000);
			        if($mensaje !== true){
			        	return $mensaje;
			        }
	        	}
	        }

	        return true;
	    }

	    function validarContacto($array){
	    	if(isset($array['nombre'])){
	            if(validador::estaVacio($array['nombre'])){
	                return 'El nombre no debe llevar solamente espacios en blanco.';
	            }
	        }
	        else{
	            return 'Debe escribir un nombre.';
	        }

	        if(isset($array['correo'])){
	            $correo = $array['correo'];
	            if(validador::estaVacio($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL)){
	                return 'El correo ingresado no es válido.';
	            }
	        }
	        else{
	            return 'Debes ingresar un correo.';
	        }

	        if(isset($array['descripcion'])){
	        	if(validador::estaVacio($array['descripcion'])){
	                return 'La descripción no debe llevar solamente espacios en blanco.';
	            }
	        }
	        else{
	        	return 'Debe escribir una descripción.';
	        }

	        return true;
	    }

	    function validarArchivoCargado($form, $fileMax){
	    	if(!isset($_FILES[$form]['error']) || is_array($_FILES[$form]['error'])){
	            return 'ERROR: Archivo erroneo.';
	        }

	        switch($_FILES[$form]['error']){
	            case UPLOAD_ERR_OK:
	                break;

	            case UPLOAD_ERR_INI_SIZE:
	            case UPLOAD_ERR_FORM_SIZE:
	                return 'ERROR: El archivo sobrepasa el límite permitido.';
	                break;

	            case UPLOAD_ERR_NO_FILE:
	                return 'ERROR: No se subió ningún archivo.';
	                break;
	        }

	        if($_FILES[$form]['size'] > $fileMax){
	            return 'ERROR: El archivo sobrepasa el límite permitido.';
	        }

	        $infoArchivo = new finfo(FILEINFO_MIME_TYPE);
	        $extension = $infoArchivo->file($_FILES[$form]['tmp_name']);
	        $arrayTipos = array(
	            'jpg' => 'image/jpeg',
	            'png' => 'image/png',
	            'gif' => 'image/gif'
	        );

	        if(array_search($extension, $arrayTipos, true) === false){
	            return 'ERROR: Formato de archivo inválido.';
	        }

	        return true;
	    }

	    function moverArchivo($form, $carpeta, $infoUsuario){
	    	if(isset($_FILES[$form]['error']) && $_FILES[$form]['error'] === UPLOAD_ERR_OK){
	    		$ruta = $_SERVER['DOCUMENT_ROOT']."/Dragonart/uploads/$carpeta/".basename($_FILES[$form]['name']);
		    	if(move_uploaded_file($_FILES[$form]['tmp_name'], $ruta)){

	                $nuevoNombre = $_SERVER['DOCUMENT_ROOT']."/Dragonart/uploads/$carpeta/".uniqid('dragonart_'.$infoUsuario['nombre'].'_').'.'.pathinfo($ruta,PATHINFO_EXTENSION);
	                $destArchivo = $_SERVER['DOCUMENT_ROOT']."/Dragonart/uploads/$carpeta/".basename($nuevoNombre);
	                while(file_exists($destArchivo)){
	                    $nuevoNombre = $_SERVER['DOCUMENT_ROOT']."/Dragonart/uploads/$carpeta/".uniqid('dragonart_'.$infoUsuario['nombre'].'_').'.'.pathinfo($ruta,PATHINFO_EXTENSION);
	                    $destArchivo = $_SERVER['DOCUMENT_ROOT']."/Dragonart/uploads/$carpeta/".basename($nuevoNombre);
	                }

	                rename($ruta, $nuevoNombre);
	                return $nuevoNombre;
	            }
        	}
        	return false;
	    }

	    function sanitizar($array){
	        require_once('app/modelos/imagenMdl.php');
	        $imgMdl = new imagenMdl();

	    	foreach($array as $llave => $valor){
	        	$array[$llave] = $imgMdl->real_escape_string($array[$llave]);
	    	}
	    	unset($valor);

	        return $array;
	    }

	    function validarComentario($array){
	    	if(isset($array['comentario'])){
		    	$nombre = $array['comentario'];
		    	if(validador::estaVacio($nombre)){
		    		return 'Su comentario no debe ser llenado solamente de espacios en blanco.';
		    	}
	    	}
	    	else{
	    		return 'Debe escribir un comentario.';
	    	}

	    	return true;
	    }

	}

?>