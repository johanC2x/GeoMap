<?php 

	require_once '../util/Conexion.php';
	require_once '../bean/UsuarioBean.php';
	require_once '../bean/PersonaBean.php';

	class UsuarioDAO{
		public function validarUsuario(UsuarioBean $usuarioBean){
			try {
				$miArray = "";
				$sql = "SELECT idusuario,usuario,passw,estado,idpersona,descripcion
						FROM usuario 
						WHERE usuario = '$usuarioBean->usuario' and passw = '$usuarioBean->passw' ";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $usuario = mysql_query($sql, $cn);
	            while ($rsUsuario = mysql_fetch_array($usuario)) {
	            	$miArray[] = array(
	            		'idusuario' => $rsUsuario['idusuario'],
	            		'usuario' => $rsUsuario['usuario'],
	            		'passw' => $rsUsuario['passw'],
	            		'estado' => $rsUsuario['estado'],
	            		'idpersona' => $rsUsuario['idpersona'],
	            		'descripcion' => $rsUsuario['descripcion']
					);
	            }
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();
			}
			return $miArray;
		}

		public function obtenerUSuario(){
			try {
				$sql = "SELECT u.idusuario,u.usuario,u.passw,u.estado,u.idpersona,
						(case when u.estado = 1 then 'Activo' else 'Inactivo' end) as datoEstado, 
						p.nombre,p.apepat,p.apemat,p.edad,p.fechanac,.p.idpersona as idper,
						concat(p.nombre,' ',p.apepat,' ',p.apemat) as nombreCompleto,
						p.idtipodoc,p.nrodoc FROM usuario u
						inner join persona p on u.idpersona = p.idpersona";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $usuario = mysql_query($sql, $cn);
	            while ($rsUsuario = mysql_fetch_array($usuario)) {
	            	$miArray[] = array(
	            		'idusuario' => $rsUsuario['idusuario'],
	            		'usuario' => $rsUsuario['usuario'],
	            		'passw' => $rsUsuario['passw'],
	            		'estado' => $rsUsuario['estado'],
	            		'datoEstado' => $rsUsuario['datoEstado'],
	            		'nombre' => $rsUsuario['nombre'],
	            		'apepat' => $rsUsuario['apepat'],
	            		'apemat' => $rsUsuario['apemat'],
	            		'edad' => $rsUsuario['edad'],
	            		'fechanac' => $rsUsuario['fechanac'],
	            		'idpersona' => $rsUsuario['idpersona'],
	            		'idper' => $rsUsuario['idper'],
	            		'nombreCompleto' => $rsUsuario['nombreCompleto'],
	            		'idtipodoc' => $rsUsuario['idtipodoc'],
	            		'nrodoc' => $rsUsuario['nrodoc']
					);
	            }
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();
			}
			return $miArray;
		}

		public function insertarUsuario(UsuarioBean $usuarioBean) {
	        try {
	            $res = 0;
	            $sql = "INSERT INTO usuario(usuario,passw,estado,idPersona)
	                    VALUES ('$usuarioBean->usuario','$usuarioBean->passw',1,$usuarioBean->idPersona)";
	            $conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $usuario = mysql_query($sql, $cn);
	            $res = 1;
	        } catch (Exception $exc) {
	            echo $exc->getTraceAsString();
	        }
	        echo $res;
	    }

	    public function modificarUsuario(UsuarioBean $usuarioBean) {
	        try {
	            $res = 0;
	            $sql = "UPDATE usuario 
	                    set 
	                    usuario = '$usuarioBean->usuario' , 
	                    passw = '$usuarioBean->passw' 
	                    where idusuario = '$usuarioBean->idUsuario'";
	            $conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $usuario = mysql_query($sql, $cn);
	            $res = 1;
	        } catch (Exception $exc) {
	            echo $exc->getTraceAsString();
	        }
	        return $res;
	    }

	    public function obtenerPorId(UsuarioBean $usuarioBean) {
	        try {
	            $miArray = "";
	            $sql = "SELECT u.idusuario,u.usuario,p.nombre,p.apePat,p.apeMat,u.estado,u.passw,
	                    p.edad,p.nroDoc,p.idTipoDoc,p.sexo
	                    FROM usuario u inner join persona p on p.idpersona = u.idpersona
	                    WHERE u.idusuario = '$usuarioBean->idUsuario'";
	           	$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $usuario = mysql_query($sql, $cn);
	            $miArray = array();
	            while ($rsUsuario = mysql_fetch_array($usuario)) {
	                $miArray[] = array(
	                    'idusuario' => $rsUsuario['idusuario'],
	                    'usuario' => $rsUsuario['usuario'],
	                    'nombre' => $rsUsuario['nombre'],
	                    'apePat' => $rsUsuario['apePat'],
	                    'apeMat' => $rsUsuario['apeMat'],
	                    'estado' => $rsUsuario['estado'],
	                    'passw' => $rsUsuario['passw'],
	                    'edad' => $rsUsuario['edad'],
	                    'nroDoc' => $rsUsuario['nroDoc'],
	                    'idTipoDoc' => $rsUsuario['idTipoDoc'],
	                    'sexo' => $rsUsuario['sexo']
	                );
	            }
	        } catch (Exception $exc) {
	            echo $exc->getTraceAsString();
	        }
	        return $miArray;
	    }

	    public function obtenerIdPersonaUsu(UsuarioBean $usuarioBean) {
	        try {
	            $idPersona = 0;
	            $sql = "select idpersona from usuario where idusuario = '$usuarioBean->idUsuario'";
	            $conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $usuario = mysql_query($sql, $cn);
	            $usuarioRes = mysql_fetch_array($usuario);
	            $idPersona = $usuarioRes["idpersona"];
	        } catch (Exception $exc) {
	            echo $exc->getTraceAsString();
	        }
	        return $idPersona;
	    }

	    public function eliminarUsuario(UsuarioBean $usuarioBean) {
	        try {
	            $res = 0;
	            $sql = "DELETE from usuario where idusuario = '$usuarioBean->idUsuario'";
	            $conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $usuario = mysql_query($sql, $cn);
	            $res = 1;
	        } catch (Exception $exc) {
	            echo $exc->getTraceAsString();
	        }
	        echo $res;
	    }

	    public function filtrarUsuario(PersonaBean $personaBean, UsuarioBean $usuarioBean) {
	        try {
	            $miArray = "";
	            $sql = "SELECT u.idusuario,u.usuario,p.nombre,p.apePat,p.apeMat,u.estado,
	            		(case when u.estado = 1 then 'Activo' else 'Inactivo' end) as datoEstado,
	            		concat(p.nombre,' ',p.apepat,' ',p.apemat) as nombreCompleto 
	            		FROM usuario u 
	                    left join persona p on p.idpersona = u.idpersona 
	                    where 
	                    u.estado = 1 and 
	                    upper(p.nombre) like concat('%','$personaBean->nombre','%') and
	                    upper(p.apePat) like concat('%','$personaBean->apePat','%') and
	                    upper(p.apeMat) like concat('%','$personaBean->apeMat','%') and
	                    upper(u.usuario) like concat('%','$usuarioBean->usuario','%')";
	            $conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $usuario = mysql_query($sql, $cn);
	            $miArray = array();
	            while ($user = mysql_fetch_array($usuario)) {
	                $miArray[] = array(
	                    'idusuario' => $user['idusuario'],
	                    'usuario' => $user['usuario'],
	                    'nombre' => $user['nombre'],
	                    'apePat' => $user['apePat'],
	                    'apeMat' => $user['apeMat'],
	                    'estado' => $user['estado'],
	                    'datoEstado' => $user['datoEstado'],
	                    'nombreCompleto' => $user['nombreCompleto']
	                );
	            }
	        } catch (Exception $exc) {
	            echo $exc->getTraceAsString();
	        }
	        return $miArray;
	    }

	}

?>