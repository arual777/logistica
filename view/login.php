{{> header}}
<main>
    <div class="container-fluid m-0 p-0" style="">
        <div class="row m-0 p-0">
            <div class="col-12 mb-5 m-0 p-0">
                <h5 class="text-center font-italic" style="font-size: 40px;">¡Bienvenido a la plataforma de trabajo de
                    Estrella del Norte!</h5>
            </div>
        </div>
        <div class="row m-0 p-0">
            <div class="col mb-5">
                <div class="card-header border border-dark w-50 m-auto bg-white">
                    <form action="/logistica/autorizacion/login" method="post">
                        <label for="usuario">Usuario: </label>
                        <input type="text" placeholder="Ingrese usuario" name="usuario" required
                               class="form-control">
                        <label for="contrasenia">Contraseña: </label>
                        <input type="password" placeholder="Ingrese contrase&ntilde;a" name="contrasenia" required
                               class="form-control">
                        <button type="submit" class="btn btn-primary btn-block mt-4">Ingresar</button>
                        <div class="dropdown-divider"></div>
                        <p class="text-danger">{{#mensajeError}}
                            {{.}}
                            {{/mensajeError}}</p>
                        <p class="text-success">{{#registroExitoso}}
                            Tu registro fue exitoso, por favor espera a que un admin te asigne un rol para poder
                            iniciar sesión
                            {{/registroExitoso}}</p>
                        <a href="/logistica/Registro/">¿No estás registrado? Hacé click en:
                            <button class="btn btn-success" type="button">Registrarse</button>
                        </a>
                    </form>
                    <!--Si mensajeError tiene elementos entra y muestra solo el primer elemento-->

                </div>
            </div>
        </div>
    </div>
</main>
{{> footer}}