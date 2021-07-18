<?php
include("phpqrcode/phpqrcode.php");

class GeneradorQr
{
    public function generarQr($idViaje){

        $host = $_SERVER['HTTP_HOST'];
        $protocolo = isset($_SERVER["HTTPS"]) ? 'https' : 'http';
        $url= $protocolo."://".$host."/logistica/Viajes/verFormNotificacion/id_viaje=".$idViaje;
        $nombreArchivo= "notificacionViaje".$idViaje.".png";
        $directorio = dirname(__DIR__)."/public/qr/".$nombreArchivo;

        QRcode::png($url, $directorio, QR_ECLEVEL_L, 8);

        return "/public/qr/".$nombreArchivo;
    }
}