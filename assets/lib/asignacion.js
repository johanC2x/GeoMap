var asignacion = (() => {

    var self = {
        map: null,
        lat: -34.397,
        lng: 150.644,
        name: "Lima Perú",
        op : ""
    };

    self.init = () => {
        
    };

    self.loadAutocomplete = () => {
        var input = document.getElementById('direccion_proyecto');
        var autocomplete = new google.maps.places.Autocomplete(input);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            if(place !== undefined){
                $("#lat_proyecto").val(place.geometry.location.lat());
                $("#long_proyecto").val(place.geometry.location.lng());
                self.lat = place.geometry.location.lat();
                self.lng = place.geometry.location.lng();
                self.name = place.name;
                self.initMap();
            }
        });
    };

    self.initMap = () => {
        self.map = new google.maps.Map(document.getElementById('map_proyecto'), {
            center: {
                lat: self.lat, 
                lng: self.lng
            },
            zoom: 8
        });
        var marker = new google.maps.Marker({
            position: {
                lat: self.lat, 
                lng: self.lng
            },
            map: self.map,
            title: self.name
        });
    };

    self.saveMap = () => {
        $.ajax({
            type:"POST",
            data:$("#frm_map").serialize(),
            async: false,
            url:"../../../controller/MapController.php",
            success:function(msg){
                var res_map = "";
                var response = JSON.parse(msg);
                if(parseInt(response) === 1){
                    document.getElementById("frm_map").reset();
                    res_map = obtenerAlert("Operación realizada con éxito");
                }else{
                    res_map = obtenerAlert("Se ha producido un error");
                }
                $("#res_map").html(res_map);
            }
        });
    };

    self.loadTable = () => {
        self.op = "23";
        $.ajax({
            type:"POST",
            data:{
                op : self.op
            },
            async: false,
            url:"../../../controller/MapController.php",
            success:function(msg){
                console.log(msg);
            }
        });
    };

    self.openModal = () => {

    };

    return self;
})();