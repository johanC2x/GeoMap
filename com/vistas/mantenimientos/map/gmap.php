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
<body onunload="GUnload()"> 
<div class="container">
    <div class="row">
		<div class="col-md-12"> 
             
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-8">
				<center>
					<div id="map_canvas" style="width: 750px; height: 500px"></div>
					<br/>
					<div id="response"></div>
				</center>
				<div id="dvDescr" class="col-md-12" style="display:none;"> 
					<div class="well">
						<form role="form" class="form-inline" > 
							R: Pendiente / A: Ejecución / V: Terminada &nbsp;&nbsp;
							<i class="fa fa-arrow-circle-right" style='color:red;padding-right:10px;'></i>
							<span id="imgBandera"></span> &nbsp;&nbsp;
							<a href="#" onclick = "obtenerDetallesMapa()" > Ver Detalles </a>
						</form> 
					</div>
				</div>
				<br/>
				<div>
					<input type="hidden" id="query">
				</div>
			</div>
			<div class="col-md-4">
				<div>
					<div class="panel-group" id="accordion">
			    		<div class="panel panel-default">
					        <div class="panel-heading">
					            <h4 class="panel-title">
					                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" class="pointer">
					                    Buscar Dirección
					                </a><i class="indicator glyphicon glyphicon-chevron-down  pull-right"></i>
					            </h4>
					        </div>
					        <div id="collapseOne" class="panel-collapse collapse in">
					            <div class="panel-body">
					                <form class="form-inline" role="form" action="#" onsubmit="showAddress(this.codsol.value); return false">
								      	<input type="text" class="form-control" style="width:150px;" id="codsol" name="codsol" placeholder="Ingresar Codigo" onchange="validarSolicitud()" />
								        <input type="submit" value="Buscar" class="btn btn-primary"  />
								        <input type="button" onclick="limpiarFiltro()" value="Limpiar" class="btn btn-primary" />
					                </form>        
					            </div>
					        </div>
					    </div> 
					</div>
				</div> 
				<div id="resMap"></div>
				<p style="font-medium">
					<i class="fa fa-arrow-circle-right" style='color:red;padding-right:10px;'></i>
						<b>Buscar por:</b>
				</p>
				<form role="form" >
					<label class="checkbox-inline"><input id="ck1" type="checkbox" value="1" onchange='filtrarMapSupervisor()'>
						Supervisor
					</label>
					<label class="checkbox-inline"><input id="ck2" type="checkbox" value="2" onchange='filtrarMapContratista()'>
						Contratista
					</label>
					<label class="checkbox-inline"><input id="ck3" type="checkbox" value="3" onchange='filtrarMapDistrito()'>
						Distrito
					</label>
				</form>
				<div id="tableDistrito"></div>
			</div>
		</div>
	</div> 
	
	<div id="modal">
		<p style="display:none;"></p>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="modalDescr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Ingresar Descripciones</h4>
	      </div>
	      <div class="modal-body"> 
      		<form role="form"> 
				<label>Estado: </label>
				<label class="checkbox-inline"><input id="sk1" type="checkbox" value="1" onchange="obtenerDesMap1()" >
					Pendiente
				</label>
				<label class="checkbox-inline"><input id="sk2" type="checkbox" value="2" onchange="obtenerDesMap2()">
					Ejecución
				</label>
				<label class="checkbox-inline"><input id="sk3" type="checkbox" value="3" onchange="obtenerDesMap3()">
					Terminada
				</label>
				<br/>
				<textarea id="txtArDescr" class="form-control" ></textarea>
				<br/>
				<input type="button" value="Grabar" onclick="grabarDescrMap()" class="btn btn-primary" >
			</form> 
	      </div>
	      <div class="modal-footer">
	      	<div id="responseCreateDes"></div>
	      </div>
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
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=AIzaSyDR9Dabu_CPuS75XJiGlctFScHrAnn1JlI&libraries=places" type="text/javascript"></script>
<script type="text/javascript" >
	initialize();
	obtenerDistrito("cboDistrito");
	obtenerMapaDistrito("tableDistrito",<?php echo "'".$codigo."'"; ?>);
</script> 

</body>
</html>