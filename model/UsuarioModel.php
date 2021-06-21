<?php

class UsuarioModel
{
    private $database;
    private $seguridad;
    public function __construct($database, $seguridad)
    {
        $this->database = $database;
        $this->seguridad = $seguridad;
    }
    //Acá faltan las query

    public function getUsuarios(){
        return $this->database->query("");
    }

    public function getUsuario($id){
        return $this->database->query("");
    }

    public function validarLogin($usuario, $contrasenia){

        if(isset($_SESSION['usuario'])){
            header("Location:view/usuario.php");
            exit();
        }else if(!isset($_POST['usuario'],$_POST['contrasenia'])) {
            header("Location:view/login.php");
            exit();
        }

        $contraseniaEncriptada= $this->seguridad->encriptar ($contrasenia);
        $usuarioUpper=strtoupper($usuario);
        $solicitud= "select * from Usuario where UPPER(mail)='$usuarioUpper' and clave='$contraseniaEncriptada'";
        $resultado=$this->database->query($solicitud);
        if(count($resultado) > 0){
            return true;
        }
        else{
            return false;
        }
    }
}