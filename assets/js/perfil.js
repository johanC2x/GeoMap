
var estadoPerfil = 0;
var resElimina = 0;

function obtenerTodosPerfil(){
	var op = 1;
	var html = "";
	$.ajax({
		type:"POST",
		data:{
			op:op
		},
		url:"../../../controller/PerfilController.php",
		success:function(msg){
			console.log(msg);
			var perfil = JSON.parse(msg);
			if(perfil.length != 0){
				html += '<table id="myTable" class="table table-striped table-bordered table-hover" style="background-color:white">';
	                html += '<thead>';
		                html += '<tr>';
			                html += '<th>Perfil</th>';
			                html += '<th>Estado</th>';
			                html += "<th colspan='3' class='textCenter' style='width:50px;'><center>Acciones</center></th>";
		                html += '</tr>';
	                html += '</thead>';
	            html += '<tbody class="bodyTable">';
                for(var i=0;i<perfil.length;i++){
                	html += '<tr>';
                		html += '<td>' + perfil[i].nombre + '</td>';
		                html += '<td>' + perfil[i].datoEstado + '</td>';
		                html += '<td><center><a href="#" data-toggle="tooltip" title="Editar" onclick="obtenerPerfilId(' + perfil[i].idperfil + ')" ><img src="../../../../assets/img/edit.gif" style="width:15px;"></a></center></td>';
	                    html += '<td><center><a href="#" data-toggle="tooltip" title="Eliminar" onclick="eliminarPerfil(' + perfil[i].idperfil + ')" ><img src="../../../../assets/img/cancelar.png" style="width:15px;"></a></center></td>';
	                    html += '<td><center><a href="#" data-toggle="tooltip" title="Asignar Modulo" onclick="obtenerPerfilModulo(' + perfil[i].idperfil + ',1)" ><i class="fa fa-sitemap"></i></a></center></td>';
                	html += '</tr>';
                }
                html += '</tbody>';
                html += '</table>';
                $("#tablePerfil").html(html);
                $('#tablePerfil').paging({limit:10});
			}
		}
	});
}

function asignarPerfil(idUsuario,val) {
	var op = 2;
	var html = "";
	var obj = "new_Perfil";
	var title = "Asignar Perfil";
	$.ajax({
		type:"POST",
		data:{
			op:op,
			idUsuario:idUsuario
		},
		url:"../../../controller/PerfilController.php",
		success:function(msg){
			var perfil = JSON.parse(msg);
			if(perfil.length != 0){
				html += '<div id="modPerfil">';
					html += '<form>';
		                html += '<select id="val" multiple="multiple">';
						for(var i=0;i<perfil.length;i++){
							html += "<option value=" + perfil[i].idperfil + " " + perfil[i].selected + ">" + perfil[i].nombre + "</option>";
						}
						html += '</select>';
		                html += '<br/>';
		                html += '<button type="button" class="btn btn-primary btn-block" onclick="actualizarAsignacionPerfil('+idUsuario+')" >Asignar</button>';
	            	html += '</form>';
            	html += '</div>';
			}else{
				if(perfil.length == 0){
					html = obtenerAlert("Ha ocurrido un Error");
				}
			}
			if(val == 1){
				crearModal(html,obj,title);
			}else{
				$("#val").bootstrapDualListbox('refresh');
			}
			$("#val").bootstrapDualListbox();
		}
	});
}

