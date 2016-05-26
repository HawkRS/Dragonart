<?php

class imagenCtl {
    public $modelo;
    
    private $doctype;
    private $header;
    private $footer;

    function __construct() {
    	session_start();
        echo 'Soy imagenCtl';
        $this->doctype = file_get_contents('app/vistas/doctype.html');
        $this->header = file_get_contents('app/vistas/header.html');
        $this->footer = file_get_contents('app/vistas/footer.html');
    }

    function run() {
        if(isset($_GET['accion'])) {
            switch($_GET['accion']) {
                case 'alta':
                    $this->alta();
                    break;
                    
                case 'mostrar':
                    $this->mostrar();
                    break;
                    
                case 'inicio':
                    $this->inicio();
                    break;
            }
        }
        else {
            $this->inicio();
        }
    }
    
    function alta() {
        require_once('app/controladores/procesadorPlantillas.php');
        $procesador = new procesadorPlantillas();

        if(!isset($_SESSION['correo']) && !isset($_SESSION['logPass'])){
            $vista = $procesador->vistaError404($this->doctype, $this->header, $vista, $this->footer, 'No es posible subir imágenes si no haz iniciado sesión.');
            echo $vista;
        }

        $errorMsg = '';

        if(isset($_POST)){
            if(imagenCtl::validarRegistro($_POST)){
                $ruta = '/var/www/html/Dragonart/uploads/img/'.basename($_FILES['imagen']['name']);
                if(move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta)){
                    require_once('app/modelos/usuarioMdl.php');
                    $usrMdl = new usuarioMdl();
                    $infoUsuario = $usrMdl->obtenerInfo($_SESSION['correo'], $_SESSION['logPass']);

                    $nuevoNombre = '/var/www/html/Dragonart/uploads/img/'.uniqid('dragonart_'.$infoUsuario['nombre'].'_').'.'.pathinfo($ruta,PATHINFO_EXTENSION);
                    $destArchivo = '/var/www/html/Dragonart/uploads/img/'.basename($nuevoNombre);
                    while(file_exists($destArchivo)){
                        $nuevoNombre = '/var/www/html/Dragonart/uploads/img/'.uniqid('dragonart_'.$infoUsuario['nombre'].'_').'.'.pathinfo($ruta,PATHINFO_EXTENSION);
                        $destArchivo = '/var/www/html/Dragonart/uploads/img/'.basename($nuevoNombre);
                    }

                    rename($ruta, $nuevoNombre);
                    imagenCtl::crearThumbnail($nuevoNombre, str_replace('/var/www/html/Dragonart/uploads/img/', '', $nuevoNombre));
                    $postLimpio = imagenCtl::sanitizar($_POST);

                    require_once('app/modelos/imagenMdl.php');
                    $imgMdl = new imagenMdl();
                    if($imgMdl->alta($infoUsuario['id'], $nuevoNombre, $postLimpio['titulo'], $postLimpio['descripcion'])){
                    	//Agregar a notificaciones
                    	$infoImagen = $imgMdl->obtenerInfoPorUrl($nuevoNombre);
                        header('Location: http://localhost/Dragonart/index.php?controlador=imagen&accion=mostrar&img='.$infoImagen['id']);
                    }
                    else{
                        $errorMsg = '<div class="alert alert-danger">ERROR: '.$imgMdl->getError().'.</div>';
                    }
                }
                else{
                    $errorMsg = '<div class="alert alert-danger">ERROR: No se pudo subir tu archivo.</div>';
                }
                 
            }
            else{
                if(count($_POST) === 0){
                    $errorMsg = '';
                }
                else{
                    $errorMsg = '<div class="alert alert-danger">Hubo un error al solicitar tu petición. Por favor, revise que no tenga errores en los campos del formulario.</div>';
                }
            }
        }
        else{
            $errorMsg = '<div class="alert alert-danger">Hubo un error al solicitar tu petición, por favor inténtelo más tarde.</div>';
        }

