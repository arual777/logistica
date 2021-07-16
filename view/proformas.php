{{> header}}
{{>headerUsuario}}
<div>
    <h2>Proformas</h2>
    <a class="btn btn-success" href="/logistica/proforma/formularioProforma" role="button">
        Crear
    </a>
    <table class="table table-striped">
        <tr>
            <th scope="col">Proforma Numero</th>
            <th scope="col">Fecha</th>
            <th scope="col">Cliente</th>
            <th scope="col">Acciones</th>
            <th scope="col"></th>
        </tr>
        {{#proformas}}
        <tr>
            <td>{{id_factura}}</td>
            <td>{{fecha}}</td>
            <td>{{denominacion_cliente}}</td>
            <td><a href="/logistica/Proforma/detalleProforma/id={{id_factura}}" ><button type="submit" class="btn btn-primary">Detalle proforma</button></a></td>
            <td><a href="/logistica/Viajes/detalleViaje/id={{id_viaje}}" ><button type="submit" class="btn btn-primary">Detalle viaje</button></a></td>
        </tr>
        {{/proformas}}
    </table>
</div>


<br><br><br><br><br>
{{> footer}}