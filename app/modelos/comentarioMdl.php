<?php
	class comentarioMdl{

		private $acceso;
		private $db;

		function __construct(){
			require_once('app/modelos/conector.php');
			$this->acceso = conector::getInstancia();
			$this->db = $this->acceso->getDriver();
		}

		function alta($idImagen, $idUsuario, $comentario){
			$bandera = false;

			if($stmt = $this->db->prepare('INSERT INTO comentario (idImagen, idUsuarioComento, comentario, fechaComentario) VALUES (?, ?, ?, NOW())')){

				$stmt->bind_param("iis", $idImagen, $idUsuario, $comentario);

				$bandera = $stmt->execute();

				$stmt->fetch();

				$stmt->close();
			}

			return $bandera;
		}

		function obtenerComentarios($idImagen){
			if($stmt = $this->db->prepare('SELECT * FROM comentario WHERE idImagen=? ORDER BY idComentario')){

				$stmt->bind_param("i", $idImagen);

				$stmt->execute();

				$stmt->bind_result($idComentario, $idImagen, $idUsuarioComento, $comentario, $fechaComentario, $tipo);

				$array = array();

				while($stmt->fetch()){
					$array[] = array(
						'id' => $idComentario,
						'imagen' => $idImagen,
						'usuario' => $idUsuarioComento,
						'comentario' => $comentario,
						'fecha' => $fechaComentario,
						'tipo' => $tipo
					);
				}
				
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