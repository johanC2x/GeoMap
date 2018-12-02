/* VALORES DE MAPA */
var MAPFILES_URL = "http://www.google.com/mapfiles/";

var map = null; 
var markers = null;
var polylines = null;
var bounds = null;
var info = null;
var details = null;
var selected = null;
var reverseIcon = null;
var clickMarker = null;
var hashFragment = "";
/* =============== */

var map = null;
var geocoder = null;
var obj = "";
var title = "";
var dis = "";
var con = "";
var codigoUsuario = "";
var param = 0;
var idDesMap = 0;
var estadoMap = 0;

/* DATOS DEL LUGAR */
var lat = 0;  
var lon = 0;

/* DATOS DEL MAPA */
var latNow = 0; 
var lonNow = 0;

function limpiarFiltro(){
  $("#codsol").val("");
  $("#address").val("");
} 


function initialize() {
  var op = 1;
  var error = 0;
  if (GBrowserIsCompatible()) {
    map = new GMap2(document.getElementById("map_canvas"));
    map.setCenter(new GLatLng(37.4419, -122.1419), 1);
    map.setUIToDefault();
    $.ajax({
      type:"POST",
      data:{
        op:op
      },
      url:"../../../controller/MapController.php",
      success:function(msg){
        var mapa = JSON.parse(msg);
        for(var i=0;i<mapa.length;i++){
          var latlong = null;
          var address = mapa[i].distrito;
          geocoder = new GClientGeocoder();
          geocoder.getLatLng(
             address + " Perú",
            function(point) {
              if (!point) {
                error = 1;
              } else {
                map.setCenter(point, 15);
                var marker = new GMarker(point, {draggable: true,title: address});
                map.addOverlay(marker);
                GEvent.addListener(marker, "dragend", function() {
                  marker.openInfoWindowHtml(marker.getLatLng().toUrlValue(6));
                  latlong = marker.getLatLng();
                  console.log(latlong);
                });
                GEvent.addListener(marker, "click", function() {
                  obtenerOrdenes(marker.getLatLng().toUrlValue(6));
                });
                GEvent.trigger(marker, "click");
              }
            }
          );
        }
        /*
        for(var i=0;i<jsonMap.length;i++){
          console.log(jsonMap[i].address+"///"+jsonMap[i].distrito);
        }
        */
      }
    });
  }
}

function obtenerOrdenes(address){
  var geocoder = new google.maps.Geocoder();
  geocoder.geocode({'address': address}, function(results, status) {
      if(status == google.maps.GeocoderStatus.OK) {
          /*console.log(results[0]['formatted_address']);*/
          /*alert(results[0]['formatted_address']);*/
      };
  });
}

function showAddress(solicitud){
  var respuesta = validarSolicitud();
  if(respuesta == 1){
    var response = obtenerAlert("Debe de ingresar un número...");
    $("#resMap").html(response);
  }else{
    var op = 21;
    $.ajax({
      type:"POST",
      data:{
        op:op,
        solicitud:solicitud
      },
      url:"../../../controller/MapController.php",
      success:function(msg){
        console.log(msg);
        var mapa = JSON.parse(msg);   
        var query = mapa[0].x.concat(',',mapa[0].y);
        $("#query").val(query);
        console.log($("#query").val(query));
        obtenerPorCoordenadas();
        obtenerBandera(mapa[0].flgEstado);
        if(mapa[0].flgEstado != 0 && mapa[0].flgEstado != null){
          idDesMap = mapa[0].idMap;
          $("#txtArDescr").val(mapa[0].descripcion);
          if(mapa[0].flgEstado == 1){
            estadoMap = 1; 
            $("#sk1").prop("checked", "checked");
            $('#sk2').attr('disabled', true);
            $('#sk3').attr('disabled', true);
            $("#txtArDescr").prop('disabled',false);
          }else{
            if(mapa[0].flgEstado == 2){
              estadoMap = 2;
              $("#sk2").prop("checked", "checked");
              $('#sk1').attr('disabled', true);
              $('#sk3').attr('disabled', true);
              $("#txtArDescr").prop('disabled',false);
            }else{
              if(mapa[0].flgEstado == 3){
                estadoMap = 3;
                $("#sk3").prop("checked", "checked");
                $('#sk1').attr('disabled', true);
                $('#sk2').attr('disabled', true);
                $("#txtArDescr").attr("disabled","disabled");
              }
            }
          }        
        }
        var distancia = updatePosition(mapa[0].x,mapa[0].y);
        if(distancia > 1000){
          bootbox.confirm("Usted no se encuentra en su punto de trabajo...", function(flg) {
            if (flg) {
              cerrarSesion();
            }else{
              cerrarSesion();
            }
          });
        }else if(distancia < 1000){
          $("#"+obj).modal("hide");
        }
      }
    });
  } 
}

