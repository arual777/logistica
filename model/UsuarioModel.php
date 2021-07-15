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

    public function insertarUsuario($tipoLicencia,$mail,$password,$activarUsuario,$nombre,$apellido,$dni,$fecha_nac,$codigoLicencia,$id_Rol)
    {
        $contraseniaEncriptada = $this->seguridad->encriptar($password);
        if($tipoLicencia==1){
            $codigoLicencia= "";
        }
        if($id_Rol==1){
            $activarUsuario = 0;
        }
        $sql = "INSERT INTO Usuario (id_Rol, id_Licencia, mail, clave, activo, nombre, apellido, dni, fecha_nac, codigo_licencia)   
                                values('$id_Rol','$tipoLicencia', '$mail', '$contraseniaEncriptada','$activarUsuario', '$nombre', '$apellido','$dni','$fecha_nac','$codigoLicencia')";
      
        $this->database->execute($sql);
    }

    public function editarUsuario($data){
        $id_Usuario = $data['idUsuario'];
        $idLicencia = $data['tipoLicencia'];
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
                                                            id_Licencia = '$idLicencia',                   
                                                            codigo_licencia = '$codigo_licencia',
                                                            id_Rol = '$id_Rol'
                                                            WHERE id_Usuario = '$id_Usuario'";
        $this->database->execute($sql);

    }

    public function obtenerUsuarios()
    {
        return $this->database->query("SELECT * FROM Usuario join Rol on Usuario.id_Rol=Rol.id_Rol order by Usuario.id_Usuario");
    }

    public function obtenerUsuario($data)
    {
        $id = $data["id"];
        return $this->database->query("select * from Rol R join Usuario U on R.id_Rol=U.id_Rol where U.id_Usuario='$id'");
    }

    public function borrarUsuario($id){
        return $this->database->execute("DELETE FROM Usuario WHERE id_Usuario = '$id'");
    }


    public function obtenerActividad($id){
        return $this->database->query("SELECT activo from Usuario WHERE id_Usuario = '$id'");
    }

    public function obtenerRol($id){
        return $this->database->query("select Rol.id_Rol, Rol.descripcion from Rol join Usuario on Rol.id_Rol=Usuario.id_Rol where Usuario.id_Usuario='$id'");
    }

    public function obtenerRoles(){
        return $this->database->query("select Rol.id_Rol, Rol.descripcion from Rol");
    }

    public function asignarRol($id,$rol){
        if($rol==SIN_ROL) {
            return $this->database->execute("UPDATE Usuario U Set activo=false, id_Rol='$rol' where U.id_Usuario='$id'");
        }else{
            return $this->database->execute("UPDATE Usuario U Set id_Rol='$rol' where U.id_Usuario='$id'");
        }
    }

    public function obtenerLicencia($id){
        $sql = "select Tipo_Licencia.id_tipoLicencia,Tipo_Licencia.descripcion from Tipo_Licencia left join Usuario on Tipo_Licencia.id_tipoLicencia=Usuario.id_Licencia where Usuario.id_Usuario='$id'";
        return $this->database->query($sql);
    }

    public function obtenerLicencias(){
        $sql = "select Tipo_Licencia.id_tipoLicencia,Tipo_Licencia.descripcion from Tipo_Licencia ";
        return $this->database->query($sql);
    }
}
