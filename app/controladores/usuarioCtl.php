<?php

class usuarioCtl {
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
                    
                case 'modificar':
                    $this->modificar();
                    break;
                    
                case 'mostrar':
                    $this->mostrar();
                    break;

                case 'seguirUsuario':
                    $this->seguirUsuario();
                    break;

                case 'dejarUsuario':
                    $this->dejarUsuario();
                    break;

                case 'estadoUsuario':
                    $this->estadoUsuario();
                    break;

                case 'seguidores':
                    echo json_encode($this->seguidores());
                    break;

                case 'seguidos':
                    echo json_encode($this->seguidos());
                    break;
            }
        }
        else {
            $this->alta();
        }
    }
    
    function alta() {

        require_once('app/controladores/procesadorPlantillas.php');
        $procesador = new procesadorPlantillas();

    	if(!empty($_POST)){
            require_once('app/controladores/validador.php');
            $validador = new validador();
            $error = $validador->validarRegistroUsuario($_POST);

			if($error === true){
                require_once('app/modelos/usuarioMdl.php');
                $usrMdl = new usuarioMdl();
                if($usrMdl->alta($_POST['nombre'],$_POST['alias'],$_POST['correo'],$_POST['contrasena'], 1)){
                    if($usrMdl->iniciarSesion($_POST['correo'],$_POST['contrasena'])){
                        $_SESSION['correo'] = $_POST['correo'];
                        $_SESSION['logPass'] = $_POST['contrasena'];
                        $_SESSION['alias'] = $_POST['alias'];
                        $_SESSION['nombre'] = $_POST['nombre'];
                        $_SESSION['admin'] = 1;
                        header('Location: http://localhost/Dragonart/index.php?controlador=usuario&accion=mostrar&usuario='.$_POST['nombre']);
                    }
                    else{
                        $vista = file_get_contents('app/vistas/formularioRegistrarUsuario.html');
                        $mensaje = '<div class="alert alert-danger">'.$usrMdl->getError().'</div>';
                        $vista = $procesador->vistaRegistrarUsuario($this->doctype, $this->header, $vista, $this->footer, $mensaje);
                        echo $vista;
                    }
                }else{
                    $vista = file_get_contents('app/vistas/formularioRegistrarUsuario.html');
                    $mensaje = '<div class="alert alert-danger">'.$usrMdl->getError().'</div>';
                    $vista = $procesador->vistaRegistrarUsuario($this->doctype, $this->header, $vista, $this->footer, $mensaje);
                    echo $vista;
                }
			}
			else{
                $vista = file_get_contents('app/vistas/formularioRegistrarUsuario.html');
                $mensaje = '<div class="alert alert-danger">'.$error.'</div>';
                $vista = $procesador->vistaRegistrarUsuario($this->doctype, $this->header, $vista, $this->footer, $mensaje);
                echo $vista;
			}
		}
		else{
			$vista = file_get_contents('app/vistas/formularioRegistrarUsuario.html');
            $mensaje = '';
            $vista = $procesador->vistaRegistrarUsuario($this->doctype, $this->header, $vista, $this->footer, $mensaje);
            echo $vista;
		}
    }
    
    function modificar() {

        require_once('app/controladores/procesadorPlantillas.php');
        $procesador = new procesadorPlantillas();
        require_once('app/modelos/usuarioMdl.php');
        $usrMdl = new usuarioMdl();

        if(!empty($_POST)){

            require_once('app/controladores/validador.php');
            $validador = new validador();
            $error = $validador->validarModificacionUsuario($_POST);

            if($error === true){
                
            }else{

            }

        } 
        else {
            if(isset($_SESSION['correo']) && isset($_SESSION['logPass'])){
                $infoUsuario = $usrMdl->obtenerInfo($_SESSION['correo'], $_SESSION['logPass']);
                if($infoUsuario !== false){
                    $vista = file_get_contents('app/vistas/formularioConfiguracionUsuario.html');
                    $mensaje = '';
                    $vista = $procesador->vistaModificarUsuario($this->doctype, $this->header, $vista, $this->footer, $infoUsuario, $mensaje);
                    echo $vista;
                }else{
                    $vista = file_get_contents('app/vistas/404.html');
                    $mensaje = 'El usuario solicitado no existe.';
                    $vista = $procesador->vistaError404($this->doctype, $this->header, $vista, $this->footer, $mensaje);
                    echo $vista;
                }
            }else{
                $vista = file_get_contents('app/vistas/404.html');
                $mensaje = 'La sesión no está iniciada.';
                $vista = $procesador->vistaError404($this->doctype, $this->header, $vista, $this->footer, $mensaje);
                echo $vista;
            }
        }

    }
    
    function mostrar(){

        require_once('app/controladores/procesadorPlantillas.php');
        $procesador = new procesadorPlantillas();

        if(isset($_GET['usuario'])){
            require_once('app/modelos/usuarioMdl.php');
            $usrMdl = new usuarioMdl();
            $infoUsuario = $usrMdl->paginaUsuario($_GET['usuario']);

            if($infoUsuario['status'] === 1 || (isset($_SESSION['admin']) && $_SESSION['admin'] === 0)){
                require_once('app/modelos/seguidorMdl.php');
                $segMdl = new seguidorMdl();
                if(isset($_SESSION['correo']) && isset($_SESSION['logPass'])){
                    $infoUsuarioSeguidor = $usrMdl->obtenerInfo($_SESSION['correo'], $_SESSION['logPass']);
                    $infoSeguidor = $segMdl->obtenerInfo($infoUsuarioSeguidor['id'], $infoUsuario['id']);
                    if($infoSeguidor['status'] === 1){
                        $estaSiguiendolo = true;
                    }else{
                        $estaSiguiendolo = false;
                    }
                }else{
                    $estaSiguiendolo = false;
                }

                require_once('app/modelos/imagenMdl.php');
                $imgMdl = new imagenMdl();
                $galeria = $imgMdl->obtenerGaleria($infoUsuario['id'], 0, 8);
                
                if(isset($infoUsuario['nombre'])){
                    $vista = file_get_contents('app/vistas/usuarioIndex.html');
                    $vista = $procesador->vistaPaginaUsuario($this->doctype, $this->header, $vista, $this->footer, $infoUsuario, $galeria, $estaSiguiendolo);
                    echo $vista;
                }
                else{
                    $vista = file_get_contents('app/vistas/404.html');
                    $mensaje = 'El usuario que buscas no existe.';
                    $vista = $procesador->vistaError404($this->doctype, $this->header, $vista, $this->footer, $mensaje);
                    echo $vista;
                }
            }
            else{
                $vista = file_get_contents('app/vistas/404.html');
                $mensaje = 'El usuario ha sido bloqueado. Si cree que esto es un error, por favor <a href="index.php?controlador=contacto&accion=mostrar">contáctenos</a>.';
                $vista = $procesador->vistaError404($this->doctype, $this->header, $vista, $this->footer, $mensaje);
                echo $vista;
            }
            
        }
        else{
            $vista = file_get_contents('app/vistas/404.html');
            $mensaje = 'No se especificó un usuario a mostrar.';
            $vista = $procesador->vistaError404($this->doctype, $this->header, $vista, $this->footer, $mensaje);
            echo $vista;
        }

    }

    function seguirUsuario(){

        if(isset($_SESSION['correo']) && isset($_SESSION['logPass']) && isset($_POST['nombre'])){
            require_once('app/modelos/usuarioMdl.php');
            $usrMdl = new usuarioMdl();
            require_once('app/modelos/seguidorMdl.php');
            $segMdl = new seguidorMdl();
            $infoUsuarioASeguir = $usrMdl->paginaUsuario($_POST['nombre']);
            $infoUsuarioSeguidor = $usrMdl->obtenerInfo($_SESSION['correo'], $_SESSION['logPass']);
            if($segMdl->existe($infoUsuarioSeguidor['id'], $infoUsuarioASeguir['id']) === false){
                if($segMdl->alta($infoUsuarioSeguidor['id'], $infoUsuarioASeguir['id'])){
                    return true;
                }
            }else{
                if($segMdl->modificar($infoUsuarioSeguidor['id'], $infoUsuarioASeguir['id'], 1)){
                    return true;
                }
            }
        }
        return false;

    }

    function dejarUsuario(){

        if(isset($_SESSION['correo']) && isset($_SESSION['logPass']) && isset($_POST['nombre'])){
            require_once('app/modelos/usuarioMdl.php');
            $usrMdl = new usuarioMdl();
            require_once('app/modelos/seguidorMdl.php');
            $segMdl = new seguidorMdl();
            $infoUsuarioASeguir = $usrMdl->paginaUsuario($_POST['nombre']);
            $infoUsuarioSeguidor = $usrMdl->obtenerInfo($_SESSION['correo'], $_SESSION['logPass']);
            if($segMdl->existe($infoUsuarioSeguidor['id'], $infoUsuarioASeguir['id']) === true){
                if($segMdl->modificar($infoUsuarioSeguidor['id'], $infoUsuarioASeguir['id'], 0)){
                    return true;
                }
            }
        }
        return false;

    }

    function estadoUsuario(){

        if(isset($_SESSION['correo']) && isset($_SESSION['logPass']) && isset($_SESSION['admin']) && $_SESSION['admin'] === 0 && isset($_POST['nombre'])){
            require_once('app/modelos/usuarioMdl.php');
            $usrMdl = new usuarioMdl();

            if($usrMdl->cambiarEstadoUsuario($_POST['nombre'], $_POST['status'])){
                return true;
            }
        }
        return false;

    }

    function seguidores(){
        require_once('app/modelos/usuarioMdl.php');
        $usrMdl = new usuarioMdl();
        require_once('app/modelos/seguidorMdl.php');
        $segMdl = new seguidorMdl();
        $infoUsuario = $usrMdl->paginaUsuario($_POST['usuario']);
        $galSeguidores = array();

        if($infoUsuario !== false && !empty($infoUsuario)){
            $infoSeguidores = $segMdl->obtenerSeguidores($infoUsuario['id'], $_POST['offset'], $_POST['limit']);
            if($infoSeguidores === false){
                $galSeguidores = array();
            }else{
                for($x = 0; $x < count($infoSeguidores) && $x < $_POST['limit']; $x++){
                    if($infoSeguidores[$x]['status'] === 1){
                        $usuarioSeguidor = $usrMdl->obtenerInfoPorID($infoSeguidores[$x]['seguidor']);
                        if($usuarioSeguidor !== false && !empty($usuarioSeguidor)){
                            $usuarioSeguidor['avatar'] = str_replace($_SERVER['DOCUMENT_ROOT'].'/Dragonart/', '', $usuarioSeguidor['avatar']);
                            
                            $galSeguidores[$x] = array(
                                'id' => $usuarioSeguidor['id'],
                                'nombre' => $usuarioSeguidor['nombre'],
                                'alias' => $usuarioSeguidor['alias'],
                                'correo' => $usuarioSeguidor['correo'],
                                'contrasena' => $usuarioSeguidor['contrasena'],
                                'biografia' => $usuarioSeguidor['biografia'],
                                'avatar' => $usuarioSeguidor['avatar'],
                                'tipo' => $usuarioSeguidor['tipo'],
                                'status' => $usuarioSeguidor['status']
                            );
                        }
                    }
                }
            }
        }

        return $galSeguidores;
    }

    function seguidos(){
        require_once('app/modelos/usuarioMdl.php');
        $usrMdl = new usuarioMdl();
        require_once('app/modelos/seguidorMdl.php');
        $segMdl = new seguidorMdl();
        $infoUsuario = $usrMdl->paginaUsuario($_POST['usuario']);
        $galSeguidores = array();

        if($infoUsuario !== false && !empty($infoUsuario)){
            $infoSeguidores = $segMdl->obtenerSeguidos($infoUsuario['id'], $_POST['offset'], $_POST['limit']);
            if($infoSeguidores === false){
                $galSeguidores = array();
            }else{
                for($x = 0; $x < count($infoSeguidores) && $x < $_POST['limit']; $x++){
                    if($infoSeguidores[$x]['status'] === 1){
                        $usuarioSeguidor = $usrMdl->obtenerInfoPorID($infoSeguidores[$x]['seguido']);
                        if($usuarioSeguidor !== false && !empty($usuarioSeguidor)){
                            $usuarioSeguidor['avatar'] = str_replace($_SERVER['DOCUMENT_ROOT'].'/Dragonart/', '', $usuarioSeguidor['avatar']);
                            
                            $galSeguidores[$x] = array(
                                'id' => $usuarioSeguidor['id'],
                                'nombre' => $usuarioSeguidor['nombre'],
                                'alias' => $usuarioSeguidor['alias'],
                                'correo' => $usuarioSeguidor['correo'],
                                'contrasena' => $usuarioSeguidor['contrasena'],
                                'biografia' => $usuarioSeguidor['biografia'],
                                'avatar' => $usuarioSeguidor['avatar'],
                                'tipo' => $usuarioSeguidor['tipo'],
                                'status' => $usuarioSeguidor['status']
                            );
                        }
                    }
                }
            }
        }

        return $galSeguidores;
    }

}
?>