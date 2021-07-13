{{>header}}
{{>headerUsuario}}

<div class="w3-container w3-content w3-center w3-padding-64">
    <h1 class="text-center">Vehículos</h1>
    <a href="/logistica/Vehiculos/insertar/"><button type="submit" class="btn btn-primary btn-block mb-3 mt-3">Nuevo Vehiculo</button></a>
    <table class='table table-primary table-hover table-responsive-xs'>
        <tr>
            <th>Id Vehículo</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Patente</th>
            <th>Año fabricación</th>
            <th>Kilometraje</th>
            <th>Chasis</th>
        </tr>

        {{#vehiculos}}
        <tr>
            <td>{{id_Vehiculo}}</td>
            <td>{{marca}}</td>
            <td>{{modelo}}</td>
            <td>{{patente}}</td>
            <td>{{anio_fabricacion}}</td>
            <td>{{kilometraje}}</td>
            <td>{{chasis}}</td>
            <td><a href="/logistica/Vehiculos/editar/id={{id_Vehiculo}}"><button type="submit" class="btn btn-warning ">Modificar</button></a></td>
            <td><a href="/logistica/Vehiculos/borrarVehiculo/id={{id_Vehiculo}}"><button type="submit" class="btn btn-danger ">Borrar</button></a></td>
        </tr>
        {{/vehiculos}}
    </table>

</div>













{{>footer}}
