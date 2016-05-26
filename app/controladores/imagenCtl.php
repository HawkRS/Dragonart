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
        require_once('app/controladores/validador.php');
        $validador = new validador();

        if(!isset($_SESSION['correo']) && !isset($_SESSION['logPass'])){
            $vista = file_get_contents('app/vistas/404.html');
            $mensaje = 'No es posible subir imágenes si no haz iniciado sesión.';
            $vista = $procesador->vistaError404($this->doctype, $this->header, $vista, $this->footer, $mensaje);
            echo $vista;
        }
        else{
            $errorMsg = '';

            if(!empty($_POST)){
                $error = $validador->validarRegistroImagen($_POST);
                if($error === true){
                    require_once('app/modelos/usuarioMdl.php');
                    $usrMdl = new usuarioMdl();
                    $infoUsuario = $usrMdl->obtenerInfo($_SESSION['correo'], $_SESSION['logPass']);
                    $nuevoNombre = $validador->moverArchivo('imagen', 'img', $infoUsuario);
                    if($nuevoNombre !== false){
                        imagenCtl::crearThumbnail($nuevoNombre, str_replace('/var/www/html/Dragonart/uploads/img/', '', $nuevoNombre));
                        $postLimpio = $validador->sanitizar($_POST);

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
                        $errorMsg = '<div class="alert alert-danger">'.$nuevoNombre.'</div>';
                    }
                     
                }
                else{
                    $errorMsg = '<div class="alert alert-danger">'.$error.'</div>';
                }
                
            }

            $vista = file_get_contents('app/vistas/formularioImagen.html');
            $vista = $procesador->vistaSubirImagen($this->doctype, $this->header, $vista, $this->footer, $errorMsg);
            echo $vista;
        }
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

        if($infoImagen === false || $infoImagen['status'] === 0){
            $vista = file_get_contents('app/vistas/404.html');
            $mensaje = 'La imagen solicitada no existe.';
            $vista = $procesador->vistaError404($this->doctype, $this->header, $vista, $this->footer, $mensaje);
            echo $vista;
        }
        else{

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