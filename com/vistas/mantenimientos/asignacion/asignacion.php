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

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" class="pointer">
                                    Registrar Proyecto
                                </a><i class="indicator glyphicon glyphicon-chevron-down  pull-right"></i>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <form class="form-inline" role="form">
                                    <div class="form-group" style="padding:5px;">
                                        <label for="text">Filtros: </label>
                                        <input type="text" class="form-control" id="cod_proyecto" style="width:350px;" placeholder="Ingresar Codigo">
                                    </div>
                                    <button type="button" class="btn btn-primary" onclick="buscarPerfilModulo()">Buscar</button>
                                    <button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#new_proyecto">Nuevo</button>
                                </form>
                            </div>
                        </div>
                    </div> 
                </div>


                <!-- Modal -->
                <div id="new_proyecto" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Nuevo Proyecto</h4>
                            </div>
                            <div class="modal-body">
                                <form role="form" >
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Proyecto</label>
                                                    <input type="text" name="nombre_proyecto" id="nombre_proyecto" class="form-control"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Codigo</label>
                                                    <input type="text" name="codigo_proyecto" id="codigo_proyecto" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        
                                    </div>
                                </form>
                            </div>
                            <br/><br/><br/>
                            <div class="modal-footer">

                            </div>
                        </div> 
                    </div>
                </div>


            </div>
        </div>
    </div>
    <body>
        <?php
			include_once '../../plantilla/footer.php';
		?>
		<?php
			include_once '../../plantilla/script.php';
		?>
		<script type="text/javascript">
			obtenerTodosPerfil();
		</script>
	</body>
</html>