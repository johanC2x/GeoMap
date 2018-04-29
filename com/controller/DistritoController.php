<?php 
	session_start();
	require_once '../bean/DistritoBean.php';
	require_once '../dao/DistritoDAO.php';

	$distritoBean = new DistritoBean();
	$distritoDAO = new DistritoDAO();

	$op = $_POST["op"];

	switch ($op) {
		case 1:
			$listaDistrito = $distritoDAO->obtenerTodosDistrito();
			echo json_encode($listaDistrito);
			break;
	}

?>