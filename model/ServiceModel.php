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

    public function obtenerChoferPorIdService($id){
        return $this->database->query("SELECT Usuario.id_Rol,Usuario.id_Usuario, Usuario.nombre, Usuario.apellido
                                        FROM Usuario
                                        JOIN Service ON  Usuario.id_Usuario = Service.id_Chofer
                                        WHERE Service.id_Service = '$id' and Usuario.id_Rol = 4");
    }

    public function obtenerMecanicoPorIdService($id){
        return $this->database->query("SELECT Usuario.id_Usuario, Usuario.nombre, Usuario.apellido
                                        FROM Usuario
                                        JOIN Service ON Usuario.id_Usuario = Service.id_Mecanico
                                        WHERE Service.id_Service = '$id' and Usuario.id_Rol = 5");
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

    /*public function obtenerUsuarios(){
        return $this->database->query("SELECT * FROM Usuario");
    }*/

    public function obtenerChoferes(){
        $rol_Chofer = 4;
        return $this->database->query("SELECT * FROM Usuario WHERE id_Rol = '$rol_Chofer'");
    }

    public function obtenerMecanicos(){
        $rol_Mecanico = 5;
        return $this->database->query("SELECT * FROM Usuario WHERE id_Rol = '$rol_Mecanico'");
    }

    public function obtenerVehiculos(){
        return $this->database->query("SELECT * FROM Vehiculo");
    }

    public function insertarService($id_Vehiculo, $id_Chofer, $id_Mecanico, $id_TipoService,$fecha,$kilometraje,$detalle,$repuestos_cambiados){
        $sql ="INSERT INTO Service (id_Vehiculo, id_Chofer, id_Mecanico, id_TipoService,fecha, kilometraje, detalle, repuestos_cambiados) VALUES 
                                ('$id_Vehiculo','$id_Chofer', '$id_Mecanico' ,'$id_TipoService','$fecha','$kilometraje','$detalle', '$repuestos_cambiados') ";
        $this->database->execute($sql);
    }

    public function cambiarVehiculoAestadoDeReparacion($id_vehiculo){
        return $this->database->execute("UPDATE Vehiculo set id_disponible=1 where id_vehiculo='$id_vehiculo'");
    }

    public function editarService($data){
        $id_Service = $data['idService'];
        $id_Vehiculo = $data['vehiculo'];
        $id_Chofer = $data['chofer'];
        $id_Mecanico = $data['mecanico'];
        $id_TipoService = $data['tipoService'];
        $fecha = $data['fecha'];
        $kilometraje = $data['kilometraje'];
        $repuestos_cambiados = $data['repuestos'];
        $estado = $data['estado'];

        $sql = "UPDATE Service SET  id_Vehiculo = '$id_Vehiculo',
                                    id_Chofer = '$id_Chofer',
                                    id_Mecanico = '$id_Mecanico',
                                    id_TipoService = '$id_TipoService',
                                    fecha = '$fecha',
                                    kilometraje = '$kilometraje',
                                    repuestos_cambiados = '$repuestos_cambiados'
                                    WHERE id_Service = '$id_Service'";

        $this->cambiarEstadoDeUnVehiculo($id_Vehiculo,$estado);
        $this->database->execute($sql);

    }

    public function cambiarEstadoDeUnVehiculo($id_vehiculo,$id_estado){
        $sql = "UPDATE Vehiculo set id_disponible='$id_estado' where id_vehiculo='$id_vehiculo'";
        $this->database->execute($sql);
    }

    public function obtenerEstadosPosiblesConUnMecanico(){
        return $this->database->query("select * from Estado_Vehiculo where id_estado<4");
    }

    public function obtenerEstadoActualDeUnVehiculo($id_vehiculo){
        return $this->database->query("select e.id_estado,e.descripcion as estadoActual from Vehiculo v join Estado_Vehiculo e on v.id_disponible=e.id_estado where v.id_vehiculo='$id_vehiculo'");
    }

    public function borrarService($id){
        return $this->database->execute("DELETE FROM Service WHERE id_Service = '$id'");
    }

}