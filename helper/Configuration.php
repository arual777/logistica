<?php
include_once("helper/MysqlDatabase.php");
include_once("helper/Render.php");
include_once("helper/UrlHelper.php");

include_once("model/UsuariosModel.php");

include_once("controller/AutorizacionController.php");
include_once("controller/UsuarioController.php");

include_once('third-party/mustache/src/Mustache/Autoloader.php');
include_once("Router.php");

class Configuration{
    private function getDatabase(){
        $config = $this->getConfig();
        return new MysqlDatabase(
            $config["servername"],
            $config["username"],
            $config["password"],
            $config["dbname"]
        );
    }

    private function getConfig(){
        return parse_ini_file("config/config.ini");
    }

    public function getRender(){
        return new Render('view/partial');
    }

    //Este método devuelve un objeto de la clase autorización controler y le pasa el parámetro que necesita
    public function getAutorizacionController(){
        return new AutorizacionController($this->getRender());
    }

    public function getUsuarioController(){
        return new UsuarioController($this->getRender());
    }

    public function getRouter(){
        return new Router($this);
    }

    public function getUrlHelper(){
        return new UrlHelper();
    }
}