function actualizarAsignacionPerfil(idUsuario){
	var list = "";
    var respuesta = "";
    var errorInsert = "";
    var resp = 0;
    $("#val").bootstrapDualListbox();
    var i = $('#val > option:selected').length; 
    var array = []; 
    array.push($("#val").bootstrapDualListbox().val());
    list = array[0]; 
    if(list == null){
    	resElimina = eliminarPerfilUSuario(idUsuario);
    	console.log(resElimina);
    	if(!isNaN(resElimina)){
    		asignarPerfil(idUsuario,2);
    		errorInsert = obtenerAlert("Operación realizada con éxito");
        	$("#responseCreate").html(errorInsert);
    	}else{
    		var error = obtenerAlert("Se ha producido un error");
        	$("#responseCreate").html(error);
    	}
    }else{
        var lista = list.toString().split(",");
        resElimina = eliminarPerfilUSuario(idUsuario);
        console.log(isNaN(resElimina));
        if(!isNaN(resElimina)){
        	for (var j = 0; j < lista.length; j++) {
	            console.log(parseInt(lista[j]) + "id listo");
	            resp = insertarPerfilUsuario(parseInt(lista[j]),idUsuario);
	        }
	        if(isNaN(resp)){
        		asignarPerfil(idUsuario,2);
	        }
        }else{
        	if(isNaN(resElimina)){
        		var errorInsert = obtenerAlert("Se ha producido un error");
        		$("#responseCreate").html(errorInsert);
        	}
        }
    }
}

function eliminarPerfilUSuario(idUsuario){
	var op = 2;
	var res = $.ajax({
		type:"POST",
		data:{
			op:op,
			idUsuario:idUsuario
		},
		async: false,
		url:"../../../controller/PerfilUsuarioController.php",
		success:function(msg){
			console.log(parseInt(msg));
		}
	});
	return parseInt(res.responseText);
}

function insertarPerfilUsuario(idPerfil,idUsuario){
	var op = 3;
	var res = $.ajax({
		type:"POST",
		data:{
			op:op,
			idPerfil:idPerfil,
			idUsuario:idUsuario
		},
		url:"../../../controller/PerfilUsuarioController.php",
		success:function(msg){
			console.log(parseInt(msg));
		}
	});
	return parseInt(res.responseText);	
}

function agregarPerfil(){
	if($("#txtNNomPerfil").val() != ""){
		if(estadoPerfil == 0){
			insertPerfil();
		}else{
			if(insertPerfil != 0){
				updatePerfil();
			}
		}
	}else{
		var msg = obtenerAlert("Existen campos requeridos: perfil");
		$("#responseCreatePer").html(msg);
	}
}

function insertPerfil(){
	var op = 3;
	var estado = 0;
	var txtNNomPerfil = $("#txtNNomPerfil").val();
	console.log($("#ckNStatus").is(':checked'));
	if($("#ckNStatus").is(':checked')){
		estado = 1;
	}else{
		estado = 0;
	}
	$.ajax({
		type:"POST",
		data:{
			op:op,
			txtNNomPerfil:txtNNomPerfil,
			estado:estado
		},
		url:"../../../controller/PerfilController.php",
		success:function(msg){
			console.log(msg);
			var res = parseInt(msg);
			if(res == 1){
				obtenerTodosPerfil();
				limpiarPerfil();
				$("#new_Perfil").modal("hide");
			}else{
				var errorInsert = obtenerAlert("Se ha producido un error");
        		$("#responseCreatePer").html(errorInsert);
			}
		}
	});
}

function obtenerPerfilId(idPerfil){
	var op = 5;
	$.ajax({
		type:"POST",
		data:{
			op:op,
			idPerfil:idPerfil
		},
		url:"../../../controller/PerfilController.php",
		success:function(msg){
			console.log(msg);
			var perfil = JSON.parse(msg);
			if(perfil.length != 0){
				$("#txtNNomPerfil").val(perfil[0].nombre);
				if(perfil[0].estado == 1){
					$("#ckNStatus").prop("checked", true);
				}else{
					if(perfil[0].estado == 0){
						$("#ckNStatus").prop("checked", false);
					}
				}
				estadoPerfil = perfil[0].idperfil;
				$("#new_Perfil").modal("show");
			}
		}
	});
}

