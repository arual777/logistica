<?php


class ViajeModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function obtenerViajesPorOrdenDeFecha(){

        return $this->database->query("SELECT UPPER(fecha_carga) FROM Viaje");
    }
}