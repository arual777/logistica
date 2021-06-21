<?php
class PermisoModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }
/*
 *  Recibe por parametro el usuario (mail) que se encuentra en sesion, la seccion y la accion a realizar
 *  En el caso que no se encuentren resultados para ese usuario/seccion se retorna false
 *  En el caso que la accion enviada no sea valida se retorna false
 *  En el caso que la accion sea valida pero no se tenga permisos para esa accion se retorna false
 *  En el caso que la accion sea valida y se tenga permisos  para esa accion se retorna true
 *  El resultado de esta validacion se debera manejar en los controllers
 *  Cuando el resultado sea false se debera renderizar la pantalla sinPermisos
 *  Cuando el resultado sea true se debera seguir con la ejecucion
 * */
    public function validarAccesoASeccion($usuario, $seccion, $accion){
        $usuario = strtoupper($usuario);
        $solicitud= "select RS.alta as alta, RS.baja as baja, RS.modificacion as modificacion, RS.lectura as lectura
                            from Usuario US JOIN Rol_Seccion RS on US.id_Rol= RS.id_Rol
                            where UPPER(mail)= '$usuario' and id_Seccion= '$seccion'";

         $resultado = $this->database->query($solicitud);

         if(count($resultado) == 0){
             return false;
         }

         switch ($accion){
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
