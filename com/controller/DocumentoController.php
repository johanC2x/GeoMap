<?php 

	session_start();
	require_once '../bean/MapBean.php';
	require_once '../dao/MapDAO.php';
	require_once '../dao/DocumentoDAO.php';
	require_once '../bean/DocumentoBean.php';
	require_once '../util/ext/PHPExcel/Classes/PHPExcel/IOFactory.php';

	$mapBean = new MapBean();
	$mapDAO = new MapDAO();
	$documentoBean = new DocumentoBean();
	$documentoDAO = new DocumentoDAO();

	$op = $_POST["op"];
	
	switch ($op) {
		case 1:
			$upload_folder ='../../xlsx';
			$nombre_archivo = $_FILES['archivo']['name'];
			opendir($upload_folder);
			$archivador = $upload_folder.'/'. $nombre_archivo;
			copy($_FILES['archivo']['tmp_name'],$archivador);
			$tipo_archivo = $_FILES['archivo']['type'];
			$tipo_archivo = $_FILES['archivo']['type'];
			$tamano_archivo = $_FILES['archivo']['size'];
			$tmp_archivo = $_FILES['archivo']['tmp_name'];
			$archivo = "";
			$archivo = substr($nombre_archivo,0,strpos($nombre_archivo,".")); 
			$fecha = $documentoDAO->obtenerFecha(); 
			$documentoBean->setNombre($archivo.'_'.$fecha.'.xlsx');
			$documentoBean->setCreaPor($_SESSION['usuario']);
			$res = $documentoDAO->insertarDocumento($documentoBean);
			rename ($upload_folder.'/'.$nombre_archivo,$upload_folder.'/'.$archivo.'_'.$fecha.'.xlsx');

			$obj = PHPExcel_IOFactory::load($upload_folder.'/'.$archivo.'_'.$fecha.'.xlsx');
			$objHoja=$obj->getActiveSheet()->toArray(null,true,true,true);
			foreach ($objHoja as $iIndice=>$objCelda) {
				$mapBean = new MapBean();
				echo $objCelda['SOLICITUD'];
				echo $objCelda['CR TECSUR'];
				echo $objCelda['CS.'];
				echo $objCelda['Actividad'];
				echo $objCelda['Nom. Contratista'];
				echo $objCelda['CLIENTE'];
				echo $objCelda['DIR.OBRA'];
				echo $objCelda['CLIENTE'];
				echo $objCelda['Distrito'];
				echo $objCelda['ROL LIQUIDADOR'];
				echo $objCelda['Tec. Tecsur'];
				echo $objCelda['FIN REAL'];
				echo $objCelda['Año'];
				echo $objCelda['Mes'];
				echo $objCelda['EST.OBRA'];
				echo $objCelda['Plazo'];
				echo $objCelda['P.Días'];
				echo $objCelda['ULT.DEV.CONTRAT'];
				echo $objCelda['Atraso de Liq Tecsur'];
				echo $objCelda['Condición'];
				echo $objCelda['ULT.ENV.CONTRAT'];
				echo $objCelda['Atraso de corrección'];
				echo $objCelda['Etapa Liquidación'];
				echo $objCelda['Ind.Liq.Par'];
				echo $objCelda['TotPlanifMaterialSol'];
				echo $objCelda['TotPlanifMObraSoles'];
				echo $objCelda['Tot Mat Liq (S/.)'];
				echo $objCelda['Tot MO Liq (S/.)'];
				echo $objCelda['MT.Pend.Aprob'];
				echo $objCelda['MO.Pend.Aprob'];
				echo $objCelda['Total MT + MO'];
				echo $objCelda['en cero'];
				echo $objCelda['P.Días Ctta. '];
				echo $objCelda['Plazo Ctta.'];
				echo $objCelda['PARALIZADA'];
				echo $objCelda['AÑO2'];
				echo $objCelda['MES2'];
				echo $objCelda['PLAZO2'];
				echo $objCelda['Area'];
				echo $objCelda['FIN ASIG.'];
				echo $objCelda['CX'];
			}
			echo $res;
			break;
	}

?>