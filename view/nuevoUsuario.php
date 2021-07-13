{{>header}}
{{>headerUsuario}}

<br><br>

<div class="container-fluid m-0 p-0">
    <div class="row m-0 p-0">
        <div class="col-12 m-0 p-0">
            <div class="card-header border border-dark w-50 m-auto bg-white">
                <h1>Nuevo Usuario</h1>

                <form action="/logistica/Usuario/insertarUsuario/" method="post" enctype="multipart/form-data">

                    <label for="idl">Id licencia:</label>
                    <input type="text" name="idl" id="idl" class="form-control"
                           placeholder="Ingrese el id de la licencia" required>

                    <label for="email">E-mail:</label>
                    <input type="email" name="email" id="email" class="form-control"
                           placeholder="Ingrese el email del usuario" required>

                    <label for="clave">Clave:</label>
                    <input type="text" name="clave" id="clave" class="form-control"
                           placeholder="Ingrese la clave del usuario" required>

                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control"
                           placeholder="Ingrese el nombre del usuario" required>

                    <label for="apellido">Apellido:</label>
                    <input type="text" name="apellido" id="apellido" class="form-control"
                           placeholder="Ingrese el apellido del usuario" required>

                    <label for="fecha_nac">Fecha de nacimiento:</label>
                    <input type="date" name="fecha_nac" id="fecha_nac" class="form-control"
                           placeholder="Ingrese la fecha de nacimiento del usuario" required>

                    <label for="codigo_licencia">Codigo licencia:</label>
                    <input type="text" name="codigo_licencia" id="codigo_licencia" class="form-control"
                           placeholder="Ingrese el codigo de licencia del usuario" required>

                    <input type="submit" value="Agregar" class="btn btn-primary btn-block mb-3 mt-3">

                </form>
            </div>
        </div>
    </div>
</div>

<br>
<br>
{{>footer}}

