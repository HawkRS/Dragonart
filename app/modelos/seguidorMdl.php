<?php
	class seguidorMdl{

		private $acceso;
		private $db;

		function __construct(){
			require_once('app/modelos/conector.php');
			$this->acceso = conector::getInstancia();
			$this->db = $this->acceso->getDriver();
		}

		function alta($seguidor, $seguido){
			$bandera = false;
			$status = 1; //Seguidor activo

			if($stmt = $this->db->prepare('INSERT INTO seguidor (idUsuarioSeguidor, idUsuarioSeguido, statusSeguidor) VALUES (?, ?, ?)')){

				$stmt->bind_param("iii", $seguidor, $seguido, $status);

				$bandera = $stmt->execute();

				$stmt->fetch();

				$stmt->close();
			}

			return $bandera;
		}

		function existe($seguidor, $seguido){
			if($stmt = $this->db->prepare('SELECT * FROM seguidor WHERE idUsuarioSeguidor=? AND idUsuarioSeguido=?')){

				$stmt->bind_param("ii", $seguidor, $seguido);

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

		function modificar($seguidor, $seguido, $status){
			$bandera = false;

			if($stmt = $this->db->prepare('UPDATE seguidor SET statusSeguidor=? WHERE idUsuarioSeguidor=? AND idUsuarioSeguido=?')){

				$stmt->bind_param("iii", $status, $seguidor, $seguido);

				$bandera = $stmt->execute();

				$stmt->fetch();
				
				$stmt->close();

			}

			return $bandera;
		}

		function obtenerInfo($seguidor, $seguido){
			if($stmt = $this->db->prepare('SELECT * FROM seguidor WHERE idUsuarioSeguidor=? AND idUsuarioSeguido=?')){

				$stmt->bind_param("ii", $seguidor, $seguido);

				$stmt->execute();

				$stmt->bind_result($idSeguidor, $idUsuarioSeguidor, $idUsuarioSeguido, $statusSeguidor, $tipo);

				$stmt->fetch();
				
				$array = array(
					'id' => $idSeguidor,
					'seguidor' => $idUsuarioSeguidor,
					'seguido' => $idUsuarioSeguido,
					'status' => $statusSeguidor,
					'tipo' => $tipo
				);
				
				$stmt->close();

				return $array;
			}

			return false;
		}

		function obtenerSeguidores($id, $offset, $limit){
			if($stmt = $this->db->prepare('SELECT * FROM seguidor WHERE idUsuarioSeguido=? LIMIT ?,?')){

				$stmt->bind_param("iii", $id, $offset, $limit);

				$stmt->execute();

				$stmt->bind_result($idSeguidor, $idUsuarioSeguidor, $idUsuarioSeguido, $statusSeguidor, $tipo);

				$array = array();

				while($stmt->fetch()){
					$array[] = array(
						'id' => $idSeguidor,
						'seguidor' => $idUsuarioSeguidor,
						'seguido' => $idUsuarioSeguido,
						'status' => $statusSeguidor,
						'tipo' => $tipo
					);
				}
				
				$stmt->close();

				return $array;
			}

			return false;
		}

		function obtenerSeguidos($id, $offset, $limit){
			if($stmt = $this->db->prepare('SELECT * FROM seguidor WHERE idUsuarioSeguidor=? LIMIT ?,?')){

				$stmt->bind_param("iii", $id, $offset, $limit);

				$stmt->execute();

				$stmt->bind_result($idSeguidor, $idUsuarioSeguidor, $idUsuarioSeguido, $statusSeguidor, $tipo);

				$array = array();

				while($stmt->fetch()){
					$array[] = array(
						'id' => $idSeguidor,
						'seguidor' => $idUsuarioSeguidor,
						'seguido' => $idUsuarioSeguido,
						'status' => $statusSeguidor,
						'tipo' => $tipo
					);
				}
				
				$stmt->close();

				return $array;
			}

			return false;
		}

		function obtenerSeguidoresCompleto($id){
			if($stmt = $this->db->prepare('SELECT * FROM seguidor WHERE idUsuarioSeguido=?')){

				$stmt->bind_param("i", $id);

				$stmt->execute();

				$stmt->bind_result($idSeguidor, $idUsuarioSeguidor, $idUsuarioSeguido, $statusSeguidor, $tipo);

				$array = array();

				while($stmt->fetch()){
					$array[] = array(
						'id' => $idSeguidor,
						'seguidor' => $idUsuarioSeguidor,
						'seguido' => $idUsuarioSeguido,
						'status' => $statusSeguidor,
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