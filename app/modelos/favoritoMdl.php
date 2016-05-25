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

	}

?>