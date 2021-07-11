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


    public function asignarRol(){
		$id = $_GET["id"];
        $rol = $_GET["rol"];
        $this->usuarioModel->asignarRol($id,$rol);
        $data['rolUsuario'] = $this->usuarioModel->obtenerRol($id);
        $data["usuario"] = $this->usuarioModel->obtenerUsuario($id);
        echo $this->render->render( "view/infoUsuario.php", $data );
    }
}