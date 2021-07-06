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
        </tr>
        {{#proformas}}
        <tr>
            <td>{{id_factura}}</td>
            <td>{{fecha}}</td>
            <td>{{denominacion_cliente}}</td>

        </tr>
        {{/proformas}}
    </table>
</div>
{{> footer}}