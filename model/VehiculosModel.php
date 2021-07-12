<?php


class VehiculosModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function obtenerVehiculos(){
        return $this->database->query("SELECT * FROM Vehiculo");
    }

    public function obtenerVehiculoPorId($data){
        $id = $data['id'];
        return $this->database->query("SELECT * FROM Vehiculo WHERE id_Vehiculo = '$id'");
    }

    public function insertarVehiculo($data){
        $marca = $data['marca'];
        $modelo = $data['modelo'];
        $patente = $data['patente'];
        $motor = $data['motor'];
        $chasis = $data['chasis'];
        $anio_fabricacion = $data['anio_fabricacion'];
        $kilometraje = $data['kilometraje'];
        $estado = $data['estado'];

        $sql =("INSERT INTO Vehiculo (marca, modelo,patente, motor, chasis, anio_fabricacion, kilometraje, estado) VALUES 
                                ('$marca', '$modelo', '$patente', '$motor', '$chasis','$anio_fabricacion','$kilometraje', '$estado') ");

        $this->database->execute($sql);

    }

    public function editarVehiculo($data){
        $id_Vehiculo = $data['id'];
        $marca = $data['marca'];
        $modelo = $data['modelo'];
        $patente = $data['patente'];
        $chasis = $data['chasis'];
        $anio_fabricacion = $data['anio_fabricacion'];
        $kilometraje = $data['kilometraje'];

        $sql= ("UPDATE Vehiculo SET marca = '$marca',
                                                            modelo = '$modelo',
                                                            patente = '$patente',
                                                            chasis = '$chasis',
                                                            anio_fabricacion = '$anio_fabricacion',
                                                            kilometraje = '$kilometraje'
                                                            WHERE id_Vehiculo = '$id_Vehiculo'");

       $this->database->execute($sql);


    }

    public function borrarVehiculo($id){
        return $this->database->execute("DELETE FROM Vehiculo WHERE id_Vehiculo = '$id'");
    }

}