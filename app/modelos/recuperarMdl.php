<?php
	class recuperarMdl{

		private $acceso;
		private $db;

		function __construct(){
			require_once('app/modelos/conector.php');
			$this->acceso = conector::getInstancia();
			$this->db = $this->acceso->getDriver();
		}

		function alta($id, $correo, $link){
			$bandera = false;

			if($stmt = $this->db->prepare('INSERT INTO recuperar (idUsuario, correo, link, fecha, status) VALUES (?, ?, ?, NOW(), 1)')){

				$stmt->bind_param("iss", $id, $correo, $link);

				$bandera = $stmt->execute();

				$stmt->fetch();

				$stmt->close();
			}

			return $bandera;
		}

		function getError(){
			return $this->db->error;
		}
        
        function modificar($correo, $status){
			$bandera = false;

			if($stmt = $this->db->prepare('UPDATE recuperar SET status=? WHERE correo=?')){

				$stmt->bind_param("is", $status, $correo);

				$bandera = $stmt->execute();

				$stmt->fetch();
				
				$stmt->close();

			}

			return $bandera;
		}
        
        function existe($id){
			if($stmt = $this->db->prepare('SELECT * FROM recuperar WHERE idUsuario=?')){

				$stmt->bind_param("i", $id);

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

		function obtenerInfo($correo){
			if($stmt = $this->db->prepare('SELECT * FROM recuperar WHERE correo=? AND status=1')){

				$stmt->bind_param("s", $correo);

				$stmt->execute();

				$stmt->bind_result($id, $idUsuario, $correoUsuario, $link, $fecha, $status);

				$stmt->fetch();
				
				$array = array(
					'id' => $id,
					'usuario' => $idUsuario,
					'correo' => $correoUsuario,
					'link' => $link,
					'fecha' => $fecha,
					'status' => $status
				);
				
				$stmt->close();

				return $array;
			}

			return false;
		}

		function existeCorreo($correo){
			if($stmt = $this->db->prepare('SELECT * FROM recuperar WHERE correo=? AND status=1')){

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

	}
?>