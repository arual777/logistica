{{>header}}
{{>headerUsuario}}

<br><br>
<div class="container-fluid m-0 p-0">
    <div class="row m-0 p-0">
        <div class="col-12 m-0 p-0">
            <div class="card-header border border-dark w-50 m-auto bg-white">
                <h1>Modificar Service</h1>
                {{#service}}
                <form action="/logistica/Service/modificarService/" method="post" enctype="multipart/form-data">
                    <label for="fecha">Fecha:</label>
                    <input type="text" name="fecha" value="{{fecha}}" id="fecha" class="form-control"
                    placeholder="Ingrese la fecha del service" required>

                    <label for="kilometraje">Kilometraje:</label>
                    <input type="text" name="kilometraje" value="{{kilometraje}}" id="kilometraje" class="form-control"
                     placeholder="Ingrese el kilometraje del vehículo" required>

                    <label for="repuestos">Repuestos cambiados:</label>
                    <input type="text" name="repuestos" value="{{repuestos_cambiados}}" id="repuestos" class="form-control"
                    placeholder="Ingrese los repuestos cambiados al vehículo durante el service" required>

                    <h3>Vehículo</h3>
                    <select name="vehiculo" id="vehiculo" class="form-control d-inline">
                        {{#vehiculoActual}}
                        <optgroup label="Vehículo actual">
                            <option value="{{id_Vehiculo}}" class="form-control d-inline">{{marca}} - {{patente}}</option>
                        </optgroup>
                        {{/vehiculoActual}}
                        <optgroup label="Vehiculos">
                            {{#vehiculo}}
                            <option value="{{id_Vehiculo}}">{{marca}} - {{patente}}</option>
                            {{/vehiculo}}
                        </optgroup>
                    </select>
                    <br>
                    <h3>Chofer</h3>
                    <select name="chofer" id="chofer" class="form-control d-inline">
                        {{#choferActual}}
                        <optgroup label="Chofer actual">
                            <option value="{{id_Chofer}}" class="form-control d-inline">{{nombre}} - {{apellido}}</option>
                        </optgroup>
                        {{/choferActual}}
                        <optgroup label="Choferes">
                            {{#chofer}}
                            <option value="{{id_Chofer}}" class="form-control d-inline">{{nombre}} - {{apellido}}</option>
                            {{/chofer}}
                        </optgroup>
                    </select>

                    <h3>Mecánico asignado</h3>
                    <select name="mecanico" id="mecanico" class="form-control d-inline">
                        {{#mecanicoActual}}
                        <optgroup label="Mecánico actual">
                            <option value="{{id_Mecanico}}" class="form-control d-inline">{{nombre}} - {{apellido}}</option>
                        </optgroup>
                        {{/mecanicoActual}}
                        <optgroup label="Mecánicos">
                            {{#mecanico}}
                            <option value="{{id_Mecanico}}" class="form-control d-inline">{{id_Mecanico}}{{nombre}} - {{apellido}}</option>
                            {{/mecanico}}
                        </optgroup>
                    </select>

                        <h3>Tipo service</h3>
                        <select name="tipoService" id="tipoService" class="form-control d-inline">
                            {{#tipoServiceActual}}
                            <optgroup label="Tipo service actual">
                                <option value="{{id_TipoService}}" class="form-control d-inline">{{descripcion}}</option>
                            </optgroup>
                            {{/tipoServiceActual}}
                            <optgroup label="Tipo service actual">
                                {{#tipoService}}
                                <option value="{{id_TipoService}}" class="form-control d-inline">{{descripcion}}</option>
                                {{/tipoService}}
                            </optgroup>
                        </select>

                    <input type="submit" value="Editar" class="btn btn-primary btn-block mb-3 mt-3">
                    <input type="hidden" id="idService" name="idService" value="{{id_Service}}" />
                </form>
                {{/service}}
            </div>
        </div>
    </div>
</div>

<br>
<br>
{{>footer}}