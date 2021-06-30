<?php
include_once("helper/Configuration.php");

session_start();
$configuration = new Configuration();

$urlHelper = $configuration->getUrlHelper();
$module = $urlHelper->getModuleFromRequestOr("autorizacion");
$action = $urlHelper->getActionFromRequestOr("execute");


//Valido que el usuario este en sesion
if(isset($_SESSION['usuario'])){
        //si la accion no es logout y el modulo (controllers)mno contiene  a p[ublic, valido los permisos
        //agrego el public porque en los request aparece y no sé de dónde sale
        if( strtoupper($action)!="LOGOUT" && !str_contains(strtoupper($module),'PUBLIC'))
        {
            if((strtoupper($module)) == "AUTORIZACION" || empty($module)){
                $module="autorizacion";
                $action="home";
            }else{
                if($action==""){
                    $action = "EXECUTE";
                }
                $permisos = $configuration->getPermisoModel();
                $tieneAcceso = $permisos->validarAccesoASeccion($_SESSION['usuario'],strtoupper($module), strtoupper($action));
                //si no tiene acceso lo mando al controller autorizacion y a una accion que le muestre
                //al usuario la pantalla sin permiso.
                if(!$tieneAcceso){
                    $module="autorizacion";
                    $action="sinPermiso";
                }
            }
        }
}else{
    //aca entra cuando el usuario no esta en sesion
    //si el usuario intenta entrar a un modulo que no sea registro o autorizacion lo mando a la pantalla de error
    //esto es porque los unicos modulos que puede usar que aun no se logueo es autorizacion (para loguearse) o registro (para registrarse)
    //agrego el public porque en los request aparece y no sé de dónde sale
    if( (strtoupper($module)!="AUTORIZACION" && strtoupper($module)!="REGISTRO") && !str_contains(strtoupper($module),'PUBLIC'))
    {
        $module="autorizacion";
        $action="";
    }
}

$router = $configuration->getRouter();  //enviA LOS VALORES GUARDADOS EM LAS VARIABLES
$router->executeActionFromModule($action, $module);
