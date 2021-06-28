<?php
class ProformaModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function crearProforma($fecha, $origen, $destino, $tipoCarga, $refrigeracion, $graduacion,
                                  $viatico, $costoPeaje, $costoHazard, $costoRefrigeracion,
                                  $tarifa, $km, $peso, $tipoHazard, $fechaCarga, $llegada, $idCliente, $idChofer)
    {
        $idCarga = $this->insertarCarga($tipoCarga, $refrigeracion, $graduacion, $peso, $tipoHazard);

        $idViaje = $this->insertarViaje($idChofer, $idCarga, $origen, $destino, $llegada, $fechaCarga);

        $importeEstimado = $this->calcularImporte($viatico, $costoPeaje, $costoHazard, $costoRefrigeracion, $tarifa);

        $idCosto = $this->insertarCosto($idViaje, $importeEstimado, $km);

        $sql = "INSERT INTO Proforma (id_costo, id_cliente, id_viaje, importe)   
                values('$idCosto', '$idCliente', '$idViaje', '$importeEstimado')";

        $this->database->execute($sql);
    }

    public function obtenerChoferes(){
        //falta agregar where
        //mover a UsuarioModel
        $sql = "SELECT ID_USUARIO,NOMBRE, APELLIDO FROM USUARIO";
        return $this->database->query($sql);
    }

    public function obtenerClientes(){
        //falta agregar where
        //mover a UsuarioModel
        $sql = "select id_Cliente, apellido, CUIT from Cliente;";
        return $this->database->query($sql);
    }

    public function obtenerTipoDeCarga(){
        //falta agregar where
        //mover a UsuarioModel
        $sql = "select id_TipoCarga, descripcion from Tipo_Carga;";
        return $this->database->query($sql);
    }

    public function obtenerTipoHazard(){
        //falta agregar where
        //mover a UsuarioModel
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
        $sql = "select id_factura, importe from proforma";
        return $this->database->query($sql);
    }

    private function insertarCarga($idTipo, $refrigeracion, $graduacion, $peso, $tipoHazard){
        $sql = "INSERT INTO Carga (id_TipoCarga, refrigeracion, graduacion, peso, id_TipoHazard)   
                values('$idTipo', '$refrigeracion','$graduacion', '$peso', '$tipoHazard')";

        $this->database->execute($sql);

        return $this->database->lastId();
    }

    private function insertarViaje($idChofer,$idCarga, $origen, $destino, $llegada,$fechaCarga){
        $sql = "INSERT INTO Viaje ( id_usuario, id_carga, origen, destino, fecha_carga, tiempo_estimadoLlegada,codigo_qr)   
                values('$idChofer', $idCarga , '$origen','$destino','$fechaCarga','$llegada', null)";

        $this->database->execute($sql);

        return $this->database->lastId();
    }

    private function insertarCosto($idViaje, $importeEstimado, $km){
        $sql = "INSERT INTO Costo (id_viaje, importeEstimado, kilometrajeEstimado)   
                values('$idViaje', '$importeEstimado','$km')";

        $this->database->execute($sql);

        return  $this->database->lastId();
    }

    private function calcularImporte($viatico, $costoPeaje, $costoHazard, $costoRefrigeracion, $tarifa)
    {
        return $viatico + $costoPeaje + $costoHazard + $costoRefrigeracion + $tarifa;
    }
}