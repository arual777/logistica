{{> header}}
<main>
        <div class="container-fluid btn-violet" style="">
            <h5 class= "centrar">¡Bienvenido a la plataforma de trabajo de Estrella del Norte!</h5>
            <div class="row">
                <div class="col-12 mb-5">
                    <div id="collapseOne" class="collapse show iniciar" aria-labelledby="headingOne"
                         data-parent="#accordionBarra">
                    </div>
                </div>
            </div>
        </div>
        <form action="" method="post">
            <div class="contenedorCentro">
                <label for="nombre"><b>Nombre</b></label><br>
                <input type="text" placeholder="Ingrese su nombre" name="nombre"required class="inputLogin" >
                <br><br>
                <label for="apellido"><b>Apellido</b></label><br>
                <input type="text" placeholder="Ingrese su apellido" name="apellido"required class="inputLogin" >
                <br><br>
                <label for="dni"><b>DNI</b></label><br>
                <input type="text" placeholder="Ingrese su dni" name="dni" required class="inputLogin">
                <br><br>
                <label for="usuario"><b>Usuario</b></label><br>
                <input type="text" placeholder="Ingrese su usuario" name="usuario"required class="inputLogin">
                <br><br>
                <label for="contrasenia"><b>Password</b></label><br>
                <input type="password" placeholder="Ingrese contrase&ntilde;a" name="contrasenia"required class="inputLogin">
                <br><br>

                <button type= "submit" class="btnRegistroR"
                        data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                        aria-controls="collapseTwo">
                    Registrarse
                </button>
            </div>
        </form>
</main>
{{> footer}}