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

    public function validarLogin($usuario, $contrasenia)
    {
        $contraseniaEncriptada = $this->seguridad->encriptar($contrasenia);
        $usuarioUpper = strtoupper($usuario);
        $solicitud = "select * from Usuario where UPPER(mail)='$usuarioUpper' and clave='$contraseniaEncriptada'";
        $resultado = $this->database->query($solicitud);
        return $resultado;
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

    public function insertarUsuario($data)
    {
        $tipoLicencia = $data['id_Licencia'];
        $mail = $data['mail'];
        $password = $data['clave'];
        $activo = $data['activo'];
        $nombre = $data['nombre'];
        $apellido = $data['apellido'];
        $dni = $data['dni'];
        $fecha_nac = $data['fecha_nac'];
        $codigoLicencia = $data['codigo_licencia'];

        $contraseniaEncriptada = $this->seguridad->encriptar($password);
        $sql = "INSERT INTO Usuario (id_Licencia, mail,clave,activo,nombre,apellido, dni,fecha_nac,codigo_licencia)   
                                values($tipoLicencia, '$mail', '$contraseniaEncriptada', false, '$nombre', '$apellido','$dni','$fecha_nac','$codigoLicencia')";

        $this->database->execute($sql);


    }

    public function editarUsuario($data){
        $id_Usuario = $data['idUsuario'];
        $id_Rol = $data['rol'];
        $mail = $data['mail'];
        $clave = $data['clave'];
        $activo = $data['activo'];
        $nombre = $data['nombre'];
        $apellido= $data['apellido'];
        $dni = $data['dni'];
        $fecha_nac = $data['fecha_nac'];
        $codigo_licencia = $data['codigo_licencia'];

        $sql= "UPDATE Usuario SET mail = '$mail',
                                                            clave = '$clave',
                                                            activo = '$activo',
                                                            nombre = '$nombre',
                                                            apellido= '$apellido',
                                                            dni = '$dni',
                                                            fecha_nac = '$fecha_nac',
                                                            codigo_licencia = '$codigo_licencia',
                                                            id_Rol = '$id_Rol'
                                                            WHERE id_Usuario = '$id_Usuario'";
        $this->database->execute($sql);

    }

    public function obtenerUsuarios()
    {
        return $this->database->query("SELECT * FROM Usuario");
    }

    public function obtenerUsuario($data)
    {
        $id = $data["id"];
        return $this->database->query("select * from Rol R join Usuario U on R.id_Rol=U.id_Rol where U.id_Usuario='$id'");
    }

    public function borrarUsuario($id){
        return $this->database->execute("DELETE FROM Usuario WHERE id_Usuario = '$id'");
    }


    public function obtenerRol($id){
        return $this->database->query("select Rol.id_Rol, Rol.descripcion from Rol join Usuario on Rol.id_Rol=Usuario.id_Rol where Usuario.id_Usuario='$id'");
    }

    public function asignarRol($id,$rol){
        if($rol==SIN_ROL) {
            return $this->database->execute("UPDATE Usuario U Set activo=false, id_Rol='$rol' where U.id_Usuario='$id'");
        }else{
            return $this->database->execute("UPDATE Usuario U Set activo=true, id_Rol='$rol' where U.id_Usuario='$id'");
        }
    }
}