        $vista = file_get_contents('app/vistas/formularioImagen.html');
        $vista = $procesador->vistaSubirImagen($this->doctype, $this->header, $vista, $this->footer, $errorMsg);
        echo $vista;
    }

    function inicio() {
        require_once('app/controladores/procesadorPlantillas.php');
        $procesador = new procesadorPlantillas();
        $vista = file_get_contents('app/vistas/principal.html');
        $vista = $procesador->vistaInicio($this->doctype, $this->header, $vista, $this->footer);
        echo $vista;
    }
    
    function mostrar() {

        require_once('app/controladores/procesadorPlantillas.php');
        $procesador = new procesadorPlantillas();
        require_once('app/modelos/imagenMdl.php');
        $imgMdl = new imagenMdl();
        require_once('app/modelos/usuarioMdl.php');
        $usrMdl = new usuarioMdl();
        require_once('app/modelos/comentarioMdl.php');
        $comMdl = new comentarioMdl();

        $infoImagen = $imgMdl->obtenerInfo($_GET['img']);
        $infoUsuario = $usrMdl->obtenerInfoPorID($infoImagen['idUsuario']);
        $infoUsuarioActual = $usrMdl->obtenerInfo($_SESSION['correo'], $_SESSION['logPass']);
        $mensaje = '';

        if(!empty($_POST)){
            require_once('app/controladores/validador.php');
            $validador = new validador();
            $error = $validador->validarComentario($_POST);

            if($error === true){
                if($comMdl->alta($infoImagen['id'], $infoUsuarioActual['id'], $_POST['comentario'])){
                    header('Location: index.php?controlador=imagen&accion=mostrar&img='.$infoImagen['id']);
                }
                else{
                    $mensaje = '<div class="alert alert-danger">'.$comMdl->getError().'</div>';
                }
            }else{
                $mensaje = '<div class="alert alert-danger">'.$error.'</div>';
            }
        } 
        
        $comentarios = $comMdl->obtenerComentarios($_GET['img']);
        
        $vista = file_get_contents('app/vistas/publicacionIndex.html');

        $vista = $procesador->vistaMostrarImagen($this->doctype, $this->header, $vista, $this->footer, $infoImagen, $infoUsuario, $comentarios, $mensaje);
        

        echo $vista;

    }

    /**
    *<h1>estaVacio</h1>
    *<p>Esta función evalúa una cadena recibida desde el parámetro $cadena y verifica que no tenga
    *longitud cero o que esté lleno de caracteres en blanco.</p>
    *
    *
    *@author    Mauricio Gerardo Lazcano Origel
    *@version   1.0.0
    *@since     22/Mayo/2016
    *@param     $cadena Cadena a evaluar.
    *@return    Retorna TRUE si las validaciones de los campos fueron correctas, sino, retorna FALSE.
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
    *reglas como el archivo imagen a subir (extensión, tamaño, tipo de archivo y que no se repita), 
    *no permitir campos llenos con espacios en blanco,
    *entre otras validaciones.</p>
    *
    *
    *@author    Mauricio Gerardo Lazcano Origel
    *@version   1.1.0
    *@since     22/Mayo/2016
    *@param     $array Arreglo que contiene los datos recibidos desde $_POST
    *@return    Retorna TRUE si las validaciones de los campos fueron correctas, sino, retorna FALSE.
    */

    function validarRegistro($array){
        if(isset($array['titulo']) && isset($array['descripcion'])){
            $titulo = $array['titulo'];
            $desc = $array['descripcion'];
            if(imagenCtl::estaVacio($titulo) || imagenCtl::estaVacio($desc)){
                return false;
            }
        }
        else{
            return false;
        }

        if(isset($array['tags'])){
            $tags = $array['tags'];
            if(imagenCtl::estaVacio($tags) || !preg_match("/^([a-zA-Z]+\s)*[a-zA-Z0-9]+$/", $tags)){
                return false;
            }
        }
        else{
            return false;
        }

        if(!isset($_FILES['imagen']['error']) || is_array($_FILES['imagen']['error'])){
            return false;
        }

        switch($_FILES['imagen']['error']){
            case UPLOAD_ERR_OK:
                break;

            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                return false;
                break;

            case UPLOAD_ERR_NO_FILE:
                return false;
                break;
        }

        if($_FILES['imagen']['size'] > 10485760){
            return false;
        }

        $infoArchivo = new finfo(FILEINFO_MIME_TYPE);
        $extension = $infoArchivo->file($_FILES['imagen']['tmp_name']);
        $arrayTipos = array(
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif'
        );

        if(array_search($extension, $arrayTipos, true) === false){
            return false;
        }

        //Intentar mover imagen

        return true;
    }

    function sanitizar($array){
        $titulo = $array['titulo'];
        $desc = $array['descripcion'];
        $tags = $array['tags'];

        require_once('app/modelos/imagenMdl.php');
        $imgMdl = new imagenMdl();

        $titulo = $imgMdl->real_escape_string($titulo);
        $desc = $imgMdl->real_escape_string($desc);
        $tags = $imgMdl->real_escape_string($tags);

        $arrayNuevo = array(
            'titulo' => $titulo,
            'descripcion' => $desc,
            'tags' => $tags
        );

        return $arrayNuevo;
    }

    function crearThumbnail($ruta, $nombre){
		$inFile = $ruta;
		$outFile = '/var/www/html/Dragonart/uploads/thumb/'.$nombre;
		$image = new Imagick($inFile);
		$image->scaleImage(400, 300, true);
		if($image->getImageWidth() < 400){
			$ancho = (400 - $image->getImageWidth())/2;
			$image->borderImage('#EEF2F2',$ancho, 0);
		}
		else if($image->getImageHeight() < 300){
			$alto = (300 - $image->getImageHeight())/2;
			$image->borderImage('#EEF2F2',0, $alto);
		}
		$image->writeImage($outFile);
    }
}   
?>