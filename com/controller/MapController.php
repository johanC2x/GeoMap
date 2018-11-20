<?php 
	session_start();
	require_once '../bean/MapBean.php';
	require_once '../dao/MapDAO.php';

	$mapBean = new MapBean();
	$mapDAO = new MapDAO();  

	$op = $_POST["op"];  

	switch ($op) {
		case 1:
			$listaDistrito = $mapDAO->obtenerDistrito();
			echo json_encode($listaDistrito);
		break;
		case 2:
			$codigo = $_POST["codigo"];
			$mapBean->setCodigo($codigo);
			$listaDistrito = $mapDAO->obtenerMapDistrito($mapBean);
			echo json_encode($listaDistrito);
		break;
		case 3:
			$codigo = $_POST["codigo"];
			$distrito = $_POST["distrito"];
			$mapBean->setCodigo($codigo);
			$mapBean->setDistrito($distrito);
			$listaDistrito = $mapDAO->obtenerAsigDistrito($mapBean);
			echo json_encode($listaDistrito);
		break;
		case 4:
			$idMap = $_POST["idMap"];
			$mapBean->setIdMap($idMap);
			$listaDistrito = $mapDAO->obtenerMapId($mapBean);
			echo json_encode($listaDistrito);
		break;
		case 5:
			$listaDistrito = $mapDAO->obtenerTodos();
			echo json_encode($listaDistrito);
		break;
		case 6:
			$idMap = $_POST["idMap"];
			$upload_folder ='../../images';
			$nombre_archivo = $_FILES['archivo']['name'];
			opendir($upload_folder);
			$archivador = $upload_folder.'/'. $nombre_archivo;
			copy($_FILES['archivo']['tmp_name'], $archivador);
			$tipo_archivo = $_FILES['archivo']['type'];
			$tipo_archivo = $_FILES['archivo']['type'];
			$tamano_archivo = $_FILES['archivo']['size'];
			$tmp_archivo = $_FILES['archivo']['tmp_name'];
			/*Seteando Ruta*/
			$mapBean->setIdMap($idMap);
			$mapBean->setRuta($archivador);
			$res = $mapDAO->actualizarRuta($mapBean);
			echo $res;
		break;
		case 7:
			$idMap = $_POST["idMap"];
			$root = $_POST["root"];
			$mapBean->setIdMap($idMap);
			$val = unlink($root);
			$res = "";
			if($val==true){
				$res = $mapDAO->eliminarArchivoMap($mapBean);
			}else{
				$res = "0";
			}
			echo $res;
			break;
		case 8:
			$codigo = $_POST["codigo"];
			$mapBean->setCodigo($codigo);
			$listaDistrito = $mapDAO->obtenerMapContratista($mapBean);
			echo json_encode($listaDistrito);
			break;
		case 9:
			$codigo = $_POST["codigo"];
			$contratista = $_POST["contratista"];
			$mapBean->setCodigo($codigo);
			$mapBean->setContratista($contratista);
			$listaDistrito = $mapDAO->obtenerAsigContratista($mapBean);
			echo json_encode($listaDistrito);
			break;
		case 10:
			$res = $mapDAO->execProMap();
			echo $res;
			break;
		case 11:
			$listaDistrito = $mapDAO->obtenerMapDistritoSuper();
			echo json_encode($listaDistrito);
			break;
		case 12: 
			$distrito = $_POST["distrito"]; 
			$mapBean->setDistrito($distrito);
			$listaDistrito = $mapDAO->obtenerAsigDistritoSuper($mapBean);
			echo json_encode($listaDistrito);
			break;
		case 13: 
			$listaDistrito = $mapDAO->obtenerMapContratistaSuper();
			echo json_encode($listaDistrito);
			break;
		case 14: 
			$contratista = $_POST["contratista"]; 
			$mapBean->setContratista($contratista);
			$listaDistrito = $mapDAO->obtenerAsigContratistaSuper($mapBean);
			echo json_encode($listaDistrito);
			break;
		case 15:
			$solicitud = $_POST["solicitud"];
			$mapBean->setSolicitud($solicitud);
			$listaDistrito = $mapDAO->obtenerMapSolicitud($mapBean);
			echo json_encode($listaDistrito);
			break;
		case 16:
			$idMap = $_POST["idMap"];
			$estado = $_POST["estado"];
			$txtArDescr = $_POST["txtArDescr"];
			$mapBean->setIdMap($idMap);
			$mapBean->setFlgEstado($estado);
			$mapBean->setDescripcion($txtArDescr);
			$res = $mapDAO->actualizarRegistrosDes($mapBean);
			echo $res;
			break;
		
		// DATOS GRAFICOS
		//PENDIENTES
		case 17:
			$listaGrafica = $mapDAO->obtenerContPend();
			echo json_encode($listaGrafica);
			break;
		//ACTIVOS
		case 18:
			$listaGrafica = $mapDAO->obtenerContAct();
			echo json_encode($listaGrafica);
			break;
		//TERMINADAS
		case 19:
			$listaGrafica = $mapDAO->obtenerContFin();
			echo json_encode($listaGrafica);
			break;
		//CONTADOR TOTAL
		case 20:
			$cboAnioGraf = $_POST["cboAnioGraf"];
			$mapBean->setAnio($cboAnioGraf);
			$listaGrafica = $mapDAO->obtenerContador($mapBean);
			echo json_encode($listaGrafica);
			break; 

		case 21:
			$solicitud = $_POST["solicitud"];
			$mapBean->setSolicitud($solicitud);
			$listaDistrito = $mapDAO->obtenerMapSolicitudFilter($mapBean);
			echo json_encode($listaDistrito);
			break;
		case 22:
			$actividad = $_POST["actividad_proyecto"];
			$codigo = $_POST["codigo_proyecto"];
			$contratista = $_POST["contratista_proyecto"];
			$cliente = $_POST["cliente_proyecto"];
			$fecini = $_POST["fecini_proyecto"];
			$fecfin = $_POST["fecfin_proyecto"];
			$direccion = $_POST["direccion_proyecto"];
			$distrito = $_POST["distrito_proyecto"];
			$long = $_POST["long_proyecto"];
			$lat = $_POST["lat_proyecto"];
			$mapBean->setSolicitud($codigo);
			$mapBean->setActividad($actividad);
			$mapBean->setNombreContratista($contratista);
			$mapBean->setCliente($cliente);
			$mapBean->setFechaIni($fecini);
			$mapBean->setFechaFin($fecfin);
			$mapBean->setDirObra($direccion);
			$mapBean->setDistrito($distrito);
			$mapBean->setLng($long);
			$mapBean->setLat($lat);
			break;
	}

?>