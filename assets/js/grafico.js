var listaSolicitudes = [];

/* DATOS PENDIENTES */
var eneroPend = 0;
var febreroPend = 0;
var marzoPend = 0;
var abrilPend = 0;
var mayoPend = 0;
var junioPend = 0;
var julioPend = 0;
var agostoPend = 0;
var setiembrePend = 0;
var octubrePend = 0;
var noviembrePend = 0;
var diciembrePend = 0;


/* DATOS ACTIVOS */
var eneroAct = 0;
var febreroAct = 0;
var marzoAct = 0;
var abrilAct = 0;
var mayoAct = 0;
var junioAct = 0;
var julioAct = 0;
var agostoAct = 0;
var setiembreAct = 0;
var octubreAct = 0;
var noviembreAct = 0;
var diciembreAct = 0;

/* DATOS TERMINADOS */
var eneroTer = 0;
var febreroTer = 0;
var marzoTer = 0;
var abrilTer = 0;
var mayoTer = 0;
var junioTer = 0;
var julioTer = 0;
var agostoTer = 0;
var setiembreTer = 0;
var octubreTer = 0;
var noviembreTer = 0;
var diciembreTer = 0;

/* CONSTANTES  */
var anioIni = 2014;
var anioDef = 2016;
var anioFin = 2025;
var listaAnio = [];

function initGrafica(){
	obtenerListaAnios();
	$("#cboAnioGraf").val(anioDef);
}

function obtenerListaAnios(){
	for (var i = anioIni; i < anioFin; i++) {
		listaAnio.push({
			"anio":anioIni
		});
	}
	if(listaAnio.length != 0){
		$('#cboAnioGraf').append($('<option>', { 
	        value: null,
	        text : 'Seleccionar Año'
	    }));
		for (var i = 0; i < listaAnio.length; i++) {
			$('#cboAnioGraf').append($('<option>', { 
		        value: i + anioIni,
		        text : i + anioIni
		    }));
		}
	}
}

function filtrarGrafica(){
	if($("#cboAnioGraf").val() != 0){
		obtenerTableGrafica();
		obtenerGrafica();
	}
}

function obtenerTableGrafica(){
	var op = 20;
	var cboAnioGraf = $("#cboAnioGraf").val();
	var html = "";
	$.ajax({
		type:"POST",
		data:{
			op:op,
			cboAnioGraf:cboAnioGraf
		},
		url:"../../../controller/MapController.php",
		success:function(msg){
			console.log(msg);
			var mapa = JSON.parse(msg);
			if(mapa.length != 0){
				html += "<table id='tableMap' class='table table-striped table-bordered table-hover' style='background-color:white'>";
		            html += "<thead>";
		              html += "<tr>";
		                html += "<th class='tr-center'>Descripción</th>";
		                html += "<th class='tr-center'>Enero</th>";
		                html += "<th class='tr-center'>Febrero</th>";
		                html += "<th class='tr-center'>Marzo</th>";
		                html += "<th class='tr-center'>Abril</th>";
		                html += "<th class='tr-center'>Mayo</th>";
		                html += "<th class='tr-center'>Junio</th>";
		                html += "<th class='tr-center'>Julio</th>";
		                html += "<th class='tr-center'>Agosto</th>";
		                html += "<th class='tr-center'>Setiembre</th>";
		                html += "<th class='tr-center'>Octubre</th>";
		                html += "<th class='tr-center'>Noviembre</th>";
		                html += "<th class='tr-center'>Diciembre</th>";
		              html += "</tr>";
		            html += "</thead>";
		            html += "<tbody class='bodyTable'>";
		              for(var i=0;i<mapa.length;i++){
		                html += "<tr>";
			                html += "<td class='font-min'>"+mapa[i].datad+"</td>";
			                html += "<td class='font-min'>"+mapa[i].Enero+"</td>";
			                html += "<td class='font-min'>"+mapa[i].Febrero+"</td>";
			                html += "<td class='font-min'>"+mapa[i].Marzo+"</td>";
			                html += "<td class='font-min'>"+mapa[i].Abril+"</td>";
			                html += "<td class='font-min'>"+mapa[i].Mayo+"</td>";
			                html += "<td class='font-min'>"+mapa[i].Junio+"</td>";
			                html += "<td class='font-min'>"+mapa[i].Julio+"</td>";
			                html += "<td class='font-min'>"+mapa[i].Agosto+"</td>";
			                html += "<td class='font-min'>"+mapa[i].Setiembre+"</td>";
			                html += "<td class='font-min'>"+mapa[i].Octubre+"</td>";
			                html += "<td class='font-min'>"+mapa[i].Noviembre+"</td>";
			                html += "<td class='font-min'>"+mapa[i].Diciembre+"</td>";
		                html += "</tr>";
		              }
		            html += "</tbody>";
		        html += "</table>";
		        $("#tableMap").html(html);
			} 
		}
	});
}

