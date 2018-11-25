<?php  
	session_start();
	require_once '../bean/UsuarioBean.php';
	require_once '../bean/PersonaBean.php';
	require_once '../dao/UsuarioDAO.php';
	require_once '../dao/PersonaDAO.php';

	$usuarioBean = new UsuarioBean();
	$usuarioDAO = new UsuarioDAO();
	$personaBean = new PersonaBean();
	$personaDAO = new PersonaDAO();

	$op = $_POST["op"];
	switch ($op) {
		case 0:
			session_destroy();
			echo 1;
			break;
		case 1:
			$username = $_POST["username"];
			$password = $_POST["password"];
			$usuarioBean->setUsuario($username);
			$usuarioBean->setPassw($password);
			$listaUsuario = $usuarioDAO->validarUsuario($usuarioBean);
			if (sizeof($listaUsuario) > 0 && !empty($listaUsuario)) {
	            foreach ($listaUsuario as $user) {
	                $_SESSION['idusuario'] = $user['idusuario'];
	                $_SESSION['usuario'] = $user['usuario'];
	                $_SESSION['idpersona'] = $user['idpersona'];
	                $_SESSION['descripcion'] = $user['descripcion'];
				}
	        }
			echo json_encode($listaUsuario);
			break;
		case 2:
			$listaUsuario = $usuarioDAO->obtenerUSuario();
			echo json_encode($listaUsuario);
			break;
		case 3:
			$txtNUser = $_POST["txtNUser"];
	        $txtNPass = $_POST["txtNPass"];
	        $txtNNom = $_POST["txtNNom"];
	        $txtNApePat = $_POST["txtNApePat"];
	        $txtNApeMat = $_POST["txtNApeMat"];
	        $txtNEdad = $_POST["txtNEdad"];
	        $txtNDoc = $_POST["txtNDoc"];
	        $txtIdDocumento = $_POST["txtIdDocumento"];
	        $txtIdSexo = $_POST["txtIdSexo"];

	        /* Insertando Persona */
	        $personaBean->setNombre($txtNNom);
	        $personaBean->setApePat($txtNApePat);
	        $personaBean->setApeMat($txtNApeMat);
	        $personaBean->setEdad($txtNEdad);
	        $personaBean->setNroDoc($txtNDoc);
	        $personaBean->setIdTipoDoc($txtIdDocumento);
	        $personaBean->setSexo($txtIdSexo);
	        $resPer = $personaDAO->insertarPersona($personaBean);

	        /* Insertando Usuario */
	        $idPersona = $personaDAO->obtenerMaxId();
	        $usuarioBean->setUsuario($txtNUser);
	        $usuarioBean->setPassw($txtNPass);
	        $usuarioBean->setIdPersona($idPersona);
	        $resUsu = $usuarioDAO->insertarUsuario($usuarioBean);

	        /* Respuesta */
	        $res = intval($resUsu) + intval($resPer);
        	echo $res;
			break;
		case 4:
			$idusuario = $_POST["idusuario"];
	        $usuarioBean->setIdUsuario($idusuario);
	        $idPerUsu = $usuarioDAO->obtenerIdPersonaUsu($usuarioBean);
	        $personaBean->setIdPersona($idPerUsu);
	        $resPersona = $personaDAO->eliminarPersona($personaBean);
	        $resUsuario = $usuarioDAO->eliminarUsuario($usuarioBean);
	        $res = intval($resUsuario) + intval($resPersona);
	        echo $res;
			break;
		case 5:
			$idUsuario = $_POST["idUsuario"];
	        $txtNUser = $_POST["txtNUser"];
	        $txtNPass = $_POST["txtNPass"];
	        $txtNNom = $_POST["txtNNom"];
	        $txtNApePat = $_POST["txtNApePat"];
	        $txtNApeMat = $_POST["txtNApeMat"];
	        $txtNEdad = $_POST["txtNEdad"];
	        $txtNDoc = $_POST["txtNDoc"];
	        $txtIdDocumento = $_POST["txtIdDocumento"];
	        $txtIdSexo = $_POST["txtIdSexo"];

	        $usuarioBean->setUsuario($txtNUser);
	        $usuarioBean->setPassw($txtNPass);
	        $usuarioBean->setIdUsuario($idUsuario);
	        $varUsuario = $usuarioDAO->modificarUsuario($usuarioBean);
	        $idPerUsu = $usuarioDAO->obtenerIdPersonaUsu($usuarioBean);

	        $personaBean->setNombre($txtNNom);
	        $personaBean->setApePat($txtNApePat);
	        $personaBean->setApeMat($txtNApeMat);
	        $personaBean->setEdad($txtNEdad);
	        $personaBean->setIdTipoDoc($txtNDoc);
	        $personaBean->setIdTipoDoc($txtIdDocumento);
	        $personaBean->setNroDoc($txtNDoc);
	        $personaBean->setSexo($txtIdSexo);
	        $personaBean->setIdPersona($idPerUsu);
	        $varPersona = $personaDAO->modificarPersona($personaBean);
	        $res = intval($varUsuario) + intval($varPersona);
	        echo $res;
	        break;
		 case 6:
	        $idusuario = $_POST["idusuario"];
	        $usuarioBean->setIdUsuario($idusuario);
	        $listaUsuario = $usuarioDAO->obtenerPorId($usuarioBean);
	        echo json_encode($listaUsuario);
	        break;
        case 7:
        	$txtNomUsu = $_POST["txtNomUsu"];
	        $txtNom = $_POST["txtNom"];
	        $apePat = $_POST["apePat"];
	        $apeMat = $_POST["apeMat"];

	        //Instancia de Persona
	        $personaBean = new PersonaBean();
	        $personaBean->setNombre($txtNom);
	        $personaBean->setApePat($apePat);
	        $personaBean->setApeMat($apeMat);

	        //Instancia de Usuario
	        $usuarioBean = new UsuarioBean();
	        $usuarioBean->setUsuario($txtNomUsu);
	       
	        $listaUsuario = $usuarioDAO->filtrarUsuario($personaBean, $usuarioBean);
        	echo json_encode($listaUsuario);
			break;
		case 8:
			$listaUsuario = $usuarioDAO->obtenerPorPerfil();
			echo json_encode($listaUsuario);
			break;
		case 9:
			$response = array();
			if(isset($_SESSION["usuario"])){
				$username = $_SESSION["usuario"];
				$access_code = $_POST["access_code"];
				$usuarioBean->setUsuario($username);
				$response = $usuarioDAO->validarUsuarioAccess($usuarioBean,$access_code);
			}
			echo json_encode($response);
			break;
	}

?>