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
	        if(count($galeria) > 0){
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
	                    '%conteo%' => $x
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

		function vistaError404($doctype, $header, $vista, $footer, $mensaje){
			$header = procesadorPlantillas::generarHeader($header);
			$vista = procesadorPlantillas::generarFooter($vista, $footer);

			$vista = str_replace('%mensaje%', $mensaje, $vista);
			$vista = $doctype.$header.$vista;

	        return $vista;
		}

	}

?>