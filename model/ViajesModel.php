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

}