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
            "INSERTAR" => ALTA,
            "AGREGARUSUARIO" => LECTURA,
            "MODIFICARUSUARIO" => MODIFICACION,
            "BORRARUSUARIO" => BAJA,
            "ASIGNARROL" => MODIFICACION,
            "LISTARVIAJES" => LECTURA,
            "DETALLEVIAJE" => MODIFICACION,
            "FORMULARIOPROFORMA" => LECTURA,
            "DETALLEPROFORMA" => LECTURA,
            "LISTARVEHICULOS" => LECTURA,
            "BORRARVEHICULO" => BAJA,
            "EDITAR" => MODIFICACION,
            "INSERTARVEHICULO" => ALTA,
            "MODIFICARVEHICULO" => LECTURA,
            "LISTARSERVICES" => LECTURA,
            "BORRARSERVICE" => BAJA,
            "MODIFICARSERVICE" => LECTURA,
            "EDITARSERVICE" => MODIFICACION,
            "INSERTARSERVICE" => ALTA,
            "CREARNUEVANOTIFICACION"=> MODIFICACION,
            "VERFORMNOTIFICACION"=> LECTURA,
            "PRINTPDF" => LECTURA,
            "EDITARNOTIFICACION"=> MODIFICACION,
            "FINALIZARVIAJE"=> MODIFICACION,
            "VERFACTURACION" => LECTURA,
            "CALCULARFACTURACION" => LECTURA
        );
    }

    public function validarAccesoASeccion($usuario, $seccion, $accion){

        //con la seccion que tenemos por parametro, buscamos el valor en el array secciones
        $idSeccion = $this->secciones[$seccion]; // 1

        //con la accion que tenemos por parametro, buscamos el valor en el array de acciones
        $idAccion = $this->acciones[$accion]; // MODIFICACION

        $solicitud= "select RS.alta as alta, RS.baja as baja, RS.modificacion as modificacion, RS.lectura as lectura
                            from Usuario US JOIN Rol_Seccion RS on US.id_Rol= RS.id_Rol
                            where US.id_usuario = $usuario and id_Seccion= $idSeccion";

        $resultado = $this->database->query($solicitud);

        if(count($resultado) == 0){  //Daría cero, si hay un usuario que no tenga especificada una seccion.
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