/*
function showAddress(solicitud) {
  var address = "";
  var respuesta = validarSolicitud();
  if(respuesta == 1){
    var response = obtenerAlert("Debe de ingresar un número...");
    $("#resMap").html(response);
  }else{
    if(solicitud != ""){
      address = obtenerAddresPorSol(solicitud); 
    } 
    if (geocoder) {
      geocoder.getLatLng(
        address,
        function(point) {
          if (!point) {
            var alert = obtenerAlert("La direccion seleccionada no pudo filtrarse");
            $("#response").html(alert);
          } else {
            map.setCenter(point, 15);
            var marker = new GMarker(point, {draggable: true});
            map.addOverlay(marker);
            GEvent.addListener(marker, "dragend", function() {
              marker.openInfoWindowHtml(address);
            });
            GEvent.addListener(marker, "click", function() {
              marker.openInfoWindowHtml(address);
            });
            GEvent.trigger(marker, "click");
          }
        }
      );
    }
  } 
}
*/

function obtenerAddresPorSol(solicitud){
  var op = 15;
  var mapa = [];
  console.log("mostrar addres");
  var address = $.ajax({
      type:"POST",
      data:{
        op:op,
        solicitud:solicitud
      },
      async: false,
      url:"../../../controller/MapController.php",
      success:function(msg){
        mapa = JSON.parse(msg);
        address = mapa[0].dirObra;
      }
    });
  return address.responseText;
}

function obtenerMapaDistrito(obj,codigo) {
  if(codigo != ""){
    codigoUsuario = codigo;
    var op = 2;
    var html = "";
    $.ajax({
      type:"POST",
      data:{
        op:op,
        codigo:codigo
      },
      url:"../../../controller/MapController.php",
      success:function(msg){      
        var mapa = JSON.parse(msg);
        html += "<table id='myTable' class='table table-striped table-bordered table-hover' style='background-color:white'>";
          html += "<thead>";
            html += "<tr>";
              html += "<th>Distrito</th>";
              html += "<th>Asig.</th>";
              html += "<th>Acción</th>";
            html += "</tr>";
          html += "</thead>";
          html += "<tbody class='bodyTable'>";
          for(var i=0;i<mapa.length;i++){
           html += "<tr>";
            html += "<td>"+mapa[i].distrito+"</td>";
            html += "<td><left>"+mapa[i].contador+"</left></td>";
            html += "<td style='width:30px;'><a href='#' data-toggle='tooltip' title='Ver Detalle'  onclick='obtenerAsigDistrito(\"" + mapa[i].distrito + "\",\""+ codigo +"\")'><center><img src='../../../../assets/img/lupa.png' style='width:15px;'/></center></a></td>";
           html += "</tr>";
          }
          html += "</tbody>";
        html += "</table>";
        $("#"+obj).html(html);
        $('#'+obj).paging({limit:10});
      }
    });
  }else{
    if(codigo == "" || codigo == null){
      var op = 11;
      var html = "";
      $.ajax({
        type:"POST",
        data:{
          op:op
        },
        url:"../../../controller/MapController.php",
        success:function(msg){
          console.log(msg);
          var mapa = JSON.parse(msg);
          html += "<table id='myTable' class='table table-striped table-bordered table-hover' style='background-color:white'>";
            html += "<thead>";
              html += "<tr>";
                html += "<th>Distrito</th>";
                html += "<th>Asig.</th>";
                html += "<th>Acción</th>";
              html += "</tr>";
            html += "</thead>";
            html += "<tbody class='bodyTable'>";
            for(var i=0;i<mapa.length;i++){
             html += "<tr>";
              html += "<td>"+mapa[i].distrito+"</td>";
              html += "<td><left>"+mapa[i].contador+"</left></td>";
              html += "<td style='width:30px;'><a href='#' data-toggle='tooltip' title='Ver Detalle'  onclick='obtenerAsigDistrito(\"" + mapa[i].distrito + "\",\""+ codigo +"\")'><center><img src='../../../../assets/img/lupa.png' style='width:15px;'/></center></a></td>";
             html += "</tr>";
            }
            html += "</tbody>";
          html += "</table>";
          $("#"+obj).html(html);
          $('#'+obj).paging({limit:10});
        }
      });
    }
  }
}
 
function obtenerMapaContratista(obj,codigo) {
  if(codigo != ""){
    codigoUsuario = codigo;
    var op = 8;
    var html = "";
    $.ajax({
      type:"POST",
      data:{
        op:op,
        codigo:codigo
      },
      url:"../../../controller/MapController.php",
      success:function(msg){      
        var mapa = JSON.parse(msg);
        html += "<table id='myTable' class='table table-striped table-bordered table-hover' style='background-color:white'>";
          html += "<thead>";
            html += "<tr>";
              html += "<th>Contratista</th>";
              html += "<th>Asig.</th>";
              html += "<th>Acción</th>";
            html += "</tr>";
          html += "</thead>";
          html += "<tbody class='bodyTable'>";
          for(var i=0;i<mapa.length;i++){
           html += "<tr>";
            html += "<td>"+mapa[i].nombreContratista+"</td>";
            html += "<td><left>"+mapa[i].contador+"</left></td>";
            html += "<td style='width:30px;'><a href='#' data-toggle='tooltip' title='Ver Detalle'  onclick='obtenerAsigContratista(\"" + mapa[i].nombreContratista + "\",\""+ codigo + "\")'><center><img src='../../../../assets/img/lupa.png' style='width:15px;'/></center></a></td>";
           html += "</tr>";
          }
          html += "</tbody>";
        html += "</table>";
        $("#"+obj).html(html);
        $('#'+obj).paging({limit:10});
      }
    });
  }else{
    if(codigo == ""){
      var op = 13;
      var html = "";
      $.ajax({
        type:"POST",
        data:{
          op:op
        },
        url:"../../../controller/MapController.php",
        success:function(msg){      
          var mapa = JSON.parse(msg);
          html += "<table id='myTable' class='table table-striped table-bordered table-hover' style='background-color:white'>";
            html += "<thead>";
              html += "<tr>";
                html += "<th>Contratista</th>";
                html += "<th>Asig.</th>";
                html += "<th>Acción</th>";
              html += "</tr>";
            html += "</thead>";
            html += "<tbody class='bodyTable'>";
            for(var i=0;i<mapa.length;i++){
             html += "<tr>";
              html += "<td>"+mapa[i].nombreContratista+"</td>";
              html += "<td><left>"+mapa[i].contador+"</left></td>";
              html += "<td style='width:30px;'><a href='#' data-toggle='tooltip' title='Ver Detalle'  onclick='obtenerAsigContratista(\"" + mapa[i].nombreContratista + "\",\""+ codigo + "\")'><center><img src='../../../../assets/img/lupa.png' style='width:15px;'/></center></a></td>";
             html += "</tr>";
            }
            html += "</tbody>";
          html += "</table>";
          $("#"+obj).html(html);
          $('#'+obj).paging({limit:10});
        }
      });
    }
  }
}

