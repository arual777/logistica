{{>header}}
<div class="w3-container w3-content w3-center w3-padding-64">
<a href="/logistica/autorizacion/logout"><input type="submit" class="form-control" value="Cerrar sesion"></a>
<h1 class="text-center">Usuarios</h1>

<table class='table table-primary table-hover table-responsive-xs'>
    <tr>
        <th>Id usuario</th>
        <th>Id Licencia</th>
        <th>E-mail</th>
        <th>Activo</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>DNI</th>
        <th>Fecha nacimiento</th>
        <th>Codigo licencia</th>
    </tr>

    {{#usuarios}}
    <tr>
        <td>{{id_Usuario}}</td>
        <td>{{id_Licencia}}</td>
        <td>{{mail}}</td>
        <td>{{activo}}</td>
        <td>{{nombre}}</td>
        <td>{{apellido}}</td>
        <td>{{dni}}</td>
        <td>{{fecha_nac}}</td>
        <td>{{codigo_licencia}}</td>
        <td><a href="/logistica/Usuario/mostrarUsuario/id={{id_Usuario}}" name="id"><button type="submit" class="btn btn-primary">Info</button></a></td>
        <td><a href=""><button type="submit" class="btn btn-warning ">Modificar</button></a></td>
        <td><a href=""><button type="submit" class="btn btn-danger ">Borrar</button></a></td>
    </tr>
    {{/usuarios}}
</table>

</div>







{{>footer}}