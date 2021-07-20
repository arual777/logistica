<?php
include_once("helper/Configuration.php");

session_start();
$configuration = new Configuration();

$urlHelper = $configuration->getUrlHelper(); //lE PIDE AL QUE ADMINISTRA LAS URL QUE LE DE EL MODULO Y EL ACTION
                                             //SINO MANDA NADA EJECUTA EL POR DEFECTO
$module = $urlHelper->getModuleFromRequestOr("autorizacion");
$action = $urlHelper->getActionFromRequestOr("execute");

//if (!function_exists('str_contains')) {
//  function str_contains($haystack, $needle) {
//    return $needle !== '' && mb_strpos($haystack, $needle) !== false;
//}
//}

if(isset($_SESSION['usuario'])){
        //si la accion no es logout y el modulo (controllers)no contiene  a p[ublic, valido los permisos
        //agregamos el public porque en los request aparece y no sAbíamos  de dónde sale
        if( strtoupper($action)!="LOGOUT")
        {
            if((strtoupper($module)) == "AUTORIZACION" || empty($module)){
                $module="autorizacion";
                $action="home";
            }else{  // si el módulo no es igual a autorización
                if($action==""){
                    //metodo por defecto de cada controller
                    $action = "EXECUTE";
                }

                $permisos = $configuration->getPermisoModel(); //llama a esa funcion para crear un PermisoModel

                $tieneAcceso = $permisos->validarAccesoASeccion($_SESSION['usuario'],strtoupper($module), strtoupper($action));
                   if(!$tieneAcceso){
                    $module="autorizacion"; //controlador
                    $action="sinPermiso";   //funcion del controlador
                }
            }
        }
}else{
    //si el usuario intenta entrar a un modulo que no sea registro o autorizacion,
    // (por ejemplo, si quiere ir directamente a la proforma x url)
    if( (strtoupper($module)!="AUTORIZACION" && strtoupper($module)!="REGISTRO") && !str_contains(strtoupper($module),'PUBLIC'))
    {
        $module="autorizacion";  //lo mandamos a la pantalla de login, si no está logueado
        $action="execute";
	}
}

$router = $configuration->getRouter();

$router->executeActionFromModule($action, $module);