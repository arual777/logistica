{{> header}}
{{>headerUsuario}}
<h1>PROFORMA</h1>
<form action="/logistica/proforma/crear" method="post">

    <h3> Cliente </h3>
    <label for="denominacion">Denominación:</label>
    <input type="text" name="denominacion" id="denominacion" class="form-control"
           placeholder="Ingrese la denominación del cliente" required>
    <label for="cuit">Cuit:</label>
    <input type="text" name="cuit" id="cuit" class="form-control"
           placeholder="Ingrese el CUIT del cliente" required>
    <label for="tele">Teléfono:</label>
    <input type="text" name="telefono" id="telefono" class="form-control"
           placeholder="Ingrese el teléfono del cliente" required>
    <label for="mail">Email:</label>
    <input type="email" name="mail" id="mail" class="form-control"
           placeholder="Ingrese el email del cliente" required>
    <label for="contacto">Contacto:</label>
    <input type="text" name="contacto" id="contacto" class="form-control"
           placeholder="Ingrese un contacto del cliente" required>

    <h3>Viaje </h3>
    <label for="origen">Origen:</label>
    <input type="text" name="origen" id="origen" class="form-control"
           placeholder="Ingrese el origen del viaje">

    <label for="destino">Destino:</label>
    <input type="text" name="destino" id="destino" class="form-control"
           placeholder="Ingrese el destino del viaje">

    <label for="fechaCarga">Fecha de carga:</label>
    <input type="date" name="fechaCarga" id="fechaCarga" class="form-control" placeholder="Fecha">

    <label for="llegada">Tiempo estimado de llegada:</label>
    <input type="date" name="llegada" id="llegada" class="form-control" placeholder="Fecha">



    <h3> Vehículo </h3>
    <label for="vehiculo">Denominación:</label>
    <select name="vehiculo">
        {{#vehiculo}}
        <option value={{id_vehiculo}}>{{patente}} - {{marca}} - {{modelo}}</option>
        {{/vehiculo}}
    </select>

    <h3> Vehículo De Arrastre </h3>
    <label for="arrastre">Denominación:</label>
    <select name="arrastre">
        {{#arrastre}}
        <option value={{id_vehiculo}}>{{chasis}} - {{patente}} - {{descripcion}}</option>
        {{/arrastre}}
    </select>

    <h3> Carga</h3>

    <p>Tipo de carga:</p>
    <label for="tipoCarga"></label>
    <select name="tipoCarga">
        {{#tipoCarga}}
        <option value={{id_TipoCarga}}>{{descripcion}}</option>
        {{/tipoCarga}}

    </select>
    <br>
    <label for="peso">Peso neto:</label>
    <input type="number" name="peso" id="peso" class="form-control"
           placeholder="Ingrese el peso neto de la carga">

    <label for="tipoHazard"> Carga peligrosa</label>
    <select name="tipoHazard">
        {{#tipoHazard}}
        <option value={{id_TipoHazard}}>{{descripcion}} </option>
        {{/tipoHazard}}
    </select>

    <br>
    <label for="refrigeracion">¿Requiere refrigeración?</label>
    <input type="radio" name="refrigeracion" id="refrigeracion" value=1 class="mt-3 mb-3" checked>SI
    <input type="radio" name="refrigeracion" id="refrigeracion" value=0 class="mt-3 mb-3">NO<br>

    <p>Graduación:</p>
    <input type="number" name="graduacion" id="graduacion" class="form-control"
           placeholder="Ingrese la graduación requerida de la refrigeración">

    <h3> Costos Estimados</h3>

    <label for="km">kilómetros:</label>
    <input type="number" name="km" id="km" class="form-control"
           placeholder="Ingrese los kilómetros estimados del trayecto">

    <label for="combustible">Combustible:</label>
    <input type="number" name="combustible" id="combustible" class="form-control"
           placeholder="Ingrese el combustible requerido para el trayecto">

    <label for="viatico">Viáticos:</label>
    <input type="number" name="viatico" id="viatico" class="form-control" placeholder="Ingrese los viáticos estimados">

    <label for="peaje">Peajes y pesajes:</label>
    <input type="number" name="peaje" id="peaje" class="form-control"
           placeholder="Ingrese los costos totales de peajes-pesajes">

    <label for="haz">Peligrosidad:</label>
    <input type="number" name="costoHazard" id="costoHazard" class="form-control" placeholder="Ingrese el costo por carga peligrosa">

    <label for="ref">Refrigeración:</label>
    <input type="number" name="costoRefrigeracion" id="costoRefrigeracion" class="form-control" placeholder="Ingrese el costo por refrigeración">

    <label for="tarifa">Tarifa:</label>
    <input type="number" name="tarifa" id="tarifa" class="form-control"
           placeholder="Ingrese la tarifa actual de la empresa">
    <h3> Personal asignado</h3>
    <label for="chofer">Chofer:</label>
    <select name="chofer">
        {{#choferes}}
        <option value={{ID_USUARIO}}>{{NOMBRE}} {{APELLIDO}}</option>
        {{/choferes}}
    </select>
    <button class="btn btn-success" type="submit">Crear</button>
</form>
{{> footer}}