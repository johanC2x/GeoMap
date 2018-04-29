<?php 
	
	require_once '../util/Conexion.php';
	require_once '../bean/ModuloBean.php';

	class ModuloDAO{
		
		public function obtenerModulosPadres($usuario){
			try {
				$listaMenu = "";
				$sql = "SELECT distinct m.idmodulo,m.recurso,m.objeto,m.estado,
						m.descripcion,m.dependencia,m.icono
	                    FROM perfilmodulo pm
	                    inner join perfilusuario pu on pm.idperfil = pu.idperfil
	                    inner join modulo m on pm.idmodulo = m.idmodulo
	                    inner join usuario u on pu.idusuario = u.idusuario
	                    WHERE u.usuario = '$usuario' and m.dependencia = 0";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $modulo = mysql_query($sql, $cn);
	            $listaMenu = array();
	            while ($resMenu = mysql_fetch_array($modulo)) {
	            	$listaMenu[] = array(
	            		'idmodulo' => $resMenu["idmodulo"],
	            		'recurso' => $resMenu["recurso"],
	            		'objeto' => $resMenu["objeto"],
	            		'estado' => $resMenu["estado"],
	            		'descripcion' => $resMenu["descripcion"],
	            		'dependencia' => $resMenu["dependencia"],
	            		'icono' => $resMenu["icono"]
	            	);
	            }
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();
			}
			return $listaMenu;
		}

		public function obtenerModulosHijos($usuario,$idmodulo){
			try {
				$listaMenu = "";
				$sql = "SELECT distinct m.idmodulo,m.recurso,m.objeto,m.estado,
						m.descripcion,m.dependencia,m.icono
	                    FROM perfilmodulo pm
	                    inner join perfilusuario pu on pm.idperfil = pu.idperfil
	                    inner join modulo m on pm.idmodulo = m.idmodulo
	                    inner join usuario u on pu.idusuario = u.idusuario
	                    WHERE u.usuario = '$usuario' and m.idmodulopadre = '$idmodulo' ";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $modulo = mysql_query($sql, $cn);
	            $listaMenu = array();
	            while ($resMenu = mysql_fetch_array($modulo)) {
	            	$listaMenu[] = array(
	            		'idmodulo' => $resMenu["idmodulo"],
	            		'recurso' => $resMenu["recurso"],
	            		'objeto' => $resMenu["objeto"],
	            		'estado' => $resMenu["estado"],
	            		'descripcion' => $resMenu["descripcion"],
	            		'dependencia' => $resMenu["dependencia"],
	            		'icono' => $resMenu["icono"]
	            	);
	            }
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();
			}
			return $listaMenu;
		}

	}
 ?>