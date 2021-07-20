<?php
include_once("helper/Configuration.php");

session_start();
$configuration = new Configuration();

$urlHelper = $configuration->getUrlHelper();
$module = $urlHelper->getModuleFromRequestOr("autorizacion");
$action = $urlHelper->getActionFromRequestOr("execute");

if(isset($_SESSION['usuario'])){

        if( strtoupper($action)!="LOGOUT")
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
                   if(!$tieneAcceso){
                    $module="autorizacion";
                    $action="sinPermiso";
                }
            }
        }
}else{
    if( (strtoupper($module)!="AUTORIZACION" && strtoupper($module)!="REGISTRO") && !str_contains(strtoupper($module),'PUBLIC'))
    {
        $module="autorizacion";
        $action="execute";
	}
}

$router = $configuration->getRouter();

$router->executeActionFromModule($action, $module);