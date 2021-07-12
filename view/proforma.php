{{> header}}
{{>headerUsuario}}

<h1>PROFORMA</h1>
<form action="/logistica/proforma/crear" method="post">

    <h3> Cliente </h3>
    <label for="denominacion">Denominación:</label>
    <input type="text" name="denominacion" id="denominacion" class="form-control"
           placeholder="Ingrese la denominación del cliente" value="{{#proforma}}{{denominacion_cliente}}{{/proforma}}" required>

    <label for="cuit">Cuit:</label>
    <input type="number" name="cuit" id="cuit" class="form-control"
           placeholder="Ingrese el CUIT del cliente" value="{{#proforma}}{{cuit}}{{/proforma}}" required>

    <label for="tele">Teléfono:</label>
    <input type="number" name="telefono" id="telefono" class="form-control"
           placeholder="Ingrese el teléfono del cliente" value="{{#proforma}}{{telefono}}{{/proforma}}" required>

    <label for="mail">Email:</label>
    <input type="email" name="mail" id="mail" class="form-control"
           placeholder="Ingrese el email del cliente" value="{{#proforma}}{{mail}}{{/proforma}}" required>

    <label for="contacto">Contacto:</label>
    <input type="number" name="contacto" id="contacto" class="form-control"
           placeholder="Ingrese un contacto del cliente" value="{{#proforma}}{{contacto}}{{/proforma}}" required>

    <h3>Viaje </h3>
    <label for="origen">Origen:</label>
    <input type="text" name="origen" id="origen" class="form-control"
           placeholder="Ingrese el origen del viaje" value="{{#proforma}}{{origen}}{{/proforma}}">

    <label for="destino">Destino:</label>
    <input type="text" name="destino" id="destino" class="form-control"
           placeholder="Ingrese el destino del viaje" value="{{#proforma}}{{destino}}{{/proforma}}">

    <label for="fechaCarga">Fecha de carga:</label>
    <input type="date" name="fechaCarga" id="fechaCarga" class="form-control" placeholder="Fecha"
           value="{{#proforma}}{{fecha_carga}}{{/proforma}}">

    <label for="llegada">Tiempo estimado de llegada:</label>

    <input type="date" name="llegada" id="llegada" class="form-control" placeholder="Fecha"
           value="{{#proforma}}{{tiempo_estimadoLlegada}}{{/proforma}}">
    
    <h3> Vehículo </h3>
    <label for="vehiculo">Denominación:</label>
    <select name="vehiculo" id="vehiculo">
        {{#vehiculo}}
        <option value="{{id_vehiculo}}">{{patente}} - {{marca}} - {{modelo}}</option>
        {{/vehiculo}}
    </select>

    <h3> Vehículo De Arrastre </h3>
    <label for="arrastre">Denominación:</label>
    <select name="arrastre" id="arrastre">
        {{#arrastre}}
        <option value="{{id_vehiculo}}">{{chasis}} - {{patente}} - {{descripcion}}</option>
        {{/arrastre}}
    </select>

    <h3> Carga</h3>


    <p>Tipo de carga:</p>
    <label for="tipoCarga"></label>
    <select name="tipoCarga" id="tipoCarga">
        {{#tipoCarga}}
        <option value="{{id_TipoCarga}}">{{descripcion}}</option>
        {{/tipoCarga}}

    </select>
    <br>
    <label for="peso">Peso neto:</label>
    <input type="number" name="peso" id="peso" class="form-control"
           placeholder="Ingrese el peso neto de la carga" value="{{#proforma}}{{peso}}{{/proforma}}">

    <label for="tipoHazard"> Carga peligrosa</label>
    <select name="tipoHazard" id="tipoHazard">
        {{#tipoHazard}}
        <option value="{{id_TipoHazard}}">{{descripcion}} </option>
        {{/tipoHazard}}
    </select>

    <br>
    <label for="refrigeracion">¿Requiere refrigeración?</label>
    <input type="radio" name="refrigeracion" id="refrigeracion" value=1 class="mt-3 mb-3" checked
           value="{{#proforma}}{{refrigeracion}}{{/proforma}}">SI
    <input type="radio" name="refrigeracion" id="refrigeracion" value=0 class="mt-3 mb-3"
           value="{{#proforma}}{{refrigeracion}}{{/proforma}}">NO<br>

    <p>Graduación:</p>
    <input type="number" name="graduacion" id="graduacion" class="form-control"
           placeholder="Ingrese la graduación requerida de la refrigeración" value="{{#proforma}}{{graduacion}}{{/proforma}}">

    <h3> Costos Estimados</h3>

    <label for="km">kilómetros:</label>
    <input type="number" name="km" id="km" class="form-control"
           placeholder="Ingrese los kilómetros estimados del trayecto" value="{{#proforma}}{{kilometros_estimados}}{{/proforma}}">

    <label for="combustible">Combustible:</label>
    <input type="number" name="combustible" id="combustible" class="form-control"
           placeholder="Ingrese el combustible requerido para el trayecto" value="{{#proforma}}{{combustible_litros_estimados}}{{/proforma}}">

    <label for="viatico">Viáticos:</label>
    <input type="number" name="viatico" id="viatico" class="form-control" placeholder="Ingrese los viáticos estimados"
                        value="{{#proforma}}{{costo_viaticos}}{{/proforma}}">

    <label for="peaje">Peajes y pesajes:</label>
    <input type="number" name="peaje" id="peaje" class="form-control"
           placeholder="Ingrese los costos totales de peajes-pesajes" value="{{#proforma}}{{costo_peajes}}{{/proforma}}">

    <label for="haz">Peligrosidad:</label>
    <input type="number" name="costoHazard" id="costoHazard" class="form-control"
           placeholder="Ingrese el costo por carga peligrosa" value="{{#proforma}}{{costo_peligroso}}{{/proforma}}">

    <label for="ref">Refrigeración:</label>
    <input type="number" name="costoRefrigeracion" id="costoRefrigeracion" class="form-control"
           placeholder="Ingrese el costo por refrigeración" value="{{#proforma}}{{costo_refrigeracion}}{{/proforma}}">

    <label for="tarifa">Tarifa:</label>
    <input type="number" name="tarifa" id="tarifa" class="form-control"
           placeholder="Ingrese la tarifa actual de la empresa" value="{{#proforma}}{{tarifa}}{{/proforma}}">

    <h3> Personal asignado</h3>
    <label for="chofer">Chofer:</label>
    <select name="chofer">
        {{#choferes}}
        <option value="{{ID_USUARIO}}">{{NOMBRE}} {{APELLIDO}}</option>
        {{/choferes}}
    </select>
    <button class="btn btn-success" type="submit">Guardar</button>

    <input type="hidden" id="vehiculoH" value="{{#proforma}}{{id_vehiculo}}{{/proforma}}"/>
    <input type="hidden" id="arrastreH" value="{{#proforma}}{{id_arrastre}}{{/proforma}}"/>
    <input type="hidden" id="cargaH" value="{{#proforma}}{{id_TipoCarga}}{{/proforma}}"/>
    <input type="hidden" id="cargaPeligrosaH" value="{{#proforma}}{{id_TipoHazard}}{{/proforma}}"/>
    <input type="hidden" id="factura" name="factura" value="{{#proforma}}{{id_factura}}{{/proforma}}"/>
    <input type="hidden" id="viaje" name="viaje" value="{{#proforma}}{{id_viaje}}{{/proforma}}"/>
    <input type="hidden" id="carga" name="carga" value="{{#proforma}}{{id_carga}}{{/proforma}}"/>
</form>

<script>
    const vehiculoId =  document.getElementById("vehiculoH").value;
    if(vehiculoId != 0){
        document.getElementById("vehiculo").value = vehiculoId;
    }

    const arrastreId =  document.getElementById("arrastreH").value;
    if(arrastreId != 0){
        document.getElementById("arrastre").value = arrastreId;
    }

    const cargaId =  document.getElementById("cargaH").value;
    if(cargaId != 0){
        document.getElementById("tipoCarga").value = cargaId;
    }

    const cargaPeligrosaId =  document.getElementById("cargaPeligrosaH").value;
    if(cargaPeligrosaId != 0){
        document.getElementById("tipoHazard").value = cargaPeligrosaId;
    }


</script>
{{> footer}}