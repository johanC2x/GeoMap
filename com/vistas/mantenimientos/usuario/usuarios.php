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
                                            <input type="text" class="form-control" id="txtNomUsu" placeholder="Ingresar Usuario">
                                        </div> 
                                        <div class="form-group" style="padding:5px;"> 
                                            <input type="text" class="form-control" id="txtNom" placeholder="Nombres">
                                        </div>  
                                        <div class="form-group" style="padding:5px;"> 
                                            <input type="text" class="form-control" id="txtApePat" placeholder="Apellido Paterno">
                                        </div>  
                                        <div class="form-group" style="padding:5px;"> 
                                            <input type="text" class="form-control" id="txtApeMat" placeholder="Apellido Materno">
                                        </div>  
                                        <button type="button" class="btn btn-primary"
                                                onclick="filtrarUsuario()">Buscar</button>
                                        <button type="button"  class="btn btn-primary" onclick="openModalUsuario()"
                                                data-toggle="modal" data-target="#new_Usuario">Nuevo</button>
                                    </form>        
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div id="response"></div>
                    <br/>
					<div id="tableUsuario" ></div> 
					
					<!-- Modal -->
                    <div id="new_Usuario" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Nuevo Usuario</h4>
                                </div>
                                <div class="modal-body">
                                    <form role="form" >
                                        <div class="form-group">
                                            <label>Usuario y Contraseña: </label>
                                            <input type="text" class="form-control" id="txtNUser" 
                                                   placeholder="Ingresar usuario" />
                                            <br/>
                                            <table>
                                                <tr>
                                                    <td style="width: 250px;padding-right: 5px;" >
                                                        <input type="password" class="form-control" id="txtNPass" 
                                                               placeholder="Ingresar contraseña" />
                                                    </td>
                                                    <td style="width: 320px;" >
                                                        <input type="password" class="form-control" id="txtNRPass" 
                                                               placeholder="Ingresar nuevamente contraseña" onchange="validarContraseña()" />
                                                    </td>
                                                </tr>
                                            </table>  
                                        </div>  
                                        <div class="form-group">
                                            <label>Datos Personales: </label>
                                            <input type="text" class="form-control" id="txtNNom" 
                                                   placeholder="Ingresar nombres"/> 
                                            <br/>
                                            <table>
                                                <tr>
                                                    <td style="width: 250px;padding-right: 5px;" >
                                                        <input type="text" class="form-control" id="txtNApePat" 
                                                               placeholder="Ingresar apellido paterno"/>
                                                    </td>
                                                    <td style="width: 320px;" >
                                                        <input type="text" class="form-control" id="txtNApeMat" 
                                                               placeholder="Ingresar apellido materno"/>
                                                    </td>
                                                </tr>
                                            </table>  
                                            <br/>
                                            <table>
                                                <tr>
                                                    <td style="width: 250px;padding-right: 5px;" > 
                                                        <input type="text" class="form-control" id="txtNEdad" 
                                                               placeholder="Ingresar edad"/>
                                                    </td>
                                                    <td style="width: 320px;" >
                                                        <div id="tipoSexo" ></div>
                                                    </td>
                                                </tr>
                                            </table> 
                                            <br/>
                                            <table>
                                                <tr>
                                                    <td style="width: 250px;padding-right: 5px;" > 
                                                        <div id="documento"></div>
                                                    </td>
                                                    <td style="width: 320px;" >
                                                        <input type="text" class="form-control" id="txtNDoc" 
                                                               placeholder="Ingresar Nro. Documento"/>
                                                    </td> 
                                                </tr> 
                                            </table> 
                                        </div> 
                                        <center>
                                            <button type="button" class="btn btn-primary" onclick="insertUsuario()" >Grabar</button> 
                                            <button type="button" class="btn btn-primary" onclick="limpiarUsuario()" >Limpiar</button> 
                                        </center>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <left>
                                        <div id="responseCreate" ></div>
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
			obtenerUsuario();
			obtenerTipoSexo();
            obtenerTipoDocumento();
		</script>
	</body>
</html>