<?php

	class procesadorPlantillas{

		function __construct(){}

		function generarHeader($header){
	        if(isset($_SESSION['correo']) && isset($_SESSION['logPass']) && isset($_SESSION['alias']) && isset($_SESSION['nombre'])){
	            $inicio = strpos($header,'<!--Inicio Offline-->');
	            $fin = strpos($header, '<!--Fin Offline-->')+18;
	            $busqueda = substr($header, $inicio, $fin-$inicio);
	            $header = str_replace($busqueda, "", $header);
	            $header = str_replace('%alias%', $_SESSION['alias'], $header);
	            $header = str_replace('%usuario%', $_SESSION['nombre'], $header);
	        }
	        else{
	            $inicio = strpos($header,'<!--Inicio Online-->');
	            $fin = strpos($header, '<!--Fin Online-->')+17;
	            $busqueda = substr($header, $inicio, $fin-$inicio);
	            $header = str_replace($busqueda, "", $header);
	        }

	        return $header;
	    }

	    function generarFooter($vista, $footer){
	    	$inicioFooter = strpos($vista, '<!--inicioFooter-->');
            $finFooter = strpos($vista, '<!--finFooter-->')+16;
            $remplazar = substr($vista,$inicioFooter,$finFooter-$inicioFooter);

            return str_replace($remplazar, $footer, $vista);
	    }

		function aplicaDiccionario($vista, $diccionario){
			return strtr($vista,$diccionario);
		}

		function vistaRegistrarUsuario($doctype, $header, $vista, $footer, $mensaje){
			$header = procesadorPlantillas::generarHeader($header);
			$vista = procesadorPlantillas::generarFooter($vista, $footer);

			$vista = str_replace('%error%', $mensaje, $vista);
			$vista = $doctype.$header.$vista;

	        return $vista;
		}

		function vistaPaginaUsuario($doctype, $header, $vista, $footer, $infoUsuario, $galeria){
			$header = procesadorPlantillas::generarHeader($header);
			$vista = procesadorPlantillas::generarFooter($vista, $footer);

			$thumbnails = '';
	        $inicio = strpos($vista,'<!--inicioRepetirImagen-->');
	        $fin = strpos($vista, '<!--finalRepetirImagen-->')+25;
	        $thumbnail = substr($vista,$inicio,$fin-$inicio);

	        $filas = '';
	        $inicioFila = strpos($vista,'<!--inicioFila-->');
	        $finFila = strpos($vista, '<!--finFila-->')+14;
	        $fila = substr($vista,$inicioFila,$finFila-$inicioFila);

	        //Valida si tiene una biografía guardada
	        if(!isset($infoUsuario['biografia'])){
	            $infoUsuario['biografia'] = '<i>No hay descripción...</i>';
	        }

	        if(isset($_SESSION['nombre'])){
		        //Valida que el usuario que visita la página sea el mismo para quitar el botón "Seguir"
		        if($infoUsuario['nombre'] === $_SESSION['nombre']){
		            $inicioBtn = strpos($vista,'<!--IniBotonSeguir-->');
		            $finBtn = strpos($vista, '<!--FinBotonSeguir-->')+21;
		            $btnSeguir = substr($vista,$inicioBtn,$finBtn-$inicioBtn);
		            $vista = str_replace($btnSeguir, '', $vista);
		        }

		        //Valida que el usuario que visita la página NO sea admin para quitar el botón "Bloquear"
		        if(isset($_SESSION['admin']) && $_SESSION['admin'] === 0){
		        	$inicioBtn = strpos($vista,'<!--IniBotonBloquear-->');
		            $finBtn = strpos($vista, '<!--FinBotonBloquear-->')+23;
		            $btnBloquear = substr($vista,$inicioBtn,$finBtn-$inicioBtn);
		            $vista = str_replace($btnBloquear, '', $vista);
		        }else{
		        	//Valida que el usuario que visita la página sea admin y esté viendo su propia página para quitar el botón "Bloquear"
		        	if(isset($_SESSION['admin']) && $_SESSION['admin'] === 1 && $infoUsuario['nombre'] === $_SESSION['nombre']){
			        	$inicioBtn = strpos($vista,'<!--IniBotonBloquear-->');
			            $finBtn = strpos($vista, '<!--FinBotonBloquear-->')+23;
			            $btnBloquear = substr($vista,$inicioBtn,$finBtn-$inicioBtn);
			            $vista = str_replace($btnBloquear, '', $vista);
		        	}
		        }
	    	}else{
	    		$inicioBtn = strpos($vista,'<!--IniBotonSeguir-->');
	            $finBtn = strpos($vista, '<!--FinBotonSeguir-->')+21;
	            $btnSeguir = substr($vista,$inicioBtn,$finBtn-$inicioBtn);
	            $vista = str_replace($btnSeguir, '', $vista);

	            $inicioBtn = strpos($vista,'<!--IniBotonBloquear-->');
	            $finBtn = strpos($vista, '<!--FinBotonBloquear-->')+23;
	            $btnBloquear = substr($vista,$inicioBtn,$finBtn-$inicioBtn);
	            $vista = str_replace($btnBloquear, '', $vista);
	    	}

	        //Generamos el diccionario con la info a escribir en la plantilla
	        $diccionario = array (
	            '%alias%' => $infoUsuario['alias'],
	            '%descripcion%' => $infoUsuario['biografia'],
	            '%avatarUsuario%' => $infoUsuario['avatar']
	        );
	        
	        //Generamos la galería
	        if(is_array($galeria) && count($galeria) > 0){
	            $contador = 0;
	            for($x=0; $x<count($galeria); $x++){

	                if($x !== 0 && $x%4 === 0){
	                    $new_fila = $fila;

	                    $diccionarioFila = array(
	                        '%conteo%' => $contador
	                    );

	                    $new_fila = str_replace($thumbnail, $thumbnails, $new_fila);
	                    $new_fila = strtr($new_fila, $diccionarioFila);
	                    $filas .= $new_fila;

	                    $contador++;
	                    $thumbnails = '';
	                }

	                $new_thumbnail = $thumbnail;
	                
	                $diccionarioImagen = array (
	                    '%titulo%' => $galeria[$x]['titulo'],
	                    '%idImagen%' => $galeria[$x]['id'],
	                    '%urlImagen%' => str_replace('/var/www/html/Dragonart/uploads/img', 'uploads/thumb', $galeria[$x]['url']),
	                    '%conteo%' => $x,
	                    '%promedioImagen%' => $galeria[$x]['promedio']
	                );
	                
	                $new_thumbnail = procesadorPlantillas::aplicaDiccionario($new_thumbnail,$diccionarioImagen);
	                $thumbnails .= $new_thumbnail;
	            }
	            
	            $new_fila = $fila;

	            $diccionarioFila = array(
	                '%conteo%' => $contador
	            );

	            $new_fila = str_replace($thumbnail, $thumbnails, $new_fila);
	            $new_fila = procesadorPlantillas::aplicaDiccionario($new_fila, $diccionarioFila);
	            $filas .= $new_fila;
	        }
	        else{
	            $filas = '<i>No hay imágenes en la galería...</i>';
	        }
	        
	        $vista = str_replace($fila, $filas, $vista);
	        
	        $vista = procesadorPlantillas::aplicaDiccionario($vista, $diccionario);
	        
	        $vista = $doctype.$header.$vista;

	        return $vista;
		}

		function vistaModificarUsuario($doctype, $header, $vista, $footer, $infoUsuario, $mensaje){
			$header = procesadorPlantillas::generarHeader($header);
			$vista = procesadorPlantillas::generarFooter($vista, $footer);

			$vista = str_replace('%error%', $mensaje, $vista);
			$diccionario = array(
				'%nombreUsuario%' => $infoUsuario['nombre'],
				'%aliasUsuario%' => $infoUsuario['alias'],
				'%correoUsuario%' => $infoUsuario['correo'],
				'%descripcionUsuario%' => $infoUsuario['biografia'],
				'%avatarUsuario%' => str_replace('/var/www/html/Dragonart/', '', $infoUsuario['avatar'])
			);
			$vista = procesadorPlantillas::aplicaDiccionario($vista, $diccionario);
			$vista = $doctype.$header.$vista;

	        return $vista;			
		}

		function vistaInicio($doctype, $header, $vista, $footer){
			$header = procesadorPlantillas::generarHeader($header);
			$vista = procesadorPlantillas::generarFooter($vista, $footer);

			$inicioBody = strpos($doctype, '<!--inicioBody-->');
	        $finBody = strpos($doctype, '<!--finBody-->')+14;
	        $remplazarBody = substr($doctype,$inicioBody,$finBody-$inicioBody); 
	        $doctype = str_replace($remplazarBody, '<body class="index">', $doctype);

			$vista = $doctype.$header.$vista;

	        return $vista;
		}

		function vistaSubirImagen($doctype, $header, $vista, $footer, $mensaje){
			$header = procesadorPlantillas::generarHeader($header);
			$vista = procesadorPlantillas::generarFooter($vista, $footer);

			$vista = str_replace('%error%', $mensaje, $vista);
			$vista = $doctype.$header.$vista;

	        return $vista;
		}

		function vistaMostrarImagen($doctype, $header, $vista, $footer, $infoImagen, $infoUsuario, $tags, $comentarios, $mensaje){
			$header = procesadorPlantillas::generarHeader($header);
			$vista = procesadorPlantillas::generarFooter($vista, $footer);
			$rating = 'true';
			$promedio = 0;

			$ruta = str_replace('/var/www/html/Dragonart/', '', $infoImagen['url']);
			if(isset($_SESSION['correo']) && $infoUsuario['correo'] !== $_SESSION['correo']){
				require_once('app/modelos/usuarioMdl.php');
				$usrMdl = new usuarioMdl();
				require_once('app/modelos/favoritoMdl.php');
				$favMdl = new favoritoMdl();
				$infoUsuarioActual = $usrMdl->obtenerInfo($_SESSION['correo'], $_SESSION['logPass']);
				if($infoUsuarioActual !== false){
					$infoFavorito = $favMdl->obtenerFavorito($infoUsuarioActual['id']);
					if($infoFavorito !== false){
						$promedio = $infoFavorito['calificacion'];
					}
				}
			}
			else{
				$promedio = $infoImagen['promedio'];
			}

			$diccionario = array(
				'%error%' => $mensaje,
				'%aliasUsuarioImagen%' => $infoUsuario['alias'],
				'%idImagen%' => $infoImagen['id'],
				'%urlImagen%' => $ruta,
				'%nombreUsuario%' => $infoUsuario['nombre'],
				'%avatarUsuario%' => $infoUsuario['avatar'],
				'%tituloImagen%' => $infoImagen['titulo'],
				'%fechaImagen%' => $infoImagen['fecha'],
				'%descripcionImagen%' => $infoImagen['descripcion'],
				'%promedioImagen%' => $promedio
			);

			$vista = procesadorPlantillas::aplicaDiccionario($vista, $diccionario);

			//Esto remueve los botones de edición si no eres el dueño de esa imágen
			if(isset($_SESSION['correo']) && $infoUsuario['correo'] !== $_SESSION['correo']){
	        	$inicioBtn = strpos($vista, '<!--iniBtn-->');
	        	$finBtn = strpos($vista, '<!--finBtn-->')+13;
	        	$remplazar = substr($vista,$inicioBtn,$finBtn-$inicioBtn);
	        	$vista = str_replace($remplazar, '', $vista);
	        	$rating = 'false';
	        }

	        //Esto remueve el formulario de comentarios y los botones de edición para los que no estén registrados
	        if(!isset($_SESSION['correo']) && !isset($_SESSION['logPass'])){
	        	$inicioForm = strpos($vista, '<!--iniForm-->');
	        	$finForm = strpos($vista, '<!--finForm-->')+14;
	        	$remplazar = substr($vista,$inicioForm,$finForm-$inicioForm);
	        	$vista = str_replace($remplazar, '', $vista);

	        	$inicioBtn = strpos($vista, '<!--iniBtn-->');
	        	$finBtn = strpos($vista, '<!--finBtn-->')+13;
	        	$remplazar = substr($vista,$inicioBtn,$finBtn-$inicioBtn);
	        	$vista = str_replace($remplazar, '', $vista);

	        	$rating = 'true';
	        }

	        $todosTags = '';
	        $inicioTag = strpos($vista, '<!--iniTag-->');
        	$finTag = strpos($vista, '<!--finTag-->')+13;
        	$tag = substr($vista,$inicioTag,$finTag-$inicioTag);

	        if(is_array($tags)){
	            for($x=0; $x<count($tags); $x++){
	            	$new_tag = $tag;
	                
	                $diccionarioTag = array (
	                    '%tag%' => $tags[$x]['tag']
	                );
	                
	                $new_tag = procesadorPlantillas::aplicaDiccionario($new_tag,$diccionarioTag);
	                $todosTags .= $new_tag;
	            }
	        }

	        $vista = str_replace($tag, $todosTags, $vista);

	        $todosComentarios = '';
	        $inicioCom = strpos($vista, '<!--iniCom-->');
        	$finCom = strpos($vista, '<!--finCom-->')+13;
        	$Comen = substr($vista,$inicioCom,$finCom-$inicioCom);

        	require_once('app/modelos/usuarioMdl.php');
        	$usrMdl = new usuarioMdl();

	        if(is_array($comentarios)){
	        	for($x = 0; $x < count($comentarios); $x++){
	        		$new_comentario = $Comen;
	        		$infoUsuario = $usrMdl->obtenerInfoPorID($comentarios[$x]['usuario']);
	                
	                $diccionarioComen = array (
	                    '%avatarCom%' => $infoUsuario['avatar'],
	                    '%aliasCom%' => $infoUsuario['alias'],
	                    '%fechaCom%' => $comentarios[$x]['fecha'],
	                    '%comentario%' => $comentarios[$x]['comentario']
	                );
	                
	                $new_comentario = procesadorPlantillas::aplicaDiccionario($new_comentario,$diccionarioComen);
	                $todosComentarios .= $new_comentario;
	        	}
	        }
	        
	        $vista = str_replace($Comen, $todosComentarios, $vista);
	        $vista = str_replace('%validaRating%', $rating, $vista);

	        $vista = $doctype.$header.$vista;

	        return $vista;
		}

		function vistaError404($doctype, $header, $vista, $footer, $mensaje){
			$header = procesadorPlantillas::generarHeader($header);
			$vista = procesadorPlantillas::generarFooter($vista, $footer);

			$vista = str_replace('%mensaje%', $mensaje, $vista);
			$vista = $doctype.$header.$vista;

	        return $vista;
		}

	}

?>