<?php

class UrlHelper
{

    //Da el valor del módulo del request que envió el cliente o uno por defecto

    public function getModuleFromRequestOr($default){

        //Si la url tiene módulo, lo obtenemos y lo retornamos. Sino, usamos el valor por defecto que le pasamos por parámtro en el index.

        return isset($_GET["module"]) ? $_GET["module"] : $default;
    }
     //Con action es igual
    public function getActionFromRequestOr($default){
        return isset($_GET["action"]) ? $_GET["action"] : $default;
    }
}