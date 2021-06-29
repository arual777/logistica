{{> header}}

<div class="container-fluid m-0 p-0">
    <div class="row m-0 p-0">
        <div class="col-12 m-0 p-0">
            <div class="card-header border border-dark w-50 m-auto bg-white">
                <h1>Bienvenido al registro</h1>
                <form action="/logistica/Registro/registrar" method="post">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre">
                    <p class="text-danger">{{#mensajeError}}
                        {{.}}
                        {{/mensajeError}}</p>
                    <label for="apellido">Apellido:</label>
                    <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Apellido">
                    <p class="text-danger">{{#mensajeError}}
                        {{.}}
                        {{/mensajeError}}</p>
                    <label for="dni">DNI:</label>
                    <input type="number" name="dni" id="dni" class="form-control" placeholder="DNI">
                    <p class="text-danger">{{#mensajeError}}
                        {{.}}
                        {{/mensajeError}}</p>
                    <p class="text-danger">{{#dniExistente}}
                        {{.}}
                        {{/dniExistente}}</p>
                    <label for="fecha_nac">Fecha de nacimiento:</label>
                    <input type="date" name="fecha_nac" id="fecha_nac" class="form-control"
                           placeholder="fecha de nacimiento">
                    <p class="text-danger">{{#mensajeError}}
                        {{.}}
                        {{/mensajeError}}</p>
                    <label for="licencia">¿Tiene licencia?</label>
                    <input type="radio" name="licencia" id="licencia" class="mt-3 mb-3" onclick='activar()'>SI
                    <input type="radio" name="licencia" id="licencia" class="mt-3 mb-3" onclick='desactivar()'>NO<br>
                    <p>Tipo de licencia:</p>
                    <select name="tipoLicencia" id="tipoLicencia" class="form-control" disabled>
                        <option value="2">A</option>
                        <option value="3">B</option>
                        <option value="4">C</option>
                        <option value="5">D</option>
                        <option value="6">E</option>
                        <option value="7">F</option>
                    </select>
                    <label for="codigoLicencia">Codigo de licencia</label>
                    <input type="text" name="codigoLicencia" id="codigoLicencia" class="form-control"
                           placeholder="Código de licencia" disabled>
                    <p class="text-danger">{{#licenciaExistente}}
                        {{.}}
                        {{/licenciaExistente}}</p>
                    <label for="email">Email:</label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                    <p class="text-danger">{{#mensajeError}}
                        {{.}}
                        {{/mensajeError}}</p>
                    <p class="text-danger">{{#usuarioExistente}}
                        {{.}}
                        {{/usuarioExistente}}</p>
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña">
                    <p class="text-danger">{{#mensajeError}}
                        {{.}}
                        {{/mensajeError}}</p>
                    <input type="submit" class="btn btn-primary btn-block mb-3 mt-3" value="Registrarse">

                    <a href="/logistica/login">¿Ya tenes una cuenta? Hacé click en:
                        <button class="btn btn-success" type="button">Iniciar sesión</button>
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

{{> footer}}