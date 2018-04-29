<?php 

	session_start();
	require_once '../bean/PerfilModuloBean.php';
	require_once '../dao/PerfilModuloDAO.php';

	$perfilModuloBean = new PerfilModuloBean();
	$perfilModuloDAO = new PerfilModuloDAO();

	$op = $_POST["op"];

	switch ($op) {
		case 1:
			$idPerfil = $_POST["idPerfil"];
			$perfilModuloBean->setIdPerfil($idPerfil);
			$listaPerfilModulo = $perfilModuloDAO->obtenerPerfilModulo($perfilModuloBean);
			echo json_encode($listaPerfilModulo);
			break;
		case 2:
			$idPerfil = $_POST["idPerfil"];
			$perfilModuloBean->setIdPerfil($idPerfil);
			$res = $perfilModuloDAO->eliminarPerfilModulo($perfilModuloBean);
			echo $res;
			break;
		case 3:
			$idPerfil = $_POST["idPerfil"];
			$idModulo = $_POST["idModulo"];
			$perfilModuloBean->setIdPerfil($idPerfil);
			$perfilModuloBean->setIdModulo($idModulo);
			$res = $perfilModuloDAO->insertarPerfilModulo($perfilModuloBean);
			echo $res;
			break;
	}

?>