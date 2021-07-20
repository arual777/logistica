<?php

class ProformaController
{
    private $render;
    private $proformaModel;

    public function __construct($render, $proformaModel, $viajesModel, $vehiculoModel)
    {
        $this->render = $render;
        $this->proformaModel = $proformaModel;
        $this->viajeModel = $viajesModel;
        $this->vehiculoModel = $vehiculoModel;
    }

    public function execute()
    {
        $proformas = $this->proformaModel->obtenerProformas();
        $data = array('proformas' => $proformas);
        echo $this->render->render("view/proformas.php", $data);
    }

    public function formularioProforma()
    {
        $id_ProformaParaSaberSiTieneQr = 0;
        $data = $this->obtenerDatosFormulario($id_ProformaParaSaberSiTieneQr);
        echo $this->render->render("view/proforma.php", $data);
    }

    public function detalleProforma()
    {
        $id = isset($_GET["id"]) ? $_GET["id"]  : "0";   //En qué caso sería un cero?
        $idViaje = $_GET["id_viaje"];

        $proforma = $this->proformaModel->detalleProforma($id);
        $data = array('proforma' => $proforma);
        $datosFormulario = $this->obtenerDatosFormulario($id);
        $datosFormulario["proforma"] = $proforma;
        $qrExistente[] = $this->proformaModel->obtenerCodigoQrPorIdDeProforma($id);
        if(isset($qrExistente)){ //PERO NO SE SETEA EL QR??  ¿QUÉ HACE ESTO?
            $datosFormulario['tieneQr'] = true;
        }

        $costosReales = $this-> proformaModel->calcularFacturacion($idViaje);
        $datosFormulario["costos"] = $costosReales;
        echo $this->render->render("view/proforma.php", $datosFormulario);
    }

    public function crear()
    {
        $denominacion = $_POST["denominacion"];
        $cuit = $_POST["cuit"];
        $telefono = $_POST["telefono"];
        $mail = $_POST["mail"];
        $contacto = $_POST["contacto"];
        $chofer = $_POST["chofer"];
        $origen = $_POST["origen"];
        $vehiculo = $_POST ["vehiculo"];
        $arrastre = $_POST ["arrastre"];

        $destino = $_POST["destino"];
        $fechaPartida = $_POST["fechaCarga"];
        $tiempoEstimadollegada = $_POST["llegada"];
        $tipoCarga = $_POST["tipoCarga"];
        $peso = $_POST["peso"];
        $peligrosidad = $_POST["tipoHazard"];
        $refrigeracion = $_POST["refrigeracion"];
        $graduacion = isset($_POST["graduacion"]) ? : "0";
        $kmEstimados = $_POST["km"];
        $combustibleEstimado = $_POST["combustible"];
        $costoPeaje = $_POST["peaje"];
        $viatico = $_POST["viatico"];
        $costoHazard = $_POST["costoHazard"];
        $costoRefrigeracion = $_POST["costoRefrigeracion"];
        $tarifa = $_POST["tarifa"];
        $idProforma = $_POST ["factura"];
        $idViaje = $_POST["viaje"];
        $idCarga = $_POST["carga"];


        $this->proformaModel->crearProforma($idProforma, $idViaje, $idCarga, $denominacion, $cuit, $telefono, $mail, $contacto, $origen, $vehiculo,
            $arrastre, $destino, $fechaPartida,
            $tiempoEstimadollegada, $tipoCarga, $peso,
            $peligrosidad, $refrigeracion, $graduacion, $kmEstimados, $combustibleEstimado,
            $costoPeaje, $viatico, $costoHazard, $costoRefrigeracion,
            $tarifa, $chofer);

        $proformas = $this->proformaModel->obtenerProformas();
        $data = array('proformas' => $proformas);
        echo $this->render->render("view/proformas.php", $data);
    }

    private function obtenerDatosFormulario($id)
    {
        //Obtengo todos los choferes disponibles
        $choferes = $this->proformaModel->obtenerChoferes();

        if(isset($_GET["id_viaje"])){
            $choferViaje = $this->proformaModel->obtenerChoferAsignadoAlViaje($_GET["id_viaje"]);
            $choferes = array_merge($choferes, $choferViaje);
        }

        //Obtengo chofer asignado al viaje
        $tipoCarga = $this->proformaModel->obtenerTipoDeCarga();
        $tipoHazard = $this->proformaModel->obtenerTipoHazard();
        if($id==0){  //CUANDO NO HAY PROFORMA SERÍA CERO?
            $tipoVehiculo = $this->proformaModel->obtenerVehiculosDisponibles();
        }else{
            $tipoVehiculo = $this->proformaModel->obtenerVehiculos();
        }
        $tipoVehiculoArrastre = $this->proformaModel->obtenerVehiculosDeArrastre();
        $data = array(
            'choferes' => $choferes,
            'tipoCarga' => $tipoCarga,
            'tipoHazard' => $tipoHazard,
            'vehiculo' => $tipoVehiculo,
            'arrastre' => $tipoVehiculoArrastre);
        return $data;
    }

