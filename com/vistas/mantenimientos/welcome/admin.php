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
	    <!--
	    <div class="row">
			<div class="col-md-12">
				<img class="media-object" src="http://placehold.it/1150x550&text=Panel de Control">
			</div>
		</div>
		-->
		<div class="row">
			<div class="col-md-12">
				<div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" class="pointer">
                                    Buscar Número de Estados de Solicitudes
                                </a><i class="indicator glyphicon glyphicon-chevron-down  pull-right"></i>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <form class="form-inline" role="form">
                                    <div class="form-group" style="padding:5px;">
                                        <label for="text">Filtros: </label>
                                        <select id="cboAnioGraf" class="form-control" style="width:200px;"></select>
                                    </div>   
                                    <button type="button" class="btn btn-primary"
                                            onclick="filtrarGrafica()">Buscar</button> 
									<button id="btnExportHistorial" type="button" class="btn btn-primary" >Exportar Excel</button>                                       
									<!--<button id="btnExportHistorial" type="button" class="btn btn-primary" onclick="obtenerPDF()" >Exportar PDF</button>-->
                                </form>        
                            </div>
                        </div>
                    </div> 
                </div>
                <br/>
				<div id="tableMap"></div>
			</div>
		</div>
		<br/>
		<div class="row">   
		<!-- /widget -->
			<div class="widget">
				<div class="widget-header">
                	<i class="fa fa-bar-chart" aria-hidden="true"></i><h3>GRAFICA DE ESTADO DE ASIGNACIONES</h3>
            	</div> 
			    <div class="widget-content">
			    	<center>
			    		<canvas id="bar-chart" class="chart-holder" width="538" height="250"></canvas>
			    	</center>
			    </div>
			</div> 
	    <!-- /widget -->
		</div>
	</div>
	<br/>
</body>
<?php
	include_once '../../plantilla/footer.php';
?>
<?php
	include_once '../../plantilla/script.php';
?>
<script type="text/javascript">
	initGrafica();
	obtenerTableGrafica();
	obtenerGrafica();
</script>
<script type="text/javascript">
    $("#btnExportHistorial").click(function(e) {
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#tableMap').html()));
        e.preventDefault();
    });
</script>
</body>
</html>