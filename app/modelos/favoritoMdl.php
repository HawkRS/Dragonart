<?php

	class favoritoMdl{

		private $acceso;
		private $db;

		function __construct(){
			require_once('app/modelos/conector.php');
			$this->acceso = conector::getInstancia();
			$this->db = $this->acceso->getDriver();
		}

		function alta($idImagen, $idUsuario, $calificacion){
			$bandera = false;

			if($stmt = $this->db->prepare('INSERT INTO favorito(idImagen, idUsuarioFavoriteo, calificacionFavorito, fechaFavorito) VALUES (?, ?, ?, NOW())')){

				$stmt->bind_param("iid", $idImagen, $idUsuario, $calificacion);

				$bandera = $stmt->execute();

				$stmt->fetch();

				$stmt->close();
			}

			return $bandera;
		}

		function modificar($calificacion, $id){
			$bandera = false;

			if($stmt = $this->db->prepare('UPDATE favorito SET calificacionFavorito=? WHERE idFavorito=?')){

				$stmt->bind_param("di", $calificacion, $id);

				$bandera = $stmt->execute();

				$stmt->fetch();

				$stmt->close();
			}

			return $bandera;
		}

		function obtenerPromedio($idImagen){
			if($stmt = $this->db->prepare('SELECT AVG(calificacionFavorito) FROM favorito WHERE idImagen=?')){

				$stmt->bind_param("i", $idImagen);

				$stmt->execute();

				$stmt->bind_result($promedio);

				$stmt->fetch();
				
				$stmt->close();

				return $promedio;
			}

			return false;
		}

		function obtenerFavorito($idUsuario, $imagen){
			if($stmt = $this->db->prepare('SELECT * FROM favorito WHERE idImagen=? AND idUsuarioFavoriteo=?')){

				$stmt->bind_param("ii", $imagen, $idUsuario);

				$stmt->execute();

				$stmt->bind_result($idFavorito, $idImagen, $idUsuarioFavoriteo, $calificacionFavorito, $fechaFavorito, $tipo);

				$res = $stmt->fetch();
				
				if($res === true){
					$array = array(
						'id' => $idFavorito,
						'imagen' => $idImagen,
						'usuario' => $idUsuarioFavoriteo,
						'calificacion' => $calificacionFavorito,
						'fecha' => $fechaFavorito,
						'tipo' => $tipo
					);
				}else{
					$array = array();
				}
				
				$stmt->close();

				return $array;
			}

			return false;
		}

		function obtenerTodos($idUsuario, $offset, $limite){
			if($stmt = $this->db->prepare('SELECT * FROM favorito WHERE idUsuarioFavoriteo=? ORDER BY fechaFavorito DESC LIMIT ?,?')){

				$stmt->bind_param("iii", $idUsuario, $offset, $limite);

				$stmt->execute();

				$stmt->bind_result($idFavorito, $idImagen, $idUsuarioFavoriteo, $calificacionFavorito, $fechaFavorito, $tipo);

				$array = array();
				while($stmt->fetch()){
					$array[] = array(
						'id' => $idFavorito,
						'imagen' => $idImagen,
						'usuario' => $idUsuarioFavoriteo,
						'calificacion' => $calificacionFavorito,
						'fecha' => $fechaFavorito,
						'tipo' => $tipo
					);
				}
				
				$stmt->close();

				return $array;
			}

			return false;
		}

	}

?>