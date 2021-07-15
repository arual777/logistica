{{>header}}
{{>headerUsuario}}

<br><br>

<div class="container-fluid m-0 p-0">
    <div class="row m-0 p-0">
        <div class="col-12 m-0 p-0">
            <div class="card-header border border-dark w-50 m-auto bg-white">
                <h1>Nuevo Service</h1>

                <form action="/logistica/Service/insertarService/" role="form" method="post" enctype="multipart/form-data">
                <label for="fecha">Fecha:</label>
                <input type="date" name="fecha" id="fecha" class="form-control"
                placeholder="Ingrese la fecha del service" required>

                 <label for="kilometraje">Kilometraje:</label>
                 <input type="number" name="kilometraje" id="kilometraje" class="form-control"
                        placeholder="Ingrese el kilometraje del vehículo" required>

                 <label for="detalle">Detalle:</label>
                 <input type="text" name="detalle" id="detalle" class="form-control"
                 placeholder="Ingrese el detalle del service" required>

                 <label for="repuestos">Repuestos cambiados:</label>
                <input type="text" name="repuestos" id="repuestos" class="form-control"
                placeholder="Ingrese los repuestos cambiados al vehículo durante el service" required>

                    <h3>Vehiculo</h3>
                    <select name="vehiculo" id="vehiculo" class="form-control d-inline">
                        <optgroup label="Vehiculos">
                            {{#vehiculo}}
                            <option value="{{id_Vehiculo}}">{{marca}} - {{patente}}</option>
                            {{/vehiculo}}
                        </optgroup>
                    </select>
                    <br>

                    <h3>Usuario</h3>
                    <select name="usuario" id="usuario" class="form-control d-inline">
                        <optgroup label="Usuario">
                            {{#usuario}}
                            <option value="{{id_Usuario}}">{{nombre}} - {{apellido}}</option>
                            {{/usuario}}
                        </optgroup>
                    </select>
                    <br>

                    <h3>Tipo service</h3>
                    <select name="tipoService" id="tipoService" class="form-control d-inline">
                        <optgroup label="Tipo Service">
                            {{#tipoService}}
                            <option value="{{id_TipoService}}">{{descripcion}}</option>
                            {{/tipoService}}
                        </optgroup>
                    </select>
                    <br>
                 <input type="submit" value="Agregar" class="btn btn-primary btn-block mb-3 mt-3">

                </form>
            </div>
        </div>
    </div>
</div>

<br>
<br>
{{>footer}}
