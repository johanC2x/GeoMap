var asignacion = (() => {

    var self = {
        map: null,
        lat: -34.397,
        lng: 150.644,
        name: "Lima Perú"
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
                console.log(msg);
            }
        });
    };

    self.openModal = () => {

    };

    return self;
})();