function obtenerMapaSupervisor(obj,codigo) {
  
}

function obtenerAsigDistrito(distrito,codigo){
  if(codigo != ""){
    var op = 3;
    var root = "../../";
    dis = distrito;
    obj = "map";
    title = "Número de Asignaciones";
    param = 1;
    var html = "";
    $.ajax({
      type:"POST",
      data:{
        distrito:distrito,
        codigo:codigo,
        op:op
      },
      url:"../../../controller/MapController.php",
      success:function(msg){
        console.log(msg);
        var mapa = JSON.parse(msg);
        html += "<table id='tableMap' class='table table-striped table-bordered table-hover' style='background-color:white'>";
          html += "<thead>";
            html += "<tr>";
              html += "<th class='tr-center'>Codigo</th>";
              html += "<th class='tr-center'>Cliente</th>";
              html += "<th class='tr-center'>Direccion</th>";
              html += "<th class='tr-center'>Distrito</th>";
              html += "<th class='tr-center' colspan='3'>Acción</th>";
            html += "</tr>";
          html += "</thead>";
          html += "<tbody class='bodyTable'>";
            for(var i=0;i<mapa.length;i++){
              html += "<tr>";
                html += "<td>"+mapa[i].solicitud+"</td>";
                html += "<td class='font-min'>"+mapa[i].cliente+"</td>";
                html += "<td class='font-min'>"+mapa[i].dirObra+"</td>";
                html += "<td class='font-min'>"+mapa[i].distrito+"</td>";
                html += "<td style='width:30px;'><a href='#' data-toggle='tooltip' title='Seleccionar' onclick='obtenerDistritoAddress("+mapa[i].idMap+")'><center><img src='../../../../assets/img/select3.png' style='width:15px;'/></center></a></td>";
                if(mapa[i].flgRuta == 1){
                  html += "<td class='font-min'><a href="+root.concat('',mapa[i].ruta)+" target='_blank' data-toggle='tooltip' title='Descargar'><center>"+"<img src='../../../../assets/img/download.png' style='width:15px;'/>"+"</center></a></td>";
                  html += "<td class='font-min'><center><a href='#' onclick='eliminarArchivoMap(\""+mapa[i].ruta+"\","+mapa[i].idMap+","+ param +")' data-toggle='tooltip' title='Eliminar archivo'><i class='fa fa-trash'></i></a></center></td>";
                }else{
                  if (mapa[i].flgRuta == 0){
                    html += "<td class='font-min'><a href='#' data-toggle='tooltip' title='Subir' onclick='subir(\""+obj+"\","+mapa[i].idMap+","+ param +")'><center>"+"<img src='../../../../assets/img/upload.png' style='width:15px;'/>"+"</center></a></td>";
                    html += "<td class='font-min'><a href='#' class='disable' data-toggle='tooltip' title='Sin archivo'><i class='fa fa-ban'></i></a></td>";
                  }
                }
              html += "</tr>";
            }
          html += "</tbody>";
        html += "</table>";
        crearModal(html,obj,title);
        $('#tableMap').paging({limit:5});
      }
    });
  }else{
    if(codigo == ""){
      var op = 12;
      var root = "../../";
      dis = distrito;
      obj = "map";
      title = "Número de Asignaciones";
      param = 1;
      var html = "";
      $.ajax({
        type:"POST",
        data:{
          op:op,
          distrito:distrito
        },
        url:"../../../controller/MapController.php",
        success:function(msg){
          console.log(msg);
          var mapa = JSON.parse(msg);
          html += "<table id='tableMap' class='table table-striped table-bordered table-hover' style='background-color:white'>";
            html += "<thead>";
              html += "<tr>";
                html += "<th class='tr-center'>Codigo</th>";
                html += "<th class='tr-center'>Cliente</th>";
                html += "<th class='tr-center'>Direccion</th>";
                html += "<th class='tr-center'>Distrito</th>";
                html += "<th class='tr-center' colspan='3'>Acción</th>";
              html += "</tr>";
            html += "</thead>";
            html += "<tbody class='bodyTable'>";
              for(var i=0;i<mapa.length;i++){
                html += "<tr>";
                  html += "<td>"+mapa[i].solicitud+"</td>";
                  html += "<td class='font-min'>"+mapa[i].cliente+"</td>";
                  html += "<td class='font-min'>"+mapa[i].dirObra+"</td>";
                  html += "<td class='font-min'>"+mapa[i].distrito+"</td>";
                  html += "<td style='width:30px;'><a href='#' data-toggle='tooltip' title='Seleccionar' onclick='obtenerDistritoAddress("+mapa[i].idMap+")'><center><img src='../../../../assets/img/select3.png' style='width:15px;'/></center></a></td>";
                  if(mapa[i].flgRuta == 1){
                    html += "<td class='font-min'><a href="+root.concat('',mapa[i].ruta)+" target='_blank' data-toggle='tooltip' title='Descargar'><center>"+"<img src='../../../../assets/img/download.png' style='width:15px;'/>"+"</center></a></td>";
                    html += "<td class='font-min'><center><a href='#' onclick='eliminarArchivoMap(\""+mapa[i].ruta+"\","+mapa[i].idMap+","+ param +")' data-toggle='tooltip' title='Eliminar archivo'><i class='fa fa-trash'></i></a></center></td>";
                  }else{
                    if (mapa[i].flgRuta == 0){
                      html += "<td class='font-min'><a href='#' data-toggle='tooltip' title='Subir' onclick='subir(\""+obj+"\","+mapa[i].idMap+","+ param +")'><center>"+"<img src='../../../../assets/img/upload.png' style='width:15px;'/>"+"</center></a></td>";
                      html += "<td class='font-min'><a href='#' class='disable' data-toggle='tooltip' title='Sin archivo'><i class='fa fa-ban'></i></a></td>";
                    }
                  }
                html += "</tr>";
              }
            html += "</tbody>";
          html += "</table>";
          crearModal(html,obj,title);
          $('#tableMap').paging({limit:5});
        }
      });
    }
  } 
}

