<?php

class Router{

    private $configuration;

    public function __construct($configuration)
    {
        $this->configuration = $configuration;
    }

    public function executeActionFromModule($action, $module){
        $controller = $this->getControllerFrom($module);
        $this->executeMethodFromController($controller,$action);
    }

    private function getControllerFrom($module){  //chequea lo que el usuario le passe por url?
           //guardamos en una variable un string con get+nombreModulo+Controler
          $controllerName = "get" . ucfirst($module) . "Controller";
          //Se fija si existe en Configuración el nomnbre del controlador buscado. Si lo encuentra, devuelve el nombre del controlardor, y sino getAutorizacionControler
          $validController = method_exists($this->configuration, $controllerName) ?$controllerName : "getAutorizacionController";
          return call_user_func(array($this->configuration, $validController));
    }
    //el method sería el equivalente  a action
    private function executeMethodFromController($controller, $method){
        $validMethod = method_exists($controller, $method) ?$method : "execute";

        //Le asigna parámetros a un método
        call_user_func(array($controller, $validMethod));
    }
}