function updatePerfil(){
	var op = 4;
	var estado = 0;
	var txtNNomPerfil = $("#txtNNomPerfil").val();
	if($("#ckNStatus").is(':checked')){
		estado = 1;
	}else{
		estado = 0;
	}
	$.ajax({
		type:"POST",
		data:{
			op:op,
			txtNNomPerfil:txtNNomPerfil,
			estado:estado,
			idPerfil:estadoPerfil
		},
		url:"../../../controller/PerfilController.php",
		success:function(msg){
			var res = parseInt(msg);
			if(res == 1){
				obtenerTodosPerfil();
				limpiarPerfil();
				$("#new_Perfil").modal("hide");
			}else{
				var errorInsert = obtenerAlert("Se ha producido un error");
        		$("#responseCreatePer").html(errorInsert);
			}
		}
	});
}

function limpiarPerfil(){
	$("#txtNNomPerfil").val("");
	$("#ckNStatus").prop("checked", false);
}

function openModalPerfil(){
	estadoPerfil = 0;
	limpiarPerfil();
}

function eliminarPerfil(idPerfil){
	var op = 6;
	bootbox.confirm("Seguro desea eliminar?", function(flg) {
		if(flg){
			$.ajax({
				type:"POST",
				data:{
					op:op,
					idPerfil:idPerfil
				},
				url:"../../../controller/PerfilController.php",
				success:function(msg){
					var res = parseInt(msg);
					if(res == 1){
						obtenerTodosPerfil();
						respuesta = obtenerAlert("Operación realizada con éxito");
		                $("#msgPerfil").html(respuesta);
					}else{
						if(res != 1){
							respuesta = obtenerAlert("Ha ocurrido un Error");
		                    $("#msgPerfil").html(respuesta);
						}
					}
				}
			});
		}else{
			obtenerTodosPerfil();
		}
	});
	//var flg = confirm("Seguro desea eliminar?"); 
}

function obtenerPerfilModulo(idPerfil,val){
	var op = 1;
	var obj = "new_Modulo";
	var title = "Asignar Modulo";
	var html = "";
	$.ajax({
		type:"POST",
		data:{
			op:op,
			idPerfil:idPerfil
		},
		url:"../../../controller/PerfilModuloController.php",
		success:function(msg){
			console.log(msg);
			var modulo = JSON.parse(msg);
			if(modulo.length != 0){
				html += '<div id="modPerfil">';
					html += '<form>';
		                html += '<select id="valMod" multiple="multiple">';
						for(var i=0;i<modulo.length;i++){
							html += "<option value=" + modulo[i].idmodulo + " " + modulo[i].selected + ">" + modulo[i].descripcion + "</option>";
						}
						html += '</select>';
		                html += '<br/>';
		                html += '<button type="button" class="btn btn-primary btn-block" onclick="actualizarAsignacionPerfilMod('+idPerfil+')" >Asignar</button>';
	            	html += '</form>';
            	html += '</div>';
			}else{
				if(modulo.length == 0){
					html = obtenerAlert("Ha ocurrido un Error");
				}
			}
			if(val == 1){
				crearModal(html,obj,title);
			}else{
				$("#valMod").bootstrapDualListbox('refresh');
			}
			$("#valMod").bootstrapDualListbox();
		}
	});
}

