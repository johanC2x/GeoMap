<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<div id="distancia">La distancia hasta el punto es: <span> </span>pixeles.</div>
	<br />
	<div id="texto">
	  <h4>Partiendo del punto de partida que es el 0 de color naranja</h4>
	  <p>Un ejemplo seria calcular la distancia desde el punto que es el 0 de color naranja hasta una caja azul con circulo blanco: </p>
	</div>
	<div id="elemento">0</div> 
	 <!-- /widget-header -->
    <div class="widget-content">
        <canvas id="bar-chart" class="chart-holder" width="538" height="250">
        </canvas>
        <!-- /bar-chart -->
    </div>
    <!-- /widget-content -->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAjU0EJWnWPMv7oQ-jjS7dYxSPW5CJgpdgO_s4yyMovOaVh_KvvhSfpvagV18eOyDWu7VytS6Bi1CWxw" type="text/javascript"></script>
	<script type="text/javascript" src="../../../../assets/js/chart.min.js"></script>
	<script type="text/javascript">
		if ("geolocation" in navigator){ 
		    navigator.geolocation.getCurrentPosition(function(position){ 
		            console.log("Found your location nLat : "+position.coords.latitude+" nLang :"+ position.coords.longitude);
		        });
		}else{
		    console.log("Browser doesn't support geolocation!");
		}
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			var sevilla = new google.maps.LatLng(-11.947510, -76.729051);
			var buenos_aires = new google.maps.LatLng(-11.947510, -76.729051);  
			var distancia = google.maps.geometry.spherical.computeDistanceBetween(sevilla, buenos_aires);
			alert(distancia);
		}); 
	</script>
	<script type="text/javascript">
	var barChartData = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [
			{
			    fillColor: "rgba(220,220,220,0.5)",
			    strokeColor: "rgba(220,220,220,1)",
			    data: [65, 59, 90, 81, 56, 55, 40]
			},
			{
			    fillColor: "rgba(151,187,205,0.5)",
			    strokeColor: "rgba(151,187,205,1)",
			    data: [28, 48, 40, 19, 96, 27, 100]
			},
            {
                fillColor: "rgba(151,187,205,0.5)",
                strokeColor: "rgba(151,187,205,1)",
                data: [50, 50, 50, 50, 50, 50, 50]
            }
		]

    }
	var myLine = new Chart(document.getElementById("bar-chart").getContext("2d")).Bar(barChartData);
	</script>
</body>
</html>