<?php
	class recuperarMdl{

		private $acceso;
		private $db;

		function __construct(){
			require_once('app/modelos/conector.php');
			$this->acceso = conector::getInstancia();
			$this->db = $this->acceso->getDriver();
		}

		function alta($correo, $link){
			$bandera = false;

			if($stmt = $this->db->prepare('INSERT INTO recuperar (correo, link, fecha, status) VALUES (?, ?, NOW(), 1)')){

				$stmt->bind_param("ss", $correo, $link);

				$bandera = $stmt->execute();

				$stmt->fetch();

				$stmt->close();
			}

			return $bandera;
		}

		function getError(){
			return $this->db->error;
		}
        
        function modificar($correo, $link, $status){
			$bandera = false;

			if($stmt = $this->db->prepare('UPDATE recuperar SET status=? WHERE correo=? AND link=?')){

				$stmt->bind_param("iss", $status, $correo, $link);

				$bandera = $stmt->execute();

				$stmt->fetch();
				
				$stmt->close();

			}

			return $bandera;
		}
        
        function existe($correo){
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