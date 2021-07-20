<?php


class Seguridad
{
    public function __construct(){

    }

    function encriptar($password) {
        return md5($password);
    }
}