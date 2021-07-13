{{>header}}
{{>headerUsuario}}

<br><br>
<div class="container-fluid m-0 p-0">
    <div class="row m-0 p-0">
        <div class="col-12 m-0 p-0">
            <div class="card-header border border-dark w-50 m-auto bg-white">
                <h1>Modificar vehículo</h1>
                {{#vehiculo}}
                <form action="/logistica/Vehiculos/modificarVehiculo/" method="post" enctype="multipart/form-data">
                <label for="marca">Marca:</label>
                <input type="text" name="marca" value="{{marca}}" id="marca" class="form-control"
                placeholder="Ingrese la marca del vehículo" required>

                <label for="modelo">Modelo:</label>
                <input type="text" name="modelo" value="{{modelo}}" id="modelo" class="form-control"
                placeholder="Ingrese el modelo del vehículo" required>

                <label for="patente">Patente:</label>
                <input type="text" name="patente" value="{{patente}}" id="patente" class="form-control"
                placeholder="Ingrese la patente del vehículo" required>

                <label for="anio_fabricacion">Año fabricacion:</label>
                <input type="date" name="anio_fabricacion" value="{{anio_fabricacion}}" id="anio_fabricacion" class="form-control"
                placeholder="Ingrese el año de fabricación del vehículo" required>

                <label for="kilometraje">Kilometraje:</label>
                <input type="number" name="kilometraje" value="{{kilometraje}}" id="kilometraje" class="form-control"
                placeholder="Ingrese el kilometraje del vehículo" required>

                <label for="chasis">Chasis:</label>
                <input type="text" name="chasis" value="{{chasis}}" id="chasis" class="form-control"
                placeholder="Ingrese la chasis del vehículo" required>

                    <input type="submit" value="Editar" class="btn btn-primary btn-block mb-3 mt-3">
                    <input type="hidden" id="idVehiculo" name="idVehiculo" value="{{id_Vehiculo}}" />
                </form>
                {{/vehiculo}}
            </div>
        </div>
    </div>
</div>

<br>
<br>













{{>footer}}
