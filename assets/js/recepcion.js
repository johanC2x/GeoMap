function obtenerTodos(obj){
  var op = 5;
  var html = "";
  $.ajax({
    type:"POST",
    data:{
      op:op
    },
    url:"../../../controller/MapController.php",
    success:function(msg){
      var mapa = JSON.parse(msg);
      html += "<table id='tableMap' class='table table-striped table-bordered table-hover' style='background-color:white'>";
        html += "<thead>";
          html += "<tr>";
            html += "<th>Codigo</th>";
            html += "<th>Actividad</th>";
            html += "<th>Contratista</th>";
            html += "<th>Cliente</th>";
            html += "<th>Dirección</th>";
            html += "<th>Liquidador</th>";
            html += "<th>Distrito</th>";
            html += "<th>Técnico</th>";
            html += "<th>Fecha Venc.</th>";
            html += "<th>Mes</th>";
          html += "</tr>";
        html += "</thead>";
        html += "<tbody class='bodyTable'>";
          for(var i=0;i<mapa.length;i++){
            html += "<tr>";
              html += "<td>"+mapa[i].solicitud+"</td>";
              html += "<td>"+mapa[i].actividad+"</td>";
              html += "<td>"+mapa[i].nombreContratista+"</td>";
              html += "<td>"+mapa[i].cliente+"</td>";
              html += "<td>"+mapa[i].dirObra+"</td>";
              html += "<td>"+mapa[i].rolLiquidador+"</td>";
              html += "<td>"+mapa[i].distrito+"</td>";
              html += "<td>"+mapa[i].tecnico+"</td>";
              html += "<td>"+mapa[i].finReal+"</td>";
              html += "<td>"+mapa[i].mes+"</td>";
            html += "</tr>";
          }
        html += "</tbody>";
      html += "</html>";
      $("#"+obj).html(html);
      $('#'+obj).paging({limit:15});
    }
  });
}

var file = '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';

function loadFile() {
    var obj = xlsx(file);
    $('#output').text(JSON.stringify(obj));
}

function cargarExcel(){
  var xlsx = $("#xlsx").val();
  console.log(xlsx);
}

function subirExcelDatos(){
  var op = 1;
  var xlsx = document.getElementById("xlsx");
  var file = xlsx.files[0];
  var data = new FormData();
  data.append('op',op);
  data.append('archivo',file);
  $.ajax({
    type:'POST',
    data:data, 
    url:"../../../controller/DocumentoController.php",
    contentType:false,
    processData:false,
    cache:false,
    success:function(msg){
      console.log(msg);
      /*
      if(msg == "1"){
        obtenerTodos("tableRecep");
      }else{
        if(msg == "0"){
          var msg = obtenerAlert("Ha ocurrido un error por favor verifique");
          $("#msg").html(msg);
        }
      }
      */
    }
  });
}

function actualizarMapXlsx(){
  var op = 10;
  var html = "";
  $.ajax({
    type:"POST",
    data:{
      op:op
    },
    url:"../../../controller/MapController.php",
    success:function(msg){
      console.log(msg);
      if(msg == "1"){
        obtenerTodos("tableRecep");
      }else{
        var msg = obtenerAlert("Ha ocurrido un error por favor verifique");
        $("#msg").html(msg);
      }
    }
  });
}









