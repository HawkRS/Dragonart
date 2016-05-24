<?php

class usuarioCtl {
    public $modelo;
    
    private $doctype;
    private $header;
    private $footer;

    function __construct() {
        session_start();
        echo 'Soy usuarioCtl';
        
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
                    
                case 'modificar':
                    $this->modificar();
                    break;
                    
                case 'mostrar':
                    $this->mostrar();
                    break;
            }
        }
        else {
            $this->alta();
        }
    }
    
    function alta() {
        usuarioCtl::generarHeader();

    	if(isset($_POST)){
			if(usuarioCtl::validarRegistro($_POST)){
                require_once('app/modelos/usuarioMdl.php');
                $usrMdl = new usuarioMdl();
                if($usrMdl->alta($_POST['nombre'],$_POST['alias'],$_POST['correo'],$_POST['contrasena'])){
                    if($usrMdl->iniciarSesion($_POST['correo'],$_POST['contrasena'])){
                        $_SESSION['correo'] = $_POST['correo'];
                        $_SESSION['logPass'] = $_POST['contrasena'];
                        $_SESSION['alias'] = $_POST['alias'];
                        $_SESSION['nombre'] = $_POST['nombre'];
                        header('Location: http://localhost/Dragonart/index.php?controlador=usuario&accion=mostrar&usuario='.$_POST['nombre']);
                    }
                    else{
                        $vista = file_get_contents('app/vistas/formularioRegistrarUsuario.html');
                        $inicioFooter = strpos($vista, '<!--inicioFooter-->');
                        $finFooter = strpos($vista, '<!--finFooter-->')+16;
                        $remplazar = substr($vista,$inicioFooter,$finFooter-$inicioFooter);

                        $vista = str_replace($remplazar, $this->footer, $vista);
                        $vista = str_replace('%error%', '<div class="alert alert-danger">Hubo un error al procesar la solicitud. Por favor, intente de nuevo.</div>', $vista);
                        $vista = $this->doctype.$this->header.$vista;
                        echo $vista;
                    }
                }else{
                    $vista = file_get_contents('app/vistas/formularioRegistrarUsuario.html');
                    $inicioFooter = strpos($vista, '<!--inicioFooter-->');
                    $finFooter = strpos($vista, '<!--finFooter-->')+16;
                    $remplazar = substr($vista,$inicioFooter,$finFooter-$inicioFooter);

                    $vista = str_replace($remplazar, $this->footer, $vista);
                    $vista = str_replace('%error%', '<div class="alert alert-danger">'.$usrMdl->getError().'</div>', $vista);
                    $vista = $this->doctype.$this->header.$vista;
                    echo $vista;
                }
			}
			else{
                if(count($_POST) === 0){
    				$vista = file_get_contents('app/vistas/formularioRegistrarUsuario.html');
                    $inicioFooter = strpos($vista, '<!--inicioFooter-->');
                    $finFooter = strpos($vista, '<!--finFooter-->')+16;
                    $remplazar = substr($vista,$inicioFooter,$finFooter-$inicioFooter);

                    $vista = str_replace($remplazar, $this->footer, $vista);
                    $vista = str_replace('%error%', '', $vista);
                    $vista = $this->doctype.$this->header.$vista;
                    echo $vista;
                }
                else{
                    $vista = file_get_contents('app/vistas/formularioRegistrarUsuario.html');
                    $inicioFooter = strpos($vista, '<!--inicioFooter-->');
                    $finFooter = strpos($vista, '<!--finFooter-->')+16;
                    $remplazar = substr($vista,$inicioFooter,$finFooter-$inicioFooter);

                    $vista = str_replace($remplazar, $this->footer, $vista);
                    $vista = str_replace('%error%', '<div class="alert alert-danger">Hubo un error al procesar la solicitud. Por favor, intente de nuevo.</div>', $vista);
                    $vista = $this->doctype.$this->header.$vista;
                    echo $vista;
                }
			}
		}
		else{
			$vista = file_get_contents('app/vistas/formularioRegistrarUsuario.html');
            $inicioFooter = strpos($vista, '<!--inicioFooter-->');
            $finFooter = strpos($vista, '<!--finFooter-->')+16;
            $remplazar = substr($vista,$inicioFooter,$finFooter-$inicioFooter);

            $vista = str_replace($remplazar, $this->footer, $vista);
            $vista = str_replace('%error%', '', $vista);
            $vista = $this->doctype.$this->header.$vista;
            echo $vista;
		}
    }
    
    function modificar() {
        usuarioCtl::generarHeader();

        if(empty($_POST) && isset($_SESSION['correo']) && isset($_SESSION['logPass'])){
            $vista = file_get_contents('app/vistas/formularioConfiguracionUsuario.html');
            $inicioFooter = strpos($vista, '<!--inicioFooter-->');
            $finFooter = strpos($vista, '<!--finFooter-->')+16;
            $remplazar = substr($vista,$inicioFooter,$finFooter-$inicioFooter);

            $vista = str_replace($remplazar, $this->footer, $vista);
            $vista = $this->doctype.$this->header.$vista;
            echo $vista;
        } 
        else {            
            $vista = file_get_contents('app/vistas/usuarioIndex.html');
            $inicioFooter = strpos($vista, '<!--inicioFooter-->');
            $finFooter = strpos($vista, '<!--finFooter-->')+16;
            $remplazar = substr($vista,$inicioFooter,$finFooter-$inicioFooter);

            $vista = str_replace($remplazar, $this->footer, $vista);
            $vista = $this->doctype.$this->header.$vista;
            echo $vista;
        }
    }
    
    function mostrar(){
        usuarioCtl::generarHeader();

        if(isset($_GET['usuario'])){
            require_once('app/modelos/usuarioMdl.php');
            $usrMdl = new usuarioMdl();
            $dato = $usrMdl->paginaUsuario($_GET['usuario']);
            $array = $usrMdl->obtenerInfo($_SESSION['correo'],$_SESSION['logPass']);

            require_once('app/modelos/imagenMdl.php');
            $imgMdl = new imagenMdl();
            $galeria = $imgMdl->obtenerGaleria($dato['id'], 0);
            
            if(isset($dato['nombre'])){
                $vista = file_get_contents('app/vistas/usuarioIndex.html');
                $inicioFooter = strpos($vista, '<!--inicioFooter-->');
                $finFooter = strpos($vista, '<!--finFooter-->')+16;
                $remplazar = substr($vista,$inicioFooter,$finFooter-$inicioFooter);

                $vista = str_replace($remplazar, $this->footer, $vista);
                $vista = usuarioCtl::completarVistaUsuario($vista, $dato, $galeria);
                $vista = $this->doctype.$this->header.$vista;
                echo $vista;
            }
            else{
                $vista = file_get_contents('app/vistas/404.html');
                $inicioFooter = strpos($vista, '<!--inicioFooter-->');
                $finFooter = strpos($vista, '<!--finFooter-->')+16;
                $remplazar = substr($vista,$inicioFooter,$finFooter-$inicioFooter);

                $vista = str_replace($remplazar, $this->footer, $vista);
                $vista = str_replace('%mensaje%', 'El usuario que buscas no existe... Seguro que modificaste la URL directamente. Deja de hacer bromas y usa este sitio de forma responzable.', $vista);
                $vista = $this->doctype.$this->header.$vista;
                echo $vista;
            }
        }
        else{
            $vista = file_get_contents('app/vistas/404.html');
            $inicioFooter = strpos($vista, '<!--inicioFooter-->');
            $finFooter = strpos($vista, '<!--finFooter-->')+16;
            $remplazar = substr($vista,$inicioFooter,$finFooter-$inicioFooter);

            $vista = str_replace($remplazar, $this->footer, $vista);
            $vista = str_replace('%mensaje%', 'No se especificó el usuario a mostrar. ¿Qué intentas provar con esto? Solo regresa a la página anterior o mejor cierra esta pestaña y olvidemos que esto pasó.', $vista);
            $vista = $this->doctype.$this->header.$vista;
            echo $vista;
        }
    }
    

    function completarVistaUsuario($vista, $array, $galeria) {
        
        $thumbnails = '';
        $inicio = strpos($vista,'<!--inicioRepetirImagen-->');
        $fin = strpos($vista, '<!--finalRepetirImagen-->')+25;
        $thumbnail = substr($vista,$inicio,$fin-$inicio);

        $filas = '';
        $inicioFila = strpos($vista,'<!--inicioFila-->');
        $finFila = strpos($vista, '<!--finFila-->')+14;
        $fila = substr($vista,$inicioFila,$finFila-$inicioFila);


        if(!isset($array['biografia'])){
            $array['biografia'] = '<i>No hay descripción...</i>';
        }

        if($array['nombre'] === $_SESSION['nombre']){
            $inicioBtn = strpos($vista,'<!--IniBotonSeguir-->');
            $finBtn = strpos($vista, '<!--FinBotonSeguir-->')+21;
            $btnSeguir = substr($vista,$inicioBtn,$finBtn-$inicioBtn);
            $vista = str_replace($btnSeguir, '', $vista);
        }

        $diccionario = array (
            '%alias%' => $array['alias'],
            '%descripcion%' => $array['biografia'],
            '%avatarUsuario%' => $array['avatar']
        );
        
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
                
                $new_thumbnail = strtr($new_thumbnail,$diccionarioImagen);
                $thumbnails .= $new_thumbnail;
            }
            
            $new_fila = $fila;

            $diccionarioFila = array(
                '%conteo%' => $contador
            );

            $new_fila = str_replace($thumbnail, $thumbnails, $new_fila);
            $new_fila = strtr($new_fila, $diccionarioFila);
            $filas .= $new_fila;
        }
        else{
            $filas = '<i>No hay imágenes en la galería...</i>';
        }
        
        $vista = str_replace($fila, $filas, $vista);
        
        $vista = strtr($vista,$diccionario);
        
        return $vista;
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
    *<h1>validarRegistro</h1>
    *<p>Esta función evalúa cada campo enviado en el parámetro $array para tomar cada
    *campo del formulario de registro de usuario. Evalúa cada uno de estos campos con distintas
    *reglas como la longitud de la contraseña, no permitir campos llenos con espacios en blanco,
    *entre otras validaciones.</p>
    *
    *
    *@author 	Mauricio Gerardo Lazcano Origel
    *@version 	1.1.0
    *@since 	15/Mayo/2016
    *@param 	$array Arreglo que contiene los datos recibidos desde $_POST
    *@return 	Retorna TRUE si las validaciones de los campos fueron correctas, sino, retorna FALSE.
    */

    function validarRegistro($array){
    	if(isset($array['nombre'])){
	    	$nombre = $array['nombre'];
	    	if(usuarioCtl::estaVacio($nombre) || !preg_match("/^([a-zA-Z]+\s)*[a-zA-Z]+$/", $nombre)){
	    		return false;
	    	}
    	}
    	else{
    		return false;
    	}

    	if(isset($array['alias'])){
	    	$alias = $array['alias'];
	    	if(usuarioCtl::estaVacio($alias) || !preg_match("/^[a-zA-Z0-9_-]{3,16}$/", $alias)){
	    		return false;
	    	}
    	}
    	else{
    		return false;
    	}

    	if(isset($array['correo'])){
	    	$correo = $array['correo'];
	    	if(usuarioCtl::estaVacio($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL)){
	    		return false;
	    	}
	    }
    	else{
    		return false;
    	}

    	if(isset($array['contrasena'])){
	    	$contrasena = $array['contrasena'];
	    	if(usuarioCtl::estaVacio($contrasena) || strlen($contrasena) < 8){
	    		return false;
	    	}
	    }
    	else{
    		return false;
    	}

    	if(isset($array['contrasenaConfirmacion'])){
	    	$contrasenaConfirmacion = $array['contrasenaConfirmacion'];
	    	if(usuarioCtl::estaVacio($contrasenaConfirmacion) || strcmp($contrasena, $contrasenaConfirmacion) !== 0){
	    		return false;
	    	}
	    }
    	else{
    		return false;
    	}

    	return true;
    }

}
?>