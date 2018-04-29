/* Tipo Documento */
function obtenerTipoDocumento() {
	var op = 1;
	$.ajax({
		type:"POST",
		data:{
			op:op
		},
		url:"../../../controller/CodigoController.php",
		success:function(msg){
			console.log(msg);
			var documento = JSON.parse(msg);
            if (documento.length != 0) {
                var html = "";
                html += "<select id='txtIdDocumento' class='form-control' >";
                html += "<option value='0' >Seleccionar Tipo Documento</option>";
                for (var i = 0; i < documento.length; i++) {
                    html += "<option value=" + documento[i].idcodigo + ">" + documento[i].codigo + "</option>";
                }
                html += "</select>";
                $("#documento").html(html);
            }
		}
	});
}

/* Tipo Sexo */
function obtenerTipoSexo() {
	var op = 2;
	$.ajax({
		type:"POST",
		data:{
			op:op
		},
		url:"../../../controller/CodigoController.php",
		success:function(msg){
			console.log(msg);
			var sexo = JSON.parse(msg);
            if (documento.length != 0) {
                var html = "";
                html += "<select id='txtIdSexo' class='form-control' >";
                html += "<option value='0' >Seleccionar Sexo</option>";
                for (var i = 0; i < sexo.length; i++) {
                    html += "<option value=" + sexo[i].idcodigo + ">" + sexo[i].codigo + "</option>";
                }
                html += "</select>";
                $("#tipoSexo").html(html);
            }
		}
	});
}
