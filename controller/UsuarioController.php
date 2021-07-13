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
        $id = $_GET["id"];
        $data["usuario"] = $this->usuarioModel->obtenerUsuario($id);
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


        $this->usuarioModel->editarUsuario($data);

        $data["usuarios"] = $this->usuarioModel->obtenerUsuarios();
        echo $this->render->render("view/verUsuarios.php",$data);
    }

    public function borrarUsuario(){
        $id = $_GET["id"];
        $this->usuarioModel->borrarUsuario($id);
        $data["usuarios"] = $this->usuarioModel->obtenerUsuarios();
        echo $this->render->render("view/verUsuarios.php",$data);
    }

    public function asignarRol(){
        $id = $_GET["id"];
        $rol = $_GET["rol"];

        $rolAntiguo = $this->usuarioModel->obtenerRol($id);
        $this->usuarioModel->asignarRol($id,$rolAntiguo[0]['id_Rol'],$rol);
        $data['rolUsuario'] = $this->usuarioModel->obtenerRol($id);
        $data["usuario"] = $this->usuarioModel->obtenerUsuario($id);

        echo $this->render->render( "view/infoUsuario.php", $data );
    }
}