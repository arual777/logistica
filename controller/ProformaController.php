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

    public function formularioProforma(){
        $data = $this->obtenerDatosFormulario();
        echo $this->render->render("view/proforma.php",$data);
    }

    public function detalleProforma()
    {   $id = $_GET["id"];
        $proforma = $this->proformaModel->detalleProforma($id);
        $data = array('proforma' => $proforma);
        $datosFormulario = $this->obtenerDatosFormulario();
        $datosFormulario["proforma"] = $proforma;
        echo $this->render->render("view/proforma.php", $datosFormulario);
    }

    public function crear()
    {
        $denominacion= $_POST["denominacion"];
        $cuit= $_POST["cuit"];
        $telefono= $_POST["telefono"];
        $mail= $_POST["mail"];
        $contacto= $_POST["contacto"];
        $chofer = $_POST["chofer"];
        $origen = $_POST["origen"];
        $vehiculo= $_POST ["vehiculo"];
        $arrastre= $_POST ["arrastre"];
        $destino  = $_POST["destino"];
        $fechaPartida = $_POST["fechaCarga"];
        $tiempoEstimadollegada  = $_POST["llegada"];
        $tipoCarga= $_POST["tipoCarga"];
        $peso = $_POST["peso"];
        $peligrosidad = $_POST["tipoHazard"];
        $refrigeracion  = $_POST["refrigeracion"];
        $graduacion= $_POST["graduacion"];
        $kmEstimados = $_POST["km"];
        $combustibleEstimado = $_POST["combustible"];
        $costoPeaje = $_POST["peaje"];
        $viatico  = $_POST["viatico"];
        $costoHazard  = $_POST["costoHazard"];
        $costoRefrigeracion = $_POST["costoRefrigeracion"];
        $tarifa  = $_POST["tarifa"];
        $idProforma= $_POST ["factura"];
        $idViaje= $_POST["viaje"];
        $idCarga= $_POST["carga"];


        $this->proformaModel->crearProforma($idProforma, $idViaje, $idCarga, $denominacion, $cuit, $telefono, $mail, $contacto, $origen, $vehiculo,
                                    $arrastre, $destino, $fechaPartida,
                                    $tiempoEstimadollegada,$tipoCarga, $peso,
                                  $peligrosidad, $refrigeracion, $graduacion, $kmEstimados, $combustibleEstimado,
                                  $costoPeaje, $viatico, $costoHazard, $costoRefrigeracion,
                                  $tarifa, $chofer);

        $proformas = $this->proformaModel->obtenerProformas();
        $data = array('proformas'=>$proformas);
        echo $this->render->render("view/proformas.php", $data);
    }

    private function obtenerDatosFormulario(){
        $choferes= $this->proformaModel->obtenerChoferes();
        $tipoCarga= $this->proformaModel->obtenerTipoDeCarga();
        $tipoHazard= $this->proformaModel->obtenerTipoHazard();
        $tipoVehiculo = $this->proformaModel->obtenerVehiculos();
        $tipoVehiculoArrastre = $this->proformaModel->obtenerVehiculosDeArrastre();
        $data = array(
            'choferes' =>$choferes,
            'tipoCarga' => $tipoCarga,
            'tipoHazard'=> $tipoHazard,
            'vehiculo' =>$tipoVehiculo,
            'arrastre' =>$tipoVehiculoArrastre);
        return $data;
    }


    public function printPdf(){
        include_once('helper/DomPdf.php');

        $html = file_get_contents_curl("http://localhost/logistica/Proforma/detalleProforma/id=".$_GET['id']);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landingpage');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("document.pdf" , ['Attachment' => 0]);


    }

}