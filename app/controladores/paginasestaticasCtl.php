<?php

class paginasestaticasCtl {
    public $modelo;
    
    private $doctype;
    private $header;
    private $footer;

    function __construct() {
    	session_start();
        echo 'Soy paginasestaticasCtl';
        $this->doctype = file_get_contents('app/vistas/doctype.html');
        $this->header = file_get_contents('app/vistas/header.html');
        $this->footer = file_get_contents('app/vistas/footer.html');
    }

    function run() {
        if(isset($_GET['accion'])) {
            switch($_GET['accion']) {
                case 'politicas':
                    $this->politicas();
                    break;
                
                case 'terminos':
                    $this->terminos();
                    break;
            }
        }
    }

    function politicas() {
        $vista = file_get_contents('app/vistas/politicaCargaImagenes.html');
        $inicioFooter = strpos($vista, '<!--inicioFooter-->');
        $finFooter = strpos($vista, '<!--finFooter-->')+16;
        $remplazar = substr($vista,$inicioFooter,$finFooter-$inicioFooter);
        
        $vista = str_replace($remplazar, $this->footer, $vista);
        $vista = $this->doctype.$this->header.$vista;
        echo $vista;
    }
    
    function terminos() {
        $vista = file_get_contents('app/vistas/terminosCondiciones.html');
        $inicioFooter = strpos($vista, '<!--inicioFooter-->');
        $finFooter = strpos($vista, '<!--finFooter-->')+16;
        $remplazar = substr($vista,$inicioFooter,$finFooter-$inicioFooter);
        
        $vista = str_replace($remplazar, $this->footer, $vista);
        $vista = $this->doctype.$this->header.$vista;
        echo $vista;
    }
}
?>