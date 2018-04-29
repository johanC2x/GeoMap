<?php 

require_once '../util/Conexion.php';
require_once '../bean/PerfilBean.php';

class PerfilDAO{
	
	public function obtenerPerfil(){
		try {
			$miArray = "";
			$sql = "SELECT idperfil,nombre,estado,
					(case
						when 1 then 'Activo'
					 	when 0 then 'Inactivo'
					end) as datoEstado
					FROM perfil";
			$conexion = new Conexion();
			$cn = $conexion->Conectarse();
			$perfil = mysql_query($sql, $cn);
	        $miArray = array();
	        while ($rsPerfil = mysql_fetch_array($perfil)) {
	        	$miArray[] = array(
	        		'idperfil' => $rsPerfil["idperfil"],
	        		'nombre' => $rsPerfil["nombre"],
	        		'estado' => $rsPerfil["estado"],
	        		'datoEstado' => $rsPerfil["datoEstado"]
				);
	        }
		} catch (Exception $exc) {
			echo $exc->getTraceAsString();
		}
		return $miArray;
	}

	public function obtenerPerfilUsuario(PerfilBean $perfilBean){
		try {
			$miArray = "";
			$sql = "SELECT idperfil,nombre,estado,'selected' as selected  from perfil 
					where idperfil in (select idperfil from perfilusuario where idusuario = '$perfilBean->idUsuario')
					union all
					select idperfil,nombre,estado,'' as selected  from perfil 
					where idperfil not in (select idperfil from perfilusuario where idusuario = '$perfilBean->idUsuario')";
			$conexion = new Conexion();
			$cn = $conexion->Conectarse();
			$perfil = mysql_query($sql, $cn);
			$miArray = array();
			while ($rsPerfil = mysql_fetch_array($perfil)) {
	        	$miArray[] = array(
	        		'idperfil' => $rsPerfil["idperfil"],
	        		'nombre' => $rsPerfil["nombre"],
	        		'estado' => $rsPerfil["estado"],
	        		'selected' => $rsPerfil["selected"]
				);
	        }
		} catch (Exception $exc) {
			echo $exc->getTraceAsString();
		}
		return $miArray;
	}

	public function insertarPerfil(PerfilBean $perfilBean){
		try {
			$res = 0;
			$sql = "INSERT INTO perfil(nombre,estado) 
				    VALUES('$perfilBean->nombre','$perfilBean->estado')";
			$conexion = new Conexion();
			$cn = $conexion->Conectarse();
			$perfil = mysql_query($sql, $cn);
			$res = 1;
		} catch (Exception $exc) {
			echo $exc->getTraceAsString();
		}
		return $res;
	}

	public function modificarPerfil(PerfilBean $perfilBean){
		try {
			$res = 0;
			$sql = "UPDATE perfil SET nombre = '$perfilBean->nombre' ,estado = '$perfilBean->estado' 
			        WHERE idperfil='$perfilBean->idPerfil' ";
			$conexion = new Conexion();
			$cn = $conexion->Conectarse();
			$perfil = mysql_query($sql, $cn);
			$res = 1;
		} catch (Exception $exc) {
			echo $exc->getTraceAsString();	
		}
		return $res;
	}

	public function obtenerPorId(PerfilBean $perfilBean){
		try {
			$miArray = "";
			$sql = "SELECT idperfil,nombre,estado,
					(case
						when 1 then 'Activo'
					 	when 0 then 'Inactivo'
					end) as datoEstado
					FROM perfil WHERE idperfil = '$perfilBean->idPerfil' ";
			$conexion = new Conexion();
			$cn = $conexion->Conectarse();
			$perfil = mysql_query($sql, $cn);
	        $miArray = array();
	        while ($rsPerfil = mysql_fetch_array($perfil)) {
	        	$miArray[] = array(
	        		'idperfil' => $rsPerfil["idperfil"],
	        		'nombre' => $rsPerfil["nombre"],
	        		'estado' => $rsPerfil["estado"],
	        		'datoEstado' => $rsPerfil["datoEstado"]
				);
	        }
		} catch (Exception $exc) {
			echo $exc->getTraceAsString();		
		}
		return $miArray;
	}

	public function eliminarPerfil(PerfilBean $perfilBean){
		try {
			$res = 0;
			$sql = "DELETE from perfil where idPerfil = '$perfilBean->idPerfil' ";
			$conexion = new Conexion();
			$cn = $conexion->Conectarse();
			$perfil = mysql_query($sql, $cn);
			$res = 1;
		} catch (Exception $exc) {
			echo $exc->getTraceAsString();	
		}
		return $res;
	}

	public function filtrarPerfil(PerfilBean $perfilBean){
		try {
			$miArray = "";
			$sql = "SELECT p.idperfil,p.nombre,p.estado,
					(case
						when 1 then 'Activo'
						when 0 then 'Inactivo'
					end) as datoEstado
					FROM perfil p
					where
					upper(p.nombre) like concat('%','$perfilBean->nombre','%')";
			$conexion = new Conexion();
			$cn = $conexion->Conectarse();
			$perfil = mysql_query($sql, $cn);
			$miArray = array();
	        while ($rsPerfil = mysql_fetch_array($perfil)) {
	        	$miArray[] = array(
	        		'idperfil' => $rsPerfil["idperfil"],
	        		'nombre' => $rsPerfil["nombre"],
	        		'estado' => $rsPerfil["estado"],
	        		'datoEstado' => $rsPerfil["datoEstado"]
				);
	        }
		} catch (Exception $exc) {
			echo $exc->getTraceAsString();	
		}
		return $miArray;
	}

}

?>