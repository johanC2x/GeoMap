var asignacion = (() => {

    var self = {
        map: null,
        lat: -12.216222,
        lng: -76.941544,
        name: "Lima Perú",
        op : "",
        current_id:0,
        offset:0,
        limit:50
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
        self.map = null;
        self.map = new google.maps.Map(document.getElementById('map_proyecto'), {
            center: {
                lat: self.lat, 
                lng: self.lng
            },
            zoom: 15
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
        $("#new_proyecto").modal("hide");
        $.blockUI({
            fadeIn: 1000, 
            timeout:   2000, 
            onBlock: function() { 
                if($("#idMap").val() !== ""){
                    self.updateMap();
                }else{
                    self.insertMap();
                }
                self.loadTable();     
            }
        });
    };

    self.insertMap = () => {
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
                    alert("Operación realizada con éxito");
                }else{
                    res_map = obtenerAlert("Se ha producido un error");
                    alert("Se ha producido un error");
                }
                $("#res_map").html(res_map);
            }
        });
    };

    self.updateMap = () => {
        $("#op").val(24);
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
                    alert("Operación realizada con éxito");
                }else{
                    res_map = obtenerAlert("Se ha producido un error");
                    alert("Se ha producido un error");
                }
                $("#idMap").val("");
                $("#res_map").html(res_map);
            }
        });
    };

    self.eliminarMap = () => {
        self.op = 25;
        $.ajax({
            type:"POST",
            data:{
                op : self.op,
                idMap : self.current_id
            },
            async: false,
            url:"../../../controller/MapController.php",
            success:function(msg){
                var res_map = "";
                var response = JSON.parse(msg);
                if(parseInt(response) === 1){
                    self.loadTable();
                }
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
                $("#idMap").val(data[0].idMap);
                self.current_id = data[0].idMap;
                if(is_deleted){
                    var bool = confirm("¿Seguro desea eliminar el siguiente registro?");
                    if(bool){
                        self.eliminarMap();
                    }
                }else{
                    $("#actividad_proyecto").val(data[0].actividad);
                    $("#lat_proyecto").val(parseFloat(data[0].x));
                    $("#long_proyecto").val(parseFloat(data[0].y));
                    $("#codigo_proyecto").val(data[0].solicitud);
                    $("#contratista_proyecto").val(data[0].nombreContratista);
                    $("#cliente_proyecto").val(data[0].cliente);
                    document.getElementById("fecini_proyecto").value = data[0].fechaIni;
                    document.getElementById("fecfin_proyecto").value = data[0].fechafin;
                    $("#direccion_proyecto").val(data[0].dirObra);
                    $("#distrito_proyecto").val(data[0].distrito);
                    $("#access_proyecto").val(data[0].access_code);
                    $("#idUser").val(data[0].idUser);
                    self.lat = parseFloat(data[0].y);
                    self.lng = parseFloat(data[0].x);
                    self.name = data[0].dirObra;
                    self.initMap();
                    $("#new_proyecto").modal("show");
                }
            }
        });
    };

    self.buscarSolicitud = () => {
        self.op = "26";
        $.ajax({
            type:"POST",
            data:{
                op : self.op,
                code : $("#cod_proyecto").val()
            },
            url:"../../../controller/MapController.php",
            success:function(response){
                var data = JSON.parse(response);
                self.obtenerTabla(data);
            }
        });
    };

    self.loadUser = () => {
        $.ajax({
            type:"POST",
            data:{
                op : 8
            },
            async: false,
            url:"../../../controller/UsuarioController.php",
            success:function(response){
                var data = JSON.parse(response);
                var option = '';
                if(data.length > 0){
                    option = '<option>Seleccionar</option>';
                    data.forEach(element => {
                        option += '<option value="'+ element.idusuario +'" >'+ element.nombre + ' ' + element.apepat + ' ' + element.apemat + ' (' + element.usuario + ')' +'</option>';
                    });
                    $("#idUser").append(option);
                }
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
            success:function(response){
                var data = JSON.parse(response);
                self.obtenerTabla(data);
            }
        });
    };

    self.loadTablePage = (num) => {
        switch(num){
            case 'min':
                self.offset = self.offset - 1;
                break;
            case 'max':
                self.offset = self.offset + 1;
                break;
        }
        if(self.offset < 0){
            self.offset = 0;
        }
        self.op = "27";
        $.ajax({
            type:"POST",
            data:{
                op : self.op,
                offset : (self.offset * self.limit)
            },
            url:"../../../controller/MapController.php",
            success:function(response){
                var data = JSON.parse(response);
                self.obtenerTabla(data);
            }
        });
    };

    self.obtenerTabla = (data) => {
        var tbody = '';
        $("#tableMap tbody").empty().append(`<tr>
                                                <td colspan="6">
                                                    <center>
                                                        <img src="../../../../assets/img/ajax_loader.gif"/>
                                                    </center>
                                                </td>
                                            </tr>`);
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
                                    <a href="javascript:void(0);" onclick="asignacion.obtenerPorId(` + data[i].idMap + `,true);">
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
    };

    self.openModal = () => {
        document.getElementById("frm_map").reset();
        if(document.getElementById("fecini_proyecto") !== null){
            document.getElementById("fecini_proyecto").value = moment().format('YYYY-MM-DD');
        }
        if(document.getElementById("fecfin_proyecto") !== null){
            document.getElementById("fecfin_proyecto").value = moment().format('YYYY-MM-DD');
        }
        $("#new_proyecto").modal("show");
    };

    return self;
})();