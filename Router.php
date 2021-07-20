<?php

class Router{

    private $configuration;

    public function __construct($configuration)
    {
        $this->configuration = $configuration;
    }

    public function executeActionFromModule($action, $module){
        $controller = $this->getControllerFrom($module); //DAME EL CONTROLLER
        $this->executeMethodFromController($controller,$action); //EJECUTÁ LA ACCIÓN DE ESE CONTROLER
    }

    private function getControllerFrom($module){
           //CREA UN NOMBRE DEL CONTROLER ANTERIOR: GET+ NOMBRE DEL CONTROLER CON MAYUSCULA INICIAL Y LA PALABRA CONTROLER
          $controllerName = "get" . ucfirst($module) . "Controller";
          //Se fija si existe en Configuración el nomnbre del controlador buscado. Si lo encuentra,
        // devuelve el nombre del controlador, y sino llama al por defecto
          $validController = method_exists($this->configuration, $controllerName) ?$controllerName : "getAutorizacionController";
          return call_user_func(array($this->configuration, $validController)); //llama al objeto configuration y le pide
        //que ejecute el metodo que se le pida, es decir, hace el new de un controler y lo devuelve
    }
    //el method sería el equivalente  a action
    private function executeMethodFromController($controller, $method){
        $validMethod = method_exists($controller, $method) ?$method : "execute";

        call_user_func(array($controller, $validMethod));
    }
}