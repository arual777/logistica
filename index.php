<?php
include_once("helper/Configuration.php");

session_start();
$configuration = new Configuration();

$urlHelper = $configuration->getUrlHelper();
$module = $urlHelper->getModuleFromRequestOr("autorizacion");
$action = $urlHelper->getActionFromRequestOr("execute");


if (!function_exists('str_contains')) {
    function str_contains($haystack, $needle) {
        return $needle !== '' && mb_strpos($haystack, $needle) !== false;
    }
}

//Valido que el usuario este en sesion
if(isset($_SESSION['usuario'])){
        //si la accion no es logout y el modulo (controllers)no contiene  a p[ublic, valido los permisos
        //agregamos el public porque en los request aparece y no sAbíamos  de dónde sale
        if( strtoupper($action)!="LOGOUT" && !str_contains(strtoupper($module),'PUBLIC'))
        {
            if((strtoupper($module)) == "AUTORIZACION" || empty($module)){
                //si actualiza la página, y el usuario ya está logueado, lo mandamos a la home.
                //así prevenimos que se loguee dos veces
                $module="autorizacion";
                $action="home"; //FUNCION DEL CONTTROLER AUTORizacion. QUE RENDERIZA A LA VISTA DE USUARIO
            }else{
                //en ocasiones el action aparece vacio
                //cuando esta vacio le ponemos la accion por defecto
                if($action==""){
                    //metodo por defecto de cada controller
                    $action = "EXECUTE";
                }
                $permisos = $configuration->getPermisoModel(); //llama a esa funcion para crear un PermisoModel
                $tieneAcceso = $permisos->validarAccesoASeccion($_SESSION['usuario'],strtoupper($module), strtoupper($action));
                //si no tiene acceso lo mando al controller autorizacion y a una accion que le muestre
                //al usuario la pantalla sin permiso.
                if(!$tieneAcceso){
                    $module="autorizacion"; //controlador
                    $action="sinPermiso";   //funcion del controlador
                }
            }
        }
}else{
    //aca entra cuando el usuario no esta en sesion
    //si el usuario intenta entrar a un modulo que no sea registro o autorizacion lo mandamos a la pantalla de error (por ejemplo, si quiere ir directamente a la proforma x url)
    //esto es porque los unicos modulos que puede usar cuando aun no se logueo es autorizacion (para loguearse) o registro (para registrarse)
    if( (strtoupper($module)!="AUTORIZACION" && strtoupper($module)!="REGISTRO") && !str_contains(strtoupper($module),'PUBLIC'))
    {
        $module="autorizacion";  //lo mandamos a la pantalla de login, si no está logueado
        $action="execute"; //manda al execute
	}
}

$router = $configuration->getRouter();
//enviA LOS VALORES GUARDADOS EM LAS VARIABLES
$router->executeActionFromModule($action, $module);