function obtenerAsigContratista(contratista,codigo){
  if(codigo != ""){
    var op = 9;
    var root = "../../";
    con = contratista;
    obj = "map";
    title = "Número de Asignaciones";
    param = 2;
    var html = "";
    $.ajax({
      type:"POST",
      data:{
        contratista:contratista,
        codigo:codigo,
        op:op
      },
      url:"../../../controller/MapController.php",
      success:function(msg){
        console.log(msg);
        var mapa = JSON.parse(msg);
        html += "<table id='tableMap' class='table table-striped table-bordered table-hover' style='background-color:white'>";
          html += "<thead>";
            html += "<tr>";
              html += "<th class='tr-center'>Codigo</th>";
              html += "<th class='tr-center'>Cliente</th>";
              html += "<th class='tr-center'>Direccion</th>";
              html += "<th class='tr-center'>Distrito</th>";
              html += "<th class='tr-center' colspan='3'>Acción</th>";
            html += "</tr>";
          html += "</thead>";
          html += "<tbody class='bodyTable'>";
            for(var i=0;i<mapa.length;i++){
              html += "<tr>";
                html += "<td>"+mapa[i].solicitud+"</td>";
                html += "<td class='font-min'>"+mapa[i].cliente+"</td>";
                html += "<td class='font-min'>"+mapa[i].dirObra+"</td>";
                html += "<td class='font-min'>"+mapa[i].distrito+"</td>";
                html += "<td style='width:30px;'><a href='#' data-toggle='tooltip' title='Seleccionar' onclick='obtenerDistritoAddress("+mapa[i].idMap+")'><center><img src='../../../../assets/img/select3.png' style='width:15px;'/></center></a></td>";
                if(mapa[i].flgRuta == 1){
                  html += "<td class='font-min'><a href="+root.concat('',mapa[i].ruta)+" target='_blank' data-toggle='tooltip' title='Descargar'><center>"+"<img src='../../../../assets/img/download.png' style='width:15px;'/>"+"</center></a></td>";
                  html += "<td class='font-min'><center><a href='#' onclick='eliminarArchivoMap(\""+mapa[i].ruta+"\","+mapa[i].idMap+","+ param +")' data-toggle='tooltip' title='Eliminar archivo'><i class='fa fa-trash'></i></a></center></td>";
                }else{
                  if (mapa[i].flgRuta == 0){
                    html += "<td class='font-min'><a href='#' data-toggle='tooltip' title='Subir' onclick='subir(\""+obj+"\","+mapa[i].idMap+",\""+ param +"\")'><center>"+"<img src='../../../../assets/img/upload.png' style='width:15px;'/>"+"</center></a></td>";
                    html += "<td class='font-min'><a href='#' class='disable' data-toggle='tooltip' title='Sin archivo'><i class='fa fa-ban'></i></a></td>";
                  }
                }
              html += "</tr>";
            }
          html += "</tbody>";
        html += "</table>";
        crearModal(html,obj,title);
        $('#tableMap').paging({limit:5});
      }
    });
  }else{
    if(codigo == "" || codigo == null){
      var op = 14;
      var root = "../../";
      con = contratista;
      obj = "map";
      title = "Número de Asignaciones";
      param = 2;
      var html = "";
      $.ajax({
        type:"POST",
        data:{
          contratista:contratista,
          op:op
        },
        url:"../../../controller/MapController.php",
        success:function(msg){
          console.log(msg);
          var mapa = JSON.parse(msg);
          html += "<table id='tableMap' class='table table-striped table-bordered table-hover' style='background-color:white'>";
            html += "<thead>";
              html += "<tr>";
                html += "<th class='tr-center'>Codigo</th>";
                html += "<th class='tr-center'>Cliente</th>";
                html += "<th class='tr-center'>Direccion</th>";
                html += "<th class='tr-center'>Distrito</th>";
                html += "<th class='tr-center' colspan='3'>Acción</th>";
              html += "</tr>";
            html += "</thead>";
            html += "<tbody class='bodyTable'>";
              for(var i=0;i<mapa.length;i++){
                html += "<tr>";
                  html += "<td>"+mapa[i].solicitud+"</td>";
                  html += "<td class='font-min'>"+mapa[i].cliente+"</td>";
                  html += "<td class='font-min'>"+mapa[i].dirObra+"</td>";
                  html += "<td class='font-min'>"+mapa[i].distrito+"</td>";
                  html += "<td style='width:30px;'><a href='#' data-toggle='tooltip' title='Seleccionar' onclick='obtenerDistritoAddress("+mapa[i].idMap+")'><center><img src='../../../../assets/img/select3.png' style='width:15px;'/></center></a></td>";
                  if(mapa[i].flgRuta == 1){
                    html += "<td class='font-min'><a href="+root.concat('',mapa[i].ruta)+" target='_blank' data-toggle='tooltip' title='Descargar'><center>"+"<img src='../../../../assets/img/download.png' style='width:15px;'/>"+"</center></a></td>";
                    html += "<td class='font-min'><center><a href='#' onclick='eliminarArchivoMap(\""+mapa[i].ruta+"\","+mapa[i].idMap+","+ param +")' data-toggle='tooltip' title='Eliminar archivo'><i class='fa fa-trash'></i></a></center></td>";
                  }else{
                    if (mapa[i].flgRuta == 0){
                      html += "<td class='font-min'><a href='#' data-toggle='tooltip' title='Subir' onclick='subir(\""+obj+"\","+mapa[i].idMap+",\""+ param +"\")'><center>"+"<img src='../../../../assets/img/upload.png' style='width:15px;'/>"+"</center></a></td>";
                      html += "<td class='font-min'><a href='#' class='disable' data-toggle='tooltip' title='Sin archivo'><i class='fa fa-ban'></i></a></td>";
                    }
                  }
                html += "</tr>";
              }
            html += "</tbody>";
          html += "</table>";
          crearModal(html,obj,title);
          $('#tableMap').paging({limit:5});
        }
      });
    }
  }
}

