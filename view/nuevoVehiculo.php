{{>header}}
{{>headerUsuario}}

<br><br>

<div class="container-fluid m-0 p-0">
    <div class="row m-0 p-0">
        <div class="col-12 m-0 p-0">
            <div class="card-header border border-dark w-50 m-auto bg-white">
                <h1>Nuevo Vehículo</h1>

                <form action="/logistica/Vehiculos/insertarVehiculo/" method="post" enctype="multipart/form-data">

                    <label for="marca">Marca:</label>
                    <input type="text" name="marca" id="marca" class="form-control"
                           placeholder="Ingrese la marca del vehiculo" required>

                    <label for="modelo">Modelo:</label>
                    <input type="text" name="modelo" id="modelo" class="form-control"
                           placeholder="Ingrese el modelo del vehiculo" required>

                    <label for="patente">Patente:</label>
                    <input type="text" name="patente" id="patente" class="form-control"
                           placeholder="Ingrese la patente del vehiculo" required>

                    <label for="motor">Motor:</label>
                    <input type="text" name="motor" id="motor" class="form-control"
                           placeholder="Ingrese el motor del vehiculo" required>

                    <label for="chasis">Chasis:</label>
                    <input type="text" name="chasis" id="chasis" class="form-control"
                           placeholder="Ingrese el chasis del vehiculo" required>

                    <label for="anio_fabricacion">Fecha fabricación:</label>
                    <input type="date" name="anio_fabricacion" id="anio_fabricacion" class="form-control"
                           placeholder="Ingrese la fecha de fabricacion del vehiculo" required>

                    <label for="kilometraje">Kilometraje:</label>
                    <input type="number" name="kilometraje" id="kilometraje" class="form-control"
                           placeholder="Ingrese el kilometraje del vehiculo" required>

                    <label for="estado">Estado:</label>
                    <input type="text" name="estado" id="estado" class="form-control"
                           placeholder="Ingrese el estado del vehiculo" required>

                    <input type="submit" value="Agregar" class="btn btn-primary btn-block mb-3 mt-3">

                </form>
            </div>
        </div>
    </div>
</div>

<br>
<br>
{{>footer}}

