<?php

	class favoritoCtl{

	    function __construct() {
	        session_start();
	        echo 'Soy favoritoCtl';
	    }

	    function run() {
	        if(isset($_GET['accion'])) {
	            switch($_GET['accion']) {
	                case 'alta':
	                    $this->alta();
	                    break;
	            }
	        }
	        else {
	            $this->alta();
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
	    		$ruta = '/var/www/html/Dragonart/'.$_POST['url'];
	    		$infoImagen = $imgMdl->obtenerInfoPorUrl($ruta);

	    		if($favMdl->alta($infoImagen['id'], $infoUsuario['id'], $_POST['calificacion'])){
	    			return true;
	    		}
	    		return false;
	    	}
	    	return false;

	    }

	}

?>