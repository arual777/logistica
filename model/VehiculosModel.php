<?php


class VehiculosModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function obtenerEstadosDeDisponibilidad(){
        return $this->database->query("SELECT *,descripcion as posicion FROM Estado_Vehiculo");
    }

    public function obtenerTiposVehiculos()
    {
        return $this->database->query("SELECT * FROM Tipo_Vehiculo");
    }

    public function obtenerVehiculoPorIdDeVehiculo($id){
        return $this->database->query("select Tipo_Vehiculo.id_TipoVehiculo,Tipo_Vehiculo.descripcion from Tipo_Vehiculo join Vehiculo on Tipo_Vehiculo.id_TipoVehiculo=Vehiculo.id_Tipo where Vehiculo.id_Vehiculo='$id'");
    }

    public function obtenerArrastrePorIdDeVehiculos($id){
        return $this->database->query("select Tipo_Semi.id_Tipo,Tipo_Semi.descripcion from Tipo_Semi join Vehiculo on Tipo_Semi.id_Tipo=Vehiculo.id_Tipo where Vehiculo.id_Vehiculo='$id'");
    }
    public function obtenerTiposRemolques(){
        return $this->database->query("SELECT * FROM Tipo_Semi");
    }

    public function obtenerVehiculos()
    {
        return $this->database->query("SELECT * FROM Vehiculo");
    }

    public function obtenerVehiculosConEstadoYtipo()
    {
        return $this->database->query("SELECT *,e.descripcion as descripcionEstado,t.descripcion as descripcionTipo FROM Vehiculo v join Estado_Vehiculo e on v.id_disponible=e.id_estado join Tipo_Vehiculo t on t.id_TipoVehiculo=v.id_Tipo");
    }

    public function obtenerVehiculoPorId($data)
    {
        $id = $data['id'];
        return $this->database->query("SELECT *,e.descripcion as disponibleActual FROM Vehiculo v join Estado_Vehiculo e on v.id_disponible=e.id_estado WHERE id_Vehiculo = '$id'");
    }

    public function insertarVehiculo($tipoVehiculo,$arrastre,$marca, $modelo, $patente, $motor, $chasis, $anio_fabricacion, $kilometraje, $estado,$disponiblidad)
    {
        $sql = "INSERT INTO Vehiculo (id_Tipo, id_TipoSemi, marca, modelo, patente, motor, chasis, anio_fabricacion, kilometraje, estado,id_disponible) VALUES 
                                ('$tipoVehiculo','$arrastre','$marca', '$modelo', '$patente', '$motor', '$chasis','$anio_fabricacion','$kilometraje', '$estado','$disponiblidad') ";

        $this->database->execute($sql);
    }

    public function editarVehiculo($data)
    {
        $id_Vehiculo = $data['idVehiculo'];
        $marca = $data['marca'];
        $modelo = $data['modelo'];
        $patente = $data['patente'];
        $chasis = $data['chasis'];
        $anio_fabricacion = $data['anio_fabricacion'];
        $kilometraje = $data['kilometraje'];
        $tipoVehiculo = $data["tipoVehiculo"];
        $tipoArrastre = $data["arrastre"];
        $disponibilidad = $data["disponibilidad"];



        $sql = "UPDATE Vehiculo 
                SET marca = '$marca',  
                modelo = '$modelo',
                patente = '$patente',
                chasis = '$chasis',
                anio_fabricacion = '$anio_fabricacion',
                kilometraje = '$kilometraje',
                id_disponible = '$disponibilidad'
                WHERE id_Vehiculo = '$id_Vehiculo'";
        $sql2 = "UPDATE Vehiculo SET  id_Tipo = '$tipoVehiculo'    
                WHERE id_Vehiculo = '$id_Vehiculo'";
        $sql3 = "UPDATE Vehiculo SET  id_TipoSemi = '$tipoArrastre'    
                WHERE id_Vehiculo = '$id_Vehiculo'";
        $this->database->execute($sql);
        $this->database->execute($sql2);
        $this->database->execute($sql3);
    }

    public function borrarVehiculo($id)
    {
        return $this->database->execute("DELETE FROM Vehiculo WHERE id_Vehiculo = '$id'");
    }

}