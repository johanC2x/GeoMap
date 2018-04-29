

/*=================== Variables Globales ==========================*/

var estadoUsuario = 0;

/*===================   ==========================*/

function validarUsuario() {
	var op = 1;
	var username = $("#username").val();
	var password = $("#password").val();
	$.ajax({
		type:"POST",
		data:{
			op:op,
			username:username,
			password:password
		},
		url:"com/controller/UsuarioController.php",
		success:function(msg){
			console.log(msg);
			var usuario = JSON.parse(msg);
			if(usuario.length > 0){
				location.href = "com/vistas/mantenimientos/welcome/admin.php";
			}
		}
	});
}

function obtenerUsuario(){
	var op = 2;
	var html = '';
	$.ajax({
		type:"POST",
		data:{
			op:op
		},
		url:"../../../controller/UsuarioController.php",
		success:function(msg){
			console.log(msg);
			var usuario = JSON.parse(msg);
			if(usuario.length > 0){
				html += '<table id="myTable" class="table table-striped table-bordered table-hover" style="background-color:white">';
	                html += '<thead>';
		                html += '<tr>';
			                html += '<th>Usuario</th>';
			                html += '<th>Nombre Completo</th>';
			                html += '<th>Estado</th>';
			                html += "<th colspan='3' class='textCenter' style='width:50px;'><center>Acciones</center></th>";
		                html += '</tr>';
	                html += '</thead>';
	                html += '<tbody class="bodyTable">';
					for (var i=0;i<usuario.length;i++) {
						html += '<tr>';
							html += '<td>' + usuario[i].usuario + '</td>';
		                    html += '<td>' + usuario[i].nombreCompleto + '</td>';
		                    html += '<td><center>' + usuario[i].datoEstado + '</center></td>';
		                    html += '<td><center><a href="#" data-toggle="tooltip" title="Editar" onclick="obtenerUsuarioId(' + usuario[i].idusuario + ')" ><img src="../../../../assets/img/edit.gif" style="width:15px;"></a></center></td>';
		                    html += '<td><center><a href="#" data-toggle="tooltip" title="Eliminar" onclick="eliminarUsuario(' + usuario[i].idusuario + ')" ><img src="../../../../assets/img/cancelar.png" style="width:15px;"></a></center></td>';
		                    html += '<td><center><a href="#" data-toggle="tooltip" title="Asignar Perfil" onclick="asignarPerfil(' + usuario[i].idusuario + ',1)" ><i class="fa fa-user-plus"></i></a></center></td>';
						html += '</tr>';
					}
					html += '</tbody>';
                html += '</table>';
                $("#tableUsuario").html(html);
                $('#tableUsuario').paging({limit:10});
			}
		}
	});
}

function filtrarUsuario(){

}

function openModalUsuario(){
    limpiarUsuario();
    estadoUsuario = 0;
}

function validarContraseña() {
    var txtNPass = $("#txtNPass").val();
    var txtNRPass = $("#txtNRPass").val();
    if (txtNPass == txtNRPass) {
        $("#txtNPass").css('border-color', '#CCC');
        $("#txtNRPass").css('border-color', '#CCC');
    } else {
        if (txtNPass != txtNRPass) {
            $("#txtNPass").css('border-color', 'red');
            $("#txtNRPass").css('border-color', 'red');
        } else {
            if (txtNPass == "" && txtNRPass == "") {
                $("#txtNPass").css('border-color', '#CCC');
                $("#txtNRPass").css('border-color', '#CCC');
            }
        }
    }
}

function obtenerUsuarioId(idusuario) {
    var op = 6;
    $.ajax({
        type: "POST",
        data: {
            op: op,
            idusuario: idusuario
        },
        url: "../../../controller/UsuarioController.php",
        success: function (msg) {
            console.log(msg);
            var usuario = JSON.parse(msg);
            $("#new_Usuario").modal("show");
            if (usuario.length != 0) {
                for (var i = 0; i < usuario.length; i++) {
                    $("#txtNUser").val(usuario[i].usuario);
                    $("#txtNNom").val(usuario[i].nombre);
                    $("#txtNApePat").val(usuario[i].apePat);
                    $("#txtNApeMat").val(usuario[i].apeMat);
                    $("#txtNPass").val(usuario[i].passw);
                    $("#txtNEdad").val(usuario[i].edad);
                    $("#txtNDoc").val(usuario[i].nroDoc);
                    $("#txtIdDocumento").val(usuario[i].idTipoDoc);
                    $("#txtIdSexo").val(usuario[i].sexo);
                    estadoUsuario = usuario[i].idusuario;
                }
            } else {
                var errorInsert = obtenerAlert("Se ha producido un error");
                $("#responseCreate").html(errorInsert);
            }
        }
    });
}

