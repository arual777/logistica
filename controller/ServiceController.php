<?php

class ServiceController
{
    private $render;
    private $serviceModel;

    public function __construct($render, $serviceModel)
    {
        $this->render = $render;
        $this->serviceModel = $serviceModel;
    }

    public function execute(){
        $data['services'] = $this->serviceModel->obtenerServices();
        echo $this->serviceModel->render("view/services.php",$data);
    }

    public function listarServices(){
        $data['services'] = $this->serviceModel->obtenerServices();
        echo $this->render->render("view/services.php",$data);
    }

    public function insertar(){
        echo $this->render->render("view/nuevoService.php");
    }

    public function insertarService(){
        $fecha = $_POST["fecha"];
        $kilometraje =$_POST["kilometraje"];
        $detalle = $_POST["detalle"];
        $repuestos_cambiados = $_POST["repuestos"];

        $this->serviceModel->insertarService($fecha,$kilometraje,$detalle,$repuestos_cambiados);
        $data['services'] = $this->serviceModel->obtenerServices();
        echo $this->render->render("view/services.php",$data);
    }

    public function editarService(){
        $id_Service = $_GET["id"];
        $data['id']= $id_Service;
        $data["service"] = $this->serviceModel->obtenerServicePorId($data);
        echo $this->render->render("view/modificarService.php",$data);
    }

    public function modificarService(){
        $data ["idService"]= isset($_POST["idService"]) ?  $_POST["idService"] : "";
        $data["fecha"] = isset($_POST["fecha"]) ?  $_POST["fecha"] : "";
        $data["kilometraje"] = isset($_POST["kilometraje"]) ?  $_POST["kilometraje"] : "";
        $data["repuestos"] = isset($_POST["repuestos"]) ?  $_POST["repuestos"] : "";


        $this->serviceModel->editarService($data);
        $data["services"] = $this->serviceModel->obtenerServices();
        echo $this->render->render("view/services.php",$data);
    }

    public function borrarService(){
        $id = $_GET["id"];
        $this->serviceModel->borrarService($id);
        $data["services"] = $this->serviceModel->obtenerServices();
        echo $this->render->render("view/services.php",$data);
    }
}