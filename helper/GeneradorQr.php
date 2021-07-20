<?php
include("phpqrcode/phpqrcode.php");

class GeneradorQr
{
    public function generarQr($idViaje){

        $host = $_SERVER['HTTP_HOST'];

        $protocolo = isset($_SERVER["HTTPS"]) ? 'https' : 'http';

        $url= $protocolo."://".$host."/logistica/Viajes/verFormNotificacion/id_viaje=".$idViaje;

        //CREAMOS EL NOMBRE DEL ARCHIVO CON EL ID QUE LE PASAMOS DEL VIAJE NUEVO Y LA EXTENSIÓN PNG
        $nombreArchivo= "notificacionViaje".$idViaje.".png";

        //INDICAMOS EN QUÉ DIRECTORIO SE VA A GUARDAR CON EL NOMBRE DEL ARCHIVO
        $directorio = dirname(__DIR__)."/public/qr/".$nombreArchivo;

        //LLAMAMOS AL MÉTODO ESTÁTICO QUE GENERA EL CÓDIGO con el contenido de la url que le pasamos
        QRcode::png($url, $directorio, QR_ECLEVEL_L, 8);

        return "/public/qr/".$nombreArchivo;
    }
}