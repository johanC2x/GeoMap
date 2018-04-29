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
				<form enctype="multipart/form-data" id="formuploadajax" method="post">
			        <input type="file" name="xlfile" id="xlsx"/> ... o hacer click para seleccionar el archivo
			    	<input type="button" value="Subir" onclick="subirExcelDatos()">
			    </form>
			</div>
		</div>
	-->
	    <div class="row">
			<div class="col-md-12">
			<!--
				<div id="output"></div>
				<br/>
			-->
				<form>	
					<input type="button" value="Actualizar Registros" class="btn btn-primary" onclick="actualizarMapXlsx()" >
				</form>	
				<br/>
				<div id="tableRecep"></div>
			</div>
		</div>
	</div>
<?php
	include_once '../../plantilla/footer.php';
?>
<?php
	include_once '../../plantilla/script.php';
?>
<script type="text/javascript" src="xlsx.js"></script>
<script type="text/javascript" src="jszip.js"></script>
<script type="text/javascript">
	loadFile();
</script>
<script type="text/javascript">
	obtenerTodos("tableRecep");
</script>
</body>
</html>