function insertUsuario() {
    var errorEdad = "";
    var errorDni = "";
    var txtIdDocumento = $("#txtIdDocumento").val();
    var txtNDoc = $("#txtNDoc").val();
    var txtNEdad = $("#txtNEdad").val();
    if (txtIdDocumento == 1) {
        if (txtNDoc.length == 8) {
            if (isNaN(txtNEdad) != true) {
                if (estadoUsuario == 0) {
                    registrarUsuario();
                } else {
                    if (estadoUsuario != 0) {
                        updateUsuario();
                    }
                } 
            } else {
                errorEdad = obtenerAlert("Error la edad debe ser un numero");
                $("#responseCreate").html(errorEdad);
            }
        } else {
            errorDni = obtenerAlert("Error de Validacion de Documento");
            $("#responseCreate").html(errorDni);
        }
    }
    if (txtIdDocumento == 3) {
        if (txtNDoc.length == 12) {
            if (isNaN(txtNEdad) != true) {
                if (estadoUsuario == 0) {
                    registrarUsuario();
                } else {
                    if (estadoUsuario != 0) {
                        updateUsuario();
                    }
                }
            } else {
                errorEdad = obtenerAlert("Error la edad debe ser un numero");
                $("#responseCreate").html(errorEdad);
            }
        } else {
            errorDni = obtenerAlert("Error de Validacion de Documento");
            $("#responseCreate").html(errorDni);
        }
    }
    if (txtIdDocumento == 4) {
        if (txtNDoc.length == 12) {
            if (isNaN(txtNEdad) != true) {
                if (estadoUsuario == 0) {
                    registrarUsuario();
                } else {
                    if (estadoUsuario != 0) {
                        updateUsuario();
                    }
                }
            } else {
                errorEdad = obtenerAlert("Error la edad debe ser un numero");
                $("#responseCreate").html(errorEdad);
            }
        } else {
            errorDni = obtenerAlert("Error de Validacion de Documento");
            $("#responseCreate").html(errorDni);
        }
    }
}

function updateUsuario() {
    var op = 5;
    var idUsuario = estadoUsuario;
    var txtNUser = $("#txtNUser").val();
    var txtNPass = $("#txtNPass").val();
    var txtNRPass = $("#txtNRPass").val();
    var txtNNom = $("#txtNNom").val();
    var txtNApePat = $("#txtNApePat").val();
    var txtNApeMat = $("#txtNApeMat").val();
    var txtNEdad = $("#txtNEdad").val();
    var txtNDoc = $("#txtNDoc").val();
    var txtIdDocumento = $("#txtIdDocumento").val();
    var txtIdSexo = $("#txtIdSexo").val();
    if (txtNPass == txtNRPass) {
        $.ajax({
            type: "POST",
            data: {
                op: op,
                idUsuario: idUsuario,
                txtNUser: txtNUser,
                txtNPass: txtNPass,
                txtNNom: txtNNom,
                txtNApePat: txtNApePat,
                txtNApeMat: txtNApeMat,
                txtNEdad: txtNEdad,
                txtNDoc: txtNDoc,
                txtIdDocumento: txtIdDocumento,
                txtIdSexo: txtIdSexo
            },
            url: "../../../controller/UsuarioController.php",
            success: function (msg) {
                console.log(msg);
                var n = parseInt(msg);
                if (n == 2) {
                    console.log(msg);
                    limpiarUsuario();
                    obtenerUsuario();
                    $("#new_Usuario").modal("hide");
                    estadoUsuario = 0;
                } else {
                    var errorInsert = obtenerAlert("Se ha producido un error");
                    $("#responseCreate").html(errorInsert);
                }
            }
        });
    } else {
        if (txtNPass != txtNRPass) {
            var msg = obtenerAlert("Las Contraseñas no coinciden");
            $("#responseCreate").html(msg);
        } else {
            if (txtNPass == "" || txtNRPass == "") {
                var msg2 = obtenerAlert("Existe un campo requerido");
                $("#responseCreate").html(msg2);
            }
        }
    }
}

function registrarUsuario() {
    var op = 3;
    var txtNUser = $("#txtNUser").val();
    var txtNPass = $("#txtNPass").val();
    var txtNRPass = $("#txtNRPass").val();
    var txtNNom = $("#txtNNom").val();
    var txtNApePat = $("#txtNApePat").val();
    var txtNApeMat = $("#txtNApeMat").val();
    var txtNEdad = $("#txtNEdad").val();
    var txtNDoc = $("#txtNDoc").val();
    var txtIdDocumento = $("#txtIdDocumento").val();
    var txtIdSexo = $("#txtIdSexo").val();
    if (txtNPass == txtNRPass) {
        $.ajax({
            type: "POST",
            data: {
                op: op,
                txtNUser: txtNUser,
                txtNPass: txtNPass,
                txtNNom: txtNNom,
                txtNApePat: txtNApePat,
                txtNApeMat: txtNApeMat,
                txtNEdad: txtNEdad,
                txtNDoc: txtNDoc,
                txtIdDocumento: txtIdDocumento,
                txtIdSexo: txtIdSexo
            },
            url: "../../../controller/UsuarioController.php",
            success: function (msg) {
                console.log(msg);
                var n = parseInt(msg);
                if (n == 11) {
                    console.log(msg);
                    limpiarUsuario();
                    obtenerUsuario();
                    $("#new_Usuario").modal("hide");
                } else {
                    var errorInsert = obtenerAlert("Se ha producido un error");
                    $("#responseCreate").html(errorInsert);
                }
            }
        });
    } else {
        if (txtNPass != txtNRPass) {
            var msg = obtenerAlert("Las Contraseñas no coinciden");
            $("#responseCreate").html(msg);
        } else {
            if (txtNPass == "" || txtNRPass == "") {
                var msg2 = obtenerAlert("Existe un campo requerido");
                $("#responseCreate").html(msg2);
            }
        }
    }
}

