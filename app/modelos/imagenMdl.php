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

			if($stmt = $this->db->prepare('INSERT INTO imagen(idUsuarioPropietario, urlImagen, tituloImagen, descripcionImagen, fechaImagen, statusImagen, calificacionPromedioImagen) VALUES (?, ?, ?, ?, NOW(), 1, 0)')){

				$stmt->bind_param("isss", $idUsuario, $urlImagen, $tituloImagen, $descripcionImagen);

				$bandera = $stmt->execute();

				$stmt->fetch();

				$stmt->close();
			}

			return $bandera;
		}

		function modificar($id, $titulo, $descripcion){
			$bandera = false;

			if($stmt = $this->db->prepare('UPDATE imagen SET tituloImagen=?, descripcionImagen=? WHERE idImagen=?')){

				$stmt->bind_param("ssi", $titulo, $descripcion, $id);

				$bandera = $stmt->execute();

				$stmt->fetch();
				
				$stmt->close();

			}

			return $bandera;
		}

		function baja($id){
			$bandera = false;

			if($stmt = $this->db->prepare('UPDATE imagen SET statusImagen=0 WHERE idImagen=?')){

				$stmt->bind_param("i", $id);

				$bandera = $stmt->execute();

				$stmt->fetch();
				
				$stmt->close();

			}

			return $bandera;
		}

		function bajaPorUsuario($id){
			$bandera = false;

			if($stmt = $this->db->prepare('UPDATE imagen SET statusImagen=0 WHERE idUsuarioPropietario=?')){

				$stmt->bind_param("i", $id);

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

				$stmt->bind_result($idImagen, $idUsuario, $urlImagen, $tituloImagen, $descripcionImagen, $fechaImagen, $statusImagen, $calificacionPromedioImagen, $tipoImagen);

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
					'promedio' => $calificacionPromedioImagen,
					'tipo' => $tipoImagen
				);

				return $array;
			}

			return false;
		}

		function obtenerInfoPorUrl($url){
			if($stmt = $this->db->prepare('SELECT * FROM imagen WHERE urlImagen=?')){

				$stmt->bind_param("s", $url);

				$stmt->execute();

				$stmt->bind_result($idImagen, $idUsuario, $urlImagen, $tituloImagen, $descripcionImagen, $fechaImagen, $statusImagen, $calificacionPromedioImagen, $tipoImagen);

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
					'promedio' => $calificacionPromedioImagen,
					'tipo' => $tipoImagen
				);

				return $array;
			}

			return false;
		}

		function obtenerGaleria($idUsuario, $offset, $limite){
			if($stmt = $this->db->prepare('SELECT * FROM imagen WHERE idUsuarioPropietario=? AND statusImagen=1 ORDER BY idImagen DESC LIMIT ?,?')){

				$stmt->bind_param("iii", $idUsuario, $offset, $limite);

				$stmt->execute();

				$stmt->bind_result($idImagen, $idUsuario, $urlImagen, $tituloImagen, $descripcionImagen, $fechaImagen, $statusImagen, $calificacionPromedioImagen, $tipoImagen);

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
						'promedio' => $calificacionPromedioImagen,
						'tipo' => $tipoImagen
					);
				}
				
				$stmt->close();

				return $array;
			}

			return false;
		}

		function actualizaPromedio($promedio, $idImagen){
			$bandera = false;

			if($stmt = $this->db->prepare('UPDATE imagen SET calificacionPromedioImagen=? WHERE idImagen=?')){

				$stmt->bind_param("ii", $promedio, $idImagen);

				$bandera = $stmt->execute();

				$stmt->fetch();
				
				$stmt->close();

			}

			return $bandera;
		}

		function getError(){
			return $this->db->error;
		}

		function real_escape_string($cadena){
			return $this->db->real_escape_string($cadena);
		}
        
        function busquedaImagenTitulo($palabra, $offset, $limite){
        	$palabra = "%$palabra%";
            if($stmt = $this->db->prepare('SELECT * FROM imagen WHERE tituloImagen LIKE ? AND statusImagen=1 LIMIT ?,?')){

				$stmt->bind_param("sii", $palabra, $offset, $limite);

				$stmt->execute();

				$stmt->bind_result($idImagen, $idUsuario, $urlImagen, $tituloImagen, $descripcionImagen, $fechaImagen, $statusImagen, $calificacionPromedioImagen, $tipoImagen);

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
						'promedio' => $calificacionPromedioImagen,
						'tipo' => $tipoImagen
					);
				}

				return $array;
			}

			return false;
        }

        function busquedaImagenDescripcion($palabra, $offset, $limite){
        	$palabra = '%'.$palabra.'%';
            if($stmt = $this->db->prepare('SELECT * FROM imagen WHERE descripcionImagen LIKE ? AND statusImagen=1 LIMIT ?,?')){

				$stmt->bind_param("sii", $palabra, $offset, $limite);

				$stmt->execute();

				$stmt->bind_result($idImagen, $idUsuario, $urlImagen, $tituloImagen, $descripcionImagen, $fechaImagen, $statusImagen, $calificacionPromedioImagen, $tipoImagen);

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
						'promedio' => $calificacionPromedioImagen,
						'tipo' => $tipoImagen
					);
				}

				return $array;
			}

			return false;
        }

	}
?>