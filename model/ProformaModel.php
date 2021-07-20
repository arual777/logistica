<?php
class ProformaModel
{
    private $database;
    private $generadorQr;

    public function __construct($database, $generadorQr)
    {
        $this->database = $database;
        $this->generadorQr = $generadorQr;
    }

    public function crearProforma($idProforma, $idViaje, $idCarga, $denominacion, $cuit, $telefono, $mail, $contacto,$origen, $vehiculo, $arrastre,
                                  $destino, $fechaPartida,
                                  $tiempoEstimadollegada,$tipoCarga, $peso,
                                  $peligrosidad, $refrigeracion, $graduacion, $kmEstimados, $combustibleEstimado,
                                  $costoPeaje, $viatico, $costoHazard, $costoRefrigeracion,
                                  $tarifa, $idChofer){



         if($idProforma=="") {
                    $idCarga = $this->insertarCarga($tipoCarga, $peligrosidad, $refrigeracion, $graduacion, $peso);
                    $idViaje = $this->insertarViaje($idChofer, $idCarga,  $origen, $destino, $fechaPartida,
                                                    $tiempoEstimadollegada, $vehiculo, $arrastre);

                     $sql = "INSERT INTO Proforma (fecha, denominacion_cliente, cuit, telefono, mail, contacto,  
                      id_viaje, 
                      kilometros_estimados, combustible_litros_estimados, costo_peajes, costo_viaticos,
                      costo_peligroso,
                      costo_refrigeracion, tarifa)
                             values(NOW(), '$denominacion', '$cuit', '$telefono', '$mail', '$contacto', '$idViaje','$kmEstimados', 
                       '$combustibleEstimado', '$costoPeaje', '$viatico', '$costoHazard', '$costoRefrigeracion',
                       '$tarifa')";
                        $this->cambiarDisponibilidadDeUnVehiculoANoDisponible($vehiculo);
                        $this->database->execute($sql);
                        $this->generarQr($idViaje);
         } else{
             $ocupacionAnterior['ocupacion'] = $this->obtenerVehiculoDeUnViaje($idViaje);
             if(isset($ocupacionAnterior['ocupacion'][0]['id_Vehiculo'])){
                 $this->cambiarDisponibilidadDeUnVehiculoADisponible($ocupacionAnterior['ocupacion'][0]['id_Vehiculo']);
             }
             $this->cambiarDisponibilidadDeUnVehiculoANoDisponible($vehiculo);

             $sql = "UPDATE Carga SET id_TipoCarga = '$tipoCarga', 
                                        id_TipoHazard = '$peligrosidad',
                                        refrigeracion = '$refrigeracion',
                                        graduacion = '$graduacion', 
                                        peso = '$peso'
                                    
                                 WHERE id_Carga = '$idCarga'";
             $this->database->execute($sql);

             $sql = "UPDATE Viaje SET id_usuario = '$idChofer',  
                                        id_vehiculo = '$vehiculo',
                                        id_arrastre = '$arrastre',
                                        id_carga = '$idCarga',
                                        origen = '$origen', 
                                        destino = '$destino', 
                                        fecha_carga='$fechaPartida',
                                        tiempo_estimadoLlegada='$tiempoEstimadollegada'
                WHERE id_Viaje = '$idViaje'";

            $this->database->execute($sql);

            $sql = "UPDATE Proforma 
                            SET 
                                fecha = NOW(),
                                denominacion_cliente = '$denominacion', 
                                cuit = '$cuit',
                                telefono = '$telefono',
                                mail = '$mail',
                                contacto = '$contacto',
                                id_viaje = '$idViaje', 
                                kilometros_estimados = '$kmEstimados', 
                                combustible_litros_estimados = '$combustibleEstimado', 
                                costo_peajes = '$costoPeaje', 
                                costo_viaticos = '$viatico', 
                                costo_peligroso = '$costoHazard',
                                costo_refrigeracion = '$costoRefrigeracion', 
                                tarifa = '$tarifa'                                                                                                                                                                                                       
                WHERE id_factura = '$idProforma'";
            $this->database->execute($sql);
        }
    }
    public function obtenerChoferes(){
        $sql = "SELECT ID_USUARIO,NOMBRE, APELLIDO FROM USUARIO where id_rol=".CHOFER;
        return $this->database->query($sql);
    }

    public function obtenerVehiculos(){
        $sql = "select id_vehiculo, marca, patente, modelo from Vehiculo
                where id_Tipo <> ".ARRASTRE;
        return $this->database->query($sql);
    }

    public function obtenerVehiculosDeArrastre(){
        $sql= "select V.id_vehiculo, V.patente, V.chasis, S.descripcion
                from Vehiculo V JOIN Tipo_Semi S on V.id_TipoSemi=S.id_Tipo
                where V.id_Tipo =".ARRASTRE; //
        return $this->database->query($sql);
    }

    public function obtenerVehiculosDisponibles(){
        $sql = "select id_vehiculo, marca, patente, modelo from Vehiculo
                where id_disponible=3 and id_Tipo <> ".ARRASTRE;
        return $this->database->query($sql);
    }

    public function obtenerTipoDeCarga(){
        $sql = "select id_TipoCarga, descripcion from Tipo_Carga;";
        return $this->database->query($sql);
    }

    public function obtenerTipoHazard(){
        $sql = "select id_TipoHazard, descripcion from Tipo_Hazard;";
        return $this->database->query($sql);
    }

    public function consultarProformasPorNumero($numero){
        $solicitud = "SELECT * FROM Proforma where id_factura ='$numero'";
        $resultado = $this->database->query($solicitud);
        if (count($resultado) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function calcularCostosCombustibleCargado($idViaje){

        $combustibleCargadoConsulta = "select sum(combustibleCargado) as combustibleCargado
                                from Viaje_Detalle 
                                where id_viaje = '$idViaje'";

        $resultadoCombustibleConsulta = $this->database->query($combustibleCargadoConsulta);

        $combustibleCargado= $resultadoCombustibleConsulta[0]["combustibleCargado"];

        $precioActualConsulta = "select precio_litro from Combustible";
        $resultadoPrecioConsulta = $this->database->query($precioActualConsulta);
        $precioActualizado= $resultadoPrecioConsulta [0] ["precio_litro"];

        $costoTotalCombustible = ($combustibleCargado * $precioActualizado);

        return $costoTotalCombustible;
    }

    public function calcularKilometros($idViaje){

        $consulta = "SELECT kilometraje
                     from Viaje_Detalle
                    where id_Viaje = '$idViaje'";
        $calcularKilometrosConsulta = $this->database->query($consulta);
        $kilometrosCargados= $calcularKilometrosConsulta[0]["kilometraje"];

        $kilometrosActuales = "select kilometros_estimados from Proforma where id_Viaje = '$idViaje'";
        $resultadoKilometrosActuales= $this->database->query($kilometrosActuales);
        $kilometrosEstimados= $resultadoKilometrosActuales [0] ["kilometros_estimados"];

        $kilometrosDiferencia = ($kilometrosEstimados - $kilometrosCargados);

        return $kilometrosDiferencia;
    }

    public function calcularFacturacion($idViaje)
    {
        $estadoViaje = "SELECT id_estado FROM Viaje where id_viaje = '$idViaje'";
        $resultado = $this->database->query($estadoViaje);

        if ($resultado[0]["id_estado"] == FINALIZADO) {

            $costoPeligrosoConsulta = "select costo_peligroso from Proforma where id_viaje = '$idViaje'";
            $resultadoCostoPeligroso = $this->database->query($costoPeligrosoConsulta);
            $costoPeligroso = $resultadoCostoPeligroso[0]["costo_peligroso"];

            $costoRefrigeracionConsulta = "select costo_refrigeracion 
                            from Proforma where id_viaje = '$idViaje'";
            $resultadoRefrigeracionConsulta = $this->database->query($costoRefrigeracionConsulta);

            $costoRefrigeracion= $resultadoRefrigeracionConsulta[0]["costo_refrigeracion"];

            $costoTarifa = "select tarifa from Proforma where id_viaje = '$idViaje'";
            $resultadoTarifaConsulta = $this->database->query($costoTarifa);
            $costoTarifa= $resultadoTarifaConsulta[0]["tarifa"];

            $calculoKilometros = $this->calcularKilometros($idViaje);
            $costoCombusitble = $this->calcularCostosCombustibleCargado($idViaje);

            $costoPeajesConsulta = "select sum(peajes) as peajes  from Viaje_Detalle where id_viaje = '$idViaje'";
            $resultadoPeajesConsulta = $this->database->query($costoPeajesConsulta);
            $costoPeajes= $resultadoPeajesConsulta[0]["peajes"];

            $costoExtrasConsulta = "select sum(extras) as extras 
                                            from Viaje_Detalle 
                                        where id_viaje = '$idViaje'";

            $resultadoExtrasConsulta = $this->database->query($costoExtrasConsulta);

            $costoExtras= $resultadoExtrasConsulta[0]["extras"];

            $importeFinal = $costoPeligroso + $costoRefrigeracion + $costoTarifa + $costoCombusitble +
                $costoPeajes + $costoExtras;

            $facturacionFinal = array("importeFinal" => $importeFinal,
                        "costoExtras" => $costoExtras,
                         "costoPeajes" => $costoPeajes,
                            "costoCombustible" => $costoCombusitble,
                            "costoTarifa" => $costoTarifa,
                            "costoRefrigeracion" => $costoRefrigeracion,
                            "costoPeligroso" => $costoPeligroso,
                            "calculoKilometros" => $calculoKilometros);

            return $facturacionFinal;
        }
    }

    public function obtenerProformas(){  
        $sql = "select id_factura, id_viaje, fecha, denominacion_cliente from Proforma";
        return $this->database->query($sql);
    }

    public function detalleProforma($id){
        $sql = "select * from PROFORMA p
        join viaje v on p.id_viaje = v.id_viaje
        join carga c on v.id_carga = c.id_Carga  WHERE p.id_factura = '$id'";
       return $this->database->query($sql);
    }

    private function insertarCarga($tipoCarga, $peligrosidad, $refrigeracion, $graduacion, $peso){
        $sql = "INSERT INTO Carga (id_TipoCarga, id_TipoHazard, refrigeracion, graduacion, peso)   
                values('$tipoCarga','$peligrosidad', '$refrigeracion','$graduacion', '$peso')";

        $this->database->execute($sql);

        return $this->database->lastId();
    }

    private function insertarViaje($idChofer, $idCarga, $origen, $destino, $fechaPartida, $tiempoEstimadoLlegada,
                                   $vehiculo, $arrastre){
        $estadoViaje= PENDIENTE;

        $sql = "INSERT INTO Viaje ( id_usuario, id_carga, id_estado, origen, destino, fecha_carga, tiempo_estimadoLlegada,codigo_qr,id_vehiculo, id_arrastre)   
                values('$idChofer', '$idCarga', '$estadoViaje', '$origen','$destino','$fechaPartida','$tiempoEstimadoLlegada', null, 
                       '$vehiculo', '$arrastre')";

        $this->database->execute($sql);

        return $this->database->lastId();
    }

    private function generarQr($idViaje){
        $directorioQrGenerado = $this->generadorQr->generarQr($idViaje);
        $sql = "UPDATE Viaje set codigo_qr = '$directorioQrGenerado'
                WHERE id_viaje = '$idViaje'";
        $this->database->execute($sql);
    }

    public function obtenerVehiculoDeUnViaje($id_viaje){
        return $this->database->query("select ve.id_Vehiculo from Viaje v join Vehiculo ve on ve.id_Vehiculo=v.id_vehiculo where v.id_viaje='$id_viaje'");
    }

    public function obtenerCodigoQrPorIdDeProforma($id_proforma){
        return $this->database->query("select v.codigo_qr from Proforma p join Viaje v on v.id_viaje=p.id_viaje where p.id_factura='$id_proforma'");
    }

    public function cambiarDisponibilidadDeUnVehiculoANoDisponible($id_vehiculo){
        return $this->database->execute("UPDATE Vehiculo set id_disponible=4 where id_vehiculo='$id_vehiculo'");
    }

    public function cambiarDisponibilidadDeUnVehiculoADisponible($id_vehiculo){
        return $this->database->execute("UPDATE Vehiculo set id_disponible=3 where id_vehiculo='$id_vehiculo'");

    }


}