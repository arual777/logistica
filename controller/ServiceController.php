<?php

class ServiceController
{
    private $render;
    private $model;

    public function __construct($render, $model)
    {
        $this->render = $render;
        $this->model = $model;
    }

    public function execute(){
        $data['services'] = $this->model->obtenerServices();
        echo $this->model->render("view/services.php",$data);
    }

    public function listarServices(){
        $data['services'] = $this->model->obtenerServices();
        echo $this->render->render("view/services.php",$data);
    }


    public function insertarService(){
        $data["id_Service"] = isset($_POST["id_Service"]) ?  $_POST["id_Service"] : "";
        $data["id_Vehiculo"] = isset($_POST["id_Vehiculo"]) ?  $_POST["id_Vehiculo"] : "";
        $data["id_Usuario"] = isset($_POST["id_Usuario"]) ?  $_POST["id_Usuario"] : "";
        $data["id_TipoService"] = isset($_POST["id_TipoService"]) ? ($_POST["id_TipoService"]) : "";
        $data["fecha"] = isset($_POST["fecha"]) ?  $_POST["fecha"] : "";
        $data["kilometraje"] = isset($_POST["kilometraje"]) ? $_POST["kilometraje"] : "";
        $data["detalle"] = isset($_POST["detalle"]) ? $_POST["detalle"] : "";
        $data["repuestos_cambiados"] = isset($_POST["repuestos_cambiados"]) ? $_POST["repuestos_cambiados"] : "";


        $this->model->insertarService($data);
        echo $this->render->render("view/nuevoService.php",$data);
    }

    public function editarService(){
        $id_Service = $_GET["id"];
        $data['id']= $id_Service;
        $data["service"] = $this->model->obtenerServicePorId($data);
        echo $this->render->render("view/modificarService.php",$data);
    }

    public function modificarService(){
        $data ["id"]= isset($_POST["id"]) ?  $_POST["id"] : "";
        $data["fecha"] = isset($_POST["fecha"]) ?  $_POST["fecha"] : "";
        $data["kilometraje"] = isset($_POST["kilometraje"]) ?  $_POST["kilometraje"] : "";
        $data["repuestos_cambiados"] = isset($_POST["repuestos_cambiados"]) ?  $_POST["repuestos_cambiados"] : "";

        $data["service"] = $this->model->obtenerServicePorId($data);

        $this->model->editarService($data);
        $data["services"] = $this->model->obtenerServices();
        echo $this->render->render("view/services.php",$data);
    }

    public function borrarService(){
        $id = $_GET["id"];
        $this->model->borrarService($id);
        $data["services"] = $this->model->obtenerServices();
        echo $this->render->render("view/services.php",$data);
    }
}