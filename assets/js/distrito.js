function obtenerDistrito(objDistrito) {
	var op = 1;
	$.ajax({ 
		type:"POST",
		data:{
			op:op
		},
		url:"../../../controller/DistritoController.php",
		success:function(msg){
			var distrito = JSON.parse(msg);
            var html = "";
            var cboFacultad = $("#"+objDistrito);
            if(distrito != 0){  
                html += '<option value="0">Seleccionar Distrito</option>';
                for(var i = 0;i<distrito.length;i++){
                    html += '<option value="'+ distrito[i].iddistrito +'" >'+ distrito[i].nombre +'</option>';
                }
                cboFacultad.html(html).selectpicker('refresh');
            }
		}
	});
}