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

    public function insertarService($fecha,$kilometraje,$detalle,$repuestos_cambiados){

        $sql ="INSERT INTO Service (fecha, kilometraje, detalle, repuestos_cambiados) VALUES 
                                ('$fecha','$kilometraje','$detalle', '$repuestos_cambiados') ";

      $this->database->execute($sql);

    }

    public function editarService($data){
        $id_Service = $data['idService'];
        $fecha = $data['fecha'];
        $kilometraje = $data['kilometraje'];
        $repuestos_cambiados = $data['repuestos'];

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