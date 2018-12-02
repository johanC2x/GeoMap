<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" >
	<head>
		<?php
	        include_once '../../plantilla/style.php';
		?>
        <style type="text/css">
            .pac-container {
                z-index: 1054 !important;
            }
        </style>
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
                                    <button type="button" class="btn btn-primary" onclick="asignacion.buscarSolicitud();">Buscar</button>
                                    <button type="button"  class="btn btn-primary" onclick="asignacion.openModal();">Nuevo</button>
                                </form>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="col-md-12">
                <table id="tableMap" class='table table-striped table-bordered table-hover' style="background-color:white">
                    <thead>
                        <tr>
                            <th>
                                <center>
                                    Solicitud
                                </center>
                            </th>
                            <th>
                                <center>
                                    Cliente
                                </center>
                            </th>
                            <th>
                                <center>
                                    Contratista
                                </center>
                            </th>
                            <th>
                                <center>
                                    Actividad
                                </center>
                            </th>
                            <th>
                                <center>
                                    Dirección
                                </center>
                            </th>
                            <th colspan="2">
                                <center>
                                    Acciones
                                </center>
                            </th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <center>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="asignacion.loadTablePage('min');">Anterior</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="asignacion.loadTablePage('max');">Siguiente</a></li>
                        </ul>
                    </nav>
                </center>
            </div>
        </div>

        <!-- =========================================  MODAL GUARDAR MAPA ===================================== -->
        <div id="new_proyecto" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="overflow-y: scroll;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Nuevo Proyecto</h4>
                    </div>
                    <div class="modal-body pac-container">
                        <form id="frm_map" role="form" >
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Actividad</label>
                                            <input type="text" name="actividad_proyecto" id="actividad_proyecto" class="form-control"/>
                                            <input type="hidden" name="lat_proyecto" id="lat_proyecto"/>
                                            <input type="hidden" name="long_proyecto" id="long_proyecto"/>
                                            <input type="hidden" name="op" id="op" value="22"/>
                                            <input type="hidden" name="idMap" id="idMap"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Codigo</label>
                                            <input type="text" name="codigo_proyecto" id="codigo_proyecto" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Contratista</label>
                                            <input type="text" name="contratista_proyecto" id="contratista_proyecto" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Cliente</label>
                                            <input type="text" name="cliente_proyecto" id="cliente_proyecto" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Fecha Inicio</label>
                                            <input type="date" name="fecini_proyecto" id="fecini_proyecto" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Fecha Fin</label>
                                            <input type="date" name="fecfin_proyecto" id="fecfin_proyecto" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Dirección</label>
                                            <input type="text" name="direccion_proyecto" id="direccion_proyecto" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Distrito</label>
                                            <input type="text" name="distrito_proyecto" id="distrito_proyecto" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Obtener Acceso</label>
                                            <input type="text" name="access_proyecto" id="access_proyecto" class="form-control"/>
                                            <button id="btn_get_code" type="button" class="btn">
                                                Obtener Código
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Colaborador Asignado:</label>
                                            <select name="idUser" id="idUser" class="form-control">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <center>
                                        <div id="map_proyecto" style="width: 550px; height: 200px"></div>
                                    </center>
                                </div>
                            </div>
                        </form>
                        <br/>
                        <button id="btn_clean_map" type="button" class="btn" data-dismiss="modal">
                            Cerrar
                        </button>
                        <button id="btn_save_map" type="button" class="btn btn-primary">
                            Guardar
                        </button>
                        <div id="res_map"></div>
                    </div>
                </div> 
            </div>
        </div>
        <!-- ========================================= / MODAL GUARDAR MAPA ===================================== -->

    </div>
    <body>
        <?php
			include_once '../../plantilla/footer.php';
		?>
		<?php
			include_once '../../plantilla/script.php';
        ?>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDR9Dabu_CPuS75XJiGlctFScHrAnn1JlI&libraries=places"></script>
		<script type="text/javascript">
            $(document).ready(function(){
                obtenerTodosPerfil();

                if(document.getElementById("btn_save_map") !== undefined){
                    $("#btn_save_map").click(function(){
                        if($("#actividad_proyecto").val() === ''
                            ||  $("#codigo_proyecto").val() === ''
                                || $("#contratista_proyecto").val() === ''
                                    || $("#cliente_proyecto").val() === ''
                                        || $("#direccion_proyecto").val() === ''
                                            || $("#distrito_proyecto").val() === ''
                                                || $("#idUser").val() === ''){                            
                            var alert_map = obtenerAlert("Los campos actividad, codigo, contratista, cliente, dirección, distrito y colaborador son requeridos");
                            $("#res_map").html(alert_map);
                        }else{
                            asignacion.saveMap();
                        }
                    });
                }
                
                if(document.getElementById("btn_get_code") !== undefined){
                    $("#btn_get_code").click(function(){
                        $("#access_proyecto").val(Math.floor((Math.random() * 10000000000) + 1));
                    });
                }

                asignacion.initMap();
                google.maps.event.addDomListener(window, 'load', asignacion.loadAutocomplete());
                asignacion.loadTable();
                asignacion.loadUser();
            });
        </script>
	</body>
</html>