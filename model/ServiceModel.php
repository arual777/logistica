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

    public function obtenerUsuarioPorIdService($id){
        return $this->database->query("SELECT Usuario.id_Usuario, Usuario.nombre, Usuario.apellido
                                        FROM Usuario 
                                        JOIN Service ON Usuario.id_Usuario = Service.id_Usuario
                                        WHERE Service.id_Service = '$id'");
    }

    public function obtenerVehiculoPorIdService($id){
        return $this->database->query("SELECT Vehiculo.id_Vehiculo, Vehiculo.marca, Vehiculo.patente
                                        FROM Vehiculo 
                                        JOIN Service ON Vehiculo.id_Vehiculo = Service.id_Vehiculo
                                        WHERE Service.id_Service = '$id'");
    }

    public function obtenerTipoServicePorIdService($id){
        return $this->database->query("SELECT Tipo_Service.id_TipoService, Tipo_Service.descripcion
                                        FROM Tipo_Service 
                                        JOIN Service ON Tipo_Service.id_TipoService = Service.id_TipoService
                                        WHERE Service.id_Service = '$id'");
    }

    public function obtenerTiposService(){
        return $this->database->query("SELECT * FROM Tipo_Service");
    }

    public function obtenerUsuarios(){
        return $this->database->query("SELECT * FROM Usuario");
    }

    public function obtenerVehiculos(){
        return $this->database->query("SELECT * FROM Vehiculo");
    }

    public function insertarService($id_Vehiculo, $id_Usuario, $id_TipoService,$fecha,$kilometraje,$detalle,$repuestos_cambiados){

        $sql ="INSERT INTO Service (id_Vehiculo, id_Usuario, id_TipoService,fecha, kilometraje, detalle, repuestos_cambiados) VALUES 
                                ('$id_Vehiculo','$id_Usuario','$id_TipoService','$fecha','$kilometraje','$detalle', '$repuestos_cambiados') ";

        $this->database->execute($sql);
    }

    public function editarService($data){
        $id_Service = $data['idService'];
        $id_Vehiculo = $data['vehiculo'];
        $id_Usuario = $data['usuario'];
        $id_TipoService = $data['tipoService'];
        $fecha = $data['fecha'];
        $kilometraje = $data['kilometraje'];
        $repuestos_cambiados = $data['repuestos'];

        $sql = "UPDATE Service SET  id_Vehiculo = '$id_Vehiculo',
                                    id_Usuario = '$id_Usuario',
                                    id_TipoService = '$id_TipoService',
                                    fecha = '$fecha',
                                    kilometraje = '$kilometraje',
                                    repuestos_cambiados = '$repuestos_cambiados'
                                    WHERE id_Service = '$id_Service'";

        $this->database->execute($sql);

    }

    public function borrarService($id){
        return $this->database->execute("DELETE FROM Service WHERE id_Service = '$id'");
    }

}