function eliminarUsuario(idusuario) {
    var op = 4;
    var respuesta = "";
    //var flg = confirm("Seguro desea eliminar?");
    bootbox.confirm("Seguro desea eliminar?", function(flg) {
        if (flg) {
            $.ajax({
                type: "POST",
                data: {
                    op: op,
                    idusuario: idusuario
                },
                url: "../../../controller/UsuarioController.php",
                success: function (msg) {
                    console.log(msg);
                    var n = parseInt(msg);
                    if (n == 11) {
                        obtenerUsuario();
                        respuesta = obtenerAlert("Operación realizada con éxito");
                        $("#response").html(respuesta);
                    }else{
                        respuesta = obtenerAlert("Ha ocurrido un Error");
                        $("#response").html(respuesta);
                    }
                }
            });
        } else {
            obtenerUsuario();
        }
    }); 
}

function limpiarUsuario() {
    $("#txtNUser").val("");
    $("#txtNPass").val("");
    $("#txtNRPass").val("");
    $("#txtNNom").val("");
    $("#txtNApePat").val("");
    $("#txtNApeMat").val("");
    $("#txtNEdad").val("");
    $("#txtNDoc").val("");
    $("#txtIdDocumento").val(0);
    $("#txtIdSexo").val(0);
}

function filtrarUsuario(){
    var op = 7;
    var txtNomUsu = $("#txtNomUsu").val();
    var txtNom = $("#txtNom").val();
    var apePat = $("#txtApePat").val();
    var apeMat = $("#txtApeMat").val();

    $.ajax({
        type: "POST",
        data: {
            op: op,
            txtNomUsu: txtNomUsu,
            txtNom: txtNom,
            apePat: apePat,
            apeMat: apeMat
        },
        url: "../../../controller/UsuarioController.php",
        success: function (msg) {
            console.log(msg);
            var usuario = JSON.parse(msg);
            if (usuario.length != 0) {
                var html = "";
                html += '<table id="myTable" class="table table-striped table-bordered table-hover" style="background-color:white">';
                html += '<thead>';
                    html += '<tr>';
                        html += '<th>Usuario</th>';
                        html += '<th>Nombre Completo</th>';
                        html += '<th>Estado</th>';
                        html += "<th colspan='3' class='textCenter' style='width:50px;'><center>Acciones</center></th>";
                    html += '</tr>';
                html += '</thead>';
                html += '<tbody class="bodyTable">';
                for (var i = 0; i < usuario.length; i++) {
                    html += '<tr>';
                        html += '<td>' + usuario[i].usuario + '</td>';
                        html += '<td>' + usuario[i].nombreCompleto + '</td>';
                        html += '<td><center>' + usuario[i].datoEstado + '</center></td>';
                        html += '<td><center><a href="#" data-toggle="tooltip" title="Editar" onclick="obtenerUsuarioId(' + usuario[i].idusuario + ')" ><img src="../../../../assets/img/edit.gif" style="width:15px;"></a></center></td>';
                        html += '<td><center><a href="#" data-toggle="tooltip" title="Eliminar" onclick="eliminarUsuario(' + usuario[i].idusuario + ')" ><img src="../../../../assets/img/cancelar.png" style="width:15px;"></a></center></td>';
                        html += '<td><center><a href="#" data-toggle="tooltip" title="Asignar Perfil" onclick="asignarPerfil(' + usuario[i].idusuario + ',1)" ><i class="fa fa-user-plus"></i></a></center></td>';
                    html += '</tr>';
                }
                html += '</tbody>';
                html += '</table>';
                $("#tableUsuario").html(html);
                $("#txtNomUsu").val("");
                $("#txtNom").val("");
                $("#txtApePat").val("");
                $("#txtApeMat").val("");
            } else {
                var res = obtenerAlert("No se encontraron datos...");
                $("#response").html(res);
                $("#tableUsuario").html("");
                $("#txtNomUsu").val("");
                $("#txtNom").val("");
                $("#txtApePat").val("");
                $("#txtApeMat").val("");
            }
        }
    });

}