    public function verFacturacion()
    {
        $idProforma = $_GET["id"];
        $idViaje = $_GET["id_viaje"];
        $proforma = $this->proformaModel->detalleProforma($idProforma);
        $datosFormulario = $this->obtenerDatosFormulario();
        $datosFormulario["proforma"] = $proforma;
        $costosReales = $this-> proformaModel->calcularFacturacion($idViaje);
        $datosFormulario["costos"] = $costosReales;

        echo $this->render->render("view/proforma.php", $datosFormulario);
    }

    public function printPdf()
    {
        include_once('helper/DomPdf.php');
        $data['proforma'] = $this->proformaModel->detalleProforma($_GET['id']);
        $data['vehiculoAusar'] = $this->vehiculoModel->obtenerVehiculoPorIdDeVehiculo($data['proforma'][0]['id_vehiculo']);
        $data['arrastreAusar'] = $this->vehiculoModel->obtenerArrastrePorIdDeVehiculos($data['proforma'][0]['id_vehiculo']);
        $data['tipoDeCarga'] = $this->viajeModel->obtenerElTipoDeCargaPeligrosa($data['proforma'][0]['id_carga']);
        $data['refrigeracion'] = $this->viajeModel->obtenerRefrigeracion($data['proforma'][0]['id_carga']);
        $data['chofeAsignado'] = $this->viajeModel->obtenerChoferDeUnViaje($data['proforma'][0]['id_viaje']);
        $qr = $data["proforma"][0]["codigo_qr"];  //traemos el directorio con el nombre del archivo
        $type = pathinfo('.'.$qr, PATHINFO_EXTENSION);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents('.'.$qr));
        //agarra el archivo png y lo convierte a base 64 para que se pueda ver dentro del pdf

        if ($data['refrigeracion'][0]['refrigeracion'] == 1) {
            $data['refrigeracion'][0]['refrigeracion'] = "Si";
        } else {
            $data['refrigeracion'][0]['refrigeracion'] = "No";
            $data['refrigeracion'][0]['graduacion'] = 0;
        }

        $costosReales = $this-> proformaModel->calcularFacturacion($data['proforma'][0]['id_viaje']);
        $data["costos"] = $costosReales;

        if(isset($costosReales)){
            $data["costos"] = $costosReales;
        }else{
            $data['costos']['calculoKilometros'] = "El viaje aún no finalizo";
            $data['costos']['costoCombustible'] = "El viaje aún no finalizo";
            $data['costos']['costoExtras'] = "El viaje aún no finalizo";
            $data['costos']['costoPeajes'] = "El viaje aún no finalizo";
            $data['costos']['costoPeligroso'] = "El viaje aún no finalizo";
            $data['costos']['costoRefrigeracion'] = "El viaje aún no finalizo";
            $data['costos']['costoTarifa'] = "El viaje aún no finalizo";
            $data['costos']['calculoKilometros'] = "El viaje aún no finalizo";
            $data['costos']['importeFinal'] = "El viaje aún no finalizo";
        }

        $id_Proforma = $data['proforma'][0]['id_factura'];



