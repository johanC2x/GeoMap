<?php 

	require_once '../util/Conexion.php';
	require_once '../bean/PerfilBean.php';

	class PerfilUsuarioDAO{
		
		public function obtenerPerfilUSuario(){
			try {
				
			} catch (Exception $e) {
				
			}
		}

		public function eliminarPerfilUsuario(PerfilUsuarioBean $perfilUsuarioBean){
			try {
				$res = 0;
				$sql = "DELETE from perfilusuario 
						where idusuario = '$perfilUsuarioBean->idUsuario'";
				$conexion = new Conexion();
				$cn = $conexion->Conectarse();
				$perfilusuario =  mysql_query($sql, $cn);
	            $res = 1;
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();
			}
			return $res;
		}

		public function insertarPerfilUsuario(PerfilUsuarioBean $perfilUsuarioBean){
			try {
				$res = 0;
				$sql = "INSERT INTO perfilusuario(idperfil,idusuario) 
						VALUES ('$perfilUsuarioBean->idPerfil','$perfilUsuarioBean->idUsuario')";
				$conexion = new Conexion();
				$cn = $conexion->Conectarse();
				$perfilusuario =  mysql_query($sql, $cn);
	            $res = 1;
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();	
			}
			return $res;
		}

	}

?>