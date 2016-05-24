<?php
	class comentarioMdl{

		private $acceso;
		private $db;

		function __construct(){
			require_once('app/modelos/conector.php');
			$this->acceso = conector::getInstancia();
			$this->db = $this->acceso->getDriver();
		}

		function alta($nombre, $alias, $correo, $contrasena){
			$bandera = false;

			if($stmt = $this->db->prepare('INSERT INTO usuario (nombreUsuario, aliasUsuario, correoUsuario, contrasenaUsuario) VALUES (?, ?, ?, PASSWORD(?))')){

				$stmt->bind_param("ssss", $nombre, $alias, $correo, $contrasena);

				$bandera = $stmt->execute();

				$stmt->fetch();

				$stmt->close();
			}

			return $bandera;
		}

		function obtenerInfo($correo, $contrasena){
			if($stmt = $this->db->prepare('SELECT * FROM usuario WHERE correoUsuario=? AND contrasenaUsuario=PASSWORD(?)')){

				$stmt->bind_param("ss", $correo, $contrasena);

				$stmt->execute();

				$stmt->bind_result($idUsuario, $nombreUsuario, $aliasUsuario, $correoUsuario, $contrasenaUsuario, $biografiaUsuario, $avatarUsuario, $statusUsuario);

				$stmt->fetch();
				
				$array = array(
					'id' => $idUsuario,
					'nombre' => $nombreUsuario,
					'alias' => $aliasUsuario,
					'correo' => $correoUsuario,
					'contrasena' => $contrasenaUsuario,
					'biografia' => $biografiaUsuario,
					'avatar' => $avatarUsuario,
					'status' => $statusUsuario
				);
				
				$stmt->close();

				return $array;
			}

			return false;
		}

		function getError(){
			return $this->db->error;
		}

	}
?>