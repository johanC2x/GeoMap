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
				<b>JS-XLSX (XLSX/XLSB/XLSM/XLS/XML) Live Demo</b><br />
				Output Format:
				<select name="format">
					<option value="csv" selected> CSV</option>
					<option value="json"> JSON</option>
					<option value="form"> FORMULAE</option>
				</select>
				<br />
				<div id="drop">Drop an XLSX / XLSM / XLSB / ODS / XLS / XML file here to see sheet data</div>
				<p><input type="file" name="xlfile" id="xlf" /> ... or click here to select a file</p>
				<textarea id="b64data">... or paste a base64-encoding here</textarea>
				<input type="button" id="dotext" value="Click here to process the base64 text" onclick="b64it();"/><br />
				Advanced Demo Options: <br />
				Use Web Workers: (when available) <input type="checkbox" name="useworker" checked><br />
				Use Transferrables: (when available) <input type="checkbox" name="xferable" checked><br />
				Use readAsBinaryString: (when available) <input type="checkbox" name="userabs" checked><br />
				<pre id="out"></pre>
			</div>
		</div>
	-->
	    <div class="row">
			<div class="col-md-12">
				<div id="output"></div>
					<br/>
				<div id="tableRecep"></div>
					<br/>
				<div id="msg"></div>
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