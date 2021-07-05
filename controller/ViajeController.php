<?php


class ViajeController
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
        echo $this->render->render("view/viajes.php");
    }

   public function listarViajes(){
        $data["viajes"] = $this->model->obtenerViajesPorOrdenDeFecha();
        echo $this->render->render( "view/viajes.php", $data );
    }
}