{{>header}}
{{>headerUsuario}}

<div class="w3-container w3-content w3-center w3-padding-64">
    <h1 class="text-center">Viajes</h1>

    <table class='table table-primary table-hover table-responsive-xs'>
        <tr>
            <th>Id viaje</th>
            <th>Id usuario</th>
            <th>Id carga</th>
            <th>Origen</th>
            <th>Destino</th>
            <th>Fecha carga</th>
            <th>Fecha llegada</th>
        </tr>

        {{#viajes}}
        <tr>
            <td>{{id_viaje}}</td>
            <td>{{id_Usuario}}</td>
            <td>{{id_Carga}}</td>
            <td>{{origen}}</td>
            <td>{{destino}}</td>
            <td>{{fecha_Carga}}</td>
            <td>{{tiempo_estimadoLlegada}}</td>
            <td><a href="" ><button type="submit" class="btn btn-primary">Info</button></a></td>
            <td><a href=""><button type="submit" class="btn btn-warning ">Modificar</button></a></td>
            <td><a href=""><button type="submit" class="btn btn-danger ">Borrar</button></a></td>
        </tr>
        {{/viajes}}
    </table>

</div>



{{>footer}}
