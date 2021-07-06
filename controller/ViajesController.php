<?php


class ViajesController
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
        $data["viajes"] = $this->model->obtenerViajesPorOrdenFecha();
        echo $this->render->render( "view/viajes.php", $data );
    }

    public function detalleViaje(){
        $id = $_GET["id"];
        $data["viaje"] = $this->model->obtenerDetalleViaje($id);
        echo $this->render->render( "view/infoViaje.php", $data );
    }
}