        //    $html = file_get_contents_curl("http://localhost/logistica/Proforma/detalleProforma/id=".$_GET['id']);
        $dompdf->loadHtml('<!DOCTYPE html>
                           <html lang="en">
                           <head>
                                <meta charset="UTF-8">
                                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                <title>Proforma: ' . $id_Proforma . '</title>
                            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
                             integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
                           </head>
                         
                           <body>
                                <h1>Proforma N°: ' . $id_Proforma . '</h1>
                                                    <h2>Datos del cliente</h2>
                                                          <table class="">           
                                                               <tr>
                                                                  <td>Nombre: ' . $data['proforma'][0]['denominacion_cliente'] . ' </td>
                                                               </tr>                                       
                                                                <tr>
                                                                   <td>Cuit: ' . $data['proforma'][0]['cuit'] . '</td>
                                                                </tr>   
                                                                <tr>
                                                                   <td>Telefono: ' . $data['proforma'][0]['telefono'] . '</td>
                                                                </tr>
                                                                <tr>
                                                                   <td>Contacto: ' . $data['proforma'][0]['contacto'] . '</td>
                                                                </tr>
                                                                <tr>
                                                                   <td>Email: ' . $data['proforma'][0]['mail'] . ' :</td>
                                                                </tr>   
                                                          </table>
                                                    <h2>Datos del viaje</h2>
                                                          <table>                        
                                                                <tr>
                                                                    <td>Fecha de carga: ' . $data['proforma'][0]['fecha_carga'] . ' </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Fecha estimada de llegada: ' . $data['proforma'][0]['tiempo_estimadoLlegada'] . ' </td>
                                                                </tr>                                          
                                                                <tr>
                                                                    <td>Origen del viaje: ' . $data['proforma'][0]['origen'] . ' :</td>
                                                                </tr>                      
                                                                <tr>
                                                                    <td>Destino del viaje: ' . $data['proforma'][0]['destino'] . '  </td>
                                                          </table>
                                                    <h2>Datos del vehiculo</h2>   
                                                          <table>         
                                                                  </tr>                                                      
                                                                  <tr>
                                                                      <td>Denominación : ' . $data['vehiculoAusar'][0]['descripcion'] . '</td>
                                                                  </tr>                      
                                                                  <tr>
                                                                      <td>Vehiculo de arrastre : ' . $data['arrastreAusar'][0]['descripcion'] . '</td>
                                                                  </tr>  
                                                          </table>
                                                    <h2>Datos de la carga</h2>
                                                          <table>                             
                                                                  <tr>
                                                                      <td>Carga peligrosa : ' . $data['tipoDeCarga'][0]['descripcion'] . '</td>
                                                                  </tr>  
                                                                  <tr>
                                                                      <td>Peso : ' . $data['refrigeracion'][0]['peso'] . '</td>
                                                                  </tr>                     
                                                                  <tr>
                                                                      <td>Requiere refrigeracion :' . $data['refrigeracion'][0]['refrigeracion'] . '</td>
                                                                  </tr>    
                                                                  <tr>
                                                                      <td>Temperatura:' . $data['refrigeracion'][0]['graduacion'] . '°C</td>
                                                                  </tr>  
                                                          </table>
                                                    <h2>Costos estimados</h2>
                                                          <table>                
                                                                  <tr>
                                                                      <td>Kilometros estimados: ' . $data['proforma'][0]['kilometros_estimados'] . ' </td>
                                                                  </tr>                                       
                                                                  <tr>
                                                                      <td>Combustible: ' . $data['proforma'][0]['combustible_litros_estimados'] . '</td>
                                                                  </tr>                                              
                                                                  <tr>
                                                                      <td>Viaticos: ' . $data['proforma'][0]['costo_viaticos'] . ' </td>
                                                                  </tr>
                                                                          
                                                                  <tr>
                                                                      <td>Peajes y pasajes : ' . $data['proforma'][0]['costo_peajes'] . ' </td>
                                                                  </tr>                            
                                                                  <tr>
                                                                      <td>Peligrosidad : ' . $data['proforma'][0]['costo_peligroso'] . '</td>
                                                                  </tr>                            
                                                                  <tr>
                                                                      <td>Refrigeracion : ' . $data['proforma'][0]['costo_refrigeracion'] . '</td>
                                                                  </tr>                            
                                                                  <tr>
                                                                      <td>Tarifa:  ' . $data['proforma'][0]['tarifa'] . '</td>
                                                                  </tr>  
                                                          </table>
                                                    <h2>Personal asignado</h2>
                                                          <table>         
                                                                  <tr>
                                                                      <td>Chofer asignado:  ' . $data['chofeAsignado'][0]['nombre'] . ' ' . $data['chofeAsignado'][0]['apellido'] . '</td>
                                                                  </tr>                         
                                                          </table>
                                                                                                              <h2>Costos reales</h2>
                                                          <table>
                                                                  <tr>
                                                                        <td>Diferencia de kilometros: ' . $data['costos']['calculoKilometros'] . '</td>
                                                                  </tr>
                                                                   <tr>
                                                                        <td>Combustible: ' . $data['costos']['costoCombustible'] . '</td>
                                                                  </tr>
                                                                  <tr>
                                                                        <td>Viaticos(extra): ' . $data['costos']['costoExtras'] . '</td>
                                                                  </tr>
                                                                  <tr>
                                                                        <td>Peajes: ' . $data['costos']['costoPeajes'] . '</td>
                                                                  </tr>
                                                                  <tr>
                                                                        <td>Peligrosidad: ' . $data['costos']['costoPeligroso'] . '</td>
                                                                  </tr>
                                                                  <tr>
                                                                        <td>Refrigeración: ' . $data['costos']['costoRefrigeracion'] . '</td>
                                                                  </tr>
                                                                  <tr>
                                                                        <td>Tarifa: ' . $data['costos']['costoTarifa'] . '</td>
                                                                  </tr>
                                                                  <tr>
                                                                        <td>Gastos reales: ' . $data['costos']['importeFinal'] . '</td>
                                                                  </tr>
                                                          </table>
                                                          <table>
                                                          <tr>
                                                            <td> 
                                                            <img src="'.$base64.'">

                                                            </td>
                                                          </tr>

                                                          </table>
                           </body>
                           </html>'


        );

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landingpage');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("document.pdf", ['Attachment' => 0]);


    }

}