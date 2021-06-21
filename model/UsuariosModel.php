<?php

class UsuariosModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }
    //Acá faltan las query

    public function getUsuarios(){
        return $this->database->query("");
    }

    public function getUsuario($id){
        return $this->database->query("");
    }
}