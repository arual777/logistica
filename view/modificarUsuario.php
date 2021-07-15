{{>header}}
{{>headerUsuario}}

<br><br>
<div class="container-fluid m-0 p-0">
    <div class="row m-0 p-0">
        <div class="col-12 m-0 p-0">
            <div class="card-header border border-dark w-50 m-auto bg-white">
                <h1>Modificar Usuario</h1>
                {{#usuario}}
                <form action="/logistica/Service/modificarUsuario/" method="post" enctype="multipart/form-data">
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" value="{{mail}}" id="email" class="form-control"
                           placeholder="Ingrese el mail del usuario" required>

                    <label for="clave">Clave:</label>
                    <input type="text" name="clave" value="{{clave}}" id="clave" class="form-control"
                           placeholder="Ingrese la clave del usuario" required>

                    <label for="activo">Activo:</label>
                    <select name="activo" id="activo" class="form-control">
                        <optgroup label="Estado actual">
                            {{#estadoActual}}<option value="{{id_Usuario}}">{{activo}}{{/estadoActual}}</option>
                        </optgroup>
                        <optgroup label="Estado">
                            <option value="true" >Si</option>
                            <option value="false">No</option>
                        </optgroup>
                    </select>

                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" value="{{nombre}}" id="nombre" class="form-control"
                           placeholder="Ingrese el nombre del usuario" required>

                    <label for="apellido">Apellido:</label>
                    <input type="text" name="apellido" value="{{apellido}}" id="apellido" class="form-control"
                           placeholder="Ingrese el apellido del usuario" required>

                    <label for="dni">DNI:</label>
                    <input type="number" name="dni" value="{{dni}}" id="dni" class="form-control"
                           placeholder="Ingrese el dni del usuario" required>

                    <label for="fecha_nac">Fecha de nacimiento:</label>
                    <input type="date" name="fecha_nac" value="{{fecha_nac}}" id="fecha_nac" class="form-control"
                           placeholder="Ingrese la fecha de nacimiento del usuario" required>

                    <label for="codigo_licencia">Codigo licencia:</label>
                    <input type="text" name="codigo_licencia" value="{{codigo_licencia}}" id="codigo_licencia" class="form-control"
                           placeholder="Ingrese el codigo de licencia del usuario" required>

<<<<<<< Updated upstream
=======
                    <label for="rol">Rol:</label>
                    <select name="rol" id="rol" class="form-control">
                        <optgroup label="Rol actual">
                            {{#rolActual}}<option value="{{id_Rol}}">{{descripcion}}{{/rolActual}}</option>
                        </optgroup>
                        <optgroup label="Roles">
                            <option value="1">Sin rol</option>
                            <option value="2">Administrador</option>
                            <option value="3">Supervisor</option>
                            <option value="4">Chofer</option>
                            <option value="5">Mecanico</option>
                        </optgroup>
                    </select>
>>>>>>> Stashed changes

                    <input type="submit" value="Editar" class="btn btn-primary btn-block mb-3 mt-3">
                    <input type="hidden" id="idUsuario" name="idUsuario" value="{{id_Usuario}}" />


                </form>
                 {{/usuario}}
            </div>
        </div>
    </div>
</div>


<br>
<br>
{{>footer}}
