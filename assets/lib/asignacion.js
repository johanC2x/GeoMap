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

    self.obtenerPorId = (idMap,is_deleted) => {
        self.op = "4";
        $.ajax({
            type:"POST",
            data:{
                op : self.op,
                idMap:idMap
            },
            url:"../../../controller/MapController.php",
            success:function(response){
                var data = JSON.parse(response);
                $("#actividad_proyecto").val(data[0].actividad);
                $("#lat_proyecto").val(parseFloat(data[0].x));
                $("#long_proyecto").val(parseFloat(data[0].y));
                $("#codigo_proyecto").val(data[0].solicitud);
                $("#contratista_proyecto").val(data[0].nombreContratista);
                $("#cliente_proyecto").val(data[0].cliente);
                //$("#fecini_proyecto").val(data[0].y);
                //$("#fecfin_proyecto").val(data[0].y);
                $("#direccion_proyecto").val(data[0].dirObra);
                $("#distrito_proyecto").val(data[0].distrito);

                self.lat = data[0].x;
                self.lng = data[0].y;
                self.name = data[0].dirObra;
                self.initMap();

                $("#new_proyecto").modal("show");

            }
        });
        if(is_deleted){
            
        }
    };

    self.loadTable = () => {
        $("#tableMap tbody").empty().append(`<tr>
                                        <td colspan="6">
                                            <center>
                                                <img src="../../../../assets/img/ajax_loader.gif"/>
                                            </center>
                                        </td>
                                    </tr>`);
        self.op = "23";
        $.ajax({
            type:"POST",
            data:{
                op : self.op
            },
            async: false,
            url:"../../../controller/MapController.php",
            success:function(response){
                var tbody = '';
                var data = JSON.parse(response);
                if(data.length > 0){
                    for(var i = 0;i < data.length;i++){
                        tbody += `<tr>
                                    <td><center>`  + data[i].solicitud + `</center></td>
                                    <td><center>`  + data[i].cliente + `</center></td>
                                    <td><center>`  + data[i].nombreContratista + `</center></td>
                                    <td><center>`  + data[i].actividad + `</center></td>
                                    <td><center>`  + data[i].dirObra + `</center></td>
                                    <td>
                                        <center>
                                            <a href="javascript:void(0);" onclick="asignacion.obtenerPorId(` + data[i].idMap + `,false);">
                                                <img src="../../../../assets/img/edit.gif" style="width:15px;">
                                            </a>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="javascript:void(0);" onclick="asignacion.obtenerPorId(` + data[i].idMap + `,false);">
                                                <img src="../../../../assets/img/cancelar.png" style="width:15px;">
                                            </a>
                                        </center>
                                    </td>
                                </tr>`;
                    }
                    if(tbody !== ''){
                        $("#tableMap tbody").empty().append(tbody);
                    }else{
                        $("#tableMap tbody").empty().append(`<tr>
                                                                <td colspan="6">
                                                                    No se encontraron resultados
                                                                </td>
                                                            </tr>`);
                    }
                }
            }
        });
    };

    self.openModal = () => {

    };

    return self;
})();