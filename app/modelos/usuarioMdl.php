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
			$bandera = false;
			$avatar = 'uploads/avatar/avatar.jpg';
			$tipo = 0; //Usuario normal
			$status = 1; //Usuario activo

			if($stmt = $this->db->prepare('INSERT INTO usuario (nombreUsuario, aliasUsuario, correoUsuario, contrasenaUsuario, avatarUsuario, tipoUsuario, statusUsuario) VALUES (?, ?, ?, PASSWORD(?), ?, ?, ?)')){

				$stmt->bind_param("sssssii", $nombre, $alias, $correo, $contrasena, $avatar, $tipo, $status);

				$bandera = $stmt->execute();

				$stmt->fetch();

				$stmt->close();
			}

			return $bandera;
		}

		function iniciarSesion($correo, $contrasena){
			if($stmt = $this->db->prepare('SELECT * FROM usuario WHERE correoUsuario=? AND contrasenaUsuario=PASSWORD(?)')){

				$stmt->bind_param("ss", $correo, $contrasena);

				$stmt->execute();

				$stmt->store_result();

				$stmt->fetch();
				$numFilas = $stmt->num_rows;

				$stmt->close();

				if($numFilas === 0){
					return false;
				}
				else{
					return true;
				}
			}
			return false;
		}

		function existeNombre($nombre){
			if($stmt = $this->db->prepare('SELECT * FROM usuario WHERE nombreUsuario=?')){

				$stmt->bind_param("s", $nombre);

				$stmt->execute();

				$stmt->store_result();

				$stmt->fetch();
				$numFilas = $stmt->num_rows;

				$stmt->close();

				if($numFilas === 0){
					return false;
				}
				else{
					return true;
				}
			}
			return true;
		}

		function existeCorreo($correo){
			if($stmt = $this->db->prepare('SELECT * FROM usuario WHERE correoUsuario=?')){

				$stmt->bind_param("s", $correo);

				$stmt->execute();

				$stmt->store_result();

				$stmt->fetch();
				$numFilas = $stmt->num_rows;

				$stmt->close();

				if($numFilas === 0){
					return false;
				}
				else{
					return true;
				}
			}
			return true;
		}

		function obtenerInfo($correo, $contrasena){
			if($stmt = $this->db->prepare('SELECT * FROM usuario WHERE correoUsuario=? AND contrasenaUsuario=PASSWORD(?)')){

				$stmt->bind_param("ss", $correo, $contrasena);

				$stmt->execute();

				$stmt->bind_result($idUsuario, $nombreUsuario, $aliasUsuario, $correoUsuario, $contrasenaUsuario, $biografiaUsuario, $avatarUsuario, $tipoUsuario, $statusUsuario);

				$stmt->fetch();
				
				$array = array(
					'id' => $idUsuario,
					'nombre' => $nombreUsuario,
					'alias' => $aliasUsuario,
					'correo' => $correoUsuario,
					'contrasena' => $contrasenaUsuario,
					'biografia' => $biografiaUsuario,
					'avatar' => $avatarUsuario,
					'tipo' => $tipoUsuario,
					'status' => $statusUsuario
				);
				
				$stmt->close();

				return $array;
			}

			return false;
		}

		function obtenerInfoPorID($id){
			if($stmt = $this->db->prepare('SELECT * FROM usuario WHERE idUsuario=?')){

				$stmt->bind_param("i", $id);

				$stmt->execute();

				$stmt->bind_result($idUsuario, $nombreUsuario, $aliasUsuario, $correoUsuario, $contrasenaUsuario, $biografiaUsuario, $avatarUsuario, $tipoUsuario, $statusUsuario);

				$stmt->fetch();
				
				$array = array(
					'id' => $idUsuario,
					'nombre' => $nombreUsuario,
					'alias' => $aliasUsuario,
					'correo' => $correoUsuario,
					'contrasena' => $contrasenaUsuario,
					'biografia' => $biografiaUsuario,
					'avatar' => $avatarUsuario,
					'tipo' => $tipoUsuario,
					'status' => $statusUsuario
				);
				
				$stmt->close();

				return $array;
			}

			return false;
		}

		function paginaUsuario($usuario){
			if($stmt = $this->db->prepare('SELECT * FROM usuario WHERE nombreUsuario=?')){

				$stmt->bind_param("s", $usuario);

				$stmt->execute();

				$stmt->bind_result($idUsuario, $nombreUsuario, $aliasUsuario, $correoUsuario, $contrasenaUsuario, $biografiaUsuario, $avatarUsuario, $tipoUsuario, $statusUsuario);

				$stmt->fetch();
				
				$stmt->close();
				
				$array = array(
					'id' => $idUsuario,
					'nombre' => $nombreUsuario,
					'alias' => $aliasUsuario,
					'correo' => $correoUsuario,
					'contrasena' => $contrasenaUsuario,
					'biografia' => $biografiaUsuario,
					'avatar' => $avatarUsuario,
					'tipo' => $tipoUsuario,
					'status' => $statusUsuario
				);

				return $array;
			}

			return false;
		}

		function getError(){
			return $this->db->error;
		}

		function real_escape_string($cadena){
			return $this->db->real_escape_string($cadena);
		}
		
	}
?>