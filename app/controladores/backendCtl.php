<?php

class backendCtl {
    public $modelo;
    
    private $doctype;
    private $header;
    private $footer;

    function __construct() {
    	session_start();
        echo 'Soy backendCtl';
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
                default:
                    $this->mostrar();
                    break;
            }
        }
    }

    function mostrar() {
        $vista = file_get_contents('app/vistas/backend.html');
        $inicioFooter = strpos($vista, '<!--inicioFooter-->');
        $finFooter = strpos($vista, '<!--finFooter-->')+16;
        $remplazar = substr($vista,$inicioFooter,$finFooter-$inicioFooter);
        
        $vista = str_replace($remplazar, $this->footer, $vista);
        $vista = $this->doctype.$this->header.$vista;
        echo $vista;
    }
}
?>