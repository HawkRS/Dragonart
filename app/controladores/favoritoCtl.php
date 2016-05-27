<?php

	class favoritoCtl{

	    function __construct() {
	        session_start();
	    }

	    function run() {
	        if(isset($_GET['accion'])) {
	            switch($_GET['accion']) {
	                case 'alta':
	                    echo $this->alta();
	                    break;
	            }
	        }
	        else {
	            echo $this->alta();
	        }
	    }

	    function alta(){

	    	if(isset($_POST['url']) && isset($_POST['calificacion']) && isset($_SESSION['correo']) && isset($_SESSION['logPass'])){
	    		require_once('app/modelos/usuarioMdl.php');
	    		$usrMdl = new usuarioMdl();
	    		require_once('app/modelos/imagenMdl.php');
	    		$imgMdl = new imagenMdl();
	    		require_once('app/modelos/favoritoMdl.php');
	    		$favMdl = new favoritoMdl();

	    		$infoUsuario = $usrMdl->obtenerInfo($_SESSION['correo'], $_SESSION['logPass']);
	    		$ruta = str_replace('/thumb/', '/img/', $_POST['url']);
	    		$ruta = '/var/www/html/Dragonart/'.$ruta;
	    		$infoImagen = $imgMdl->obtenerInfoPorUrl($ruta);

	    		if($infoUsuario !== false && $infoImagen !== false){
	    			$infoFavorito = $favMdl->obtenerFavorito($infoUsuario['id'], $infoImagen['id']);
	    			if($infoFavorito !== false && !empty($infoFavorito)){
	    				//Modificamos el favorito actual
	    				if($favMdl->modificar($_POST['calificacion'], $infoFavorito['id'])){
	    					$promedio = $favMdl->obtenerPromedio($infoImagen['id']);
		    				if($promedio !== false){
		    					if($imgMdl->actualizaPromedio($promedio, $infoImagen['id'])){
		    						return true;
		    					}
		    				}
	    				}
	    			}
	    			else{
	    				//Agregamos nuevo favorito
	    				if($favMdl->alta($infoImagen['id'], $infoUsuario['id'], $_POST['calificacion'])){
		    				$promedio = $favMdl->obtenerPromedio($infoImagen['id']);
		    				if($promedio !== false){
		    					if($imgMdl->actualizaPromedio($promedio, $infoImagen['id'])){
		    						return true;
		    					}
		    				}
		    			}
	    			}
	    		}
	    		return false;
	    	}
	    	return false;

	    }

	}

?>