function obtenerGrafica(){
	var op = 20;
	var cboAnioGraf = $("#cboAnioGraf").val();
	$.ajax({
		type:"POST",
		data:{
			op:op,
			cboAnioGraf:cboAnioGraf
		},
		url:"../../../controller/MapController.php",
		success:function(msg){
			console.log(msg);
			var mapa = JSON.parse(msg);
			if(mapa.length != 0){
				for(var i=0;i<mapa.length;i++){
					listaSolicitudes.push({
						'Enero':mapa[i].Enero,
						'Febrero':mapa[i].Febrero,
						'Marzo':mapa[i].Marzo,
						'Abril':mapa[i].Abril,
						'Mayo':mapa[i].Mayo,
						'Junio':mapa[i].Junio,
						'Julio':mapa[i].Julio,
						'Agosto':mapa[i].Agosto,
						'Setiembre':mapa[i].Setiembre,
						'Octubre':mapa[i].Octubre,
						'Noviembre':mapa[i].Noviembre,
						'Diciembre':mapa[i].Diciembre
					});
					if (i==0){
						eneroPend = mapa[i].Enero;
						febreroPend = mapa[i].Febrero;
						marzoPend = mapa[i].Marzo;
						abrilPend = mapa[i].Abril;
						mayoPend = mapa[i].Mayo;
						junioPend = mapa[i].Junio;
						julioPend = mapa[i].Julio;
						agostoPend = mapa[i].Agosto;
						setiembrePend = mapa[i].Setiembre;
						octubrePend = mapa[i].Octubre;
						noviembrePend = mapa[i].Noviembre;
						diciembrePend = mapa[i].Diciembre;
					} else if (i==1){
						eneroAct = mapa[i].Enero;
						febreroAct  = mapa[i].Febrero;
						marzoAct  = mapa[i].Marzo;
						abrilAct  = mapa[i].Abril;
						mayoAct  = mapa[i].Mayo;
						junioAct  = mapa[i].Junio;
						julioAct  = mapa[i].Julio;
						agostoAct  = mapa[i].Agosto;
						setiembreAct  = mapa[i].Setiembre;
						octubreAct  = mapa[i].Octubre;
						noviembreAct  = mapa[i].Noviembre;
						diciembreAct  = mapa[i].Diciembre;
					} else if (i==2){
						eneroTer  = mapa[i].Enero;
						febreroTer  = mapa[i].Febrero;
						marzoTer  = mapa[i].Marzo;
						abrilTer  = mapa[i].Abril;
						mayoTer  = mapa[i].Mayo;
						junioTer  = mapa[i].Junio;
						julioTer  = mapa[i].Julio;
						agostoTer  = mapa[i].Agosto;
						setiembreTer  = mapa[i].Setiembre;
						octubreTer  = mapa[i].Octubre;
						noviembreTer  = mapa[i].Noviembre;
						diciembreTer  = mapa[i].Diciembre;
					} 
				}
			}
			/* OBTENER GRAFICA */
			var barChartData = {
			    labels: ["Enero", "Febrero", "Marzo", "Abril", "Maya", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre"],
			    datasets: [
					{
					    fillColor: "rgba(220,220,220,0.5)",
					    strokeColor: "rgba(220,220,220,1)",
					    data: [
					    		eneroPend,
					    		febreroPend, 
					    		marzoPend, 
					    		abrilPend, 
					    		mayoPend, 
					    		junioPend, 
					    		julioPend,
					    		agostoPend,
					    		setiembrePend,
					    		octubrePend,
					    		noviembrePend,
					    		diciembrePend
					    	]
					},
					{
					    fillColor: "rgba(151,187,205,0.5)",
					    strokeColor: "rgba(151,187,205,1)",
					    data: [
					    		eneroAct ,
					    		febreroAct , 
					    		marzoAct , 
					    		abrilAct , 
					    		mayoAct , 
					    		junioAct , 
					    		julioAct ,
					    		agostoAct ,
					    		setiembreAct ,
					    		octubreAct ,
					    		noviembreAct ,
					    		diciembreAct 
					    	]
					},
			        {
			            fillColor: "rgba(154,182,205,0.5)",
			            strokeColor: "rgba(152,183,204,1)",
			            data: [
					    		eneroTer ,
					    		febreroTer , 
					    		marzoTer , 
					    		abrilTer , 
					    		mayoTer ,
					    		junioTer , 
					    		julioTer ,
					    		agostoTer ,
					    		setiembreTer ,
					    		octubreTer ,
					    		noviembreTer ,
					    		diciembreTer 
					    	]
			        }
				]
			}
			var myLine = new Chart(document.getElementById("bar-chart").getContext("2d")).Bar(barChartData);
		}
	}); 
}

function obtenerFechaActual(){
	var hoy = new Date();
    var dd = hoy.getDate();
    var mm = hoy.getMonth() + 1;
    var yyyy = hoy.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }
    hoy = mm + '/' + dd + '/' + yyyy;
    return hoy;
}

