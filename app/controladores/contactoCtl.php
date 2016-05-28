<?php

class contactoCtl {
    public $modelo;

    private $doctype;
    private $header;
    private $footer;

    function __construct() {
        session_start();
        echo 'Soy contactoCtl';
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
        require_once('app/controladores/procesadorPlantillas.php');
        $procesador = new procesadorPlantillas();
        $vista = file_get_contents('app/vistas/formularioContacto.html');
        $vista = $procesador->vistaContacto($this->doctype, $this->header, $vista, $this->footer);

        echo $vista;
    }

    function mandarcorreocontacto(){
        if(!empty($_POST)){
            echo $_POST['correo'];
            require_once('app/controladores/correoCtl.php');
            $correoCtl = new correoCtl();
            return $correoCtl->mandarCorreoContacto($_POST['nombre'],$_POST['correo'],$_POST['descripcion']);
        }
    }
}
?>