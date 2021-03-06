{{>header}}
{{>headerUsuario}}

<head>
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

            google.maps.event.addListener(map, "click", function (event) {
                var latitude = event.latLng.lat();
                var longitude = event.latLng.lng();
                document.getElementById("longitud").value = longitude;
                document.getElementById("latitud").value = latitude;
            });

        }
    </script>
</head>
<body onload="loadMap()">

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card-header border border-dark w-50 m-auto bg-white">

<h1>NOTIFICACIONES DEL VIAJE </h1>
<form action="/logistica/viajes/crear/id_viaje={{#id}}{{id}}{{/id}}" method="post">
    <label for="km">Kilometraje:</label>
    <input type="text" name="km" id="km" class="form-control"
           placeholder="Ingrese el kilometraje actual" value="{{#viajes}}{{kilometraje}}{{/viajes}}" required>

    <label for="latitud">Latitud:</label>
    <input type="number" name="latitud" id="latitud" class="form-control"
           placeholder="Ingrese la latitud actual" value="{{#viajes}}{{latitud}}{{/viajes}}" readonly required>

    <label for="latitud">Longitud:</label>
    <input type="number" name="longitud" id="longitud" class="form-control"
           placeholder="Ingrese la longitud actual" value="{{#viajes}}{{longitud}}{{/viajes}}" readonly required>

    <label for="fecha">Fecha de ??ltima actualizaci??n:</label>
    <input type="date" name="fecha" id="fecha" class="form-control"
           placeholder="Ingrese la fecha de hoy " value="{{#viajes}}{{fecha}}{{/viajes}}" required>

    <label for="combustible">Combustible:</label>
    <input type="number" name="combustible" id="combustible" class="form-control"
           placeholder="Ingrese los litros de combustible cargados" value="{{#viajes}}{{combustibleCargado}}{{/viajes}}" required>


    <label for="peajes">Peajes:</label>
    <input type="number" name="peajes" id="peajes" class="form-control"
           placeholder="Ingrese el costo del peaje" value="{{#viajes}}{{peajes}}{{/viajes}}">

    <label for="extras">Extras:</label>
    <input type="text" name="extras" id="extras" class="form-control"
           placeholder="Ingrese los costos extras" value="{{#viajes}}{{extras}}{{/viajes}}">

    <input type="hidden" id="idViaje" name="idViaje" value="{{#id}}{{id}}{{/id}}"/>
    <input type="hidden" id="idViajeDetalle" name="idViajeDetalle" value="{{#idViajeDetalle}}{{idViajeDetalle}}{{/idViajeDetalle}}"/>

    <div id="mapa" style="width:100%; height:400px;" class="mt-3"></div>

    <button class="btn btn-success btn-block mt-3" type="submit">Guardar</button>
</form>

            </div>
        </div>
    </div>
</div>
</body>

{{>footer}}
