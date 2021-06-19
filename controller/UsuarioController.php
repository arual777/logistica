<?php

class UsuarioController
{
    private $render;

    public function __construct($render)
    {
        $this->render = $render;
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