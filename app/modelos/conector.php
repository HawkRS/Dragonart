<?php

	/**
	*<h1>CONECTOR</h1>
	*Clase encargada de mantener un solo acceso a la base de datos. Esta clase
	*utiliza la estructura Singleton.
	*
	*@author 	Mauricio Gerardo Lazcano Origel
	*@version 	1.0.0
	*@since 	19/Mayo/2016
	*/
	class conector{

		private $driver;
		private static $objeto;

		/**
		*<h1>CONSTRUCTOR</h1>
		*Cuando se crea un objeto de esta clase simplemente realiza la conexión a
		*la base de datos.
		*
		*@author 	Mauricio Gerardo Lazcano Origel
		*@version 	1.0.0
    	*@since 	19/Mayo/2016
		*/
		function __construct(){
			//require_once('datosBD.inc');
			//$this->driver = new mysqli($servidor, $usuario, $pass, $baseDatos);
			$this->driver = new mysqli("localhost","root","Licosvook5","dragonart");
			if($this->driver->connect_errno)
				die("Error en la conexión");
		}

		/**
		*<h1>getInstancia</h1>
		*Crea una instancia propia de esta clase. Este objeto creado es el singleton
		*que manejará la conexión para todos los modelos.
		*
		*@author 	Mauricio Gerardo Lazcano Origel
		*@version 	1.0.0
    	*@since 	19/Mayo/2016
    	*@return 	Objeto instancia de ésta clase.
		*/
		public static function getInstancia(){
			if(!self::$objeto){
				self::$objeto = new self();
			}
			return self::$objeto;
		}

		/**
		*<h1>__clone</h1>
		*Sobreescritura del método mágico __clone. Este método no contiene nada, por lo que
		*evita que se creen múltiples instancias del objeto. Esto previene que nuestra clase
		*deje de ser Singleton.
		*
		*@author 	Mauricio Gerardo Lazcano Origel
		*@version 	1.0.0
    	*@since 	19/Mayo/2016
		*/
		private function __clone(){ }

		/**
		*<h1>getDriver</h1>
		*Devuelve el objeto que contiene la conexión a la base de datos.
		*
		*@author 	Mauricio Gerardo Lazcano Origel
		*@version 	1.0.0
    	*@since 	19/Mayo/2016
    	*@return 	Objeto mysqli que contiene el acceso a la base de datos.
		*/
		public function getDriver(){
			return $this->driver;
		}

	}
?>