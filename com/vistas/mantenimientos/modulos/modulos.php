<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" >
	<head>
		<?php
	        include_once '../../plantilla/style.php';
		?>
		<?php
	        include_once '../../plantilla/nav.php';
		?>
	</head>
	<body>
		<div class="container">
	    	<div class="row">
				<div class="col-md-12">
					<div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" class="pointer">
                                        Buscar Usuario
                                    </a><i class="indicator glyphicon glyphicon-chevron-down  pull-right"></i>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <form class="form-inline" role="form">
                                        <div class="form-group" style="padding:5px;">
                                            <label for="text">Filtros: </label>
                                            <input type="text" class="form-control" id="txtNomPerfil" 
                                            	   style="width:350px;" placeholder="Ingresar Perfil">
                                        </div>
                                         <div class="form-group" style="padding:5px;"> 
                                           	<input id="ckStatus" type="checkbox" 
                                           	checked data-off-class="btn-primary" data-on-class="btn-primary"> 
                                        </div>  
                                        <button type="button" class="btn btn-primary" onclick="buscarPerfilModulo()">Buscar</button>
                                        <button type="button"  class="btn btn-primary" onclick="openModalPerfil()"
                                                data-toggle="modal" data-target="#new_Perfil">Nuevo</button>
                                    </form>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div id="msgPerfil"></div>
                    <br/>
                    <div id="tablePerfil"></div>

                    <!-- Modal -->
                    <div id="new_Perfil" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Nuevo Perfil</h4>
                                </div>
                                <div class="modal-body">
                                    <form role="form" >
                                        <div class="form-group">
                                            <label>Datos del Perfil: </label>
                                            <br/>
                                            <table>
                                                <tr>
                                                    <td style="width: 450px;padding-right: 5px;" >
                                                       <input type="text" class="form-control" id="txtNNomPerfil" 
                                                   placeholder="Ingresar Perfil"/> 
                                                    </td>
                                                    <td style="width: 120px;" >
                                                        <input id="ckNStatus" type="checkbox" 
                                           	checked data-off-class="btn-primary" data-on-class="btn-primary"> 
                                                    </td>
                                                </tr>
                                            </table>  
                                        </div> 
                                        <center>
                                            <button type="button" class="btn btn-primary" onclick="agregarPerfil()" >Grabar</button> 
                                            <button type="button" class="btn btn-primary" onclick="limpiarPerfil()" >Limpiar</button> 
                                        </center>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <left>
                                        <div id="responseCreatePer" ></div>
                                    </left>
                                </div>
                            </div> 
                        </div>
                    </div>

                    <div id="modal">
                        <p style="display:none;"></p>
                    </div>

				</div>
			</div>
		</div>
		<?php
			include_once '../../plantilla/footer.php';
		?>
		<?php
			include_once '../../plantilla/script.php';
		?>
		<script type="text/javascript">
			$(':checkbox').checkboxpicker();
		</script>
		<script type="text/javascript">
			obtenerTodosPerfil();
		</script>
	</body>
</html>