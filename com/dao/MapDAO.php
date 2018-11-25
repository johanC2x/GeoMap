<?php 

	require_once '../util/Conexion.php';
	require_once '../bean/MapBean.php';

	class MapDAO{

		public function obtenerDistrito(){
			try { 
				$miArray = "";
				$sql = "SELECT distinct distrito FROM map";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $map = mysql_query($sql, $cn);
	            $miArray = array(); 
	            while ($rsMap = mysql_fetch_array($map)) {
	            	$miArray[] = array(
	            		'distrito' => $rsMap['distrito']
					);
	            }
			}catch (Exception $exc) {
				echo $exc->getTraceAsString();
			}
			return $miArray;
		}

		public function obtenerMapDistrito(MapBean $mapBean){
			try {
				$miArray= "";
				$sql = "SELECT distrito,count(*) as contador FROM map 
						WHERE roltecnico = '$mapBean->codigo'
						group by distrito";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $map = mysql_query($sql, $cn);
	            while ($rsMap = mysql_fetch_array($map)) {
	            	$miArray[] = array(
	            		'distrito' => $rsMap['distrito'],
	            		'contador' => $rsMap['contador']
					);
	            }
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();
			}
			return $miArray;
		}

		public function obtenerMapContratista(MapBean $mapBean){
			try {
				$miArray= "";
				$sql = "SELECT DISTINCT nombreContratista,roltecnico,count(*) as contador from map 
						where roltecnico = '$mapBean->codigo'
						group by nombreContratista";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $map = mysql_query($sql, $cn);
	            while ($rsMap = mysql_fetch_array($map)) {
	            	$miArray[] = array(
	            		'nombreContratista' => $rsMap['nombreContratista'],
	            		'roltecnico' => $rsMap['roltecnico'],
	            		'contador' => $rsMap['contador']
					);
	            }
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();
			}
			return $miArray;
		}

		public function obtenerAsigDistrito(MapBean $mapBean){
			try {
				$miArray= "";
				$sql = "SELECT idMap,solicitud,actividad,nombreContratista,
				        cliente,dirObra,distrito,rolLiquidador,tecnico,finReal,mes,ruta,
				        nombreContratista,roltecnico,
				        (case 
				        	when ruta is null then 0 
				        	when ruta is not null then 1 
				        end) as flgRuta
				        FROM map 
				        where distrito = '$mapBean->distrito' and roltecnico = '$mapBean->codigo' ";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $map = mysql_query($sql, $cn);
	            while ($rsMap = mysql_fetch_array($map)) {
	            	$miArray[] = array(
	            		'idMap' => $rsMap['idMap'],
	            		'solicitud' => $rsMap['solicitud'],
	            		'actividad' => $rsMap['actividad'],
	            		'nombreContratista' => $rsMap['nombreContratista'],
	            		'cliente' => $rsMap['cliente'],
	            		'dirObra' => $rsMap['dirObra'],
	            		'rolLiquidador' => $rsMap['rolLiquidador'],
	            		'distrito' => $rsMap['distrito'],
	            		'tecnico' => $rsMap['tecnico'],
	            		'finReal' => $rsMap['finReal'],
	            		'mes' => $rsMap['mes'],
	            		'ruta' => $rsMap['ruta'],
	            		'flgRuta' => $rsMap['flgRuta'],
	            		'nombreContratista' => $rsMap['nombreContratista'],
	            		'roltecnico' => $rsMap['roltecnico']
					);
	            }
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();	
			}
			return $miArray;
		}

		public function obtenerAsigContratista(MapBean $mapBean){
			try {
				$miArray= "";
				$sql = "SELECT idMap,solicitud,actividad,nombreContratista,
						cliente,dirObra,distrito,rolLiquidador,tecnico,finReal,
						mes,ruta,nombreContratista,roltecnico,
						(case 
							when ruta is null then 0 
							when ruta is not null then 1 
						end) as flgRuta
						FROM map
						where nombreContratista = '$mapBean->contratista' and roltecnico = '$mapBean->codigo'";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $map = mysql_query($sql, $cn);
	            while ($rsMap = mysql_fetch_array($map)) {
	            	$miArray[] = array(
	            		'idMap' => $rsMap['idMap'],
	            		'solicitud' => $rsMap['solicitud'],
	            		'actividad' => $rsMap['actividad'],
	            		'nombreContratista' => $rsMap['nombreContratista'],
	            		'cliente' => $rsMap['cliente'],
	            		'dirObra' => $rsMap['dirObra'],
	            		'rolLiquidador' => $rsMap['rolLiquidador'],
	            		'distrito' => $rsMap['distrito'],
	            		'tecnico' => $rsMap['tecnico'],
	            		'finReal' => $rsMap['finReal'],
	            		'mes' => $rsMap['mes'],
	            		'ruta' => $rsMap['ruta'],
	            		'flgRuta' => $rsMap['flgRuta'],
	            		'nombreContratista' => $rsMap['nombreContratista'],
	            		'roltecnico' => $rsMap['roltecnico']
					);
	            }
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();
			}
			return $miArray;
		}

		public function obtenerMapId(MapBean $mapBean){
			try {
				$miArray¨= "";
				$sql = "SELECT x,y,idMap,solicitud,actividad,nombreContratista,
				        cliente,dirObra,distrito,rolLiquidador,tecnico,finReal,mes,
				        flgEstado,descripcion,fechafin,fechaIni,access_code,idUser
				        FROM map where idMap = '$mapBean->idMap'";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $map = mysql_query($sql, $cn);
	            while ($rsMap = mysql_fetch_array($map)) {
	            	$miArray[] = array(
	            		'idMap' => $rsMap['idMap'],
	            		'x' => $rsMap['x'],
	            		'y' => $rsMap['y'],
	            		'solicitud' => $rsMap['solicitud'],
	            		'actividad' => $rsMap['actividad'],
	            		'nombreContratista' => $rsMap['nombreContratista'],
	            		'cliente' => $rsMap['cliente'],
	            		'dirObra' => $rsMap['dirObra'],
	            		'rolLiquidador' => $rsMap['rolLiquidador'],
	            		'distrito' => $rsMap['distrito'],
	            		'tecnico' => $rsMap['tecnico'],
	            		'finReal' => $rsMap['finReal'],
	            		'mes' => $rsMap['mes'],
	            		'flgEstado' => $rsMap['flgEstado'],
						'descripcion' => $rsMap['descripcion'],
						'access_code' => $rsMap['access_code'],
						'fechaIni' => $rsMap['fechaIni'],
						'fechafin' => $rsMap['fechafin'],
						'idUser' => $rsMap['idUser']
					);
	            }
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();
			}
			return $miArray;
		}

		public function obtenerMapSolicitudFilter(MapBean $mapBean){
			try {
				$miArray¨= "";
				$sql = "SELECT x,y,idMap,solicitud,actividad,nombreContratista,
				        cliente,dirObra,distrito,rolLiquidador,tecnico,finReal,mes,
				        flgEstado,descripcion 
				        FROM map where solicitud = '$mapBean->solicitud'";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $map = mysql_query($sql, $cn);
	            while ($rsMap = mysql_fetch_array($map)) {
	            	$miArray[] = array(
	            		'idMap' => $rsMap['idMap'],
	            		'x' => $rsMap['x'],
	            		'y' => $rsMap['y'],
	            		'solicitud' => $rsMap['solicitud'],
	            		'actividad' => $rsMap['actividad'],
	            		'nombreContratista' => $rsMap['nombreContratista'],
	            		'cliente' => $rsMap['cliente'],
	            		'dirObra' => $rsMap['dirObra'],
	            		'rolLiquidador' => $rsMap['rolLiquidador'],
	            		'distrito' => $rsMap['distrito'],
	            		'tecnico' => $rsMap['tecnico'],
	            		'finReal' => $rsMap['finReal'],
	            		'mes' => $rsMap['mes'],
	            		'flgEstado' => $rsMap['flgEstado'],
	            		'descripcion' => $rsMap['descripcion']
					);
	            }
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();
			}
			return $miArray;
		}

		public function obtenerMapSolicitud(MapBean $mapBean){
			try {
				$miArray = "";
				$sql = "SELECT idMap,solicitud,actividad,nombreContratista,
				        cliente,dirObra,distrito,rolLiquidador,tecnico,finReal,mes 
				        FROM map where solicitud = '$mapBean->solicitud'";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $map = mysql_query($sql, $cn);
	            while ($rsMap = mysql_fetch_array($map)) {
	            	$miArray[] = array(
	            		'dirObra' => $rsMap['dirObra']." ".$rsMap['distrito']
					);
	            }	        
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();
			}
			return $miArray;
		}

		public function obtenerTodos(){
			try {
				$miArray¨= "";
				$sql = "SELECT idMap,solicitud,actividad,nombreContratista,
				        cliente,dirObra,distrito,rolLiquidador,tecnico,finReal,mes FROM map ";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $map = mysql_query($sql, $cn);
	            while ($rsMap = mysql_fetch_array($map)) {
	            	$miArray[] = array(
	            		'idMap' => $rsMap['idMap'],
	            		'solicitud' => $rsMap['solicitud'],
	            		'actividad' => $rsMap['actividad'],
	            		'nombreContratista' => $rsMap['nombreContratista'],
	            		'cliente' => $rsMap['cliente'],
	            		'dirObra' => $rsMap['dirObra'],
	            		'rolLiquidador' => $rsMap['rolLiquidador'],
	            		'distrito' => $rsMap['distrito'],
	            		'tecnico' => $rsMap['tecnico'],
	            		'finReal' => $rsMap['finReal'],
	            		'mes' => $rsMap['mes']
					);
	            }
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();	
			}
			return $miArray;
		}

		public function actualizarRuta(MapBean $mapBean){
			try {
				$res = "";
				$sql = "UPDATE map set ruta = '$mapBean->ruta' WHERE idMap = '$mapBean->idMap'";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $map = mysql_query($sql, $cn);
	            $res = "1";
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();	
			}
			return $res;
		}

		public function eliminarArchivoMap(MapBean $mapBean){
			try {
				$res = "";
				$sql = "UPDATE map set ruta = null WHERE idMap = '$mapBean->idMap'";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $map = mysql_query($sql, $cn);
	            $res = "1";
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();
			}
			return $res;
		}
 
		public function execProMap(){
			try {
				$res = "";
				$sql1 = "CALL GENERA_MAP_PROGRA";
				$sql2 = "CALL GENERA_MAP_UPDATE";
				$sql3 = "CALL GENERA_MAP_INSERT";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $map1 = mysql_query($sql1, $cn);
	            $map2 = mysql_query($sql2, $cn);
	            $map3 = mysql_query($sql3, $cn);
	            $res = "1";
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();
			}
			echo $res;
		}

		//Metodos para el Administrador - Gerente
		public function obtenerMapDistritoSuper(){
			try {
				$miArray= "";
				$sql = "SELECT distrito,count(*) as contador FROM map
						group by distrito";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $map = mysql_query($sql, $cn);
	            while ($rsMap = mysql_fetch_array($map)) {
	            	$miArray[] = array(
	            		'distrito' => $rsMap['distrito'],
	            		'contador' => $rsMap['contador']
					);
	            }
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();
			}
			return $miArray;
		}

		public function obtenerAsigDistritoSuper(MapBean $mapBean){
			try {
				$miArray= "";
				$sql = "SELECT idMap,solicitud,actividad,nombreContratista,
				        cliente,dirObra,distrito,rolLiquidador,tecnico,finReal,mes,ruta,
				        nombreContratista,roltecnico,
				        (case 
				        	when ruta is null then 0 
				        	when ruta is not null then 1 
				        end) as flgRuta
				        FROM map 
				        where distrito = '$mapBean->distrito' ";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $map = mysql_query($sql, $cn);
	            while ($rsMap = mysql_fetch_array($map)) {
	            	$miArray[] = array(
	            		'idMap' => $rsMap['idMap'],
	            		'solicitud' => $rsMap['solicitud'],
	            		'actividad' => $rsMap['actividad'],
	            		'nombreContratista' => $rsMap['nombreContratista'],
	            		'cliente' => $rsMap['cliente'],
	            		'dirObra' => $rsMap['dirObra'],
	            		'rolLiquidador' => $rsMap['rolLiquidador'],
	            		'distrito' => $rsMap['distrito'],
	            		'tecnico' => $rsMap['tecnico'],
	            		'finReal' => $rsMap['finReal'],
	            		'mes' => $rsMap['mes'],
	            		'ruta' => $rsMap['ruta'],
	            		'flgRuta' => $rsMap['flgRuta'],
	            		'nombreContratista' => $rsMap['nombreContratista'],
	            		'roltecnico' => $rsMap['roltecnico']
					);
	            }
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();	
			}
			return $miArray;
		}

		public function obtenerMapContratistaSuper(){
			try {
				$miArray= "";
				$sql = "SELECT DISTINCT nombreContratista,roltecnico,count(*) as contador from map 
						where roltecnico is not null and nombreContratista is not null
						group by nombreContratista";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $map = mysql_query($sql, $cn);
	            while ($rsMap = mysql_fetch_array($map)) {
	            	$miArray[] = array(
	            		'nombreContratista' => $rsMap['nombreContratista'],
	            		'roltecnico' => $rsMap['roltecnico'],
	            		'contador' => $rsMap['contador']
					);
	            }
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();
			}
			return $miArray;
		}

		public function obtenerAsigContratistaSuper(MapBean $mapBean){
			try {
				$miArray= "";
				$sql = "SELECT idMap,solicitud,actividad,nombreContratista,
						cliente,dirObra,distrito,rolLiquidador,tecnico,finReal,
						mes,ruta,nombreContratista,roltecnico,
						(case 
							when ruta is null then 0 
							when ruta is not null then 1 
						end) as flgRuta
						FROM map
						where nombreContratista = '$mapBean->contratista'";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $map = mysql_query($sql, $cn);
	            while ($rsMap = mysql_fetch_array($map)) {
	            	$miArray[] = array(
	            		'idMap' => $rsMap['idMap'],
	            		'solicitud' => $rsMap['solicitud'],
	            		'actividad' => $rsMap['actividad'],
	            		'nombreContratista' => $rsMap['nombreContratista'],
	            		'cliente' => $rsMap['cliente'],
	            		'dirObra' => $rsMap['dirObra'],
	            		'rolLiquidador' => $rsMap['rolLiquidador'],
	            		'distrito' => $rsMap['distrito'],
	            		'tecnico' => $rsMap['tecnico'],
	            		'finReal' => $rsMap['finReal'],
	            		'mes' => $rsMap['mes'],
	            		'ruta' => $rsMap['ruta'],
	            		'flgRuta' => $rsMap['flgRuta'],
	            		'nombreContratista' => $rsMap['nombreContratista'],
	            		'roltecnico' => $rsMap['roltecnico']
					);
	            }
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();
			}
			return $miArray;
		}
		
		public function obtenerAsignaciones(){
			try{
				$miArray= "";
				$sql = "SELECT `idMap`, `X`, `Y`, `solicitud`, `actividad`, `nombreContratista`, `cliente`, `dirObra`, 
						`distrito`, `rolLiquidador`, `tecnico`, `finReal`, `mes`, `ruta`, `roltecnico`, `estadoobra`, `plazo`, 
						`ultdevcon`, `atrazoliqtecsur`, `condicion`, `utlenvcont`, `descripcion`, `flgEstado`, `fechafin`, `fechaIni`,
						access_code
						FROM `map` ORDER BY idMap DESC limit 50";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
				$map = mysql_query($sql, $cn);
				while ($rsMap = mysql_fetch_array($map)) {
	            	$miArray[] = array(
	            		'idMap' => $rsMap['idMap'],
	            		'solicitud' => $rsMap['solicitud'],
	            		'actividad' => $rsMap['actividad'],
	            		'nombreContratista' => $rsMap['nombreContratista'],
	            		'cliente' => $rsMap['cliente'],
	            		'dirObra' => $rsMap['dirObra'],
	            		'rolLiquidador' => $rsMap['rolLiquidador'],
	            		'distrito' => $rsMap['distrito'],
	            		'tecnico' => $rsMap['tecnico'],
	            		'finReal' => $rsMap['finReal'],
	            		'mes' => $rsMap['mes'],
	            		'ruta' => $rsMap['ruta'],
	            		'nombreContratista' => $rsMap['nombreContratista'],
						'roltecnico' => $rsMap['roltecnico'],
						'fechafin' => $rsMap['fechafin'],
						'fechaIni' => $rsMap['fechaIni']
					);
				}		
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();
			}
			return $miArray;
		}

		public function obtenerAsignacionesByPage($offset){
			try{
				$miArray= "";
				$sql = "SELECT `idMap`, `X`, `Y`, `solicitud`, `actividad`, `nombreContratista`, `cliente`, `dirObra`, 
						`distrito`, `rolLiquidador`, `tecnico`, `finReal`, `mes`, `ruta`, `roltecnico`, `estadoobra`, `plazo`, 
						`ultdevcon`, `atrazoliqtecsur`, `condicion`, `utlenvcont`, `descripcion`, `flgEstado`, `fechafin`, `fechaIni`,
						access_code
						FROM `map` ORDER BY idMap DESC limit 50 OFFSET $offset";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
				$map = mysql_query($sql, $cn);
				while ($rsMap = mysql_fetch_array($map)) {
	            	$miArray[] = array(
	            		'idMap' => $rsMap['idMap'],
	            		'solicitud' => $rsMap['solicitud'],
	            		'actividad' => $rsMap['actividad'],
	            		'nombreContratista' => $rsMap['nombreContratista'],
	            		'cliente' => $rsMap['cliente'],
	            		'dirObra' => $rsMap['dirObra'],
	            		'rolLiquidador' => $rsMap['rolLiquidador'],
	            		'distrito' => $rsMap['distrito'],
	            		'tecnico' => $rsMap['tecnico'],
	            		'finReal' => $rsMap['finReal'],
	            		'mes' => $rsMap['mes'],
	            		'ruta' => $rsMap['ruta'],
	            		'nombreContratista' => $rsMap['nombreContratista'],
						'roltecnico' => $rsMap['roltecnico'],
						'fechafin' => $rsMap['fechafin'],
						'fechaIni' => $rsMap['fechaIni']
					);
				}		
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();
			}
			return $miArray;
		}

		public function obtenerAsignacionesPorCod(MapBean $mapBean){
			$miArray= array();
			try{
				$sql = "SELECT `idMap`, `X`, `Y`, `solicitud`, `actividad`, `nombreContratista`, `cliente`, `dirObra`, 
						`distrito`, `rolLiquidador`, `tecnico`, `finReal`, `mes`, `ruta`, `roltecnico`, `estadoobra`, `plazo`, 
						`ultdevcon`, `atrazoliqtecsur`, `condicion`, `utlenvcont`, `descripcion`, `flgEstado`, `fechafin`, `fechaIni`,
						access_code
						FROM `map` 
						WHERE solicitud like concat('%','$mapBean->solicitud','%')
						ORDER BY idMap DESC limit 50";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
				$map = mysql_query($sql, $cn);
				while ($rsMap = mysql_fetch_array($map)) {
	            	$miArray[] = array(
	            		'idMap' => $rsMap['idMap'],
	            		'solicitud' => $rsMap['solicitud'],
	            		'actividad' => $rsMap['actividad'],
	            		'nombreContratista' => $rsMap['nombreContratista'],
	            		'cliente' => $rsMap['cliente'],
	            		'dirObra' => $rsMap['dirObra'],
	            		'rolLiquidador' => $rsMap['rolLiquidador'],
	            		'distrito' => $rsMap['distrito'],
	            		'tecnico' => $rsMap['tecnico'],
	            		'finReal' => $rsMap['finReal'],
	            		'mes' => $rsMap['mes'],
	            		'ruta' => $rsMap['ruta'],
	            		'nombreContratista' => $rsMap['nombreContratista'],
						'roltecnico' => $rsMap['roltecnico'],
						'fechafin' => $rsMap['fechafin'],
						'fechaIni' => $rsMap['fechaIni']
					);
				}		
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();
			}
			return $miArray;
		}

		public function insertarSolicitud(MapBean $mapBean){
			$res = 0;
			try {
				$sql = "INSERT INTO map (X,Y,solicitud,actividad, 
						 nombreContratista,cliente,dirObra,distrito,estadoobra,
						 flgEstado,fechafin,fechaini,access_code,idUser)
						VALUES ('$mapBean->lng','$mapBean->lat','$mapBean->solicitud',
						        '$mapBean->actividad','$mapBean->nombreContratista',
						        '$mapBean->cliente','$mapBean->dirObra',
						        '$mapBean->distrito',0,0,'$mapBean->fechaFin',
								'$mapBean->fechaIni','$mapBean->access_code',
								'$mapBean->idUser')";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $map = mysql_query($sql, $cn);
	            $res = 1;
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();
			}
			return $res;
		}

		public function actualizarSolicitud(MapBean $mapBean){
			$res = 0;
			try {
				$sql = "UPDATE map set 
							X = '$mapBean->lng',
							Y = '$mapBean->lat',
							solicitud = '$mapBean->solicitud',
							actividad = '$mapBean->actividad',
							nombreContratista = '$mapBean->nombreContratista',
							cliente = '$mapBean->cliente',
							dirObra = '$mapBean->dirObra',
							distrito = '$mapBean->distrito',
							fechafin = '$mapBean->fechaFin',
							fechaini = '$mapBean->fechaIni',
							access_code = '$mapBean->access_code',
							idUser = '$mapBean->idUser'
						WHERE idMap = $mapBean->idMap";
				$conexion = new Conexion();
				$cn = $conexion->Conectarse();
	            $map = mysql_query($sql, $cn);
	            $res = 1;
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();
			}
			return $res;
		}

		public function eliminarSolicitud(MapBean $mapBean){
			$res = 0;
			try {
				$sql = "DELETE FROM map WHERE idMap = $mapBean->idMap";
				$conexion = new Conexion();
				$cn = $conexion->Conectarse();
	            $map = mysql_query($sql, $cn);
	            $res = 1;
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();
			}
			return $res;
		}

		public function actualizarRegistrosDes(MapBean $mapBean){
			try {
				$res = 0;
				$miArray= "";
				$sql = "UPDATE map set 
						descripcion = '$mapBean->descripcion',
						flgEstado = '$mapBean->flgEstado',
						fechaFin = now()
						WHERE idmap = '$mapBean->idMap' ";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $map = mysql_query($sql, $cn);
	            $res = 1;
			} catch (Exception $exc) {
				echo $exc->getTraceAsString();
			}
			return $res;
		}

		public function obtenerContPend(){
			try {
				$miArray= "";
				$sql = "select
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 1 and m.flgEstado = 1) as Enero,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 2 and m.flgEstado = 1) as Febrero,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 3 and m.flgEstado = 1) as Marzo,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 4 and m.flgEstado = 1) as Abril,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 5 and m.flgEstado = 1) as Mayo,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 6 and m.flgEstado = 1) as Junio,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 7 and m.flgEstado = 1) as Julio,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 8 and m.flgEstado = 1) as Agosto,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 9 and m.flgEstado = 1) as Setiembre,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 10 and m.flgEstado = 1) as Octubre,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 11 and m.flgEstado = 1) as Noviembre,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 12 and m.flgEstado = 1) as Diciembre";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $map = mysql_query($sql, $cn);
	            while ($rsMap = mysql_fetch_array($map)) {
	            	$miArray[] = array(
	            		'Enero' => $rsMap['Enero'],
	            		'Febrero' => $rsMap['Febrero'],
	            		'Marzo' => $rsMap['Marzo'],
	            		'Abril' => $rsMap['Abril'],
	            		'Mayo' => $rsMap['Mayo'],
	            		'Junio' => $rsMap['Junio'],
	            		'Julio' => $rsMap['Julio'],
	            		'Agosto' => $rsMap['Agosto'],
	            		'Setiembre' => $rsMap['Setiembre'],
	            		'Octubre' => $rsMap['Octubre'],
	            		'Noviembre' => $rsMap['Noviembre'],
	            		'Diciembre' => $rsMap['Diciembre'] 
					);
	            }
			} catch (Exception $e) {
				echo $exc->getTraceAsString();	
			}
			return $miArray;
		}

		public function obtenerContAct(){
			try {
				$miArray= "";
				$sql = "select
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 1 and m.flgEstado = 2) as Enero,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 2 and m.flgEstado = 2) as Febrero,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 3 and m.flgEstado = 2) as Marzo,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 4 and m.flgEstado = 2) as Abril,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 5 and m.flgEstado = 2) as Mayo,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 6 and m.flgEstado = 2) as Junio,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 7 and m.flgEstado = 2) as Julio,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 8 and m.flgEstado = 2) as Agosto,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 9 and m.flgEstado = 2) as Setiembre,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 10 and m.flgEstado = 2) as Octubre,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 11 and m.flgEstado = 2) as Noviembre,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 12 and m.flgEstado = 2) as Diciembre";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $map = mysql_query($sql, $cn);
	            while ($rsMap = mysql_fetch_array($map)) {
	            	$miArray[] = array(
	            		'Enero' => $rsMap['Enero'],
	            		'Febrero' => $rsMap['Febrero'],
	            		'Marzo' => $rsMap['Marzo'],
	            		'Abril' => $rsMap['Abril'],
	            		'Mayo' => $rsMap['Mayo'],
	            		'Junio' => $rsMap['Junio'],
	            		'Julio' => $rsMap['Julio'],
	            		'Agosto' => $rsMap['Agosto'],
	            		'Setiembre' => $rsMap['Setiembre'],
	            		'Octubre' => $rsMap['Octubre'],
	            		'Noviembre' => $rsMap['Noviembre'],
	            		'Diciembre' => $rsMap['Diciembre'] 
					);
	            }
			} catch (Exception $e) {
				echo $exc->getTraceAsString();	
			}
			return $miArray;
		}

		public function obtenerContFin(){
			try {
				$miArray= "";
				$sql = "select
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 1 and m.flgEstado = 3) as Enero,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 2 and m.flgEstado = 3) as Febrero,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 3 and m.flgEstado = 3) as Marzo,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 4 and m.flgEstado = 3) as Abril,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 5 and m.flgEstado = 3) as Mayo,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 6 and m.flgEstado = 3) as Junio,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 7 and m.flgEstado = 3) as Julio,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 8 and m.flgEstado = 3) as Agosto,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 9 and m.flgEstado = 3) as Setiembre,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 10 and m.flgEstado = 3) as Octubre,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 11 and m.flgEstado = 3) as Noviembre,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = 2016 and MONTH(m.fechafin) = 12 and m.flgEstado = 3) as Diciembre";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $map = mysql_query($sql, $cn);
	            while ($rsMap = mysql_fetch_array($map)) {
	            	$miArray[] = array(
	            		'Enero' => $rsMap['Enero'],
	            		'Febrero' => $rsMap['Febrero'],
	            		'Marzo' => $rsMap['Marzo'],
	            		'Abril' => $rsMap['Abril'],
	            		'Mayo' => $rsMap['Mayo'],
	            		'Junio' => $rsMap['Junio'],
	            		'Julio' => $rsMap['Julio'],
	            		'Agosto' => $rsMap['Agosto'],
	            		'Setiembre' => $rsMap['Setiembre'],
	            		'Octubre' => $rsMap['Octubre'],
	            		'Noviembre' => $rsMap['Noviembre'],
	            		'Diciembre' => $rsMap['Diciembre'] 
					);
	            }
			} catch (Exception $e) {
				echo $exc->getTraceAsString();	
			}
			return $miArray;
		}

		public function obtenerContador(MapBean $mapBean){
			try {
				$miArray= "";
				$sql = "select
						'PENDIENTES' as datad,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 1 and m.flgEstado = 1) as Enero,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 2 and m.flgEstado = 1) as Febrero,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 3 and m.flgEstado = 1) as Marzo,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 4 and m.flgEstado = 1) as Abril,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 5 and m.flgEstado = 1) as Mayo,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 6 and m.flgEstado = 1) as Junio,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 7 and m.flgEstado = 1) as Julio,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 8 and m.flgEstado = 1) as Agosto,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 9 and m.flgEstado = 1) as Setiembre,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 10 and m.flgEstado = 1) as Octubre,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 11 and m.flgEstado = 1) as Noviembre,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 12 and m.flgEstado = 1) as Diciembre
						union all
						select
						'ACTIVOS' as datad,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 1 and m.flgEstado = 2) as Enero,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 2 and m.flgEstado = 2) as Febrero,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 3 and m.flgEstado = 2) as Marzo,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 4 and m.flgEstado = 2) as Abril,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 5 and m.flgEstado = 2) as Mayo,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 6 and m.flgEstado = 2) as Junio,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 7 and m.flgEstado = 2) as Julio,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 8 and m.flgEstado = 2) as Agosto,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 9 and m.flgEstado = 2) as Setiembre,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 10 and m.flgEstado = 2) as Octubre,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 11 and m.flgEstado = 2) as Noviembre,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 12 and m.flgEstado = 2) as Diciembre
						union all
						select
						'TERMINADOS' as datad,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 1 and m.flgEstado = 3) as Enero,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 2 and m.flgEstado = 3) as Febrero,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 3 and m.flgEstado = 3) as Marzo,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 4 and m.flgEstado = 3) as Abril,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 5 and m.flgEstado = 3) as Mayo,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 6 and m.flgEstado = 3) as Junio,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 7 and m.flgEstado = 3) as Julio,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 8 and m.flgEstado = 3) as Agosto,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 9 and m.flgEstado = 3) as Setiembre,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 10 and m.flgEstado = 3) as Octubre,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 11 and m.flgEstado = 3) as Noviembre,
						(select IFNULL(count(m.flgestado),0) from map m 
							where m.fechafin is not null and year(m.fechafin) = '$mapBean->anio' and MONTH(m.fechafin) = 12 and m.flgEstado = 3) as Diciembre";
				$conexion = new Conexion();
	            $cn = $conexion->Conectarse();
	            $map = mysql_query($sql, $cn);
	            while ($rsMap = mysql_fetch_array($map)) {
	            	$miArray[] = array(
	            		'datad' => $rsMap['datad'],
	            		'Enero' => $rsMap['Enero'],
	            		'Febrero' => $rsMap['Febrero'],
	            		'Marzo' => $rsMap['Marzo'],
	            		'Abril' => $rsMap['Abril'],
	            		'Mayo' => $rsMap['Mayo'],
	            		'Junio' => $rsMap['Junio'],
	            		'Julio' => $rsMap['Julio'],
	            		'Agosto' => $rsMap['Agosto'],
	            		'Setiembre' => $rsMap['Setiembre'],
	            		'Octubre' => $rsMap['Octubre'],
	            		'Noviembre' => $rsMap['Noviembre'],
	            		'Diciembre' => $rsMap['Diciembre'] 
					);
	            }
			} catch (Exception $e) {
				echo $exc->getTraceAsString();		
			}
			return $miArray;
		}

	}

?>