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

			if($stmt = $this->db->prepare('INSERT INTO comentario (idImagen, idUsuarioComento, comentario, fechaComentario, statusComentario) VALUES (?, ?, ?, NOW(), 1)')){

				$stmt->bind_param("iis", $idImagen, $idUsuario, $comentario);

				$bandera = $stmt->execute();

				$stmt->fetch();

				$stmt->close();
			}

			return $bandera;
		}

		function baja($idImagen){
			$bandera = false;

			if($stmt = $this->db->prepare('UPDATE comentario SET statusComentario=0 WHERE idImagen=? AND statusComentario=1')){

				$stmt->bind_param("i", $idImagen);

				$bandera = $stmt->execute();

				$stmt->fetch();
				
				$stmt->close();

			}

			return $bandera;
		}

		function reactivar($idImagen){
			$bandera = false;

			if($stmt = $this->db->prepare('UPDATE comentario SET statusComentario=1 WHERE idImagen=?')){

				$stmt->bind_param("i", $idImagen);

				$bandera = $stmt->execute();

				$stmt->fetch();
				
				$stmt->close();

			}

			return $bandera;
		}

		function reactivarPorUsuario($idUsuario){
			$bandera = false;

			if($stmt = $this->db->prepare('UPDATE comentario SET statusComentario=1 WHERE idUsuarioComento=?')){

				$stmt->bind_param("i", $idUsuario);

				$bandera = $stmt->execute();

				$stmt->fetch();
				
				$stmt->close();

			}

			return $bandera;
		}

		function bajaPorUsuario($id){
			$bandera = false;

			if($stmt = $this->db->prepare('UPDATE comentario SET statusComentario=0 WHERE idUsuarioComento=?')){

				$stmt->bind_param("i", $id);

				$bandera = $stmt->execute();

				$stmt->fetch();
				
				$stmt->close();

			}

			return $bandera;
		}

		function bajaPorComentario($id){
			$bandera = false;

			if($stmt = $this->db->prepare('UPDATE comentario SET statusComentario=0 WHERE idComentario=?')){

				$stmt->bind_param("i", $id);

				$bandera = $stmt->execute();

				$stmt->fetch();
				
				$stmt->close();

			}

			return $bandera;
		}

		function obtenerComentarios($idImagen){
			if($stmt = $this->db->prepare('SELECT * FROM comentario WHERE idImagen=? AND statusComentario=1 ORDER BY idComentario')){

				$stmt->bind_param("i", $idImagen);

				$stmt->execute();

				$stmt->bind_result($idComentario, $idImagen, $idUsuarioComento, $comentario, $fechaComentario, $statusComentario, $tipo);

				$array = array();

				while($stmt->fetch()){
					$array[] = array(
						'id' => $idComentario,
						'imagen' => $idImagen,
						'usuario' => $idUsuarioComento,
						'comentario' => $comentario,
						'fecha' => $fechaComentario,
                        'status' => $statusComentario,
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

				$stmt->bind_result($idComentario, $idImagen, $idUsuarioComento, $comentario, $fechaComentario, $statusComentario, $tipo);

				$stmt->fetch();

				$array = array(
					'id' => $idComentario,
					'imagen' => $idImagen,
					'usuario' => $idUsuarioComento,
					'comentario' => $comentario,
					'fecha' => $fechaComentario,
                    'status' => $statusComentario,
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

				$stmt->bind_result($idComentario, $idImagen, $idUsuarioComento, $comentario, $fechaComentario, $statusComentario, $tipo);

				$stmt->fetch();

				$array = array(
					'id' => $idComentario,
					'imagen' => $idImagen,
					'usuario' => $idUsuarioComento,
					'comentario' => $comentario,
					'fecha' => $fechaComentario,
                    'status' => $statusComentario,
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
        
        function busquedaComentario($palabra, $offset, $limit){
        	$palabra = '%'.$palabra.'%';
            if($stmt = $this->db->prepare('SELECT idImagen, idUsuarioComento, comentario, fechaComentario FROM comentario WHERE comentario LIKE ? AND statusComentario=1 LIMIT ?,?')){

				$stmt->bind_param("sii", $palabra, $offset, $limit);

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

        function backend($offset, $limit){
        	if($stmt = $this->db->prepare('SELECT * FROM comentario ORDER BY idComentario DESC LIMIT ?,?')){

				$stmt->bind_param("ii", $offset, $limit);

				$stmt->execute();

				$stmt->bind_result($idComentario, $idImagen, $idUsuarioComento, $comentario, $fechaComentario, $statusComentario, $tipo);

				$array = array();

				while($stmt->fetch()){
					$array[] = array(
						'id' => $idComentario,
						'imagen' => $idImagen,
						'usuario' => $idUsuarioComento,
						'comentario' => $comentario,
						'fecha' => $fechaComentario,
                        'status' => $statusComentario,
						'tipo' => $tipo
					);
				}
				
				$stmt->close();

				return $array;
			}

			return false;
        }

        function backendPorImagen($id, $offset, $limit){
        	if($stmt = $this->db->prepare('SELECT * FROM comentario WHERE idImagen=? ORDER BY idComentario DESC LIMIT ?,?')){

				$stmt->bind_param("iii", $id, $offset, $limit);

				$stmt->execute();

				$stmt->bind_result($idComentario, $idImagen, $idUsuarioComento, $comentario, $fechaComentario, $statusComentario, $tipo);

				$array = array();

				while($stmt->fetch()){
					$array[] = array(
						'id' => $idComentario,
						'imagen' => $idImagen,
						'usuario' => $idUsuarioComento,
						'comentario' => $comentario,
						'fecha' => $fechaComentario,
                        'status' => $statusComentario,
						'tipo' => $tipo
					);
				}
				
				$stmt->close();

				return $array;
			}

			return false;
        }

        function reactivarPorComentario($id){
			$bandera = false;

			if($stmt = $this->db->prepare('UPDATE comentario SET statusComentario=1 WHERE idComentario=?')){

				$stmt->bind_param("i", $id);

				$bandera = $stmt->execute();

				$stmt->fetch();
				
				$stmt->close();

			}

			return $bandera;
		}

	}
?>