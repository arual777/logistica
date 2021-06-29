<?php

class UsuarioController
{
    private $render;
    private $model;


    public function __construct($render, $model)
    {
        $this->render = $render;
        $this->model = $model;

    }

    public function execute()
    {
        echo $this->render->render("view/usuario.php");
    }

    public function activar($id)
    {

    }

    public function listar()
    {
        $data["usuarios"] = $this->model->obtenerUsuarios();
        echo $this->render->render( "view/verUsuarios.php", $data );
    }

    public function mostrarUsuario(){
        $id = $_GET["id"];
        $data["usuario"] = $this->model->obtenerUsuario($id);
        echo $this->render->render( "view/infoUsuario.php", $data );
    }

    public function asignarRol(){
        $id = $_GET["id"];
        $rol = $_GET["rol"];
        $rolAntiguo = $this->model->obtenerRol($id);
        $this->model->asignarRol($id,$rolAntiguo[0]['id_Rol'],$rol);
        $data["usuario"] = $this->model->obtenerUsuario($id);
        echo $this->render->render( "view/infoUsuario.php", $data );
    }



    public function buscarPorId($id)
    {

    }

    public function actualizar()
    {

    }

    public function registrar(){
        echo $this->render->render("view/registro.php");
    }
}