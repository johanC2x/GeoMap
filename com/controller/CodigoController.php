<?php 
	
	/* Instancias */
	session_start();
	require_once '../dao/CodigoDAO.php';
	require_once '../bean/CodigoBean.php';
	require_once '../bean/TipoCodigoBean.php';
	require_once '../util/GmapConstantes.php';

	$op = $_POST["op"];

	$codigoBean = new CodigoBean();
	$codigoDAO = new CodigoDAO();
	$gmapConstantes = new GmapConstantes();
 
	switch ($op) {
		
		case 1:/* Tipo Documento */
			$codigoBean->setIdTipoCodigo($gmapConstantes::tipoDocumento);
			$listaCodigo = $codigoDAO->obtenerPorTipo($codigoBean);
			echo json_encode($listaCodigo);
			break;

		case 2:/* Tipo Sexo */
			$codigoBean->setIdTipoCodigo($gmapConstantes::tipoSexo);
			$listaCodigo = $codigoDAO->obtenerPorTipo($codigoBean);
			echo json_encode($listaCodigo);
			break;
		
	}

?>