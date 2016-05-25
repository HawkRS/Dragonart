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

        require_once('app/controladores/procesadorPlantillas.php');
        $procesador = new procesadorPlantillas();

    	if(!empty($_POST)){
            require_once('app/controladores/validador.php');
            $validador = new validador();
            $error = $validador->validarRegistroUsuario($_POST);

			if($error === true){
                require_once('app/modelos/usuarioMdl.php');
                $usrMdl = new usuarioMdl();
                if($usrMdl->alta($_POST['nombre'],$_POST['alias'],$_POST['correo'],$_POST['contrasena'])){
                    if($usrMdl->iniciarSesion($_POST['correo'],$_POST['contrasena'])){
                        $_SESSION['correo'] = $_POST['correo'];
                        $_SESSION['logPass'] = $_POST['contrasena'];
                        $_SESSION['alias'] = $_POST['alias'];
                        $_SESSION['nombre'] = $_POST['nombre'];
                        $_SESSION['admin'] = 0;
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

        require_once('app/controladores/procesadorPlantillas.php');
        $procesador = new procesadorPlantillas();

        if(isset($_GET['usuario'])){
            require_once('app/modelos/usuarioMdl.php');
            $usrMdl = new usuarioMdl();
            $infoUsuario = $usrMdl->paginaUsuario($_GET['usuario']);

            require_once('app/modelos/imagenMdl.php');
            $imgMdl = new imagenMdl();
            $galeria = $imgMdl->obtenerGaleria($infoUsuario['id'], 0);
            
            if(isset($infoUsuario['nombre'])){
                $vista = file_get_contents('app/vistas/usuarioIndex.html');
                $vista = $procesador->vistaPaginaUsuario($this->doctype, $this->header, $vista, $this->footer, $infoUsuario, $galeria);
                echo $vista;
            }
            else{
                $vista = file_get_contents('app/vistas/usuarioIndex.html');
                $mensaje = 'El usuario que buscas no existe.';
                $vista = $procesador->vistaError404($this->doctype, $this->header, $vista, $this->footer, $mensaje);
                echo $vista;
            }
        }
        else{
            $vista = file_get_contents('app/vistas/usuarioIndex.html');
            $mensaje = 'No se especificó un usuario a mostrar.';
            $vista = $procesador->vistaError404($this->doctype, $this->header, $vista, $this->footer, $mensaje);
            echo $vista;
            echo $vista;
        }

    }

}
?>