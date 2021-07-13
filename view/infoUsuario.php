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