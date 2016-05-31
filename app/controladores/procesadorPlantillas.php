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

	            //Si NO es administrador, entonces quitamos el botón de registrar Admin
	            if(isset($_SESSION['admin']) && $_SESSION['admin'] === 1){
	            	$inicio = strpos($header,'<!--IniAdmin-->');
		            $fin = strpos($header, '<!--FinAdmin-->')+15;
		            $busqueda = substr($header, $inicio, $fin-$inicio);
		            $header = str_replace($busqueda, '', $header);
	            }

	            require_once('app/modelos/usuarioMdl.php');
	            $usrMdl = new usuarioMdl();
	            require_once('app/modelos/notificacionMdl.php');
	            $ntfMdl = new notificacionMdl();

	            $infoUsuario = $usrMdl->obtenerInfo($_SESSION['correo'], $_SESSION['logPass']);
	            $conteo = $ntfMdl->contarNotificaciones($infoUsuario['id']);

	            if($conteo > 0){
	            	$header = str_replace('%num%', $conteo, $header);
	            }else{
	            	$inicio = strpos($header,'<!--iniNotif1-->');
		            $fin = strpos($header, '<!--finNotif1-->')+16;
		            $busqueda = substr($header, $inicio, $fin-$inicio);
		            $header = str_replace($busqueda, '', $header);

		            $inicio = strpos($header,'<!--iniNotif2-->');
		            $fin = strpos($header, '<!--finNotif2-->')+16;
		            $busqueda = substr($header, $inicio, $fin-$inicio);
		            $header = str_replace($busqueda, '', $header);
	            }
	        }
	        else{
	            $inicio = strpos($header,'<!--Inicio Online-->');
	            $fin = strpos($header, '<!--Fin Online-->')+17;
	            $busqueda = substr($header, $inicio, $fin-$inicio);
	            $header = str_replace($busqueda, '', $header);
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

		function vistaIniciarSesion($doctype, $header, $vista, $footer, $mensaje){
			$header = procesadorPlantillas::generarHeader($header);
			$vista = procesadorPlantillas::generarFooter($vista, $footer);

			$vista = str_replace('%error%', $mensaje, $vista);
			$vista = $doctype.$header.$vista;

	        return $vista;
		}

		function vistaPaginaUsuario($doctype, $header, $vista, $footer, $infoUsuario, $galeria, $estaSiguiendolo){
			$header = procesadorPlantillas::generarHeader($header);
			$vista = procesadorPlantillas::generarFooter($vista, $footer);
			$rating = 'true';
			$estrella = '';
			$btnSeguirCortado = false;
			$btnDejarCortado = false;
			$btnBloquearCortado = false;
			$btnDesbloquearCortado = false;

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

	        //Si el usuario que visitas es Admin, entonces mostramos una estrella
	        if($infoUsuario['tipo'] === 0){
	        	$estrella = '<span class="glyphicon glyphicon-star"></span>';
	        }

	        if(isset($_SESSION['nombre'])){
		        //Valida que el usuario que visita la página sea el mismo para quitar el botón "Seguir"
		        if($infoUsuario['nombre'] === $_SESSION['nombre']){
		            $inicioBtn = strpos($vista,'<!--IniBotonSeguir-->');
		            $finBtn = strpos($vista, '<!--FinBotonSeguir-->')+21;
		            $btnSeguir = substr($vista,$inicioBtn,$finBtn-$inicioBtn);
		            $vista = str_replace($btnSeguir, '', $vista);
		            $rating = 'true';

		            $inicioBtn = strpos($vista,'<!--IniBotonDejar-->');
		            $finBtn = strpos($vista, '<!--FinBotonDejar-->')+20;
		            $btnSeguir = substr($vista,$inicioBtn,$finBtn-$inicioBtn);
		            $vista = str_replace($btnSeguir, '', $vista);

		            $btnSeguirCortado = true;
		            $btnDejarCortado = true;
		        }else{
		        	$rating = 'false';
		        }

		        //Valida que el usuario que visita la página NO sea admin para quitar el botón "Bloquear"
		        if(isset($_SESSION['admin']) && $_SESSION['admin'] === 1){
		        	$inicioBtn = strpos($vista,'<!--IniBotonBloquear-->');
		            $finBtn = strpos($vista, '<!--FinBotonBloquear-->')+23;
		            $btnBloquear = substr($vista,$inicioBtn,$finBtn-$inicioBtn);
		            $vista = str_replace($btnBloquear, '', $vista);

		            $inicioBtn = strpos($vista,'<!--IniBotonDesbloquear-->');
		            $finBtn = strpos($vista, '<!--FinBotonDesbloquear-->')+26;
		            $btnBloquear = substr($vista,$inicioBtn,$finBtn-$inicioBtn);
		            $vista = str_replace($btnBloquear, '', $vista);

		            $btnBloquearCortado = true;
		            $btnDesbloquearCortado = true;

		            if($estaSiguiendolo && !$btnSeguirCortado){
		            	$inicioBtn = strpos($vista,'<!--IniBotonSeguir-->');
			            $finBtn = strpos($vista, '<!--FinBotonSeguir-->')+21;
			            $btnSeguir = substr($vista,$inicioBtn,$finBtn-$inicioBtn);
			            $vista = str_replace($btnSeguir, '', $vista);
		            }else{
		            	if(!$estaSiguiendolo && !$btnDejarCortado){
		            		$inicioBtn = strpos($vista,'<!--IniBotonDejar-->');
				            $finBtn = strpos($vista, '<!--FinBotonDejar-->')+20;
				            $btnSeguir = substr($vista,$inicioBtn,$finBtn-$inicioBtn);
				            $vista = str_replace($btnSeguir, '', $vista);
		            	}
		            }
		        }else{
		        	//Valida que el usuario que visita la página sea admin y esté viendo su propia página para quitar el botón "Bloquear"
		        	if(isset($_SESSION['admin']) && $_SESSION['admin'] === 0 && $infoUsuario['nombre'] === $_SESSION['nombre']){
			        	$inicioBtn = strpos($vista,'<!--IniBotonBloquear-->');
			            $finBtn = strpos($vista, '<!--FinBotonBloquear-->')+23;
			            $btnBloquear = substr($vista,$inicioBtn,$finBtn-$inicioBtn);
			            $vista = str_replace($btnBloquear, '', $vista);
			            $rating = 'true';

			            $inicioBtn = strpos($vista,'<!--IniBotonDesbloquear-->');
			            $finBtn = strpos($vista, '<!--FinBotonDesbloquear-->')+26;
			            $btnBloquear = substr($vista,$inicioBtn,$finBtn-$inicioBtn);
			            $vista = str_replace($btnBloquear, '', $vista);

			            $btnBloquearCortado = true;
		            	$btnDesbloquearCortado = true;
		        	}
		        	if(isset($_SESSION['admin']) && $_SESSION['admin'] === 0){
		        		$rating = 'false';
		        		if($estaSiguiendolo && !$btnSeguirCortado){
			            	$inicioBtn = strpos($vista,'<!--IniBotonSeguir-->');
				            $finBtn = strpos($vista, '<!--FinBotonSeguir-->')+21;
				            $btnSeguir = substr($vista,$inicioBtn,$finBtn-$inicioBtn);
				            $vista = str_replace($btnSeguir, '', $vista);
			            }else{
			            	if(!$estaSiguiendolo && !$btnDejarCortado){
			            		$inicioBtn = strpos($vista,'<!--IniBotonDejar-->');
					            $finBtn = strpos($vista, '<!--FinBotonDejar-->')+20;
					            $btnSeguir = substr($vista,$inicioBtn,$finBtn-$inicioBtn);
					            $vista = str_replace($btnSeguir, '', $vista);
			            	}
			            }

			            if($infoUsuario['status'] === 0 && !$btnBloquearCortado){
			            	$inicioBtn = strpos($vista,'<!--IniBotonBloquear-->');
				            $finBtn = strpos($vista, '<!--FinBotonBloquear-->')+23;
				            $btnBloquear = substr($vista,$inicioBtn,$finBtn-$inicioBtn);
				            $vista = str_replace($btnBloquear, '', $vista);
			            }else{
			            	if($infoUsuario['status'] === 1 && !$btnDesbloquearCortado){
			            		$inicioBtn = strpos($vista,'<!--IniBotonDesbloquear-->');
					            $finBtn = strpos($vista, '<!--FinBotonDesbloquear-->')+26;
					            $btnBloquear = substr($vista,$inicioBtn,$finBtn-$inicioBtn);
					            $vista = str_replace($btnBloquear, '', $vista);
			            	}
			            }
		        	}
		        }
	    	}else{
	    		$inicioBtn = strpos($vista,'<!--IniBotonSeguir-->');
	            $finBtn = strpos($vista, '<!--FinBotonSeguir-->')+21;
	            $btnSeguir = substr($vista,$inicioBtn,$finBtn-$inicioBtn);
	            $vista = str_replace($btnSeguir, '', $vista);

	            $inicioBtn = strpos($vista,'<!--IniBotonDejar-->');
	            $finBtn = strpos($vista, '<!--FinBotonDejar-->')+20;
	            $btnSeguir = substr($vista,$inicioBtn,$finBtn-$inicioBtn);
	            $vista = str_replace($btnSeguir, '', $vista);

	            $inicioBtn = strpos($vista,'<!--IniBotonBloquear-->');
	            $finBtn = strpos($vista, '<!--FinBotonBloquear-->')+23;
	            $btnBloquear = substr($vista,$inicioBtn,$finBtn-$inicioBtn);
	            $vista = str_replace($btnBloquear, '', $vista);

	            $inicioBtn = strpos($vista,'<!--IniBotonDesbloquear-->');
	            $finBtn = strpos($vista, '<!--FinBotonDesbloquear-->')+26;
	            $btnBloquear = substr($vista,$inicioBtn,$finBtn-$inicioBtn);
	            $vista = str_replace($btnBloquear, '', $vista);

	            $rating = 'true';
	    	}

	        //Generamos el diccionario con la info a escribir en la plantilla
	        $ruta = str_replace($_SERVER['DOCUMENT_ROOT'].'/Dragonart/', '', $infoUsuario['avatar']);
	        $diccionario = array (
	        	'%estrella%' => $estrella,
	            '%alias%' => $infoUsuario['alias'],
	            '%nombreUsuario%' => $infoUsuario['nombre'],
	            '%descripcion%' => $infoUsuario['biografia'],
	            '%avatarUsuario%' => $ruta,
	            '%validaRating%' => $rating
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
				'%aliasUsuario%' => $infoUsuario['alias'],
				'%descripcionUsuario%' => $infoUsuario['biografia'],
				'%avatarUsuario%' => str_replace($_SERVER['DOCUMENT_ROOT'].'/Dragonart/', '', $infoUsuario['avatar']),
				'%idUsuario%' => $infoUsuario['id']
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

			$ruta = str_replace($_SERVER['DOCUMENT_ROOT'].'/Dragonart/', '', $infoImagen['url']);
			if(isset($_SESSION['correo']) && $infoUsuario['correo'] !== $_SESSION['correo']){
				require_once('app/modelos/usuarioMdl.php');
				$usrMdl = new usuarioMdl();
				require_once('app/modelos/favoritoMdl.php');
				$favMdl = new favoritoMdl();
				$infoUsuarioActual = $usrMdl->obtenerInfo($_SESSION['correo'], $_SESSION['logPass']);
				if($infoUsuarioActual !== false){
					$infoFavorito = $favMdl->obtenerFavorito($infoUsuarioActual['id'], $infoImagen['id']);
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
				'%avatarUsuario%' => str_replace($_SERVER['DOCUMENT_ROOT'].'/Dragonart/', '', $infoUsuario['avatar']),
				'%tituloImagen%' => $infoImagen['titulo'],
				'%fechaImagen%' => $infoImagen['fecha'],
				'%descripcionImagen%' => $infoImagen['descripcion'],
				'%promedioImagen%' => $promedio,
				'%idImagen%' => $infoImagen['id']
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
	                    '%avatarCom%' => str_replace($_SERVER['DOCUMENT_ROOT'].'/Dragonart/', '', $infoUsuario['avatar']),
	                    '%aliasCom%' => $infoUsuario['alias'],
	                    '%fechaCom%' => $comentarios[$x]['fecha'],
	                    '%comentario%' => $comentarios[$x]['comentario'],
	                    '%nomUsuario%' => $infoUsuario['nombre']
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

		function vistaModificarImagen($doctype, $header, $vista, $footer, $infoImagen, $tags, $mensaje){
			$header = procesadorPlantillas::generarHeader($header);
			$vista = procesadorPlantillas::generarFooter($vista, $footer);

			$vista = str_replace('%error%', $mensaje, $vista);
			$diccionario = array(
                '%idImagen%' => $infoImagen['id'],
                '%urlImagen%' => str_replace($_SERVER['DOCUMENT_ROOT'].'/Dragonart/', '', $infoImagen['url']),
                '%titulo%' => $infoImagen['titulo'],
                '%descripcion%' => $infoImagen['descripcion'],
                '%tags%' => $tags
            );

			$vista = procesadorPlantillas::aplicaDiccionario($vista, $diccionario);
			$vista = $doctype.$header.$vista;

	        return $vista;			
		}

		function vistaNotificaciones($doctype, $header, $vista, $footer, $notifSeguidores, $notifImagenes, $notifComentarios, $notifFavoritos){
			$header = procesadorPlantillas::generarHeader($header);
			$vista = procesadorPlantillas::generarFooter($vista, $footer);
			$contador = 0;

			if($notifSeguidores !== false && !empty($notifSeguidores)){
				$vista = procesadorPlantillas::llenarSeguidores($vista, $notifSeguidores);
			}else{
				$inicio = strpos($vista, '<!--iniSeguidores-->');
	        	$fin = strpos($vista, '<!--finSeguidores-->')+20;
	        	$remplazar = substr($vista,$inicio,$fin-$inicio);
	        	$vista = str_replace($remplazar, '', $vista);
	        	$contador++;
			}

			if($notifImagenes !== false && !empty($notifImagenes)){
				$vista = procesadorPlantillas::llenarImgNuevas($vista, $notifImagenes);
			}else{
				$inicio = strpos($vista, '<!--iniGaleria-->');
	        	$fin = strpos($vista, '<!--finGaleria-->')+17;
	        	$remplazar = substr($vista,$inicio,$fin-$inicio);
	        	$vista = str_replace($remplazar, '', $vista);
	        	$contador++;
			}

			if($notifComentarios !== false && !empty($notifComentarios)){
				$vista = procesadorPlantillas::llenarComentarios($vista, $notifComentarios);
			}else{
				$inicio = strpos($vista, '<!--iniComentarios-->');
	        	$fin = strpos($vista, '<!--finComentarios-->')+21;
	        	$remplazar = substr($vista,$inicio,$fin-$inicio);
	        	$vista = str_replace($remplazar, '', $vista);
	        	$contador++;
			}

			if($notifFavoritos !== false && !empty($notifFavoritos)){
				$vista = procesadorPlantillas::llenarFavoritos($vista, $notifFavoritos);
			}else{
				$inicio = strpos($vista, '<!--iniFavoritos-->');
	        	$fin = strpos($vista, '<!--finFavoritos-->')+19;
	        	$remplazar = substr($vista,$inicio,$fin-$inicio);
	        	$vista = str_replace($remplazar, '', $vista);
	        	$contador++;
			}

			if($contador === 4){
				$vista = str_replace('%mensaje%', '<h3>No hay notificaciones nuevas.</h3>', $vista);
			}else{
				$vista = str_replace('%mensaje%', '', $vista);
			}

			$vista = $doctype.$header.$vista;

	        return $vista;
		}

		function llenarSeguidores($vista, $notifSeguidores){
			require_once('app/modelos/usuarioMdl.php');
        	$usrMdl = new usuarioMdl();
        	$usrTmp = array();

			$filas = '';
	        $inicioFila = strpos($vista,'<!--iniFilaSeg-->');
	        $finFila = strpos($vista, '<!--finFilaSeg-->')+17;
	        $fila = substr($vista,$inicioFila,$finFila-$inicioFila);

	        $thumbnails = '';
	        $inicio = strpos($vista,'<!--iniSeg-->');
	        $fin = strpos($vista, '<!--finSeg-->')+13;
	        $thumbnail = substr($vista,$inicio,$fin-$inicio);

	        if(is_array($notifSeguidores) && count($notifSeguidores) > 0){
	            $contador = 0;
	            for($x=0; $x<count($notifSeguidores); $x++){

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

	                $usrTmp = $usrMdl->obtenerInfoPorID($notifSeguidores[$x]['autor']);

	                $new_thumbnail = $thumbnail;
	                
	                $diccionario = array (
	                	'%idNotificacion%' => $notifSeguidores[$x]['id'],
	                	'%conteo%' => $x,
	                    '%nombreUsuario%' => $usrTmp['nombre'],
	                    '%urlAvatar%' => str_replace($_SERVER['DOCUMENT_ROOT'].'/Dragonart/', '', $usrTmp['avatar'])
	                );
	                
	                $new_thumbnail = procesadorPlantillas::aplicaDiccionario($new_thumbnail,$diccionario);
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

	        $vista = str_replace($fila, $filas, $vista);

	        return $vista;
		}

		function llenarImgNuevas($vista, $notifImagenes){
			require_once('app/modelos/imagenMdl.php');
        	$imgMdl = new imagenMdl();
        	$imgTmp = array();

        	require_once('app/modelos/usuarioMdl.php');
        	$usrMdl = new usuarioMdl();
        	$usrTmp = array();

        	require_once('app/modelos/favoritoMdl.php');
        	$favMdl = new favoritoMdl();
        	$favTmp = array();

			$filas = '';
	        $inicioFila = strpos($vista,'<!--iniFilaGal-->');
	        $finFila = strpos($vista, '<!--finFilaGal-->')+17;
	        $fila = substr($vista,$inicioFila,$finFila-$inicioFila);

	        $thumbnails = '';
	        $inicio = strpos($vista,'<!--iniGal-->');
	        $fin = strpos($vista, '<!--finGal-->')+13;
	        $thumbnail = substr($vista,$inicio,$fin-$inicio);

	        if(is_array($notifImagenes) && count($notifImagenes) > 0){
	            $contador = 0;
	            for($x=0; $x<count($notifImagenes); $x++){

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

	                $imgTmp = $imgMdl->obtenerInfo($notifImagenes[$x]['elemento']);
	                $usrTmp = $usrMdl->obtenerInfo($_SESSION['correo'], $_SESSION['logPass']);
	                $favTmp = $favMdl->obtenerFavorito($usrTmp['id'], $imgTmp['id']);
                	if($favTmp !== false && !empty($favTmp)){
                		$valorFav = $favTmp['calificacion'];
                	}else{
                		$valorFav = 0;
                	}

	                $new_thumbnail = $thumbnail;
	                
	                $diccionarioImagen = array (
	                	'%idNotificacion%' => $notifImagenes[$x]['id'],
	                    '%conteo%' => $x,
	                    '%idImagen%' => $imgTmp['id'],
	                    '%urlImagen%' => str_replace($_SERVER['DOCUMENT_ROOT'].'/Dragonart/uploads/img', 'uploads/thumb', $imgTmp['url']),
	                    '%tituloImagen%' => $imgTmp['titulo'],
	                    '%valorFav%' => $valorFav
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

	        return $vista;
		}

		function llenarComentarios($vista, $notifComentarios){
			require_once('app/modelos/usuarioMdl.php');
        	$usrMdl = new usuarioMdl();
        	$usrTmp = array();

        	require_once('app/modelos/comentarioMdl.php');
        	$comMdl = new comentarioMdl();
        	$comTmp = array();

	        $thumbnails = '';
	        $inicio = strpos($vista,'<!--iniCom-->');
	        $fin = strpos($vista, '<!--finCom-->')+13;
	        $thumbnail = substr($vista,$inicio,$fin-$inicio);

	        if(is_array($notifComentarios) && count($notifComentarios) > 0){
	            $contador = 0;
	            for($x=0; $x<count($notifComentarios); $x++){

	                $usrTmp = $usrMdl->obtenerInfoPorID($notifComentarios[$x]['autor']);
	                $comTmp = $comMdl->obtenerInfo($notifComentarios[$x]['elemento']);

	                $new_thumbnail = $thumbnail;
	                
	                $diccionario = array (
	                	'%idNotificacion%' => $notifComentarios[$x]['id'],
	                	'%conteo%' => $x,
	                    '%nombreUsuario%' => $usrTmp['nombre'],
	                    '%urlAvatar%' => str_replace($_SERVER['DOCUMENT_ROOT'].'/Dragonart/', '', $usrTmp['avatar']),
	                    '%aliasUsuario%' => $usrTmp['alias'],
	                    '%fechaComentario%' => $comTmp['fecha'],
	                    '%comentario%' => $comTmp['comentario'],
	                    '%idImagen%' => $comTmp['imagen']
	                );
	                
	                $new_thumbnail = procesadorPlantillas::aplicaDiccionario($new_thumbnail,$diccionario);
	                $thumbnails .= $new_thumbnail;
	            }
	        }

	        $vista = str_replace($thumbnail, $thumbnails, $vista);

	        return $vista;
		}

		function llenarFavoritos($vista, $notifFavoritos){
			require_once('app/modelos/usuarioMdl.php');
        	$usrMdl = new usuarioMdl();
        	$usrTmp = array();

        	require_once('app/modelos/favoritoMdl.php');
        	$favMdl = new favoritoMdl();
        	$favTmp = array();

        	require_once('app/modelos/imagenMdl.php');
        	$imgMdl = new imagenMdl();
        	$imgTmp = array();

	        $thumbnails = '';
	        $inicio = strpos($vista,'<!--iniFav-->');
	        $fin = strpos($vista, '<!--finFav-->')+13;
	        $thumbnail = substr($vista,$inicio,$fin-$inicio);

	        if(is_array($notifFavoritos) && count($notifFavoritos) > 0){
	            $contador = 0;
	            for($x=0; $x<count($notifFavoritos); $x++){

	                $usrTmp = $usrMdl->obtenerInfoPorID($notifFavoritos[$x]['autor']);
	                $favTmp = $favMdl->obtenerInfo($notifFavoritos[$x]['elemento']);
	                $imgTmp = $imgMdl->obtenerInfo($favTmp['imagen']);

	                $new_thumbnail = $thumbnail;
	                
	                $diccionario = array (
	                	'%idNotificacion%' => $notifFavoritos[$x]['id'],
	                	'%conteo%' => $x,
	                    '%idImagen%' => $imgTmp['id'],
	                    '%urlAvatar%' => str_replace($_SERVER['DOCUMENT_ROOT'].'/Dragonart/', '', $usrTmp['avatar']),
	                    '%aliasUsuario%' => $usrTmp['alias'],
	                    '%tituloImagen%' => $imgTmp['titulo']
	                );
	                
	                $new_thumbnail = procesadorPlantillas::aplicaDiccionario($new_thumbnail,$diccionario);
	                $thumbnails .= $new_thumbnail;
	            }
	        }

	        $vista = str_replace($thumbnail, $thumbnails, $vista);

	        return $vista;
		}

		function vistaBusqueda($doctype, $header, $vista, $footer, $resImagenes){
			require_once('app/modelos/usuarioMdl.php');
        	$usrMdl = new usuarioMdl();
        	$usrTmp = array();

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

			//Generamos la galería
	        if(is_array($resImagenes) && count($resImagenes) > 0){
	            $contador = 0;
	            for($x=0; $x<count($resImagenes); $x++){

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
	                $usrTmp = $usrMdl->obtenerInfoPorID($resImagenes[$x]['idUsuario']);

	                if(isset($_SESSION['correo']) && strlen($_SESSION['correo']) > 0){
		                if($usrTmp['correo'] === $_SESSION['correo']){
		                	$rating = true;
		                }else{
		                	$rating = false;
		                }
	                }else{
	                	$rating = true;
	                }

	                $diccionarioImagen = array (
	                    '%titulo%' => $resImagenes[$x]['titulo'],
	                    '%idImagen%' => $resImagenes[$x]['id'],
	                    '%urlImagen%' => str_replace('/var/www/html/Dragonart/uploads/img', 'uploads/thumb', $resImagenes[$x]['url']),
	                    '%conteo%' => $x,
	                    '%promedioImagen%' => $resImagenes[$x]['promedio'],
	                    '%rating%' => $rating
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
	            $filas = '<i>No hay resultados...</i>';
	        }
	        
	        $vista = str_replace($fila, $filas, $vista);

	        if(isset($_GET['buscar']) && strlen($_GET['buscar']) > 0){
	        	$buscar = $_GET['buscar'];
	        }else{
	        	if(isset($_GET['inputBuscar']) && strlen($_GET['inputBuscar']) > 0){
		        	$buscar = $_GET['inputBuscar'];
		        }else{
	        		$buscar = '';
		        }
	        }
	        $vista = str_replace('%buscar%', $buscar, $vista);

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
        
        function vistaContacto($doctype, $header, $vista, $footer, $mensaje){
            $header = procesadorPlantillas::generarHeader($header);
			$vista = procesadorPlantillas::generarFooter($vista, $footer);
            
            $vista = str_replace('%error%', $mensaje, $vista);
            $vista = $doctype.$header.$vista;
            
            return $vista;
        }
        
        function vistaRecuperarContrasena($doctype, $header, $vista, $footer, $mensaje){
            $header = procesadorPlantillas::generarHeader($header);
			$vista = procesadorPlantillas::generarFooter($vista, $footer);
            
            $vista = str_replace('%error%', $mensaje, $vista);
            $vista = $doctype.$header.$vista;
            
            return $vista;
        }
        
        function vistaRecuperarContrasenaCorreo($doctype, $header, $vista, $footer, $mensaje){
            $header = procesadorPlantillas::generarHeader($header);
			$vista = procesadorPlantillas::generarFooter($vista, $footer);
            
            $vista = str_replace('%error%', $mensaje, $vista);
            $vista = $doctype.$header.$vista;
            
            return $vista;
        }

        function vistaBackend($doctype, $header, $vista, $footer, $infoImagen){
        	$header = procesadorPlantillas::generarHeader($header);
			$vista = procesadorPlantillas::generarFooter($vista, $footer);
            
			require_once('app/modelos/usuarioMdl.php');
        	$usrMdl = new usuarioMdl();
        	$usrTmp = array();

			$thumbnails = '';
	        $inicio = strpos($vista,'<!--iniFila-->');
	        $fin = strpos($vista, '<!--finFila-->')+14;
	        $thumbnail = substr($vista,$inicio,$fin-$inicio);

			//Generamos la galería
	        if(is_array($infoImagen) && count($infoImagen) > 0){

	            for($x=0; $x<count($infoImagen); $x++){

	                $new_thumbnail = $thumbnail;
	                $usrTmp = $usrMdl->obtenerInfoPorID($infoImagen[$x]['idUsuario']);

	                if($infoImagen[$x]['status'] === 1){
	                	$status = 'Activo';
	                }else{
	                	$status = 'Inactivo';
	                }

	                $diccionarioImagen = array (
	                	'%conteo%' => $x,
	                	'%idImagen%' => $infoImagen[$x]['id'],
	                	'%urlImagen%' => str_replace('/var/www/html/Dragonart/uploads/img', 'uploads/thumb', $infoImagen[$x]['url']),
	                	'%tituloImagen%' => $infoImagen[$x]['titulo'],
	                	'%aliasUsuario%' => $usrTmp['alias'],
	                	'%statusImagen%' => $status,
	                	'%promedioImagen%' => $infoImagen[$x]['promedio']
	                );
	                
	                $new_thumbnail = procesadorPlantillas::aplicaDiccionario($new_thumbnail,$diccionarioImagen);
	                $thumbnails .= $new_thumbnail;
	            }

	        }
	        else{
	            $thumbnails = '<i>No hay resultados...</i>';
	        }
	        
	        $vista = str_replace($thumbnail, $thumbnails, $vista);

            $vista = $doctype.$header.$vista;
            
            return $vista;
        }
	}

?>