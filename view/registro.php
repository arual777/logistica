{{> header}}


<div class="container-fluid m-0 p-0">
    <div class="row m-0 p-0">
        <div class="col-12 m-0 p-0">
            <div class="card-header border border-dark w-50 m-auto bg-white">
                <h1>Bienvenido al registro</h1>
                <form action="#">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre">
                    <label for="apellido">Apellido:</label>
                    <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Apellido">
                    <label for="dni">DNI:</label>
                    <input type="number" name="dni" id="dni" class="form-control" placeholder="DNI">
                    <label for="user">Nombre de usuario:</label>
                    <input type="text" name="user" id="user" class="form-control" placeholder="Nombre de usuario">
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña">
                    <input type="submit" class="btn btn-primary btn-block mb-3 mt-3" value="Registrarse">
                    <a href="login">¿Ya tenes una cuenta? Hacé click en:
                        <button class="btn btn-success" type="button">Iniciar sesión</button></a>
                </form>
            </div>
        </div>
    </div>
</div>



{{> footer}}