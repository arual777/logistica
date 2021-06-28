<?php

class ProformaController
{
    private $render;
    private $proformaModel;

    public function __construct($render, $proformaModel)
    {
        $this->render = $render;
        $this->proformaModel= $proformaModel;
    }

    public function execute()
    {
        $proformas = $this->proformaModel->obtenerProformas();
        $data = array('proformas'=>$proformas);
        echo $this->render->render("view/proformas.php", $data);
    }

    public function crear()
    {
        if(!$this->parametrosEstanCompletos()){
            $data = $this->obtenerDatosFormulario();
            echo $this->render->render("view/proforma.php",$data);
            exit();
        }

        $cliente = $_POST["clientes"];
        $chofer = $_POST["chofer"];
        $fecha  = $_POST["fecha"];
        $origen = $_POST["origen"];
        $destino  = $_POST["destino"];
        $fechaCarga = $_POST["fechaCarga"];
        $llegada  = $_POST["llegada"];
        $tipoCarga= $_POST["tipoCarga"];
        $peso = $_POST["peso"];
        $tipoHazard = $_POST["tipoHazard"];
        $refrigeracion  = $_POST["refrigeracion"];
        $graduacion= $_POST["graduacion"];
        $km  = $_POST["km"];
        $combustible = $_POST["combustible"];
        $viatico  = $_POST["viatico"];
        $costoPeaje = $_POST["peaje"];
        $costoHazard  = $_POST["costoHazard"];
        $costoRefrigeracion = $_POST["costoRefrigeracion"];
        $tarifa  = $_POST["tarifa"];

        $this->proformaModel->crearProforma($fecha, $origen, $destino, $tipoCarga, $refrigeracion, $graduacion,
            $viatico, $costoPeaje, $costoHazard, $costoRefrigeracion,
            $tarifa, $km, $peso, $tipoHazard, $fechaCarga, $llegada, $cliente, $chofer);

        $proformas = $this->proformaModel->obtenerProformas();
        $data = array('proformas'=>$proformas);
        echo $this->render->render("view/proformas.php", $data);
    }


    private function parametrosEstanCompletos(){
        if(
            empty($_POST['origen'])||
            empty($_POST['destino'])||
            empty($_POST['fechaCarga'])||
            empty($_POST['llegada']) ||
            empty($_POST['tipoCarga'])||
            empty($_POST['peso'])||
            empty($_POST['tipoHazard'])||
            empty($_POST['refrigeracion'])||
            empty($_POST['km'])||
            empty($_POST['combustible'])||
            empty($_POST['viatico'])||
            empty($_POST['peaje'])||
            empty($_POST['costoHazard']) ||
            empty($_POST['costoRefrigeracion']) ||
            empty($_POST['tarifa'])){
            return false;
        }
        return true;
    }

    private function obtenerDatosFormulario(){
        $choferes= $this->proformaModel->obtenerChoferes();
        $tipoCarga= $this->proformaModel->obtenerTipoDeCarga();
        $clientes= $this->proformaModel->obtenerClientes();
        $tipoHazard= $this->proformaModel->obtenerTipoHazard();
        $data = array('choferes'=>$choferes, 'tipoCarga' => $tipoCarga, 'clientes'=>$clientes, 'tipoHazard'=> $tipoHazard);
        return $data;
    }
}