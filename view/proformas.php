{{> header}}
{{>headerUsuario}}
<div>
    <h2>Proformas</h2>
    <a class="btn btn-success" href="/logistica/proforma/crear" role="button">
        Crear
    </a>
    <table class="table table-striped">
        <tr>
            <th scope="col">Proforma Numero</th>
            <th scope="col">Importe</th>
        </tr>
        {{#proformas}}
        <tr>
            <td>{{id_factura}}</td>
            <td>{{importe}}</td>
        </tr>
        {{/proformas}}
    </table>
</div>
{{> footer}}