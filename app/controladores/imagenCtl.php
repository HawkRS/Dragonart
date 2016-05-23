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
        imagenCtl::generarHeader();

        if(!isset($_SESSION['correo']) && !isset($_SESSION['logPass'])){
            $vista = file_get_contents('app/vistas/404.html');
            $inicioFooter = strpos($vista, '<!--inicioFooter-->');
            $finFooter = strpos($vista, '<!--finFooter-->')+16;
            $remplazar = substr($vista,$inicioFooter,$finFooter-$inicioFooter);

            $vista = str_replace($remplazar, $this->footer, $vista);
            $vista = str_replace('%mensaje%', 'No es posible subir imágenes si no haz iniciado sesión. Deja de buscar fallas en este sitio web, ¿De acuerdo?. Mira, te dejo este <a href="index.php?controlador=sesion&accion=iniciarsesion">vínculo</a> para que inicies sesión o <a href="index.php?controlador=usuario&accion=alta">este</a> para que te registres.', $vista);
            $vista = $this->doctype.$this->header.$vista;
            echo $vista;
        }

        $errorMsg = '';

        if(isset($_POST)){
            if(imagenCtl::validarRegistro($_POST)){
                $ruta = '/tmp/uploads/'.basename($_FILES['imagen']['name']);
                if(move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta)){

                	imagenCtl::crearThumbnail($ruta, $_FILES['imagen']['name']);
                    $postLimpio = imagenCtl::sanitizar($_POST);

                    require_once('app/modelos/usuarioMdl.php');
                    $usrMdl = new usuarioMdl();
                    $infoUsuario = $usrMdl->obtenerInfo($_SESSION['correo'], $_SESSION['logPass']);
                    var_dump($infoUsuario);

                    require_once('app/modelos/imagenMdl.php');
                    $imgMdl = new imagenMdl();
                    if($imgMdl->alta($infoUsuario['id'], $ruta, $postLimpio['titulo'], $postLimpio['descripcion'])){
                    	//Agregar a notificaciones
                    	$infoImagen = $imgMdl->obtenerInfoPorUrl($ruta);
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
        $inicioFooter = strpos($vista, '<!--inicioFooter-->');
        $finFooter = strpos($vista, '<!--finFooter-->')+16;
        $remplazar = substr($vista,$inicioFooter,$finFooter-$inicioFooter);
        
        $vista = str_replace($remplazar, $this->footer, $vista);
        $vista = str_replace('%error%', $errorMsg, $vista);
        $vista = $this->doctype.$this->header.$vista;
        echo $vista;
    }

    function inicio() {
        imagenCtl::generarHeader();

        $vista = file_get_contents('app/vistas/principal.html');
        $inicioBody = strpos($this->doctype, '<!--inicioBody-->');
        $finBody = strpos($this->doctype, '<!--finBody-->')+14;
        $inicioFooter = strpos($vista, '<!--inicioFooter-->');
        $finFooter = strpos($vista, '<!--finFooter-->')+16;
        
        $remplazarBody = substr($this->doctype,$inicioBody,$finBody-$inicioBody); 
        $remplazarFooter = substr($vista,$inicioFooter,$finFooter-$inicioFooter);
        
        $this->doctype = str_replace($remplazarBody, '<body class="index">', $this->doctype);        
        $vista = str_replace($remplazarFooter, $this->footer, $vista);
        
        $vista = $this->doctype.$this->header.$vista;
        echo $vista;
    }
    
    function mostrar() {
        imagenCtl::generarHeader();

        $vista = file_get_contents('app/vistas/publicacionIndex.html');
        $inicioFooter = strpos($vista, '<!--inicioFooter-->');
        $finFooter = strpos($vista, '<!--finFooter-->')+16;
        $remplazar = substr($vista,$inicioFooter,$finFooter-$inicioFooter);
        
        $vista = str_replace($remplazar, $this->footer, $vista);
        $vista = $this->doctype.$this->header.$vista;
        echo $vista;
    }

    function generarHeader(){
        if(isset($_SESSION['correo']) && isset($_SESSION['logPass']) && isset($_SESSION['alias']) && isset($_SESSION['nombre'])){
            $inicio = strpos($this->header,'<!--Inicio Offline-->');
            $fin = strpos($this->header, '<!--Fin Offline-->')+18;
            $busqueda = substr($this->header, $inicio, $fin-$inicio);
            $this->header = str_replace($busqueda, "", $this->header);
            $this->header = str_replace('%alias%', $_SESSION['alias'], $this->header);
            $this->header = str_replace('%usuario%', $_SESSION['nombre'], $this->header);
        }
        else{
            $inicio = strpos($this->header,'<!--Inicio Online-->');
            $fin = strpos($this->header, '<!--Fin Online-->')+17;
            $busqueda = substr($this->header, $inicio, $fin-$inicio);
            $this->header = str_replace($busqueda, "", $this->header);
        }
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

        //SECCION VALIDADOR DE ARCHIVO IMAGEN
        $destino = '/tmp/uploads/';
        $destArchivo = $destino.basename($_FILES['imagen']['name']);

        $tipoImagen = pathinfo($destArchivo,PATHINFO_EXTENSION);

        if(isset($array["submit"])){
            $tam = getimagesize($_FILES['imagen']['tmp_name']);
            if($tam === false) {
                echo 'No es imagen';
                return false;
            }
        }

        if(file_exists($destArchivo)){
            echo 'archivo existente';
            return false;
        }

        if($_FILES['imagen']['size'] > 1310720){
            echo 'archivo pesado';
            return false;
        }

        if($tipoImagen != 'jpg' && $tipoImagen != 'png' && $tipoImagen != 'jpeg' && $tipoImagen != 'gif') {
            echo 'archivo sin extension valida';
            return false;
        }
        

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
		$outFile = '/tmp/uploads/thumb/'.$nombre;
		$image = new Imagick($inFile);
		$image->scaleImage(400, 300, true);
		if($image->getImageWidth() < 400){
			$ancho = (400 - $image->getImageWidth())/2;
			$image->borderImage('transparent',$ancho, 0);
		}
		else if($image->getImageHeight() < 300){
			$alto = (300 - $image->getImageHeight())/2;
			$image->borderImage('transparent',0, $alto);
		}
		$image->writeImage($outFile);
    }
}   
?>