function obtenerMapId(idMap){
  var op = 4;
  $.ajax({
    type:"POST",
    data:{
      op:op,
      idMap:idMap
    },
    url:"../../../controller/MapController.php",
    success:function(msg){
      var mapa = JSON.parse(msg); 
      obtenerBandera(mapa[0].flgEstado);
      if(mapa[0].flgEstado != 0 && mapa[0].flgEstado != null){
        idDesMap = idMap;
        $("#txtArDescr").val(mapa[0].descripcion);
        if(mapa[0].flgEstado == 1){
          estadoMap = 1;
          $("#sk1").prop("checked", "checked");
          $('#sk2').attr('disabled', true);
          $('#sk3').attr('disabled', true);
          $("#txtArDescr").prop('disabled',false);
        }else{
          if(mapa[0].flgEstado == 2){
            estadoMap = 2;
            $("#sk2").prop("checked", "checked");
            $('#sk1').attr('disabled', true);
            $('#sk3').attr('disabled', true);
            $("#txtArDescr").prop('disabled',false);
          }else{
            if(mapa[0].flgEstado == 3){
              estadoMap = 3;
              $("#sk3").prop("checked", "checked");
              $('#sk1').attr('disabled', true);
              $('#sk2').attr('disabled', true);
              $("#txtArDescr").attr("disabled","disabled");
            }
          }
        }        
      }
    }
  });
}

function obtenerDistritoAddress(idMap){
  var op = 4;
  $.ajax({
    type:"POST",
    data:{
      op:op,
      idMap:idMap
    },
    url:"../../../controller/MapController.php",
    success:function(msg){
      var mapa = JSON.parse(msg);
      /*mostrarAddress(mapa[0].dirObra.concat(' ',mapa[0].distrito,' Perú'));*/
      var query = mapa[0].y.concat(',',mapa[0].x);
      $("#query").val(query);
      console.log($("#query").val(query));
      obtenerPorCoordenadas();
      obtenerBandera(mapa[0].flgEstado);
      if(mapa[0].flgEstado != 0 && mapa[0].flgEstado != null){
        idDesMap = idMap;
        $("#txtArDescr").val(mapa[0].descripcion);
        if(mapa[0].flgEstado == 1){
          estadoMap = 1;
          $("#sk1").prop("checked", "checked");
          $('#sk2').attr('disabled', true);
          $('#sk3').attr('disabled', true);
          $("#txtArDescr").prop('disabled',false);
        }else{
          if(mapa[0].flgEstado == 2){
            estadoMap = 2;
            $("#sk2").prop("checked", "checked");
            $('#sk1').attr('disabled', true);
            $('#sk3').attr('disabled', true);
            $("#txtArDescr").prop('disabled',false);
          }else{
            if(mapa[0].flgEstado == 3){
              estadoMap = 3;
              $("#sk3").prop("checked", "checked");
              $('#sk1').attr('disabled', true);
              $('#sk2').attr('disabled', true);
              $("#txtArDescr").attr("disabled","disabled");
            }
          }
        }        
      }
      var distancia = updatePosition(mapa[0].y,mapa[0].x);
      if(distancia > 1000){
        bootbox.confirm("Usted no se encuentra en su punto de trabajo...", function(flg) {
          if (flg) {
            cerrarSesion();
          }else{
            cerrarSesion();
          }
        });
      }else if(distancia < 1000){
        $("#"+obj).modal("hide");
      }
    }
  });
}

