<?php
	class usuarioMdl{

		private $acceso;
		private $db;

		function __construct(){
			require_once('app/modelos/conector.php');
			$this->acceso = conector::getInstancia();
			$this->db = $this->acceso->getDriver();
		}

		function alta($nombre, $alias, $correo, $contrasena){			
			if($stmt = $this->db->prepare('INSERT INTO usuario (nombreUsuario, aliasUsuario, correoUsuario, contrasenaUsuario) VALUES (?, ?, ?, ?)')){

				$stmt->bind_param("ssss", $nombre, $alias, $correo, $contrasena);

				$stmt->execute();

				$stmt->bind_result($res);

				$stmt->fetch();

				$stmt->close();
			}
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