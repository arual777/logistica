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

                <td><a href="/logistica/Viajes/editarNotificacion/id_Viaje_Detalle={{id_Viaje_Detalle}}&id_viaje={{#id}}{{id}}{{/id}}"><button type="submit" class="btn btn-warning ">Editar</button></a></td>


            </tr>
            {{/viajes}}
        </table>
    </div>

    <div class="container">
        <div class="row align-items-start">
            <div class="col">
                <a href="/logistica/Viajes/listarViajes"><button type="submit" class="btn btn-primary ">Volver</button></a>

            </div>
            <div class="col">
                <a href="/logistica/Viajes/verFormNotificacion/id_viaje={{#id}}{{id}}{{/id}}"><button type="submit" class="btn btn-primary">Crear Notificación</button></a>

            </div>
            <div class="col">
                <form method="post" action="/logistica/Viajes/finalizarViaje">
                    <input type="hidden" name="idViaje" id="idViaje" value="{{#id}}{{id}}{{/id}}"/>
                    <button type="submit" class="btn btn-danger">Finalizar Viaje</button>
                </form>

            </div>
        </div>
    </div>

    <br>
</div>




{{>footer}}