function mostrarAddress(address) {
  var alert = ""; 
  console.log("pase por aca"); 
  if (geocoder) {
    geocoder.getLatLng(
      address,
      function(point) {
        if (!point) {
          alert = obtenerAlert("La direccion seleccionada no pudo filtrarse");
          $("#response").html(alert);
        } else {
          map.setCenter(point, 15);
          var marker = new GMarker(point, {
              draggable: true,
              map: map
            });
          map.addOverlay(marker);
          GEvent.addListener(marker, "dragend", function() {
            marker.openInfoWindowHtml(address); 
          });
          GEvent.addListener(marker, "click", function() {
            marker.openInfoWindowHtml(address);
          });
          GEvent.trigger(marker, "click");
          alert = obtenerDireccion(address);
        }
      }
    );
  }
  //codeAddress(address);
}

function codeAddress(address) { 
    geocoder = new google.maps.Geocoder(); 
    geocoder.geocode( { 'address': address}, function(results, status) { 
    if (status == google.maps.GeocoderStatus.OK) {  
        updatePosition(results[0].geometry.location);
    } else { 
        alert("No podemos encontrar la direcci&oacute;n, error: " + status);
    }
  });
}

function updatePosition(x,y){  
  console.log(x + ' /// ' + y);
  console.log(lat + ' /// ' + lon);
  var sevilla = new google.maps.LatLng(x, y);
  var buenos_aires = new google.maps.LatLng(lat, lon); 
  var distancia = google.maps.geometry.spherical.computeDistanceBetween(sevilla, buenos_aires);
  console.log(distancia);
  return distancia;
}
/*
  DECRIPCIÓN BANDERA:
    - ESTADO 1: PENDIENTE
    - ESTADO 2: OBSERVADA
    - ESTADO 3: ACABADA
*/
function obtenerBandera(estado){
  var img = "";
  if(estado == 1){
    img = "<img src='../../../../assets/img/rojo.png' style='width:15px;'/>";
  }else{
    if(estado == 2){
      img = "<img src='../../../../assets/img/amarillo.png' style='width:15px;'/>";
    }else{
      if(estado == 3){
        img = "<img src='../../../../assets/img/verde.png' style='width:15px;'/>";
      }
    }
  }
  $("#imgBandera").html(img);
  $("#dvDescr").css("display","inline");
}

function obtenerDetallesMapa(){
  $("#modalDescr").modal("show");
}

function grabarDescrMap(){
  var op = 16;
  var txtArDescr = $("#txtArDescr").val();
  $.ajax({
    type:"POST",
    data:{
      op:op,
      idMap:idDesMap,
      estado:estadoMap,
      txtArDescr:txtArDescr
    },
    url:"../../../controller/MapController.php",
    success:function(msg){
      console.log(msg);
      if(msg == "1"){
        obtenerMapId(idDesMap);
        var errorInsert = obtenerAlert("Operación realizada con exito");
        $("#responseCreateDes").html(errorInsert);
      }else{
        var errorInsert = obtenerAlert("Se ha producido un error");
        $("#responseCreateDes").html(errorInsert);
      }
    }
  });
}

var jsonModal = [];
if(jsonModal.length != 0){
  var json = JSON.parse(jsonModal);
}

function obtenerModal(){
  var obj = "map";
  var title = "Número de Asignaciones";
  jsonModal.push({
    'Codigo':'Cod. Solicitud',
    'Cliente':'Cliente',
    'Direccion':'Dirección',
    'Distrito':'Distrito'
  });
  var mod = crearModal(jsonModal,obj,title);
  $("#modal").html(mod);
  $("#"+obj).modal("show");
  jsonModal = [];
}

function subir(objOld,idMap,param){
  var obj = "upload";
  var title = "Subir Plano";
  var html = '<form id="formData" enctype="multipart/form-data" role="form"><table><tr><td style="padding:5px;"><input type="file" id="image" name="image" class="filestyle form-control"></td><td><button type="button" onclick="subirArchivo('+idMap+',\''+ obj +'\','+ param +')" class="btn btn-primary" >Subir</button></td></tr></table><form>';
  html += "<br/><div id='msg'></div>";
  $("#"+objOld).modal("hide");
  crearModal(html,obj,title);
}

