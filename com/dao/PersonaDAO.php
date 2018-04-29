<?php 
	/**
	* 
	*/
	class PersonaDAO{

		public function obtenerMaxId(){
			try {
				$sql = "SELECT MAX(idpersona) as idpersona FROM persona";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $persona = mysql_query($sql, $cn);
	            $resultId = mysql_fetch_array($persona);
            	$resultPersonaId = $resultId["idpersona"];
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();
			}
			return $resultPersonaId;
		}

		public function insertarPersona(PersonaBean $personaBean) {
	        try {
	            $res = 0;
	            $sql = "INSERT INTO persona(nombre,apePat,apeMat,edad,idTipoDoc,nroDoc,sexo) 
	                    VALUES ('$personaBean->nombre','$personaBean->apePat','$personaBean->apeMat',$personaBean->edad,$personaBean->idTipoDoc,'$personaBean->nroDoc',$personaBean->sexo)";
	            $conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $persona = mysql_query($sql, $cn);
	            $res = 1;
	        } catch (Exception $exc) {
	            echo $exc->getTraceAsString();
	        }
	        return $res;
	    }

	    public function modificarPersona(PersonaBean $personaBean) {
	        try {
	            $res = 0;
	            $sql = "UPDATE persona set 
	                    nombre ='$personaBean->nombre',
	                    apePat ='$personaBean->apePat',
	                    apeMat ='$personaBean->apeMat',
	                    edad ='$personaBean->edad',
	                    idTipoDoc ='$personaBean->idTipoDoc',
	                    nroDoc ='$personaBean->nroDoc',
	                    sexo ='$personaBean->sexo'
	                    where idpersona = '$personaBean->idPersona'";
	            $conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $persona = mysql_query($sql, $cn);
	            $res = 1;
	        } catch (Exception $exc) {
	            echo $exc->getTraceAsString();
	        }
	        return $res;
	    }

	    public function eliminarPersona(PersonaBean $personaBean) {
	        try {
	            $res = 0;
	            $sql = "DELETE from persona where idpersona = '$personaBean->idPersona'";
	            $conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $persona = mysql_query($sql, $cn);
	            $res = 1;
	        } catch (Exception $exc) {
	            echo $exc->getTraceAsString();
	        }
	        return $res;
	    }

	}
 ?>