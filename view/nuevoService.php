{{>header}}
{{>headerUsuario}}

<br><br>

<div class="container-fluid m-0 p-0">
    <div class="row m-0 p-0">
        <div class="col-12 m-0 p-0">
            <div class="card-header border border-dark w-50 m-auto bg-white">
                <h1>Nuevo Service</h1>

                <form action="/logistica/Service/insertarService/" method="post" enctype="multipart/form-data">

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

                 <input type="submit" value="Agregar" class="btn btn-primary btn-block mb-3 mt-3">

                </form>
            </div>
        </div>
    </div>
</div>

<br>
<br>
{{>footer}}
