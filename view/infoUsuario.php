{{>header}}
{{>headerUsuario}}
<div class="w3-container w3-content w3-center w3-padding-64">


<div>
    <h1 class="text-black font-italic display-4 text-center">

        {{#usuario}}
        <tr>
            <td>{{nombre}}</td>
            <td>{{apellido}}</td>
        </tr>
        {{/usuario}}

    </h1>
    <table class='table table-primary table-hover table-responsive-xs'>
        <tr>
            <th>Id usuario</th>
            <th>Id Licencia</th>
            <th>E-mail</th>
            <th>Password</th>
            <th>Activo</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>DNI</th>
            <th>Fecha nacimiento</th>
            <th>Codigo licencia</th>
            <th>Rol</th>
        </tr>

        {{#usuario}}
        <tr>
            <td>{{id_Usuario}}</td>
            <td>{{id_Licencia}}</td>
            <td>{{mail}}</td>
            <td>{{clave}}</td>
            <td>{{activo}}</td>
            <td>{{nombre}}</td>
            <td>{{apellido}}</td>
            <td>{{dni}}</td>
            <td>{{fecha_nac}}</td>
            <td>{{codigo_licencia}}</td>
            <td>{{descripcion}}</td>
            <td><button type="button" class="btn btn-secondary" data-toggle="modal"
                                    data-target="#mimodal">Cambiar rol</button></td>
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
        </tr>
        {{/usuario}}
    </table>
</div>

 <div class="text-center">
     <a href="/logistica/Usuario/listar"><button type="submit" class="btn btn-primary ">Volver</button></a>
 </div>



</div>


<br>
<br>
<br>
<br>
<br>
<br>
<br>


{{>footer}}