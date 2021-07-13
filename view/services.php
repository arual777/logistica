{{>header}}
{{>headerUsuario}}

<div class="w3-container w3-content w3-center w3-padding-64">
    <h1 class="text-center">Services</h1>
    <a href="/logistica/Service/insertar/"><button type="submit" class="btn btn-primary btn-block mb-3 mt-3">Nuevo service</button></a>
    <table class='table table-primary table-hover table-responsive-xs'>
        <tr>
            <th>Id service</th>
            <th>Id vehículo</th>
            <th>Id usuario</th>
            <th>Id tipo service</th>
            <th>Fecha</th>
            <th>Kilometraje</th>
            <th>Repuestos cambiados</th>
        </tr>

        {{#services}}
        <tr>
            <td>{{id_Service}}</td>
            <td>{{id_Vehiculo}}</td>
            <td>{{id_Usuario}}</td>
            <td>{{id_TipoService}}</td>
            <td>{{fecha}}</td>
            <td>{{kilometraje}}</td>
            <td>{{repuestos_cambiados}}</td>
            <td><a href="/logistica/Service/editarService/id={{id_Service}}"><button type="submit" class="btn btn-warning ">Modificar</button></a></td>
            <td><a href="/logistica/Service/borrarService/id={{id_Service}}"><button type="submit" class="btn btn-danger ">Borrar</button></a></td>
        </tr>
        {{/services}}
    </table>

</div>

{{>footer}}

