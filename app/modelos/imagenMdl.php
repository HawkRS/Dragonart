<?php
	class imagenMdl{

		private $acceso;
		private $db;

		function __construct(){
			require_once('app/modelos/conector.php');
			$this->acceso = conector::getInstancia();
			$this->db = $this->acceso->getDriver();
		}

		function alta($idUsuario, $urlImagen, $tituloImagen, $descripcionImagen){
			$bandera = false;

			if($stmt = $this->db->prepare('INSERT INTO imagen(idUsuario, urlImagen, tituloImagen, descripcionImagen, fechaImagen, statusImagen, calificacionPromedioImagen) VALUES (?, ?, ?, ?, NOW(), 1, 0)')){

				$stmt->bind_param("isss", $idUsuario, $urlImagen, $tituloImagen, $descripcionImagen);

				$bandera = $stmt->execute();

				$stmt->fetch();

				$stmt->close();
			}

			return $bandera;
		}

		function obtenerInfo($id){
			if($stmt = $this->db->prepare('SELECT * FROM imagen WHERE idImagen=?')){

				$stmt->bind_param("i", $id);

				$stmt->execute();

				$stmt->bind_result($idImagen, $idUsuario, $urlImagen, $tituloImagen, $descripcionImagen, $fechaImagen, $statusImagen, $calificacionPromedioImagen);

				$stmt->fetch();
				
				$stmt->close();
				
				$array = array(
					'id' => $idImagen,
					'idUsuario' => $idUsuario,
					'url' => $urlImagen,
					'titulo' => $tituloImagen,
					'descripcion' => $descripcionImagen,
					'fecha' => $fechaImagen,
					'status' => $statusImagen,
					'promedio' => $calificacionPromedioImagen
				);

				return $array;
			}
		}

		function obtenerInfoPorUrl($url){
			if($stmt = $this->db->prepare('SELECT * FROM imagen WHERE urlImagen=?')){

				$stmt->bind_param("s", $url);

				$stmt->execute();

				$stmt->bind_result($idImagen, $idUsuario, $urlImagen, $tituloImagen, $descripcionImagen, $fechaImagen, $statusImagen, $calificacionPromedioImagen);

				$stmt->fetch();
				
				$stmt->close();
				
				$array = array(
					'id' => $idImagen,
					'idUsuario' => $idUsuario,
					'url' => $urlImagen,
					'titulo' => $tituloImagen,
					'descripcion' => $descripcionImagen,
					'fecha' => $fechaImagen,
					'status' => $statusImagen,
					'promedio' => $calificacionPromedioImagen
				);

				return $array;
			}
		}

		function obtenerGaleria($idUsuario, $limite){
			if($stmt = $this->db->prepare('SELECT * FROM imagen WHERE idUsuario=? ORDER BY idImagen DESC LIMIT ?,8')){

				$stmt->bind_param("ii", $idUsuario, $limite);

				$stmt->execute();

				$stmt->bind_result($idImagen, $idUsuario, $urlImagen, $tituloImagen, $descripcionImagen, $fechaImagen, $statusImagen, $calificacionPromedioImagen);

				$array = array();

				while($stmt->fetch()){
					$array[] = array(
						'id' => $idImagen,
						'idUsuario' => $idUsuario,
						'url' => $urlImagen,
						'titulo' => $tituloImagen,
						'descripcion' => $descripcionImagen,
						'fecha' => $fechaImagen,
						'status' => $statusImagen,
						'promedio' => $calificacionPromedioImagen
					);
				}
				
				$stmt->close();

				return $array;
			}
		}

		function getError(){
			return $this->db->error;
		}

		function real_escape_string($cadena){
			return $this->db->real_escape_string($cadena);
		}

	}
?>