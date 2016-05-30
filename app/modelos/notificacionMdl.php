<?php
	
	class notificacionMdl{

		private $acceso;
		private $db;

		function __construct(){
			require_once('app/modelos/conector.php');
			$this->acceso = conector::getInstancia();
			$this->db = $this->acceso->getDriver();
		}

		function alta($idAut, $idDes, $tipo, $idObj){
			$bandera = false;
			$status = 1; //Notificación activa

			if($stmt = $this->db->prepare('INSERT INTO notificacion(idUsuarioAutor, idUsuarioDestino, TipoNotificacion, idElementoObjetivo, statusNotificacion) VALUES (?, ?, ?, ?, ?)')){

				$stmt->bind_param("iiiii", $idAut, $idDes, $tipo, $idObj, $status);

				$bandera = $stmt->execute();

				$stmt->fetch();

				$stmt->close();
			}

			return $bandera;
		}

		function bajaPorUsuario($id){
			$bandera = false;

			if($stmt = $this->db->prepare('UPDATE notificacion SET statusNotificacion=0 WHERE idUsuarioAutor=? OR idUsuarioDestino=?')){

				$stmt->bind_param("ii", $id, $id);

				$bandera = $stmt->execute();

				$stmt->fetch();
				
				$stmt->close();

			}

			return $bandera;
		}

		function contarNotificaciones($id){
			if($stmt = $this->db->prepare('SELECT COUNT(*) FROM notificacion WHERE idUsuarioDestino=? AND statusNotificacion=1')){

				$stmt->bind_param("i", $id);

				$stmt->execute();

				$stmt->bind_result($conteo);

				$stmt->fetch();
				
				$stmt->close();

				return $conteo;
			}

			return false;
		}

		function modificar($idAut, $idDes, $tipo, $idObj, $status){
			$bandera = false;

			if($stmt = $this->db->prepare('UPDATE notificacion SET statusNotificacion=? WHERE idUsuarioAutor=? AND idUsuarioDestino=? AND TipoNotificacion=? AND idElementoObjetivo=?')){

				$stmt->bind_param("iiiii", $status, $idAut, $idDes, $tipo, $idObj);

				$bandera = $stmt->execute();

				$stmt->fetch();
				
				$stmt->close();

			}

			return $bandera;
		}

		function modificarPorID($id, $status){
			$bandera = false;

			if($stmt = $this->db->prepare('UPDATE notificacion SET statusNotificacion=? WHERE idNotificacion=?')){

				$stmt->bind_param("ii", $status, $id);

				$bandera = $stmt->execute();

				$stmt->fetch();
				
				$stmt->close();

			}

			return $bandera;
		}

		function existe($idAut, $idDes, $tipo, $idObj){
			if($stmt = $this->db->prepare('SELECT * FROM notificacion WHERE idUsuarioAutor=? AND idUsuarioDestino=? AND TipoNotificacion=? AND idElementoObjetivo=?')){

				$stmt->bind_param("iiii", $idAut, $idDes, $tipo, $idObj);

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

		function obtenerSeguidores($idDes){
			if($stmt = $this->db->prepare('SELECT * FROM notificacion WHERE idUsuarioDestino=? AND TipoNotificacion=4 AND statusNotificacion=1')){

				$stmt->bind_param("i", $idDes);

				$stmt->execute();

				$stmt->bind_result($idNotificacion, $idUsuarioAutor, $idUsuarioDestino, $tipo, $idElementoObjetivo, $statusNotificacion);

				$array = array();

				while($stmt->fetch()){
					$array[] = array(
						'id' => $idNotificacion,
						'autor' => $idUsuarioAutor,
						'destino' => $idUsuarioDestino,
						'tipo' => $tipo,
						'elemento' => $idElementoObjetivo,
						'status' => $statusNotificacion
					);
				}
				
				$stmt->close();

				return $array;
			}

			return false;
		}

		function obtenerImagenes($idDes){
			if($stmt = $this->db->prepare('SELECT * FROM notificacion WHERE idUsuarioDestino=? AND TipoNotificacion=3 AND statusNotificacion=1')){

				$stmt->bind_param("i", $idDes);

				$stmt->execute();

				$stmt->bind_result($idNotificacion, $idUsuarioAutor, $idUsuarioDestino, $tipo, $idElementoObjetivo, $statusNotificacion);

				$array = array();

				while($stmt->fetch()){
					$array[] = array(
						'id' => $idNotificacion,
						'autor' => $idUsuarioAutor,
						'destino' => $idUsuarioDestino,
						'tipo' => $tipo,
						'elemento' => $idElementoObjetivo,
						'status' => $statusNotificacion
					);
				}
				
				$stmt->close();

				return $array;
			}

			return false;
		}

		function obtenerComentarios($idDes){
			if($stmt = $this->db->prepare('SELECT * FROM notificacion WHERE idUsuarioDestino=? AND TipoNotificacion=1 AND statusNotificacion=1')){

				$stmt->bind_param("i", $idDes);

				$stmt->execute();

				$stmt->bind_result($idNotificacion, $idUsuarioAutor, $idUsuarioDestino, $tipo, $idElementoObjetivo, $statusNotificacion);

				$array = array();

				while($stmt->fetch()){
					$array[] = array(
						'id' => $idNotificacion,
						'autor' => $idUsuarioAutor,
						'destino' => $idUsuarioDestino,
						'tipo' => $tipo,
						'elemento' => $idElementoObjetivo,
						'status' => $statusNotificacion
					);
				}
				
				$stmt->close();

				return $array;
			}

			return false;
		}

		function obtenerFavoritos($idDes){
			if($stmt = $this->db->prepare('SELECT * FROM notificacion WHERE idUsuarioDestino=? AND TipoNotificacion=2 AND statusNotificacion=1')){

				$stmt->bind_param("i", $idDes);

				$stmt->execute();

				$stmt->bind_result($idNotificacion, $idUsuarioAutor, $idUsuarioDestino, $tipo, $idElementoObjetivo, $statusNotificacion);

				$array = array();

				while($stmt->fetch()){
					$array[] = array(
						'id' => $idNotificacion,
						'autor' => $idUsuarioAutor,
						'destino' => $idUsuarioDestino,
						'tipo' => $tipo,
						'elemento' => $idElementoObjetivo,
						'status' => $statusNotificacion
					);
				}
				
				$stmt->close();

				return $array;
			}

			return false;
		}

	}

?>