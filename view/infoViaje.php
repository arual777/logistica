{{>header}}
{{>headerUsuario}}
<script src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyAiq3xISXSZYgkd9GDAOdajy4NK2d3L7dY"></script>
<script>
    function loadMap() {

        var mapOptions = {
            center:new google.maps.LatLng(-34.6686986,-58.5614947),
            zoom:12,
            panControl: false,
            zoomControl: false,
            scaleControl: false,
            mapTypeControl:false,
            streetViewControl:true,
            overviewMapControl:true,
            rotateControl:true,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };

        var map = new google.maps.Map(document.getElementById("mapa"),mapOptions);

        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(-34.6686986,-58.5614947),
            map: map,
            draggable:true,
            icon:'/imagenes/logo_unlam.png'
        });

        google.maps.event.addListener(map, "rightclick", function(event) {
            var lat = event.latLng.lat();
            var lng = event.latLng.lng();
            alert("Lat=" + lat + "; Lon=" + lng);
        });

    }
</script>
<div class="w3-container w3-content w3-center w3-padding-64">


    <div>
        <h1 class="text-black font-italic display-4 text-center">

            {{#usuario}}
            <tr>
                <td>{{nombre}}</td>
                <td>{{apellido}}</td>
            </tr>
            {{/usuario}}

        </h1>
        <table class='table table-primary table-hover table-responsive-xs'>
            <tr>
                <th>Id Viaje</th>
                <th>Kilometraje</th>
                <th>Latitud</th>
                <th>Longitud</th>
                <th>Fecha</th>
                <th>Combustible cargado</th>
                <th>Peajes</th>
                <th>Extras</th>
            </tr>

            {{#viaje}}
            <tr>
                <td>{{id_viaje}}</td>
                <td>{{kilometraje}}</td>
                <td>{{latitud}}</td>
                <td>{{longitud}}</td>
                <td>{{fecha}}</td>
                <td>{{combustibleCargado}}</td>
                <td>{{peajes}}</td>
                <td>{{extras}}</td>
                <td><button type="button" class="btn btn-warning" data-toggle="modal"
                            data-target="#mimodal">Actualizar</button></td>
                <!--El modal -->
                <div class="modal fade" id="mimodal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- header o cabecera -->
                            <div class="modal-header">
                                <h4 class="modal-title">Viaje: {{id_viaje}}</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body" onload="loadMap()">
                                <div id="mapa" style="width:500px; height:400px;"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success" >Actualizar</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </tr>
            {{/viaje}}

        </table>

    </div>


    <div class="text-center">
        <a href="/logistica/Viajes/listarViajes"><button type="submit" class="btn btn-primary ">Volver</button></a>
    </div>

    <br>
</div>



{{>footer}}
