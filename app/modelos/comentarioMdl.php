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

		function obtenerComentario($imagen, $usuario, $com){
			if($stmt = $this->db->prepare('SELECT * FROM comentario WHERE idImagen=? AND idUsuarioComento=? AND comentario=?')){

				$stmt->bind_param("iis", $imagen, $usuario, $com);

				$stmt->execute();

				$stmt->bind_result($idComentario, $idImagen, $idUsuarioComento, $comentario, $fechaComentario, $tipo);

				$stmt->fetch();

				$array = array(
					'id' => $idComentario,
					'imagen' => $idImagen,
					'usuario' => $idUsuarioComento,
					'comentario' => $comentario,
					'fecha' => $fechaComentario,
					'tipo' => $tipo
				);
				
				$stmt->close();

				return $array;
			}

			return false;
		}

		function obtenerInfo($id){
			if($stmt = $this->db->prepare('SELECT * FROM comentario WHERE idComentario=?')){

				$stmt->bind_param("i", $id);

				$stmt->execute();

				$stmt->bind_result($idComentario, $idImagen, $idUsuarioComento, $comentario, $fechaComentario, $tipo);

				$stmt->fetch();

				$array = array(
					'id' => $idComentario,
					'imagen' => $idImagen,
					'usuario' => $idUsuarioComento,
					'comentario' => $comentario,
					'fecha' => $fechaComentario,
					'tipo' => $tipo
				);
				
				$stmt->close();

				return $array;
			}

			return false;
		}

		function getError(){
			return $this->db->error;
		}
        
        function busquedaComentario($palabra){
            if($stmt = $this->db->prepare('SELECT idImagen, idUsuarioComento, comentario, fechaComentario FROM comentario WHERE comentario LIKE '%?%'')){

				$stmt->bind_param("s", $palabra);

				$stmt->execute();

				$stmt->bind_result($idImagen, $idUsuarioComento, $comentario, $fechaComentario);

				$array = array();

				while($stmt->fetch()){
					$array[] = array(
						'idImagen' => $idImagen,
						'idUsuarioComento' => $idUsuarioComento,
						'comentario' => $comentario,
						'fecha' => $fechaComentario
					);
				}

				return $array;
			}

			return false;
        }

	}
?>