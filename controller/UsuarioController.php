<?php

class UsuarioController
{
    private $render;
    private $usuarioModel;

    public function __construct($render, $usuarioModel)
    {
        $this->render = $render;
        $this->usuarioModel = $usuarioModel;
    }

    public function execute()
    {
        echo $this->render->render("view/verUsuarios.php");
    }

    public function listar()
    {
        $data["usuarios"] = $this->usuarioModel->obtenerUsuarios();
        for ($i=0; $i < count($data["usuarios"]); $i++) {
            if($data["usuarios"][$i]['activo']==1){
                $data["usuarios"][$i]['activo'] = "Si";
            }else{
                $data["usuarios"][$i]['activo'] = "No";
            }
        }

        echo $this->render->render("view/verUsuarios.php", $data);
    }

    public function mostrarUsuario()
    {
        $id = $_GET["id"];
        $data['id'] = $_GET["id"];
        $data["usuario"] = $this->usuarioModel->obtenerUsuario($data);
        $data['rolUsuario'] = $this->usuarioModel->obtenerRol($id);
        echo $this->render->render("view/infoUsuario.php", $data);
    }

    public function agregarUsuario()
    {
        $data['licencia'] = $this->usuarioModel->obtenerLicencias();
        $data['roles'] = $this->usuarioModel->obtenerRoles();
        echo $this->render->render("view/nuevoUsuario.php",$data);
    }

    public function insertarUsuario()
    {
        $id_Rol = $_POST['rol'];
        $usuario = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $dni = $_POST['dni'];
        $fecha_nac = $_POST['fecha_nac'];
        $mail = $_POST['email'];
        $password = $_POST['clave'];
        $tipoLicencia = isset($_POST["tipoLicencia"]) ? $_POST["tipoLicencia"] : "1";
        $codigoLicencia = isset($_POST["codigo_licencia"]) ? $_POST["codigo_licencia"] : "";
        $activarUsuario = $_POST['activo'];

        $this->usuarioModel->insertarUsuario($tipoLicencia, $mail, $password,$activarUsuario, $usuario, $apellido,
            $dni, $fecha_nac, $codigoLicencia, $id_Rol);
        header("Location: /logistica/Usuario/listar");

    }

    public function editar()
    {
        $id_Usuario = $_GET["id"];
        $data['id'] = $id_Usuario;
        $data["usuario"] = $this->usuarioModel->obtenerUsuario($data);
        $data['estadoActual'] = $this->usuarioModel->obtenerActividad($id_Usuario);
        $data['rolActual'] = $this->usuarioModel->obtenerRol($id_Usuario);
        $data['licencia'] = $this->usuarioModel->obtenerLicencia($id_Usuario);

        $data['estado']['actual'] = "No";
        if ($data['estadoActual']['0']['activo'] == "1") {
            $data['estado']['actual'] = "Si";
        }

        echo $this->render->render("view/modificarUsuario.php", $data);
    }

    public function modificarUsuario()
    {
        $data ["idUsuario"] = isset($_POST["idUsuario"]) ? $_POST["idUsuario"] : "";
        $data['rol'] = isset($_POST["rol"]) ? $_POST["rol"] : "";
        $data["mail"] = isset($_POST["mail"]) ? $_POST["mail"] : "";
        $data["clave"] = isset($_POST["clave"]) ? md5($_POST["clave"]) : "";
        $data["activo"] = isset($_POST["activo"]) ? $_POST["activo"] : "";
        $data["nombre"] = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
        $data["apellido"] = isset($_POST["apellido"]) ? $_POST["apellido"] : "";
        $data["dni"] = isset($_POST["dni"]) ? $_POST["dni"] : "";
        $data["fecha_nac"] = isset($_POST["fecha_nac"]) ? $_POST["fecha_nac"] : "";
        $data["codigo_licencia"] = isset($_POST["codigo_licencia"]) ? $_POST["codigo_licencia"] : "";
        $data["tipoLicencia"] = isset($_POST["tipoLicencia"]) ? $_POST["tipoLicencia"] : "";
        $data["nuevoRol"] = isset($_POST["rol"]) ? $_POST["rol"] : "";


        $this->usuarioModel->editarUsuario($data);
        $this->usuarioModel->asignarRol($data['idUsuario'], $data['rol']);

        header("Location: /logistica/Usuario/listar");
    }

    public function borrarUsuario()
    {
        $id = $_GET["id"];
        $this->usuarioModel->borrarUsuario($id);
        $data["usuarios"] = $this->usuarioModel->obtenerUsuarios();
        header("Location: /logistica/Usuario/listar");
    }

}