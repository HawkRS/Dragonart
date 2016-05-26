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

		function obtenerFavorito($idUsuario){
			if($stmt = $this->db->prepare('SELECT * FROM favorito WHERE idUsuarioFavoriteo=?')){

				$stmt->bind_param("i", $idUsuario);

				$stmt->execute();

				$stmt->bind_result($idFavorito, $idImagen, $idUsuarioFavoriteo, $calificacionFavorito, $fechaFavorito, $tipo);

				$stmt->fetch();
				
				$array = array(
					'id' => $idFavorito,
					'imagen' => $idImagen,
					'usuario' => $idUsuarioFavoriteo,
					'calificacion' => $calificacionFavorito,
					'fecha' => $fechaFavorito,
					'tipo' => $tipo
				);
				
				$stmt->close();

				return $array;
			}

			return false;
		}

	}

?>