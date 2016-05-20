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
			if($stmt = $this->db->prepare('INSERT INTO usuario (nombreUsuario, aliasUsuario, correoUsuario, contrasenaUsuario) VALUES (?, ?, ?, PASSWORD(?))')){

				$stmt->bind_param("ssss", $nombre, $alias, $correo, $contrasena);

				$stmt->execute();

				$stmt->bind_result($res);

				$stmt->fetch();

				$stmt->close();
			}
		}

		function iniciarSesion($correo, $contrasena){
			if($stmt = $this->db->prepare('SELECT * FROM usuario WHERE correoUsuario=? AND contrasenaUsuario=PASSWORD(?)')){

				$stmt->bind_param("ss", $correo, $contrasena);

				$stmt->execute();

				$stmt->bind_result($res1, $res2, $res3, $res4, $res5, $res6, $res7, $res8);
				$stmt->store_result();

				$stmt->fetch();
				$numFilas = $stmt->num_rows;
				var_dump($numFilas);

				$stmt->close();

				if($numFilas === 0){
					return false;
				}
				else{
					return true;
				}
			}
			var_dump($stmt);
			return false;
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