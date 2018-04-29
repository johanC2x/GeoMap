<?php 

	require_once '../util/Conexion.php';
	require_once '../bean/DocumentoBean.php';

	class DocumentoDAO{
		
		public function obtenerFecha(){
			try {
				$fecha = "";
				$sql = "SELECT replace(curdate(),'-','') as fecha";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $documento = mysql_query($sql, $cn);
	            $rsdocumento = mysql_fetch_array($documento);
	            $fecha = $rsdocumento["fecha"];
			} catch (Exception $e) {
				echo $exc->getTraceAsString();
			}
			return $fecha;
		}
		
		public function insertarDocumento(DocumentoBean $documentoBean){
			try {
				$res = 0;
				$sql = "INSERT INTO documento(nombre,creapor,creafecha,estado)
				        VALUES('$documentoBean->nombre','$documentoBean->creaPor',now(),1)";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $documento = mysql_query($sql, $cn);
	            $res = 1;
			} catch (Exception $e) {
				echo $exc->getTraceAsString();
			}
			return $res;
		}

	}

?>