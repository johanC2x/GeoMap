<?php 

	session_start();
	require_once '../bean/ModuloBean.php';
	require_once '../dao/ModuloDAO.php';

	$moduloBean = new ModuloBean();
	$moduloDAO = new ModuloDAO();

	$op = $_POST["op"];

	switch ($op) {
		case 1:
			$usuario = $_POST["usuario"];
			$listaModuloPadre = $moduloDAO->obtenerModulosPadres($usuario);
			$menu = "";
			foreach ($listaModuloPadre as $padre) {
				$menu .= '<li id="'.$padre["objeto"].'" class="dropdown"><a href="'.$padre["recurso"].'">';
					$menu .= $padre["icono"].'<span>'.$padre["objeto"].'</span></a>';
						$listaMenuHijo = $moduloDAO->obtenerModulosHijos($usuario,$padre['idmodulo']);
						if(sizeof($listaMenuHijo) != 0){
							$menu .= '<ul class="dropdown-menu navbar-right">';
								foreach ($listaMenuHijo as $hijo) {
									$menu .= '<li><a href="'.$hijo["recurso"].'">'.$hijo["objeto"].'</a></li>';
								}
							$menu .= '</ul>';
						}
				$menu .= '</li>';
			}
			echo $menu;
			break;	
	}

?>