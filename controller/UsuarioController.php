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
        echo $this->render->render("view/usuario.php");
    }

    public function listar()
    {
        $data["usuarios"] = $this->usuarioModel->obtenerUsuarios();
        echo $this->render->render( "view/verUsuarios.php", $data );
    }

    public function mostrarUsuario(){
        $id =$_GET["id"];
        $data['id'] = $_GET["id"];
        $data["usuario"] = $this->usuarioModel->obtenerUsuario($data);
        $data['rolUsuario'] = $this->usuarioModel->obtenerRol($id);
        echo $this->render->render( "view/infoUsuario.php", $data );
    }

    public function insertar(){
        echo $this->render->render("view/nuevoUsuario.php");
    }

    public function insertarUsuario(){
        $data["id_Licencia"] = isset($_POST["id_Licencia"]) ?  $_POST["id_Licencia"] : "";
        $data["mail"] = isset($_POST["mail"]) ? $_POST["mail"] : "";
        $data["clave"] = isset($_POST["clave"]) ? md5 ($_POST["clave"]) : "";
        $data["activo"] = isset($_POST["activo"]) ? $_POST["activo"] : "";
        $data["nombre"] = isset($_POST["nombre"]) ?  $_POST["nombre"] : "";
        $data["apellido"] = isset($_POST["apellido"]) ? $_POST["apellido"] : "";
        $data["dni"] = isset($_POST["dni"]) ?  $_POST["dni"] : "";
        $data["fecha_nac"] = isset($_POST["fecha_nac"]) ? $_POST["fecha_nac"] : "";
        $data["codigo_licencia"] = isset($_POST["codigo_licencia"]) ?  $_POST["codigo_licencia"] : "";

        $this->usuarioModel->insertarUsuario($data);

        $data["usuarios"] = $this->usuarioModel->obtenerUsuarios();
        echo $this->render->render("view/verUsuarios.php",$data);
    }


    public function editar(){
        $id_Usuario= $_GET["id"];
        $data['id']= $id_Usuario;
        $data["usuario"] = $this->usuarioModel->obtenerUsuario($data);
        $data['rolActual'] = $this->usuarioModel->obtenerRol($id_Usuario);
        $data['licencia'] = $this->usuarioModel->obtenerLicencia($id_Usuario);
        echo $this->render->render("view/modificarUsuario.php",$data);
    }

    public function modificarUsuario(){
        $data ["idUsuario"]= isset($_POST["idUsuario"]) ?  $_POST["idUsuario"] : "";
        $data['rol'] = isset($_POST["rol"]) ?  $_POST["rol"] : "";
        $data["mail"] = isset($_POST["mail"]) ?  $_POST["mail"] : "";
        $data["clave"] = isset($_POST["clave"]) ?  md5($_POST["clave"]) : "";
        $data["activo"] = isset($_POST["activo"]) ?  $_POST["activo"] : "";
        $data["nombre"] = isset($_POST["nombre"]) ?  $_POST["nombre"] : "";
        $data["apellido"] = isset($_POST["apellido"]) ? $_POST["apellido"] : "";
        $data["dni"] = isset($_POST["dni"]) ? $_POST["dni"] : "";
        $data["fecha_nac"] = isset($_POST["fecha_nac"]) ?  $_POST["fecha_nac"] : "";
        $data["codigo_licencia"] = isset($_POST["codigo_licencia"]) ?  $_POST["codigo_licencia"] : "";
        $data["tipoLicencia"] = isset($_POST["tipoLicencia"]) ?  $_POST["tipoLicencia"] : "";
        $data["nuevoRol"] = isset($_POST["rol"]) ?  $_POST["rol"] : "";


        $this->usuarioModel->editarUsuario($data);
        $this->usuarioModel->asignarRol($data['idUsuario'],$data['rol']);

        $data["usuarios"] = $this->usuarioModel->obtenerUsuarios();
        echo $this->render->render("view/verUsuarios.php",$data);
    }

    public function borrarUsuario(){
        $id = $_GET["id"];
        $this->usuarioModel->borrarUsuario($id);
        $data["usuarios"] = $this->usuarioModel->obtenerUsuarios();
        echo $this->render->render("view/verUsuarios.php",$data);
    }

}