function subirArchivo(idMap,obj,param){
  var op = 6; 
  var inputFileImage = document.getElementById("image");
  var file = inputFileImage.files[0];
  var data = new FormData();
  data.append('op',op);
  data.append('archivo',file);
  data.append('idMap',idMap);
  $.ajax({
    type:'POST',
    data:data, 
    url:"../../../controller/MapController.php",
    contentType:false,
    processData:false,
    cache:false,
    success:function(msg){
      if(msg == "1"){
        if(param == 1){
          obtenerAsigDistrito(dis,codigoUsuario);
        }else{
          if(param == 2){
            obtenerAsigContratista(con,codigoUsuario);
          }else{
            if(param == 3){

            } 
          }
        }
        $("#"+obj).modal("hide");
      }else{
        if(msg == "0"){
          var msg = obtenerAlert("Ha ocurrido un error por favor verifique");
          $("#msg").html(msg);
        }
      }
    }
  });
}  

function eliminarArchivoMap(root,idMap,param){
  var op = 7;
  $.ajax({
    type:"POST",
    data:{
      op:op,
      idMap:idMap,
      root:root
    },
    url:"../../../controller/MapController.php",
    success:function(msg){
      console.log(msg);
      if(msg == "1"){
        if(param == 1){
          obtenerAsigDistrito(dis,codigoUsuario);
        }
        if(param == 2){
          obtenerAsigContratista(con,codigoUsuario);
        }
        if(param == 3){

        }
        $("#"+obj).modal("hide");
      }else{
        if(msg == "0"){
          var msg = obtenerAlert("Ha ocurrido un error por favor verifique");
          $("#msg").html(msg);
        }
      }
    }
  });
}

function filtrarMapSupervisor(){
  if($('#ck1').is(":checked")){
    $('#ck2').attr('disabled', true);
    $('#ck3').attr('disabled', true);
    obtenerMapaSupervisor("tableDistrito",codigoUsuario);
  }else{
    if ($('#ck1').is(":checked") == false) {
      $('#ck2').attr('disabled', false);
      $('#ck3').attr('disabled', false);
    } 
  } 
}

function filtrarMapContratista(){
  if ($('#ck2').is(":checked")) {
    $('#ck1').attr('disabled', true);
    $('#ck3').attr('disabled', true);
    obtenerMapaContratista("tableDistrito",codigoUsuario);
  }else{
    if($('#ck2').is(":checked") == false){
      $('#ck1').attr('disabled', false);
      $('#ck3').attr('disabled', false);
    } 
  }
}

function filtrarMapDistrito(){
  if ($('#ck3').is(":checked")) {
    $('#ck1').attr('disabled', true);
    $('#ck2').attr('disabled', true);
    obtenerMapaDistrito("tableDistrito",codigoUsuario);
  }else{
    if($('#ck3').is(":checked") == false){
      $('#ck1').attr('disabled', false);
      $('#ck2').attr('disabled', false);
    } 
  }
}

/* =================================== DESCRIPCIONES ======================================== */

function obtenerDesMap1(){
  if ($('#sk1').is(":checked")) {
    $('#sk2').attr('disabled', true);
    $('#sk3').attr('disabled', true);
    estadoMap = 1;
  }else{
    if($('#sk1').is(":checked") == false){
      $('#sk2').attr('disabled', false);
      $('#sk3').attr('disabled', false);
      estadoMap = 0;
    } 
  }
}

function obtenerDesMap2(){
  if ($('#sk2').is(":checked")) {
    $('#sk1').attr('disabled', true);
    $('#sk3').attr('disabled', true);
    estadoMap = 2;
  }else{
    if($('#sk2').is(":checked") == false){
      $('#sk1').attr('disabled', false);
      $('#sk3').attr('disabled', false);
      estadoMap = 0;
    } 
  }
}

function obtenerDesMap3(){
  if ($('#sk3').is(":checked")) {
    $('#sk1').attr('disabled', true);
    $('#sk2').attr('disabled', true);
    $("#txtArDescr").prop('disabled',true);
    estadoMap = 3;
  }else{
    if($('#sk3').is(":checked") == false){
      $('#sk1').attr('disabled', false);
      $('#sk2').attr('disabled', false);
      $("#txtArDescr").prop('disabled',false);
      estadoMap = 0;
    } 
  }
}

function obtenerUbicacion(){
  if ("geolocation" in navigator){ 
    navigator.geolocation.getCurrentPosition(function(position){ 
            console.log("Found your location nLat : "+position.coords.latitude+" nLang :"+ position.coords.longitude);
            lat = position.coords.latitude;
            lon = position.coords.longitude;
        });
  }else{
      console.log("Browser doesn't support geolocation!");
  }
}

/* OBTENER POR COORDENADAS */
function obtenerPorCoordenadas(){
  var query = document.getElementById("query").value;
  console.log(query);
  if (/\s*^\-?\d+(\.\d+)?\s*\,\s*\-?\d+(\.\d+)?\s*$/.test(query)) {
    var latlng = parseLatLng(query);
    console.log(latlng);
    if (latlng == null) {
      document.getElementById("query").value = "";
    } else {
      console.log("1");
      reverseGeocode(latlng);
    }
  } else {
    console.log("2");
    forwardGeocode(query);
  }
}

function parseLatLng(value) {
  value.replace('/\s//g');
  var coords = value.split(',');
  var lat = parseFloat(coords[0]);
  var lng = parseFloat(coords[1]);
  if (isNaN(lat) || isNaN(lng)) {
    return null;
  } else {
    return new GLatLng(lat, lng);
  }
}

