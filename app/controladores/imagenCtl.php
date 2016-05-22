<?php

class imagenCtl {
    public $modelo;
    
    private $doctype;
    private $header;
    private $footer;

    function __construct() {
    	session_start();
        echo 'Soy imagenCtl';
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
                    
                case 'mostrar':
                    $this->mostrar();
                    break;
                    
                case 'inicio':
                    $this->inicio();
                    break;
            }
        }
        else {
            $this->inicio();
        }
    }
    
    function alta() {
        $vista = file_get_contents('app/vistas/formularioImagen.html');
        $inicioFooter = strpos($vista, '<!--inicioFooter-->');
        $finFooter = strpos($vista, '<!--finFooter-->')+16;
        $remplazar = substr($vista,$inicioFooter,$finFooter-$inicioFooter);
        
        $vista = str_replace($remplazar, $this->footer, $vista);
        $vista = $this->doctype.$this->header.$vista;
        echo $vista;
    }

    function inicio() {
        $vista = file_get_contents('app/vistas/principal.html');
        $inicioBody = strpos($this->doctype, '<!--inicioBody-->');
        $finBody = strpos($this->doctype, '<!--finBody-->')+14;
        $inicioFooter = strpos($vista, '<!--inicioFooter-->');
        $finFooter = strpos($vista, '<!--finFooter-->')+16;
        
        $remplazarBody = substr($this->doctype,$inicioBody,$finBody-$inicioBody); 
        $remplazarFooter = substr($vista,$inicioFooter,$finFooter-$inicioFooter);
        
        $this->doctype = str_replace($remplazarBody, '<body class="index">', $this->doctype);        
        $vista = str_replace($remplazarFooter, $this->footer, $vista);

        imagenCtl::generarHeader();
        
        $vista = $this->doctype.$this->header.$vista;
        echo $vista;
    }
    
    function mostrar() {
        $vista = file_get_contents('app/vistas/publicacionIndex.html');
        $inicioFooter = strpos($vista, '<!--inicioFooter-->');
        $finFooter = strpos($vista, '<!--finFooter-->')+16;
        $remplazar = substr($vista,$inicioFooter,$finFooter-$inicioFooter);
        
        $vista = str_replace($remplazar, $this->footer, $vista);
        $vista = $this->doctype.$this->header.$vista;
        echo $vista;
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
}   
?>