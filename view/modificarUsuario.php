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
                    <input type="number" name="activo" value="{{activo}}" id="activo" class="form-control"
                           placeholder="Ingrese la actividad del usuario" required>

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

                    <input
                    <button type="button" class="btn btn-secondary" data-toggle="modal"
                            data-target="#mimodal">Cambiar rol</button>
                    <!--El modal -->
                    <div class="modal fade" id="mimodal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- header o cabecera -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Usuario {{nombre}}</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <form action="/logistica/Usuario/asignarRol" method="GET">
                                        <input type = "hidden" name = "id" id="id" value = "{{id_Usuario}}"><br>
                                        <select name="rol" id="rol" class="form-control">
                                            <optgroup label="Rol actual">
                                                {{#rolUsuario}}<option value="{{id_Rol}}">{{descripcion}}{{/rolUsuario}}</option>
                                            </optgroup>
                                            <optgroup label="Roles">optgroup>
                                                <option value="1">Sin rol</option>
                                                <option value="2">Administrador</option>
                                                <option value="3">Supervisor</option>
                                                <option value="4">Chofer</option>
                                                <option value="5">Mecanico</option>
                                            </optgroup>
                                        </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success" >Cambiar rol</button>
                                </div>
                        </form>
                            </div>
                        </div>


</div>
    <input type="submit" value="Editar" class="btn btn-primary btn-block mb-3 mt-3">

    </form>
    {{/usuario}}

        </div>
    </div>
</div>


<br>
<br>
{{>footer}}
