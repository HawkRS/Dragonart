<?php
	class tagsMdl{

		private $acceso;
		private $db;

		function __construct(){
			require_once('app/modelos/conector.php');
			$this->acceso = conector::getInstancia();
			$this->db = $this->acceso->getDriver();
		}

		function alta($idImagen, $tag){			
			if($stmt = $this->db->prepare('INSERT INTO tag (idImagen, tag) VALUES (?, ?)')){

				$stmt->bind_param("ss", $idImagen, $tag);

				$stmt->execute();

				$stmt->fetch();

				$stmt->close();
			}
		}
        
        function obtenerTag($tag){
			if($stmt = $this->db->prepare('SELECT * FROM tag WHERE tag=?')){

				$stmt->bind_param("s", $tag);

				$stmt->execute();

				$stmt->bind_result($tags);

				$stmt->fetch();
				
				$stmt->close();
				
				$array = array(
					'tag' => $tags
				);

				return $array;
			}
		}
        
        function obtenerTagsImagen($idImagen){
			if($stmt = $this->db->prepare('SELECT * FROM tag WHERE idImagen=?')){

				$stmt->bind_param("s", $idImagen);

				$stmt->execute();

				$stmt->bind_result($idImagenTag);

				$stmt->fetch();
				
				$stmt->close();
				
				$array = array(
					'idImagen' => $idImagenTag
				);

				return $array;
			}
		}

	}
?>