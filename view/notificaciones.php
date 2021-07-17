{{> header}}
{{>headerUsuario}}
<div>
    <h2> Notificaciones del viaje en curso</h2>
    <a class="btn btn-success" href="/logistica/viajes/crear" role="button">
        Crear
    </a>
    <table class="table table-striped">
        <tr>
            <th scope="col"> Número de notificación</th>
            <th scope="col">Código de Viaje</th>
            <th scope="col">Kilometraje</th>
            <th scope="col">Latitud</th>
            <th scope="col">Longitud</th>
            <th scope="col">Fecha</th>
            <th scope="col">Combustible</th>
            <th scope="col">Peajes</th>
            <th scope="col">Extras</th>
        </tr>
        {{#notificaciones}}
        <tr>
            <td>{{id_Viaje_Detalle}}</td>
            <td>{{id_viaje}}</td>
            <td>{{kilometraje}}</td>
            <td>{{latitud}}</td>
            <td>{{longitud}}</td>
            <td>{{fecha}}</td>
            <td>{{combustibleCargado}}</td>
            <td>{{peajes}}</td>
            <td>{{extras}}</td>
        </tr>
        {{/notificaciones}}
    </table>
</div>


<br><br><br><br><br>
{{> footer}}
