<?php
	class conector{

		require_once('datosBD.inc');

		private $driver;

		function __construct(){
			$this->driver = new mysqli($servidor, $usuario, $pass, $baseDatos);
			if($this->driver->connect_errno)
				die("Error en la conexión");
		}

	}
?>