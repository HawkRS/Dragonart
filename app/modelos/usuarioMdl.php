<?php
	class AlumnoMdl{

		private $driver;

		function __construct(){
			$this->driver = new mysqli('localhost','root','Licosvook5','dragonart');
			if($this->driver->connect_errno)
				die("Error en la conexión");
		}

		function alta($nombre, $codigo, $carrera, $correo){
			$query = 
					"INSERT INTO alumno
					(nombre, correo)
					VALUES (
						\"$nombre\",
						\"$correo\"
					)";
			$r = $this->driver->query($query);
			if($this->driver->insert_id){
				return $this->driver->insert_id;
			}
			else if($r === FALSE)
				return FALSE;
		}

		function mostrar(){
			$query = 'SELECT * FROM alumno';
			$r = $this->driver->query($query);
			while($row = $r->fetch_assoc())
				$rows[] = $row;
			return $rows;
		}

	}
?>