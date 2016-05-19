<?php

class paginasestaticasCtl {
    public $modelo;

    function __construct() {
        echo 'Soy paginasestaticasCtl';
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
        require_once('app/vistas/politicaCargaImagenes.php');
    }
    
    function terminos() {
        require_once('app/vistas/terminosCondiciones.php');
    }
}
?>