<?php 

	session_start();
	require_once '../bean/PerfilBean.php';
	require_once '../dao/PerfilDAO.php';

	$perfilBean = new PerfilBean();
	$perfilDAO = new PerfilDAO();

	$op = $_POST["op"];

	switch ($op){
		case 1:
			$listaPerfil = $perfilDAO->obtenerPerfil();
			echo json_encode($listaPerfil);
			break;
		case 2:
			$idUsuario = $_POST["idUsuario"];
			$perfilBean->setIdUsuario($idUsuario);
			$listaPerfil = $perfilDAO->obtenerPerfilUsuario($perfilBean);
			echo json_encode($listaPerfil);
			break;
		case 3:
			$txtNNomPerfil = $_POST["txtNNomPerfil"];
			$estado = $_POST["estado"];
			$perfilBean->setNombre($txtNNomPerfil);
			$perfilBean->setEstado($estado);
			$res = $perfilDAO->insertarPerfil($perfilBean);
			echo $res;
			break;
		case 4:
			$idPerfil = $_POST["idPerfil"];
			$txtNNomPerfil = $_POST["txtNNomPerfil"];
			$estado = $_POST["estado"];
			$perfilBean->setIdPerfil($idPerfil);
			$perfilBean->setNombre($txtNNomPerfil);
			$perfilBean->setEstado($estado);
			$res = $perfilDAO->modificarPerfil($perfilBean);
			echo $res;
			break;
		case 5:
			$idPerfil = $_POST["idPerfil"];
			$perfilBean->setIdPerfil($idPerfil);
			$listaPerfil = $perfilDAO->obtenerPorId($perfilBean);
			echo json_encode($listaPerfil);
			break;
		case 6:
			$idPerfil = $_POST["idPerfil"];
			$perfilBean->setIdPerfil($idPerfil);
			$res = $perfilDAO->eliminarPerfil($perfilBean);
			echo $res;
			break;
		case 7:
			$txtNomPerfil = $_POST["txtNomPerfil"];
			$estado = $_POST["estado"];
			$perfilBean->setNombre($txtNomPerfil);
			$perfilBean->setEstado($estado);
			$listaPerfil = $perfilDAO->filtrarPerfil($perfilBean);
			echo json_encode($listaPerfil);
			break;
	}

?>