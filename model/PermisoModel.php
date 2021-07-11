<?php
class PermisoModel
{
    private $database;
    private $secciones;
    private $acciones;

    public function __construct($database)
    {
        $this->database = $database;

        //estas secciones son nuestros controllers
        $this->secciones = array(
            "USUARIO" => 1,
            "VIAJES" => 2,
            "VEHICULOS" => 3,
            "SERVICE" => 4,
            "PROFORMA" => 5
        );

        //estas acciones son las functiones que tenemos en los controllers
        //de esta manera dos usuarios distintos pueden tener distintos permisos para una misma vista
        //por ejemplo, un mecánico puede leer los viajes pero no modificarlos
        $this->acciones = array(
            "EXECUTE" => LECTURA,
            "CREAR" =>  ALTA,
            "LISTAR" => LECTURA,
            "MOSTRARUSUARIO" => LECTURA,
            "ASIGNARROL" => MODIFICACION,
            "LISTARVIAJES" => LECTURA,
            "DETALLEVIAJE" => MODIFICACION,
            "FORMULARIOPROFORMA" => LECTURA,
            "DETALLEPROFORMA"=> LECTURA
        );
    }

    public function validarAccesoASeccion($usuario, $seccion, $accion){
        //le pasamos el Id del usuario que sacamos de la sesion, el nombre del modulo (seccion) al que quiere ingresar y el action ()

        //con la seccion que tengo por parametro, busco el valor en el array secciones
        $idSeccion = $this->secciones[$seccion];

        //con la accion que tengo por parametro busco el valor en el array de acciones
        $idAccion = $this->acciones[$accion];

        $solicitud= "select RS.alta as alta, RS.baja as baja, RS.modificacion as modificacion, RS.lectura as lectura
                            from Usuario US JOIN Rol_Seccion RS on US.id_Rol= RS.id_Rol
                            where US.id_usuario = $usuario and id_Seccion= $idSeccion";

        //puede arrojar un solo resultado o ninguno

        $resultado = $this->database->query($solicitud);

        if(count($resultado) == 0){
            return false;
        }

        switch ($idAccion){
            case LECTURA:
                if($resultado[0]["lectura"] == 1)
                {
                    return true;
                }
                return false;
            case BAJA:
                if($resultado[0]["baja"] == 1)
                {
                    return true;
                }
                return false;
            case MODIFICACION:
                if($resultado[0]["modificacion"] == 1)
                {
                    return true;
                }
                return false;
            case ALTA:
                if($resultado[0]["alta"] == 1)
                {
                    return true;
                }
                return false;
            default:
                return false;
        }
    }
}
