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

                    <input type="submit" value="Editar" class="btn btn-primary btn-block mb-3 mt-3">

                </form>
                {{/service}}
            </div>
        </div>
    </div>
</div>

<br>
<br>
{{>footer}}