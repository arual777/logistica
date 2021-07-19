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
        $data['vehiculo'] = $this->serviceModel->obtenerVehiculos();
        $data['chofer'] = $this->serviceModel->obtenerChoferes();
        $data['mecanico'] = $this->serviceModel->obtenerMecanicos();
        $data['tipoService'] = $this->serviceModel->obtenerTiposService();
        echo $this->render->render("view/nuevoService.php",$data);
    }

    public function insertarService(){

        $fecha = $_POST["fecha"];
        $kilometraje = $_POST["kilometraje"];
        $detalle = $_POST["detalle"];
        $repuestos_cambiados = $_POST["repuestos"];
        $id_Vehiculo = $_POST["vehiculo"];
        $id_Chofer = $_POST["chofer"];
        $id_Mecanico = $_POST["mecanico"];
        $id_TipoService = $_POST["tipoService"];

        $this->serviceModel->cambiarVehiculoAestadoDeReparacion($id_Vehiculo);
        $this->serviceModel->insertarService($id_Vehiculo,$id_Chofer, $id_Mecanico,$id_TipoService,$fecha,$kilometraje,$detalle,$repuestos_cambiados);
        $data['services'] = $this->serviceModel->obtenerServices();
        header("Location: /logistica/Service/listarServices");
        exit();
    }

    public function editarService(){
        $id_Service = $_GET["id"];
        $data['id']= $id_Service;
        $data["service"] = $this->serviceModel->obtenerServicePorId($data);
        $data["vehiculoActual"] = $this->serviceModel->obtenerVehiculoPorIdService($id_Service);
        $data["choferActual"] = $this->serviceModel->obtenerChoferPorIdService($id_Service);
        $data["mecanicoActual"] = $this->serviceModel->obtenerMecanicoPorIdService($id_Service);
        $data["tipoServiceActual"] = $this->serviceModel->obtenerTipoServicePorIdService($id_Service);
        $data["estadoActual"] = $this->serviceModel->obtenerEstadoActualDeUnVehiculo($id_Service);
        $data['vehiculo'] = $this->serviceModel->obtenerVehiculos();
        $data['tipoService'] = $this->serviceModel->obtenerTiposService();
        $data['chofer'] = $this->serviceModel->obtenerChoferes();
        $data['mecanico'] = $this->serviceModel->obtenerMecanicos();
        $data['estados'] = $this->serviceModel->obtenerEstadosPosiblesConUnMecanico();
        echo $this->render->render("view/modificarService.php",$data);
    }

    public function modificarService(){
        $data ["idService"]= isset($_POST["idService"]) ?  $_POST["idService"] : "";
        $data["fecha"] = isset($_POST["fecha"]) ?  $_POST["fecha"] : "";
        $data["kilometraje"] = isset($_POST["kilometraje"]) ?  $_POST["kilometraje"] : "";
        $data["repuestos"] = isset($_POST["repuestos"]) ?  $_POST["repuestos"] : "";
        $data["tipoService"] = isset($_POST["tipoService"]) ? $_POST["tipoService"] : "";
        $data["chofer"] = isset($_POST["chofer"]) ? $_POST["chofer"] : "";
        $data["mecanico"] = isset($_POST["mecanico"]) ? $_POST["mecanico"] : "";
        $data["vehiculo"] = isset($_POST["vehiculo"]) ? $_POST["vehiculo"] : "";
        $data["estado"] = isset($_POST["estado"]) ? $_POST["estado"] : "";

        $this->serviceModel->editarService($data);
        $data["services"] = $this->serviceModel->obtenerServices();
        header("Location: /logistica/Service/listarServices");
        exit();
    }

    public function borrarService(){
        $id = $_GET["id"];
        $this->serviceModel->borrarService($id);
        $data["services"] = $this->serviceModel->obtenerServices();
        header("Location: /logistica/Service/listarServices");
        exit();
    }

    public function obtenerDatosServices(){
        $id_Vehiculo= $this->serviceModel->obtenerVehiculos();
        $id_TipoService = $this->serviceModel->obtenerTiposService();
        $id_Usuario = $this->serviceModel->obtenerUsuarios();

        $data = array(
            'vehiculo' =>$id_Vehiculo,
            'tipoService' => $id_TipoService,
            'usuario' => $id_Usuario);
        return $data;
    }
}