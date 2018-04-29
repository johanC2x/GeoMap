<?php 

	require_once '../util/Conexion.php';
	require_once '../bean/PerfilModuloBean.php';

	class PerfilModuloDAO{
		
		public function obtenerPerfilModulo(PerfilModuloBean $perfilModuloBean){
			try {
				$miArray = "";
				$sql = "SELECT idmodulo,idmodulopadre,objeto,recurso,descripcion,dependencia,estado,'selected' as selected FROM modulo
						where idmodulo in (select idmodulo from perfilmodulo where idperfil = '$perfilModuloBean->idPerfil')
						union all 
						SELECT idmodulo,idmodulopadre,objeto,recurso,descripcion,dependencia,estado,'' as selected FROM modulo
						where idmodulo not in (select idmodulo from perfilmodulo where idperfil = '$perfilModuloBean->idPerfil')";
				$conexion = new Conexion();
				$cn = $conexion->Conectarse();
				$perfilmod= mysql_query($sql, $cn);
		        $miArray = array();
		        while($rsPerfilMod = mysql_fetch_array($perfilmod)){
		        	$miArray[] = array(
		        		'idmodulo' => $rsPerfilMod["idmodulo"],
		        		'idmodulopadre' => $rsPerfilMod["idmodulopadre"],
		        		'objeto' => $rsPerfilMod["objeto"],
		        		'recurso' => $rsPerfilMod["recurso"],
		        		'descripcion' => $rsPerfilMod["descripcion"],
		        		'dependencia' => $rsPerfilMod["dependencia"],
		        		'estado' => $rsPerfilMod["estado"],
		        		'selected' => $rsPerfilMod["selected"]
		        	);
		        }
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();
			}
			return $miArray;
		}

		public function eliminarPerfilModulo(PerfilModuloBean $perfilModuloBean){
			try {
				$res = 0;
				$sql = "DELETE from perfilmodulo 
						where idPerfil = '$perfilModuloBean->idPerfil' ";
				$conexion = new Conexion();
				$cn = $conexion->Conectarse();
				$perfilmod= mysql_query($sql, $cn);
				$res = 1;
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();
			}
			return $res;
		}

		public function insertarPerfilModulo(PerfilModuloBean $perfilModuloBean){
			try {
				$sql = "INSERT into perfilmodulo(idmodulo,idperfil)
						VALUES('$perfilModuloBean->idModulo','$perfilModuloBean->idPerfil')";
				$conexion = new Conexion();
				$cn = $conexion->Conectarse();
				$perfilmod= mysql_query($sql, $cn);
				$res = 1;
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();	
			}
			return $res;
		}

	}

?>