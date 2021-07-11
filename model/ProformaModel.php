<?php
class ProformaModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function crearProforma($idProforma, $idViaje, $idCarga, $denominacion, $cuit, $telefono, $mail, $contacto,$origen, $vehiculo, $arrastre,
                                  $destino, $fechaPartida,
                                  $tiempoEstimadollegada,$tipoCarga, $peso,
                                  $peligrosidad, $refrigeracion, $graduacion, $kmEstimados, $combustibleEstimado,
                                  $costoPeaje, $viatico, $costoHazard, $costoRefrigeracion,
                                  $tarifa, $idChofer){



         if($idProforma=="") {
                    $idCarga = $this->insertarCarga($tipoCarga, $peligrosidad, $refrigeracion, $graduacion, $peso);
                    $idViaje = $this->insertarViaje($idChofer, $idCarga, $origen, $destino, $fechaPartida,
                                                    $tiempoEstimadollegada, $vehiculo, $arrastre);

                     $sql = "INSERT INTO Proforma (fecha, denominacion_cliente, cuit, telefono, mail, contacto,  id_viaje, 
                      kilometros_estimados, combustible_litros_estimados, costo_peajes, costo_viaticos,costo_peligroso,
                      costo_refrigeracion, tarifa)
                             values(NOW(), '$denominacion', '$cuit', '$telefono', '$mail', '$contacto', '$idViaje','$kmEstimados', 
                       '$combustibleEstimado', '$costoPeaje', '$viatico', '$costoHazard', '$costoRefrigeracion',
                       '$tarifa')";
                        $this->database->execute($sql);
         } else{


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

    public function obtenerProformas(){  
        $sql = "select id_factura, id_viaje, fecha, denominacion_cliente from Proforma";
        return $this->database->query($sql);
    }

    public function detalleProforma($id){
        $sql = "select * from PROFORMA p
        join viaje v on p.id_viaje = v.id_viaje
        join carga c on v.id_carga = c.id_Carga WHERE p.id_factura = '$id'";
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
        $sql = "INSERT INTO Viaje ( id_usuario, id_carga, origen, destino, fecha_carga, tiempo_estimadoLlegada,codigo_qr,id_vehiculo, id_arrastre)   
                values('$idChofer', $idCarga , '$origen','$destino','$fechaPartida','$tiempoEstimadoLlegada', null, 
                       '$vehiculo', '$arrastre')";

        $this->database->execute($sql);

        return $this->database->lastId();
    }


}