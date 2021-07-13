<?php


class ServiceModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function obtenerServices(){
        return $this->database->query("SELECT * FROM Service");
    }

    public function obtenerServicePorId($data){
        $id = $data['id'];
        return $this->database->query("SELECT * FROM Service WHERE id_Service= '$id'");
    }

    public function insertarService($data){
        $id_Service = $data['id_Service'];
        $id_Vehiculo = $data['id_Vehiculo'];
        $id_Usuario = $data['id_Usuario'];
        $id_TipoService = $data['id_TipoService'];
        $fecha = $data['fecha'];
        $kilometraje = $data['kilometraje'];
        $detalle = $data['detalle'];
        $repuestos_cambiados = $data['repuestos_cambiados'];

        $sql =("INSERT INTO Service (id_Service, id_Vehiculo, id_Usuario, id_TipoService, fecha, kilometraje, detalle, repuestos_cambiados) VALUES 
                                ('$id_Service', '$id_Vehiculo', '$id_Usuario', '$id_TipoService', '$fecha','$kilometraje','$detalle', '$repuestos_cambiados') ");

      return $this->database->execute($sql);

    }

    public function editarService($data){
        $id_Service = $data['idService'];
        $fecha = $data['fecha'];
        $kilometraje = $data['kilometraje'];
        $repuestos_cambiados = $data['repuestos_cambiados'];

        $sql = "UPDATE Service SET fecha = '$fecha',
                                    kilometraje = '$kilometraje',
                                    repuestos_cambiados = '$repuestos_cambiados'
                                    WHERE id_Service = '$id_Service'";

        $this->database->execute($sql);

    }

    public function borrarService($id){
        return $this->database->execute("DELETE FROM Service WHERE id_Service = '$id'");
    }

}