<?php 

	session_start();
	require_once '../bean/PerfilUSuarioBean.php';
	require_once '../dao/PerfilUSuarioDAO.php';

	$perfilUsuarioBean = new PerfilUSuarioBean();
	$perfilUsuarioDAO = new perfilUsuarioDAO();

	$op = $_POST["op"];

	switch ($op) {
		case 2:
			$idUsuario = $_POST["idUsuario"];
			$perfilUsuarioBean->setIdUsuario($idUsuario);
			$res = $perfilUsuarioDAO->eliminarPerfilUsuario($perfilUsuarioBean);
			echo $res;
			break;
		case 3:
			$idUsuario = $_POST["idUsuario"];
			$idPerfil = $_POST["idPerfil"];
			$perfilUsuarioBean->setIdUsuario($idUsuario);
			$perfilUsuarioBean->setIdPerfil($idPerfil);
			$res = $perfilUsuarioDAO->insertarPerfilUsuario($perfilUsuarioBean);
			echo $res;
			break;
	}

?>