function reverseGeocode(latlng) {
  var geocoder = initGeocoder(latlng.toUrlValue(6));
  geocoder.getLocations(latlng, function(response) {
    showResponse(response, true);
  });
  map.panTo(latlng);
  map.addOverlay(new GMarker(latlng, { 'icon': reverseIcon })); 
}

function forwardGeocode(address) {
  var geocoder = initGeocoder(address);
  geocoder.getLocations(address, function(response) {
    showResponse(response, false);
  });  
}

function initGeocoder(query) {
  selected = null;
  map.clearOverlays();
  
  var hash = 'q=' + query; 
  var geocoder = new GClientGeocoder();
   
  hashFragment = '#' + escape(hash);
  window.location.hash = escape(hash);
  return geocoder;
}

function showResponse(response, reverse) { 
  if (! response) {
    alert("Geocoder request failed");
  } else { 
    if (response.Status.code == 200) { 
      plotMatchesOnMap(response, reverse);
    } else { 
      document.getElementById("query").value = "";
      if (! reverse) {
        map.setCenter(new GLatLng(0.0, 0.0), 1);
      }
    }
  }
}


function plotMatchesOnMap(response, reverse) {
  var resultCount = response.Placemark.length;
  
  info      = new Array(resultCount);
  details   = new Array(resultCount);
  markers   = new Array(resultCount);
  polylines = new Array(resultCount);
  bounds    = new Array(resultCount);
  
  var icons   = new Array(resultCount);
  var latlngs = new Array(resultCount);
  
  var infoListHtml = "";
  
  for (var i = 0; i < resultCount; i++) {
    icons[i] = new GIcon(G_DEFAULT_ICON);
    icons[i].image = MAPFILES_URL + "marker" + String.fromCharCode(65 + i) + ".png";
    latlngs[i] = new GLatLng(response.Placemark[i].Point.coordinates[1],
                             response.Placemark[i].Point.coordinates[0]);
    markers[i] = new GMarker(latlngs[i], { icon: icons[i] } );
    polylines[i] = getPolyline(response.Placemark[i]);
    bounds[i] = getBounds(response.Placemark[i]);
    /*info[i] = getInfoHtml(response.Placemark[i]);*/
    details[i] = getAddressDetailHtml(response.Placemark[i]);
  } 
  if (! reverse) {
    zoomToBounds(bounds, map);
  }
  for (var i = 0; i < resultCount; i++) {
    map.addOverlay(markers[i]);
    addInfoWindowListener(i, markers[i], details[i]);
  }
  
  GEvent.trigger(markers[0], "click");
}

function getPolyline(placemark) {
  var ne = new GLatLng(placemark.ExtendedData.LatLonBox.north, placemark.ExtendedData.LatLonBox.east);
  var se = new GLatLng(placemark.ExtendedData.LatLonBox.south, placemark.ExtendedData.LatLonBox.east);
  var sw = new GLatLng(placemark.ExtendedData.LatLonBox.south, placemark.ExtendedData.LatLonBox.west);
  var nw = new GLatLng(placemark.ExtendedData.LatLonBox.north, placemark.ExtendedData.LatLonBox.west);
  var polyline = new GPolyline([ne, se, sw, nw, ne], '#ff0000', 2, 1.0);
  return polyline;
}

function getBounds(placemark) {
  var ne = new GLatLng(placemark.ExtendedData.LatLonBox.north, placemark.ExtendedData.LatLonBox.east);
  var sw = new GLatLng(placemark.ExtendedData.LatLonBox.south, placemark.ExtendedData.LatLonBox.west);
  var bounds = new GLatLngBounds(sw, ne);
  return bounds;
}

function getAddressDetailHtml(placemark) {
  return html = '<table class="tabContent">' + getAddressDetailDt(placemark.AddressDetails) + '</table>';
}

function getAddressDetailDt(feature) {
  var html = '';
  for (var key in feature) {
    if (feature[key] instanceof Array) {
      html += tr(key, feature[key][0]);
    } else if (feature[key] instanceof Object) {
      html += getAddressDetailDt(feature[key]);
    } else {
      html += tr(key, feature[key]);
    }
  }
  return html;
}

function tr(key, value) {
  return '<tr><td style="text-align: right; font-weight: bold; vertical-align: top; white-space: nowrap;">' + key + ':</td><td>' + value + '</td></tr>';
}

function addInfoWindowListener(i, marker, details) {
  GEvent.addListener(marker, "click", function() {
    if (selected != null) {
      map.removeOverlay(polylines[selected]);
    }
    var zoomDelta = map.getBoundsZoomLevel(bounds[i]) - map.getZoom();
    if (zoomDelta < 0 || zoomDelta > 5) {
      map.setZoom(map.getBoundsZoomLevel(bounds[i]));
    }
    marker.openInfoWindowHtml(details);
    if (! map.getBounds().containsBounds(bounds[i])) {
      map.zoomOut();
      map.panTo(bounds[i].getCenter());
    }
    map.addOverlay(polylines[i]);
    selected = i;
  });
}

function validarSolicitud(){
  var resp = 0;
  var codsol = $("#codsol").val();
  if(isNaN(codsol) == true){
    resp = 1
  }
  return resp;
}
