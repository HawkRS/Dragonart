<?php

class sesionCtl {
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
                    
                case 'iniciarsesion':
                    $this->iniciarsesion();
                    break;
                    
                case 'iniciarsesionFB':
                    echo $this->iniciarsesionFB();
                    break;
                    
                case 'recuperarcontrasenacorreo':
                    $this->recuperarcontrasenacorreo();
                    break;
                
                case 'mandarcorreorecuperacion':
                    $this->mandarcorreorecuperacion();
                    break;
                    
                case 'recuperarcontrasena':
                    $this->recuperarcontrasena();
                    break;
                    
                case 'mandarcorreoconfirmacion':
                    $this->mandarcorreoconfirmacion();
                    break;

                case 'cerrarsesion':
                    $this->cerrarSesion();
                    break;
            }
        }
        else {
            $this->iniciarsesion();
        }
    }
    
    function iniciarsesion() {
        require_once('app/controladores/validador.php');
        $validador = new validador();
        require_once('app/controladores/procesadorPlantillas.php');
        $procesador = new procesadorPlantillas();

        if(!empty($_POST)){
            $error = $validador->validarSesion($_POST);
            if($error === true){
                require_once('app/modelos/usuarioMdl.php');
                $usrMdl = new usuarioMdl();
                if($usrMdl->iniciarSesion($_POST['correo'],$_POST['logPass'])){
                    $array = $usrMdl->obtenerInfo($_POST['correo'],$_POST['logPass']);
                    $_SESSION['correo'] = $_POST['correo'];
                    $_SESSION['logPass'] = $_POST['logPass'];
                    $_SESSION['alias'] = $array['alias'];
                    $_SESSION['nombre'] = $array['nombre'];
                    $_SESSION['admin'] = $array['tipo'];
                    header('Location: http://localhost/Dragonart/index.php?controlador=usuario&accion=mostrar&usuario='.$_SESSION['nombre']);
                }
                else{
                    unset($_SESSION['correo']);
                    unset($_SESSION['logPass']);
                    unset($_SESSION['alias']);
                    unset($_SESSION['nombre']);
                    unset($_SESSION['admin']);
                    
                    $vista = file_get_contents('app/vistas/formularioIniciarSesion.html');
                    $mensaje = '<div class="alert alert-danger">El correo o la contraseña ingresados son erroneos.</div>';
                    $vista = $procesador->vistaIniciarSesion($this->doctype, $this->header, $vista, $this->footer, $mensaje);
                    echo $vista;
                }
            }
            else{
                $vista = file_get_contents('app/vistas/formularioIniciarSesion.html');
                $mensaje = '<div class="alert alert-danger">'+ $error +'</div>';
                $vista = $procesador->vistaIniciarSesion($this->doctype, $this->header, $vista, $this->footer, $mensaje);
                echo $vista;
            }
        }
        else{
            $vista = file_get_contents('app/vistas/formularioIniciarSesion.html');
            $mensaje = '';
            $vista = $procesador->vistaIniciarSesion($this->doctype, $this->header, $vista, $this->footer, $mensaje);
            echo $vista;
        }
    }
    
    function iniciarsesionFB() {
        require_once('app/controladores/procesadorPlantillas.php');
        $procesador = new procesadorPlantillas();
        require_once('app/modelos/usuarioMdl.php');
        $usrMdl = new usuarioMdl();

        if(!empty($_POST)){
            $datosFB = json_decode($_POST['datosFB'], true);
            if($usrMdl->existeCorreo($datosFB['email'])){
                $array = $usrMdl->obtenerInfoFB($datosFB['email']);
                $_SESSION['correo'] = $array['correo'];
                $_SESSION['logPass'] = $array['contrasena'];
                $_SESSION['alias'] = $array['alias'];
                $_SESSION['nombre'] = $array['nombre'];
                $_SESSION['admin'] = $array['tipo'];
                echo $_SESSION['nombre'];
            }
            else {
                $contrasena = sha1($contrasena);
                if($usrMdl->alta($datosFB['name'],$datosFB['name'],$datosFB['email'],$contrasena, 1)){
                    if($usrMdl->iniciarSesion($datosFB['email'],$contrasena)){
                        $_SESSION['correo'] = $datosFB['email'];
                        $_SESSION['logPass'] = $contrasena;
                        $_SESSION['alias'] = $datosFB['name'];
                        $_SESSION['nombre'] = $datosFB['name'];
                        $_SESSION['admin'] = 1;
                        echo $_SESSION['nombre'];
                    }
                    else{
                        echo false;
                    }
                }
            }
        }
        else{
            echo false;
        }
    }
    
    function recuperarcontrasenacorreo() {
        require_once('app/controladores/validador.php');
        $validador = new validador();
        require_once('app/controladores/procesadorPlantillas.php');
        $procesador = new procesadorPlantillas();
        require_once('app/modelos/usuarioMdl.php');
        $usrMdl = new usuarioMdl();

        if(!empty($_POST)){
            $error = $validador->validarCorreoParaNuevaContrasena($_POST);
            if($error === true){
                if($usrMdl->existeCorreo($_POST['correo'])){
                    $respuesta = sesionCtl::mandarcorreorecuperacion();
                    if($respuesta === true){
                        $vista = file_get_contents('app/vistas/formularioRecuperarContrasenaCorreo.html');
                        $mensaje = '<div class="alert alert-success">Se ha enviado un correo para cambiar su contraseña. Revise su bandeja de correos.</div>';
                        $vista = $procesador->vistaRecuperarContrasenaCorreo($this->doctype, $this->header, $vista, $this->footer, $mensaje);
                        echo $vista;
                    }else{
                        $vista = file_get_contents('app/vistas/formularioRecuperarContrasenaCorreo.html');
                        $mensaje = '<div class="alert alert-danger">'+ $respuesta +'</div>';
                        $vista = $procesador->vistaRecuperarContrasenaCorreo($this->doctype, $this->header, $vista, $this->footer, $mensaje);
                        echo $vista;
                    }
                }else{
                    $vista = file_get_contents('app/vistas/formularioRecuperarContrasenaCorreo.html');
                    $mensaje = '<div class="alert alert-danger">El correo ingresado no existe en la base de datos.</div>';
                    $vista = $procesador->vistaRecuperarContrasenaCorreo($this->doctype, $this->header, $vista, $this->footer, $mensaje);
                    echo $vista;
                }
            }else{
                $vista = file_get_contents('app/vistas/formularioRecuperarContrasenaCorreo.html');
                $mensaje = '<div class="alert alert-danger">'+ $error +'</div>';
                $vista = $procesador->vistaRecuperarContrasenaCorreo($this->doctype, $this->header, $vista, $this->footer, $mensaje);
                echo $vista;
            }
        }else{
            $vista = file_get_contents('app/vistas/formularioRecuperarContrasenaCorreo.html');
            $mensaje = '';
            $vista = $procesador->vistaRecuperarContrasenaCorreo($this->doctype, $this->header, $vista, $this->footer, $mensaje);
            echo $vista;
        }

    }
    
    function mandarcorreorecuperacion(){
        $respuesta = 'Debe escribir un correo.';
        if(!empty($_POST)){
            require_once('app/modelos/usuarioMdl.php');
            $usrMdl = new usuarioMdl();
            $infoUsuario = $usrMdl->existeCorreoNombre($_POST['correo']);
            if($infoUsuario !== false && !empty($infoUsuario)){
                require_once('app/controladores/correoCtl.php');
                $correoCtl = new correoCtl();
                $respuesta = $correoCtl->mandarCorreoRecuperacion($infoUsuario['nombre'],$infoUsuario['correo'],$infoUsuario['pass']);
            }else{
                $respuesta = 'No existe el correo en la base de datos.';
            }
        }
        return $respuesta;
    }
    
    function recuperarcontrasena() {
        require_once('app/controladores/procesadorPlantillas.php');
        $procesador = new procesadorPlantillas();
        require_once('app/controladores/procesadorPlantillas.php');
        $procesador = new procesadorPlantillas();
        require_once('app/modelos/usuarioMdl.php');
        $usrMdl = new usuarioMdl();

        if(isset($_SESSION['correo']) && isset($_SESSION['logPass'])){
            header('Location: http://localhost/Dragonart/index.php');
        }else{
            if(isset($_GET['w']) && strlen($_GET['w']) > 0){
                $vista = file_get_contents('app/vistas/formularioRecuperarContrasena.html');
                $mensaje = '';
                $vista = $procesador->vistaRecuperarContrasena($this->doctype, $this->header, $vista, $this->footer, $mensaje);
                
                echo $vista;
            }else{
                header('Location: http://localhost/Dragonart/index.php');
            }
        }
    }
    
    function mandarcorreoconfirmacion(){
        if(!empty($_POST)){
            require_once('app/modelos/usuarioMdl.php');
            $usrMdl = new usuarioMdl();
            $infoUsuario = $usrMdl->existeCorreoNombre($_POST['correo']);
            if($infoUsuario !== false && !empty($infoUsuario)){
                require_once('app/controladores/correoCtl.php');
                $correoCtl = new correoCtl();
                if($correoCtl->mandarCorreoConfirmacion($infoUsuario['nombre'],$infoUsuario['correo'])){
                    header('Location: http://localhost/Dragonart/index.php');
                }
            }
        }
    }

    function cerrarSesion(){
        session_unset();
        session_destroy();
        setcookie(session_name(), '', time()-3600);
        header('Location: http://localhost/Dragonart/index.php');
    }
    
}
?>