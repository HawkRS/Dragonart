<?php

class contactoCtl {
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
                case 'mostrar':
                    $this->mostrar();
                    break;
                case 'mandarcorreocontacto':
                    echo $this->mandarcorreocontacto();
                    break;
            }
        }else {
            $this->mostrar();
        }
    }

    function mostrar() {
        require_once('app/controladores/validador.php');
        $validador = new validador();
        require_once('app/controladores/procesadorPlantillas.php');
        $procesador = new procesadorPlantillas();

        if(!empty($_POST)){
            $error = $validador->validarContacto($_POST);
            if($error === true){
                $_POST = $validador->sanitizar($_POST);
                if(contactoCtl::mandarcorreocontacto($_POST) === true){
                    $vista = file_get_contents('app/vistas/formularioContacto.html');
                    $mensaje = '<div class="alert alert-success">El correo se ha mandado exitosamente.</div>';
                    $vista = $procesador->vistaContacto($this->doctype, $this->header, $vista, $this->footer, $mensaje);

                    echo $vista;
                }else{
                    $vista = file_get_contents('app/vistas/formularioContacto.html');
                    $mensaje = '<div class="alert alert-danger">No se pudo mandar el correo.</div>';
                    $vista = $procesador->vistaContacto($this->doctype, $this->header, $vista, $this->footer, $mensaje);

                    echo $vista;
                }
            }else{
                $vista = file_get_contents('app/vistas/formularioContacto.html');
                $mensaje = '<div class="alert alert-danger">'.$error.'</div>';
                $vista = $procesador->vistaContacto($this->doctype, $this->header, $vista, $this->footer, $mensaje);

                echo $vista;
            }
        }else{
            $vista = file_get_contents('app/vistas/formularioContacto.html');
            $mensaje = '';
            $vista = $procesador->vistaContacto($this->doctype, $this->header, $vista, $this->footer, $mensaje);

            echo $vista;
        }

    }

    function mandarcorreocontacto($array){
        if(!empty($array)){
            require_once('app/controladores/correoCtl.php');
            $correoCtl = new correoCtl();
            return $correoCtl->mandarCorreoContacto($array['nombre'],$array['correo'],$array['descripcion']);
        }
    }
}
?>