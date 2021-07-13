{{>header}}
{{>headerUsuario}}


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

            {{#viajes}}
            <tr>
                <td>{{id_viaje}}</td>
                <td>{{kilometraje}}</td>
                <td>{{latitud}}</td>
                <td>{{longitud}}</td>
                <td>{{fecha}}</td>
                <td>{{combustibleCargado}}</td>
                <td>{{peajes}}</td>
                <td>{{extras}}</td>

            </tr>
            {{/viajes}}
        </table>
    </div>

    <div class="text-center">
        <a href="/logistica/Viajes/listarViajes"><button type="submit" class="btn btn-primary ">Volver</button></a>
        <a href="/logistica/Viajes/verFormNotificacion/id_viaje={{#id}}{{id}}{{/id}}" ><button type="submit" class="btn btn-primary">Crear Notificación</button></a>
    </div>

    <br>
</div>




{{>footer}}
