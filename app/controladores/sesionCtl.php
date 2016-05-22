<?php

class sesionCtl {
    public $modelo;
    
    private $doctype;
    private $header;
    private $footer;

    function __construct() {
        session_start();
        echo 'Soy sesionCtl';
        
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
                    
                case 'recuperarcontrasenacorreo':
                    $this->recuperarcontrasenacorreo();
                    break;
                    
                case 'recuperarcontrasena':
                    $this->recuperarcontrasena();
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
        sesionCtl::generarHeader();

        if(isset($_POST)){
            if(sesionCtl::validarSesion($_POST)){
                require_once('app/modelos/usuarioMdl.php');
                $usrMdl = new usuarioMdl();
                if($usrMdl->iniciarSesion($_POST['correo'],$_POST['logPass'])){
                    $array = $usrMdl->obtenerInfo($_POST['correo'],$_POST['logPass']);
                    $_SESSION['correo'] = $array['correo'];
                    $_SESSION['logPass'] = $array['contrasena'];
                    $_SESSION['alias'] = $array['alias'];
                    $_SESSION['nombre'] = $array['nombre'];
                    header('Location: http://localhost/Dragonart/index.php?controlador=usuario&accion=mostrar&usuario='.$array['nombre']);
                }
                else{
                    unset($_SESSION['correo']);
                    unset($_SESSION['logPass']);
                    unset($_SESSION['alias']);
                    unset($_SESSION['nombre']);
                    
                    $vista = file_get_contents('app/vistas/formularioIniciarSesion.html');
                    $inicioFooter = strpos($vista, '<!--inicioFooter-->');
                    $finFooter = strpos($vista, '<!--finFooter-->')+16;
                    $remplazar = substr($vista,$inicioFooter,$finFooter-$inicioFooter);

                    $vista = str_replace($remplazar, $this->footer, $vista);
                    $vista = $this->doctype.$this->header.$vista;
                    echo $vista;
                }
            }
            else{
                $vista = file_get_contents('app/vistas/formularioIniciarSesion.html');
                $inicioFooter = strpos($vista, '<!--inicioFooter-->');
                $finFooter = strpos($vista, '<!--finFooter-->')+16;
                $remplazar = substr($vista,$inicioFooter,$finFooter-$inicioFooter);

                $vista = str_replace($remplazar, $this->footer, $vista);
                $vista = $this->doctype.$this->header.$vista;
                echo $vista;
            }
        }
        else{
            $vista = file_get_contents('app/vistas/formularioIniciarSesion.html');
            $inicioFooter = strpos($vista, '<!--inicioFooter-->');
            $finFooter = strpos($vista, '<!--finFooter-->')+16;
            $remplazar = substr($vista,$inicioFooter,$finFooter-$inicioFooter);

            $vista = str_replace($remplazar, $this->footer, $vista);
            $vista = str_replace('%error%', '', $vista);
            $vista = $this->doctype.$this->header.$vista;
            echo $vista;
        }
    }
    
    function recuperarcontrasenacorreo() {
        sesionCtl::generarHeader();

        $vista = file_get_contents('app/vistas/formularioRecuperarContrasenaCorreo.html');
        $inicioFooter = strpos($vista, '<!--inicioFooter-->');
        $finFooter = strpos($vista, '<!--finFooter-->')+16;
        $remplazar = substr($vista,$inicioFooter,$finFooter-$inicioFooter);

        $vista = str_replace($remplazar, $this->footer, $vista);
        $vista = $this->doctype.$this->header.$vista;
        echo $vista;
    }
    
    function recuperarcontrasena() {
        sesionCtl::generarHeader();

        $vista = file_get_contents('app/vistas/formularioRecuperarContrasena.html');
        $inicioFooter = strpos($vista, '<!--inicioFooter-->');
        $finFooter = strpos($vista, '<!--finFooter-->')+16;
        $remplazar = substr($vista,$inicioFooter,$finFooter-$inicioFooter);

        $vista = str_replace($remplazar, $this->footer, $vista);
        $vista = $this->doctype.$this->header.$vista;
        echo $vista;
    }

    function cerrarSesion(){
        session_unset();
        session_destroy();
        setcookie(session_name(), '', time()-3600);
        header('Location: http://localhost/Dragonart/index.php');
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
    *@since     19/Mayo/2016
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
    *<h1>validarSesion</h1>
    *<p>Esta función evalúa cada campo enviado en el parámetro $array para tomar cada
    *campo del formulario de inicio de sesión. Evalúa cada uno de estos campos con distintas
    *reglas como la longitud de la contraseña, no permitir campos llenos con espacios en blanco,
    *entre otras validaciones.</p>
    *
    *
    *@author    Mauricio Gerardo Lazcano Origel
    *@version   1.0.0
    *@since     15/Mayo/2016
    *@param     $array Arreglo que contiene los datos recibidos desde $_POST
    *@return    Retorna TRUE si las validaciones de los campos fueron correctas, sino, retorna FALSE.
    */

    function validarSesion($array){
        if(isset($array['correo'])){
            $correo = $array['correo'];
            if(sesionCtl::estaVacio($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL)){
                return false;
            }
        }
        else{
            return false;
        }

        if(isset($array['logPass'])){
            $contrasena = $array['logPass'];
            if(sesionCtl::estaVacio($contrasena) || strlen($contrasena) < 8){
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