function obtenerPDF(){
	var fecha = obtenerFechaActual();
	var docDefinition = {
	content: [
			{ text: 'Fecha de Impresión: ' + fecha, style: 'anotherStyle'},
			{ text: '                                                  ', style: 'center' },
			{ text: 'REPORTE DE ESTADO DE SOLICITUDES', style: 'header' },
			{ text: '                                                  ', style: 'center' }, 
			{ text: '                                                  ', style: 'center' },
			{
			columns: [
		        { 
		          width: 'auto',
		          text: 'Enero'
		        },
		        { 
		          width: 'auto',
		          text: 'Febrero'
		        },
		        { 
		          width: 'auto',
		          text: 'Marzo'
		        },
		        { 
		          width: 'auto',
		          text: 'Abril'
		        },
		        { 
		          width: 'auto',
		          text: 'Mayo'
		        },
		        { 
		          width: 'auto',
		          text: 'Junio'
		        },
		        { 
		          width: 'auto',
		          text: 'Julio'
		        },
		        { 
		          width: 'auto',
		          text: 'Agosto'
		        },
		        { 
		          width: 'auto',
		          text: 'Setiembre'
		        },
		        { 
		          width: 'auto',
		          text: 'Octubre'
		        },
		        { 
		          width: 'auto',
		          text: 'Noviembre'
		        },
		        { 
		          width: 'auto',
		          text: 'Diciembre'
		        }
		      ], 
		      columnGap: 6
		    },
		], 
		styles: {
			header: {
				fontSize: 22,
				bold: true,
				alignment: 'center'
			},
			center: {
				fontSize: 18,
				alignment: 'center'	
			},
			anotherStyle: {
				italic: true,
				alignment: 'right'
			},
			space: {
				  bottom: 'pre'
			}
		}
	};
	pdfMake.createPdf(docDefinition).open();
}