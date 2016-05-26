<?php
	class tagsMdl{

		private $acceso;
		private $db;

		function __construct(){
			require_once('app/modelos/conector.php');
			$this->acceso = conector::getInstancia();
			$this->db = $this->acceso->getDriver();
		}

		function alta($idImagen, $tags){			
			$bandera = true;

			$token = strtok($tags, ' ');

			while($token !== false){
				if($stmt = $this->db->prepare('INSERT INTO tag (idImagen, tag) VALUES (?, ?)')){

					$stmt->bind_param("is", $idImagen, $token);

					if($stmt->execute() !== true){
						$bandera = false;
					}

					$stmt->fetch();

					$stmt->close();
				}
				$token = strtok(' ');
			}

			return $bandera;
		}
        
        function obtenerTagsImagen($id){
			if($stmt = $this->db->prepare('SELECT * FROM tag WHERE idImagen=?')){

				$stmt->bind_param("i", $id);

				$stmt->execute();

				$stmt->bind_result($idTag, $idImagen, $tag);

				$array = array();

				while($stmt->fetch()){
					$array[] = array(
						'id' => $idTag,
						'imagen' => $idImagen,
						'tag' => $tag
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