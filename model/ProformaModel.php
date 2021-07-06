<?php
class ProformaModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function crearProforma($denominacion, $cuit, $telefono, $mail, $contacto,$origen, $destino, $fechaPartida, $tiempoEstimadollegada,$tipoCarga, $peso,
                                  $peligrosidad, $refrigeracion, $graduacion, $kmEstimados, $combustibleEstimado,
                                  $costoPeaje, $viatico, $costoHazard, $costoRefrigeracion,
                                  $tarifa, $idChofer)
    {
        $idCarga = $this->insertarCarga($tipoCarga, $peligrosidad, $refrigeracion, $graduacion, $peso);
        $idViaje = $this->insertarViaje($idChofer, $idCarga, $origen, $destino, $fechaPartida, $tiempoEstimadollegada);

        $sql = "INSERT INTO Proforma (fecha, denominacion_cliente, cuit, telefono, mail, contacto,  id_viaje, kilometros_estimados,
                      combustible_litros_estimados, costo_peajes, costo_viaticos,costo_peligroso, costo_refrigeracion, tarifa)
                values(NOW(), '$denominacion', '$cuit', '$telefono', '$mail', '$contacto', '$idViaje','$kmEstimados', 
                       '$combustibleEstimado', '$costoPeaje', '$viatico', '$costoHazard', '$costoRefrigeracion',
                       '$tarifa')";
        $this->database->execute($sql);
    }

    public function obtenerChoferes(){
        $sql = "SELECT ID_USUARIO,NOMBRE, APELLIDO FROM USUARIO where id_rol=".CHOFER;
        return $this->database->query($sql);
    }

    public function obtenerVehiculos(){
        $sql = "select id_Vehiculo, marca, patente, modelo from Vehiculo
                where id_Tipo <> ".ARRASTRE;
        return $this->database->query($sql);
    }

    public function obtenerVehiculosDeArrastre(){
        $sql= "select V.id_Vehiculo, V.patente, V.chasis, S.descripcion
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
        $sql = "select id_factura, fecha, denominacion_cliente from proforma";
        return $this->database->query($sql);
    }

    private function insertarCarga($tipoCarga, $peligrosidad, $refrigeracion, $graduacion, $peso){
        $sql = "INSERT INTO Carga (id_TipoCarga, id_TipoHazard, refrigeracion, graduacion, peso)   
                values('$tipoCarga','$peligrosidad', '$refrigeracion','$graduacion', '$peso')";

        $this->database->execute($sql);

        return $this->database->lastId();
    }

    private function insertarViaje($idChofer, $idCarga, $origen, $destino, $fechaPartida, $tiempoEstimadoLlegada){
        $sql = "INSERT INTO Viaje ( id_usuario, id_carga, origen, destino, fecha_carga, tiempo_estimadoLlegada,codigo_qr,id_vehiculo, id_arrastre)   
                values('$idChofer', $idCarga , '$origen','$destino','$fechaPartida','$tiempoEstimadoLlegada', null, '1', '2')";

        $this->database->execute($sql);

        return $this->database->lastId();
    }
}