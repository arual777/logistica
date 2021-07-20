<?php


class ViajesModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function obtenerViajesPorOrdenFecha()
    {
        return $this->database->query("select * from PROFORMA p join viaje v on p.id_viaje = v.id_viaje ORDER BY fecha_carga DESC");
    }

    public function obtenerViajesPorIdUsuario($idUsuario)
    {
        $consulta = "select * from PROFORMA p join viaje v on p.id_viaje = v.id_viaje 
                        where v.id_usuario = '$idUsuario'
                    ORDER BY fecha_carga DESC";

        return $this->database->query($consulta);
    }

    public function obtenerDetalleViaje($idViaje)
    {
        return $this->database->query("SELECT * FROM Viaje_Detalle WHERE id_viaje = '$idViaje'");
    }

    public function obtenerDetalleViajePorIdViajeDetalle($idViajeDetalle)
    {
        return $this->database->query("SELECT * FROM Viaje_Detalle WHERE id_Viaje_Detalle = '$idViajeDetalle'");
    }

    public function obtenerIdDelViaje()
    {
        $sql = "select id_Viaje from Viaje as V join ViajeDetalle VD where V.id_Viaje= VD.id_viaje";
    }

    public function obtenerElTipoDeCargaPeligrosa($id)
    {
        return $this->database->query("select t.id_TipoHazard,t.descripcion from Carga c join Tipo_Hazard t on c.id_TipoHazard=t.id_TipoHazard where c.id_Carga='$id'");

    }

    public function obtenerRefrigeracion($id){
      return $this->database->query("select refrigeracion,graduacion,peso from Carga c where c.id_Carga='$id'");
    }

    public function crearNuevaNotificacion($id, $km, $latitud, $longitud, $fecha, $combustibleCargado,
                                           $peajes, $extras)
    {$sql = "INSERT INTO Viaje_Detalle (id_viaje, kilometraje, latitud, longitud, fecha, 
                                                combustibleCargado, peajes, extras)   
                values('$id','$km','$latitud', '$longitud','$fecha', '$combustibleCargado', '$peajes', 
                       '$extras')";

        $this->database->execute($sql);
    }

    public function obtenerChoferDeUnViaje($id_viaje){
        return $this->database->query("select u.nombre,u.apellido from Usuario u join viaje v on u.id_usuario=v.id_usuario where v.id_viaje='$id_viaje'");
    }

    public function editar($idDetalleViaje, $km, $latitud, $longitud, $fecha, $combustibleCargado, $extras, $peajes){

        $sql = "UPDATE Viaje_Detalle SET kilometraje = '$km',
                                                            latitud = '$latitud',
                                                            longitud = '$longitud',
                                                            fecha = '$fecha',
                                                            combustibleCargado= '$combustibleCargado',
                                                            peajes = '$peajes',
                                                            extras = '$extras'
                                                            
                                                            WHERE id_Viaje_Detalle = '$idDetalleViaje'";
        $this->database->execute($sql);
    }

    public function cambiarEstadoViaje($idViaje, $estadoViaje){

        $sql = "UPDATE Viaje
                            SET 
                                id_estado  = '$estadoViaje'                                                                                                                                                                                                
                WHERE id_viaje = '$idViaje'";
        $this->database->execute($sql);
    }

    public function consultarEstadoViaje($idViaje){
        $sql="select id_estado from Viaje where id_viaje='$idViaje'";
        $resultado = $this->database->query($sql);
        return $resultado[0]["id_estado"];
    }

    public function obtenerVehiculoDeUnViaje($id_viaje){
        $sql = "select v.id_vehiculo from Vehiculo v join Viaje vi on v.id_vehiculo=vi.id_vehiculo where vi.id_viaje=1";
        return $this->database->query($sql);
    }

    public function cambiarVehiculoADisponibleAlFinalizarUnViaje($id_vehiculo){
        $sql = "UPDATE Vehiculo set id_disponible=3 where id_vehiculo='$id_vehiculo'";
        $this->database->execute($sql);
    }
}