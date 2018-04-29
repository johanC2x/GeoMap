<?php 

	require_once '../util/Conexion.php';
	require_once '../bean/CodigoBean.php';
	require_once '../bean/TipoCodigoBean.php';

	class CodigoDAO{
		
		public function obtenerPorTipo(CodigoBean $codigoBean){
			try {
				$miArray = ""; 
				$sql = "SELECT idcodigo,codigo,idTipoCodigo FROM codigo 
					    WHERE idtipocodigo = $codigoBean->idTipoCodigo";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $codigo = mysql_query($sql, $cn);
	            $miArray = array();
	            while ($rsCodigo= mysql_fetch_array($codigo)) {
	            	$miArray[] = array(
	            		'idcodigo' => $rsCodigo['idcodigo'],
	            		'codigo' => $rsCodigo['codigo'],
	            		'idTipoCodigo' => $rsCodigo['idTipoCodigo']
					);
	            }
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();
			}
			return $miArray;
		}

	}

?>