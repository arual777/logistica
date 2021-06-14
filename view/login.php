{{> header}}
        <main>
            <div class="container-fluid btn-violet" style="">
                <h5 class="centrar">¡Bienvenido a la plataforma de trabajo de Estrella del Norte!</h5>
                <div class="row">
                    <div class="col-12 mb-5">
                        <div id="collapseOne" class="collapse show iniciar" aria-labelledby="headingOne"
                             data-parent="#accordionBarra">
                        </div>
                    </div>
                </div>
            </div>
            <form action="autorizacion/login" method="post">
                <div class="contenedor centro">
                    <label for="usuario"><b>Usuario</b></label>
                    <input type="text" placeholder="Ingrese usuario" name="usuario" required class="inputLogin">
                    <br>
                    <label for="contrasenia"><b>Password</b></label>
                    <input type="password" placeholder="Ingrese contrase&ntilde;a" name="contrasenia" required
                           class="inputLogin">

                    <button type="submit" class="btnLogin">Ingresar</button>

                    <a href="registro.html">¿No estás registrado? Hacé click en: </a><br>
                    <button class="btnRegistro" type="button"
                            data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                            aria-controls="collapseTwo">
                        Registrarse
                    </button>
                </div>
            </form>
        </main>
{{> footer}}