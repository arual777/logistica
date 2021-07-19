<?php


class VehiculosController
{
    private $render;
    private $model;

    public function __construct($render,$model)
    {
        $this->render = $render;
        $this->model = $model;
    }

    public function execute(){
        $data['vehiculos'] = $this->model->obtenerVehiculos();
        echo $this->model->render("view/vehiculos.php",$data);
    }

    public function listarVehiculos(){
        $data['vehiculos'] = $this->model->obtenerVehiculosConEstadoYtipo();
        echo $this->render->render("view/vehiculos.php",$data);
    }

    public function insertar(){
        $data['tipoVehiculo'] = $this->model->obtenerTiposVehiculos();
        $data['tipoArrastre'] = $this->model->obtenerTiposRemolques();
        echo $this->render->render("view/nuevoVehiculo.php",$data);
    }

    public function insertarVehiculo(){
        $marca = $_POST["marca"];
        $modelo = $_POST["modelo"];
        $patente = $_POST["patente"];
        $motor = $_POST["motor"];
        $chasis = $_POST["chasis"];
        $anio_fabricacion = $_POST["anio_fabricacion"];
        $kilometraje = $_POST["kilometraje"];
        $estado = $_POST["estado"];
        $tipoVehiculo = $_POST["tipoVehiculo"];
        $arrastre = $_POST["arrastre"];
        $disponibilidad = 3;
        $this->model->insertarVehiculo($tipoVehiculo,$arrastre,$marca,$modelo,$patente,$motor,$chasis,$anio_fabricacion,$kilometraje,$estado,$disponibilidad);
        $data['vehiculos'] = $this->model->obtenerVehiculos();
        header("Location: /logistica/Vehiculos/listarVehiculos/");
    }

    public function editar(){
        $id_Vehiculo = $_GET["id"];
        $data['id']= $id_Vehiculo;
        $data["vehiculo"] = $this->model->obtenerVehiculoPorId($data);
        $data["vehiculoTipoActual"] = $this->model->obtenerVehiculoPorIdDeVehiculo($id_Vehiculo);
        $data["arrastreActual"] = $this->model->obtenerArrastrePorIdDeVehiculos($id_Vehiculo);
        $data['tipoVehiculo'] = $this->model->obtenerTiposVehiculos();
        $data['tipoArrastre'] = $this->model->obtenerTiposRemolques();
        $data['disponibilidad'] = $this->model->obtenerEstadosDeDisponibilidad();

        echo $this->render->render("view/vehiculoModificar.php",$data);
    }

    public function modificarVehiculo(){
        $data ["idVehiculo"]= isset($_POST["idVehiculo"]) ?  $_POST["idVehiculo"] : "";
        $data["marca"] = isset($_POST["marca"]) ?  $_POST["marca"] : "";
        $data["modelo"] = isset($_POST["modelo"]) ?  $_POST["modelo"] : "";
        $data["patente"] = isset($_POST["patente"]) ?  $_POST["patente"] : "";
        $data["chasis"] = isset($_POST["chasis"]) ?  $_POST["chasis"] : "";
        $data["anio_fabricacion"] = isset($_POST["anio_fabricacion"]) ? $_POST["anio_fabricacion"] : "";
        $data["kilometraje"] = isset($_POST["kilometraje"]) ? $_POST["kilometraje"] : "";
        $data["tipoVehiculo"] = isset($_POST["tipoVehiculo"]) ? $_POST["tipoVehiculo"] : "";
        $data["arrastre"] = isset($_POST["arrastre"]) ? $_POST["arrastre"] : "1";
        $data["disponibilidad"] = isset($_POST["disponibilidad"]) ? $_POST["disponibilidad"] : "4";
        $this->model->editarVehiculo($data);
        header("Location: /logistica/Vehiculos/listarVehiculos/");
    }

    public function borrarVehiculo(){
        $id = $_GET["id"];
        $this->model->borrarVehiculo($id);
        $data["vehiculos"] = $this->model->obtenerVehiculos();
        echo $this->render->render("view/vehiculos.php",$data);
    }


    public function obtenerDatosVehiculos(){

        $tipoVehiculos= $this->model->obtenerTiposVehiculos();
        $tipoRemolques= $this->model->obtenerTiposRemolque();
        $data = array(
            'tipoVehiculos' =>$tipoVehiculos,
            'tipoRemolques' => $tipoRemolques);
        return $data;
    }
}