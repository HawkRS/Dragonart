<?php

class imagenCtl {
    public $modelo;
    
    private $doctype;
    private $header;
    private $footer;

    function __construct() {
    	session_start();

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

                case 'modificar':
                    $this->modificar();
                    break;

                case 'masImagenes':
                    echo json_encode($this->masImagenes());
                    break;

                case 'masFavoritos':
                    echo json_encode($this->masFavoritos());
                    break;

                case 'altaFavorito':
                    echo $this->altaFavorito();
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
                        imagenCtl::crearThumbnail($nuevoNombre, str_replace($_SERVER['DOCUMENT_ROOT'].'/Dragonart/uploads/img/', '', $nuevoNombre));
                        $postLimpio = $validador->sanitizar($_POST);

                        require_once('app/modelos/imagenMdl.php');
                        $imgMdl = new imagenMdl();
                        require_once('app/modelos/tagsMdl.php');
                        $tagMdl = new tagsMdl();
                        if($imgMdl->alta($infoUsuario['id'], $nuevoNombre, $postLimpio['titulo'], $postLimpio['descripcion'])){
                            $infoImagen = $imgMdl->obtenerInfoPorUrl($nuevoNombre);
                            if($tagMdl->alta($infoImagen['id'], $postLimpio['tags'])){
                                //Agregar a notificaciones
                                $infoImagen = $imgMdl->obtenerInfoPorUrl($nuevoNombre);
                                header('Location: http://localhost/Dragonart/index.php?controlador=imagen&accion=mostrar&img='.$infoImagen['id']);
                            }
                            else{
                                $errorMsg = '<div class="alert alert-danger">ERROR: '.$tagMdl->getError().'.</div>';
                            }
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
        if(isset($_SESSION['correo']) && isset($_SESSION['logPass'])){
        	$infoUsuarioActual = $usrMdl->obtenerInfo($_SESSION['correo'], $_SESSION['logPass']);
        }
        else{
        	$infoUsuarioActual = false;
        }
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
                    if($infoUsuarioActual !== false && $comMdl->alta($infoImagen['id'], $infoUsuarioActual['id'], $_POST['comentario'])){
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

            require_once('app/modelos/tagsMdl.php');
            $tagMdl = new tagsMdl();
            $tags = $tagMdl->obtenerTagsImagen($infoImagen['id']);
            
            $vista = file_get_contents('app/vistas/publicacionIndex.html');

            $vista = $procesador->vistaMostrarImagen($this->doctype, $this->header, $vista, $this->footer, $infoImagen, $infoUsuario, $tags, $comentarios, $mensaje);

            echo $vista;
            
        }

    }

    function masImagenes(){

        require_once('app/modelos/usuarioMdl.php');
        $usrMdl = new usuarioMdl();
        require_once('app/modelos/imagenMdl.php');
        $imgMdl = new imagenMdl();
        $infoUsuario = $usrMdl->paginaUsuario($_POST['usuario']);
        $infoImagen = array();

        if($infoUsuario !== false){
            $infoImagen = $imgMdl->obtenerGaleria($infoUsuario['id'], $_POST['offset'], $_POST['limit']);
            if($infoImagen === false){
                $infoImagen = array();
            }else{
                for($x = 0; $x < count($infoImagen); $x++){
                    $infoImagen[$x]['url'] = str_replace($_SERVER['DOCUMENT_ROOT'].'/Dragonart/', '', $infoImagen[$x]['url']);
                    if(isset($_SESSION['correo']) && $_SESSION['correo'] === $infoUsuario['correo']){
                        $infoImagen[$x]['bool'] = true;
                    }else{
                        if(isset($_SESSION['correo']) && $_SESSION['correo'] !== $infoUsuario['correo']){
                            $infoImagen[$x]['bool'] = false;
                        }else{
                           if(!isset($_SESSION['correo'])){
                                $infoImagen[$x]['bool'] = true;
                           }
                        }
                    }
                }
            }
        }

        return $infoImagen;

    }

    function modificar(){
        require_once('app/controladores/procesadorPlantillas.php');
        $procesador = new procesadorPlantillas();

        if(isset($_SESSION['correo']) && isset($_SESSION['logPass'])){
            if(isset($_GET['img'])){
                require_once('app/modelos/usuarioMdl.php');
                $usrMdl = new usuarioMdl();
                require_once('app/modelos/imagenMdl.php');
                $imgMdl = new imagenMdl();
                require_once('app/modelos/tagsMdl.php');
                $tagMdl = new tagsMdl();

                $infoUsuario = $usrMdl->obtenerInfo($_SESSION['correo'], $_SESSION['logPass']);
                $infoImagen = $imgMdl->obtenerInfo($_GET['img']);
                $infoTags = $tagMdl->obtenerTagsImagen($_GET['img']);
                $todosTags = '';

                if($infoUsuario !== false && $infoImagen !== false && $infoTags !== false && !empty($infoUsuario) && !empty($infoImagen) && !empty($infoTags)){
                    for($x = 0; $x < count($infoTags); $x++){
                        $todosTags .= $infoTags[$x]['tag'];
                        $todosTags .= ' ';
                    }

                    if($infoUsuario['id'] === $infoImagen['idUsuario']){
                        if(!empty($_POST)){

                        }else{
                            $vista = file_get_contents('app/vistas/formularioEditarImagen.html');
                            $mensaje = '';
                            $vista = $procesador->vistaModificarImagen($this->doctype, $this->header, $vista, $this->footer, $infoImagen, $todosTags, $mensaje);
                            echo $vista;
                        }
                    }else{
                        $vista = file_get_contents('app/vistas/404.html');
                        $mensaje = 'No puedes editar esta imagen si no eres su autor.';
                        $vista = $procesador->vistaError404($this->doctype, $this->header, $vista, $this->footer, $mensaje);
                        echo $vista;
                    }
                }else{
                    $vista = file_get_contents('app/vistas/404.html');
                    $mensaje = 'La imagen solicitada no existe.';
                    $vista = $procesador->vistaError404($this->doctype, $this->header, $vista, $this->footer, $mensaje);
                    echo $vista;
                }

            }else{
                $vista = file_get_contents('app/vistas/404.html');
                $mensaje = 'La imagen solicitada no existe.';
                $vista = $procesador->vistaError404($this->doctype, $this->header, $vista, $this->footer, $mensaje);
                echo $vista;
            }
        }else{
            $vista = file_get_contents('app/vistas/404.html');
            $mensaje = 'No puedes modificar la imagen si no haz iniciado sesión.';
            $vista = $procesador->vistaError404($this->doctype, $this->header, $vista, $this->footer, $mensaje);
            echo $vista;
        }
    }

    function masFavoritos(){

        require_once('app/modelos/usuarioMdl.php');
        $usrMdl = new usuarioMdl();
        require_once('app/modelos/imagenMdl.php');
        $imgMdl = new imagenMdl();
        require_once('app/modelos/favoritoMdl.php');
        $favMdl = new favoritoMdl();
        $infoUsuario = $usrMdl->paginaUsuario($_POST['usuario']);
        $galFavoritos = array();
        $bool = true;

        if($infoUsuario !== false && !empty($infoUsuario)){
            $infoFavorito = $favMdl->obtenerTodos($infoUsuario['id'], $_POST['offset'], $_POST['limit']);
            if($infoFavorito === false){
                $galFavoritos = array();
            }else{
                for($x = 0; $x < count($infoFavorito) && $x < $_POST['limit']; $x++){
                    $infoImagen = $imgMdl->obtenerInfo($infoFavorito[$x]['imagen']);
                    if($infoImagen !== false && !empty($infoImagen) && $infoImagen['status'] !== 0){
                        $infoImagen['url'] = str_replace('/var/www/html/Dragonart/', '', $infoImagen['url']);
                        if(isset($_SESSION['correo']) && $_SESSION['correo'] === $infoUsuario['correo']){
                            $bool = true;
                        }else{
                            if(isset($_SESSION['correo']) && $_SESSION['correo'] !== $infoUsuario['correo']){
                                $bool = false;
                            }else{
                               if(!isset($_SESSION['correo'])){
                                    $bool = true;
                               }
                            }
                        }
                        $galFavoritos[$x] = array(
                            'id' => $infoImagen['id'],
                            'idUsuario' => $infoImagen['idUsuario'],
                            'url' => $infoImagen['url'],
                            'titulo' => $infoImagen['titulo'],
                            'descripcion' => $infoImagen['descripcion'],
                            'fecha' => $infoImagen['fecha'],
                            'status' => $infoImagen['status'],
                            'promedio' => $infoImagen['promedio'],
                            'tipo' => $infoImagen['tipo'],
                            'bool' => $bool
                        );
                    }
                }
            }
        }

        return $galFavoritos;

    }

    function altaFavorito(){

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