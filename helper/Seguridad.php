<?php


class Seguridad
{
    public function __construct(){

    }
    // este método encripta la constraseña con md5
    function encriptar($password) {
        return md5($password);
    }
}