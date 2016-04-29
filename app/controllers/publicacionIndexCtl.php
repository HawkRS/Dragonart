<?php

class publicacionIndexCtl {
    public $modelo;

    function __construct() {
        echo 'Soy publicacionIndexCtl';
    }

    function run() {
        if(isset($_GET['accion'])) {
            switch($_GET['accion']) {
                case 'mostrar':
                    $this->mostrar();
                    break;
            }
        }else {
            $this->mostrar();
        }
    }

    function mostrar() {
        include('app/views/publicacionIndex.php');
    }
}
?>