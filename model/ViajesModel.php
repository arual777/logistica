<?php


class ViajesModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function obtenerViajesPorOrdenFecha(){

        return $this->database->query("select * from PROFORMA p join viaje v on p.id_viaje = v.id_viaje ORDER BY fecha_carga DESC");
    }

    public function obtenerDetalleViaje($id){
        return $this->database->query("SELECT * FROM Viaje_Detalle WHERE id_viaje = '$id'");
    }



}