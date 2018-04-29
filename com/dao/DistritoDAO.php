<?php 

	require_once '../util/Conexion.php';
	require_once '../bean/DistritoBean.php';

	class DistritoDAO{

		public function obtenerTodosDistrito(){
			try {
				$miArray = "";
				$sql = "SELECT iddistrito, nombre FROM distrito";	
				$conexion = new Conexion();
		        $cn = $conexion->Conectarse();
		        $distrito = mysql_query($sql, $cn);
				$miArray = array();
				while ($rsDistrito = mysql_fetch_array($distrito)) {
	            	$miArray[] = array(
	            		'iddistrito' => $rsDistrito['iddistrito'],
	            		'nombre' => $rsDistrito['nombre']
					);
	            }
			} catch (Exception $e) {
				echo $exc->getTraceAsString();
			}
			return $miArray;
		}

	}

 ?>