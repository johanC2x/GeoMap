<?php
  session_start();
  $idusuario = $_SESSION['idusuario'];
  $usuario = $_SESSION['usuario'];
  $idpersona = $_SESSION['idpersona'];
  $codigo = $_SESSION['descripcion'];
?>
<!--
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li class="active dropdown"><a href="../../mantenimientos/welcome/admin.php">
          <i class="fa fa-tachometer"></i><span>Dashboard</span></a> 
        </li>
        <li class="dropdown"><a href="../../mantenimientos/map/gmap.php">
          <i class="fa fa-globe"></i><span>Mapa</span></a> 
        </li>
        <li class="dropdown"><a href="../../mantenimientos/xlsx/recepcion.php">
          <i class="fa fa-list-alt"></i><span>Reporte</span></a>
        </li>
        <li class="dropdown"><a href="../../mantenimientos/usuario/usuarios.php">
          <i class="fa fa-users"></i><span>Usuarios</span></a> 
        </li>
        <li class="dropdown"><a href="../../mantenimientos/modulos/modulos.php">
          <i class="fa fa-sitemap"></i><span>Módulos</span></a> 
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right"> 
        <li class="dropdown" ><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-cogs"></i><span>Configuración</span><b class="caret"></b></a>
            <ul class="dropdown-menu navbar-right">
              <li><a href="#">Configuración</a></li>
              <li><a href="#" onclick="cerrarSesion()" >Cerrar Sesión</a></li>
            </ul>
        </li>
        <li class="dropdown" ><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-user"></i><span style="color:red;"><b><?php echo $usuario; ?></b></span> 
            <b class="caret"></b></a>    
        </li>
      </ul>  
    </div>
  </div>
</div>
-->
<div id="menu"></div>