function actualizarAsignacionPerfilMod(idPerfil){
	var list = "";
    var respuesta = "";
    var errorInsert = "";
    var error = "";
    var res = 0;
    var resp = 0;
    $("#valMod").bootstrapDualListbox();
    var i = $('#valMod > option:selected').length; 
    var array = []; 
    array.push($("#valMod").bootstrapDualListbox().val());
    list = array[0]; 
    if(list == null){
    	res = eliminarPerfilModulo(idPerfil);
    	console.log(res);
    	if(!isNaN(res)){
    		obtenerPerfilModulo(idPerfil,2);
    		errorInsert = obtenerAlert("Operación realizada con éxito");
        	$("#responseCreate").html(errorInsert);
    	}else{
    		var error = obtenerAlert("Se ha producido un error");
        	$("#responseCreate").html(error);
    	}
    }else{
        var lista = list.toString().split(",");
        res = eliminarPerfilModulo(idPerfil);
        if(isNaN(res)){
        	for (var j = 0; j < lista.length; j++) {
	            console.log(parseInt(lista[j]));
	            resp = insertarPerfilUsuarioMod(parseInt(lista[j]),idPerfil);
	        }
	        console.log(resp);
	        if(isNaN(resp)){
        		obtenerPerfilModulo(idPerfil,2);
        		error = obtenerAlert("Operación realizada con éxito");
        		$("#responseCreate").html(error);
	        }else{
	        	error = obtenerAlert("Se ha producido un error");
        		$("#responseCreate").html(error);
	        }
        }else{
        	if(!isNaN(res)){
        		var errorInsert = obtenerAlert("Se ha producido un error");
        		$("#responseCreate").html(errorInsert);
        	}
        }
    }
}

function insertarPerfilUsuarioMod(idModulo,idPerfil){
	var op = 3;
	var res = $.ajax({
			type:"POST",
			data:{
				op:op,
				idModulo:idModulo,
				idPerfil:idPerfil
			},
			url:"../../../controller/PerfilModuloController.php",
			success:function(msg){
				console.log(parseInt(msg));	
			}
		});
	return parseInt(res.responseText);
}

function eliminarPerfilModulo(idPerfil){
	var op = 2;
	var res = $.ajax({
			type:"POST",
			data:{
				op:op,
				idPerfil:idPerfil
			},
			url:"../../../controller/PerfilModuloController.php",
			success:function(msg){
				console.log(parseInt(msg));		
			}
		});
	return parseInt(res.responseText);
}

function buscarPerfilModulo(){
	var op = 7;
	var estado = 0;
	var txtNomPerfil = $("#txtNomPerfil").val();
	var html = "";
	if($("#ckStatus").is(':checked')){
		estado = 1;
	}else{
		estado = 0;
	}
	$.ajax({
		type:"POST",
		data:{
			op:op,
			txtNomPerfil:txtNomPerfil,
			estado:estado
		},
		url:"../../../controller/PerfilController.php",
		success:function(msg){
			console.log(msg);
			var perfil = JSON.parse(msg);
			if(perfil.length != 0){
				html += '<table id="myTable" class="table table-striped table-bordered table-hover" style="background-color:white">';
	                html += '<thead>';
		                html += '<tr>';
			                html += '<th>Perfil</th>';
			                html += '<th>Estado</th>';
			                html += "<th colspan='3' class='textCenter' style='width:50px;'><center>Acciones</center></th>";
		                html += '</tr>';
	                html += '</thead>';
	            html += '<tbody class="bodyTable">';
                for(var i=0;i<perfil.length;i++){
                	html += '<tr>';
                		html += '<td>' + perfil[i].nombre + '</td>';
		                html += '<td>' + perfil[i].datoEstado + '</td>';
		                html += '<td><center><a href="#" data-toggle="tooltip" title="Editar" onclick="obtenerPerfilId(' + perfil[i].idperfil + ')" ><img src="../../../../assets/img/edit.gif" style="width:15px;"></a></center></td>';
	                    html += '<td><center><a href="#" data-toggle="tooltip" title="Eliminar" onclick="eliminarPerfil(' + perfil[i].idperfil + ')" ><img src="../../../../assets/img/cancelar.png" style="width:15px;"></a></center></td>';
	                    html += '<td><center><a href="#" data-toggle="tooltip" title="Asignar Modulo" onclick="obtenerPerfilModulo(' + perfil[i].idperfil + ',1)" ><i class="fa fa-sitemap"></i></a></center></td>';
                	html += '</tr>';
                }
                html += '</tbody>';
                html += '</table>';
                $("#tablePerfil").html(html);
                $('#tablePerfil').paging({limit:10});
			}
		}
	});
}