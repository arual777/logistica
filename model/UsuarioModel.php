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


    public function getUsuarios()
    {
        return $this->database->query("");
    }

    public function getUsuario($id)
    {
        return $this->database->query("");
    }

    public function validarLogin($usuario, $contrasenia)
    {
        $contraseniaEncriptada = $this->seguridad->encriptar($contrasenia);
        $usuarioUpper = strtoupper($usuario);
        $solicitud = "select * from Usuario where UPPER(mail)='$usuarioUpper' and clave='$contraseniaEncriptada'";
        $resultado = $this->database->query($solicitud);
        if (count($resultado) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function buscarUsuarioPorEmail($email)
    {
        $solicitud = "SELECT * FROM Usuario where UPPER(mail) ='$email'";
        $resultado = $this->database->query($solicitud);
        if (count($resultado) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function buscarUsuarioPorDNI($DNI)
    {
        $solicitud = "SELECT * FROM Usuario where UPPER(dni) ='$DNI'";
        $resultado = $this->database->query($solicitud);
        if (count($resultado) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function buscarUsuarioPorCodigoDeLicencia($codigoLicencia)
    {
        $solicitud = "SELECT * FROM Usuario where UPPER(codigo_licencia) ='$codigoLicencia'";
        $resultado = $this->database->query($solicitud);
        if (count($resultado) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insertarUsuario($tipoLicencia, $mail, $password, $nombre, $apellido, $dni, $fecha_nac, $codigoLicencia)
    {
        $sql = "INSERT INTO Usuario (id_Licencia, mail,clave,activo,nombre,apellido, dni,fecha_nac,codigo_licencia)   
                                values($tipoLicencia, '$mail', '$password', false, '$nombre', '$apellido','$dni','$fecha_nac','$codigoLicencia')";
        $resultado = $this->database->execute($sql);

    }

    public function obtenerUsuarios()
    {
        return $this->database->query("SELECT * FROM Usuario");
    }

    public function obtenerUsuario($id)
    {
        return $this->database->query("SELECT * FROM Usuario WHERE id_Usuario = $id ");

    }
}
